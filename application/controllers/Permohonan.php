<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permohonan extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_model');
        $this->load->library('form_validation');
        $this->load->model('Agen_kapal_model');

    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'permohonan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'permohonan/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'permohonan/index';
            $config['first_url'] = base_url() . 'permohonan/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Permohonan_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $permohonan                  = $this->Permohonan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'permohonan_data' => $permohonan,
            'q'               => $q,
            'pagination'      => $this->pagination->create_links(),
            'total_rows'      => $config['total_rows'],
            'start'           => $start,
        );
        $this->render_view('permohonan/permohonan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'               => $row->id,
                'parent'           => $row->parent,
                'operasional'      => $row->operasional,
                'no_rkbm'          => $row->no_rkbm,
                'mulai'            => $row->mulai,
                'selesai'          => $row->selesai,
                'kapal'            => $row->kapal,
                'tempat_muat'      => $row->tempat_muat,
                'barang'           => $row->barang,
                'tempat_bongkar'   => $row->tempat_bongkar,
                'jumlah_asli'      => $row->jumlah_asli,
                'jumlah_kira'      => $row->jumlah_kira,
                'asal_barang'      => $row->asal_barang,
                'perusahaan'       => $row->perusahaan,
                'status'           => $row->status,
                'permohonan_jenis' => $row->permohonan_jenis,
            );
            $this->render_view('permohonan/permohonan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan'));
        }
    }
    public function read_json($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'               => $row->id,
                'parent'           => $row->parent,
                'operasional'      => $row->operasional,
                'no_rkbm'          => $row->no_rkbm,
                'mulai'            => $row->mulai,
                'selesai'          => $row->selesai,
                'kapal'            => $row->kapal,
                'tempat_muat'      => $row->tempat_muat,
                'barang'           => $row->barang,
                'tempat_bongkar'   => $row->tempat_bongkar,
                'jumlah_asli'      => $row->jumlah_asli,
                'jumlah_kira'      => $row->jumlah_kira,
                'permohonan_ke'    => $row->permohonan_ke,
                'payment'          => $row->payment,
                'status'           => $row->status,
                'permohonan_jenis' => $row->permohonan_jenis,
            );
            // $this->render_view('permohonan/permohonan_read', $data);
            echo json_encode($data);
        }
    }

    public function create()
    {
        $data = array(
            'button'           => 'Create',
            'action'           => site_url('permohonan/create_action'),
            'id'               => set_value('id'),
            'parent'           => set_value('parent'),
            'operasional'      => set_value('operasional'),
            'no_rkbm'          => set_value('no_rkbm'),
            'mulai'            => set_value('mulai'),
            'selesai'          => set_value('selesai'),
            'kapal'            => set_value('kapal'),
            'tempat_muat'      => set_value('tempat_muat'),
            'barang'           => set_value('barang'),
            'tempat_bongkar'   => set_value('tempat_bongkar'),
            'jumlah_asli'      => set_value('jumlah_asli'),
            'jumlah_kira'      => set_value('jumlah_kira'),
            'asal_barang'      => set_value('asal_barang'),
            'perusahaan'       => set_value('perusahaan'),
            'status'           => set_value('status'),
            'permohonan_jenis' => set_value('permohonan_jenis'),
        );
        $this->render_view('permohonan/permohonan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'parent'           => $this->input->post('parent', true),
                'operasional'      => $this->input->post('operasional', true),
                'no_rkbm'          => $this->input->post('no_rkbm', true),
                'mulai'            => $this->input->post('mulai', true),
                'selesai'          => $this->input->post('selesai', true),
                'kapal'            => $this->input->post('kapal', true),
                'tempat_muat'      => $this->input->post('tempat_muat', true),
                'barang'           => $this->input->post('barang', true),
                'tempat_bongkar'   => $this->input->post('tempat_bongkar', true),
                'jumlah_asli'      => $this->input->post('jumlah_asli', true),
                'jumlah_kira'      => $this->input->post('jumlah_kira', true),
                'status'           => $this->input->post('status', true),
                'permohonan_ke'    => $this->input->post('permohonan_ke', true),
                'permohonan_jenis' => $this->input->post('permohonan_jenis', true),
            );

            $this->Permohonan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('permohonan'));
        }
    }

    public function update($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button'           => 'Update',
                'action'           => site_url('permohonan/update_action'),
                'id'               => set_value('id', $row->id),
                'parent'           => set_value('parent', $row->parent),
                'operasional'      => set_value('operasional', $row->operasional),
                // 'no_rkbm'          => set_value('no_rkbm', $row->no_rkbm ? $row->no_rkbm : ''),
                 'mulai'            => set_value('mulai', $row->mulai),
                'selesai'          => set_value('selesai', $row->selesai),
                'kapal'            => set_value('kapal', $row->kapal),
                'tempat_muat'      => set_value('tempat_muat', $row->tempat_muat),
                'barang'           => set_value('barang', $row->barang),
                'tempat_bongkar'   => set_value('tempat_bongkar', $row->tempat_bongkar),
                'jumlah_asli'      => set_value('jumlah_asli', $row->jumlah_asli),
                'jumlah_kira'      => set_value('jumlah_kira', $row->jumlah_kira),
                'status'           => set_value('status', $row->status),
                'permohonan_ke'    => set_value('permohonan_ke', $row->permohonan_ke),
                'permohonan_jenis' => set_value('permohonan_jenis', $row->permohonan_jenis),
            );
            $this->render_view('permohonan/permohonan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'parent'           => $this->input->post('parent', true),
                'operasional'      => $this->input->post('operasional', true),
                'no_rkbm'          => $this->input->post('no_rkbm', true),
                'mulai'            => $this->input->post('mulai', true),
                'selesai'          => $this->input->post('selesai', true),
                'kapal'            => $this->input->post('kapal', true),
                'tempat_muat'      => $this->input->post('tempat_muat', true),
                'barang'           => $this->input->post('barang', true),
                'tempat_bongkar'   => $this->input->post('tempat_bongkar', true),
                'jumlah_asli'      => $this->input->post('jumlah_asli', true),
                'jumlah_kira'      => $this->input->post('jumlah_kira', true),
                'status'           => $this->input->post('status', true),
                'permohonan_ke'    => $this->input->post('permohonan_ke', true),
                'permohonan_jenis' => $this->input->post('permohonan_jenis', true),
            );

            $this->Permohonan_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permohonan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);

        if ($row) {
            $re = $this->Permohonan_model->delete($id);
            // var_dump($re);
            if ($re == 'foreign_key') {
                echo json_encode(array('status' => 'error', 'data' => 'Foreign Key, Permohonan ini punya anak, mohon hapus anak untuk menghapus permohonan ini..'));
            } else {
                //
                echo json_encode(array('status' => 'success', 'data' => 'Permohonan Berhasil dihapus'));
            }
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            echo json_encode(array('status' => 'error', 'data' => 'gagal'));
            // redirect(site_url('permohonan'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('parent', 'parent', 'trim|required|numeric');
        $this->form_validation->set_rules('operasional', 'operasional', 'trim|required|numeric');
        $this->form_validation->set_rules('no_rkbm', 'no rkbm', 'trim|required|numeric');
        $this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
        $this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
        $this->form_validation->set_rules('kapal', 'kapal', 'trim|required|numeric');
        $this->form_validation->set_rules('tempat_muat', 'tempat muat', 'trim|required|numeric');
        $this->form_validation->set_rules('barang', 'barang', 'trim|required|numeric');
        $this->form_validation->set_rules('tempat_bongkar', 'tempat bongkar', 'trim|required');
        $this->form_validation->set_rules('jumlah_asli', 'jumlah asli', 'trim|required|numeric');
        $this->form_validation->set_rules('jumlah_kira', 'jumlah kira', 'trim|required|numeric');
        // $this->form_validation->set_rules('asal_barang', 'asal barang', 'trim|required|numeric');
        // $this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'status', 'trim|required|numeric');
        $this->form_validation->set_rules('permohonan_jenis', 'permohonan jenis', 'trim|required|numeric');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Permohonan.php */
/* Location: ./application/controllers/Permohonan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-03 10:40:27 */
/* http://harviacode.com */