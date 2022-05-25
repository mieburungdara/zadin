<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rkbm extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('Rkbm_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'rkbm/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'rkbm/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'rkbm/index';
            $config['first_url'] = base_url() . 'rkbm/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Rkbm_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $rkbm                        = $this->Rkbm_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rkbm_data'  => $rkbm,
            'q'          => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start'      => $start,
        );
        $this->render_view('rkbm/rkbm_list', $data);
    }

    public function read($id)
    {
        $row = $this->Rkbm_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'                  => $row->id,
                'no_surat_rkbm'       => $row->no_surat_rkbm,
                'exp_id'              => $row->exp_id,
                'no_rkbm'             => $row->no_rkbm,
                'no_invoice'          => $row->no_invoice,
                'nama_kapal'          => $row->nama_kapal,
                'bendera'             => $row->bendera,
                'ukuran'              => $row->ukuran,
                'agen'                => $row->agen,
                'bongkar'             => $row->bongkar,
                'jumlah'              => $row->jumlah,
                'jumlah_real'         => $row->jumlah_real,
                'mulai'               => $row->mulai,
                'selesai'             => $row->selesai,
                'buruh'               => $row->buruh,
                'asal_brg'            => $row->asal_brg,
                'pemilik_brg'         => $row->pemilik_brg,
                'tujuan'              => $row->tujuan,
                'jenis'               => $row->jenis,
                'loading'             => $row->loading,
                'loading_detail'      => $row->loading_detail,
                'operasional'         => $row->operasional,
                'biaya_operasional'   => $row->biaya_operasional,
                'keterangan'          => $row->keterangan,
                'status'              => $row->status,
                'tanggal'             => $row->tanggal,
                'tanggal_invoice'     => $row->tanggal_invoice,
                'tanggal_exp_invoice' => $row->tanggal_exp_invoice,
                'tanggal_final'       => $row->tanggal_final,
                'perusahaan'          => $row->perusahaan,
                'admin_by'            => $row->admin_by,
                'created_at'          => $row->created_at,
                'updated_at'          => $row->updated_at,
            );
            $this->render_view('rkbm/rkbm_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm'));
        }
    }

    public function create()
    {
        $this->load->model('Jenis_terminal_model');
        $this->load->model('Agen_kapal_model');
        $this->load->model('Asal_pemilik_model');
        $this->load->model('Perusahaan_model');
        $this->load->model('Barang_model');

        $data = array(
            'button'              => 'Create',
            'action'              => site_url('rkbm/create_action'),
            'id'                  => set_value('id'),
            'no_surat_rkbm'       => set_value('no_surat_rkbm'),
            'exp_id'              => set_value('exp_id'),
            'no_rkbm'             => set_value('no_rkbm'),
            'no_invoice'          => set_value('no_invoice'),
            'nama_kapal'          => set_value('nama_kapal'),
            'bendera'             => set_value('bendera'),
            'ukuran'              => set_value('ukuran'),
            'agen_kapal'          => set_value('agen'),
            'bongkar'             => set_value('bongkar'),
            'jumlah'              => set_value('jumlah'),
            'jumlah_real'         => set_value('jumlah_real'),
            'mulai'               => set_value('mulai'),
            'selesai'             => set_value('selesai'),
            'buruh'               => set_value('buruh'),
            'asal_brg'            => set_value('asal_brg'),
            'pemilik_brg'         => set_value('pemilik_brg'),
            'tujuan'              => set_value('tujuan'),
            'barang'              => set_value('jenis'),
            'jenis_terminal'      => set_value('jenis'),
            'loading'             => set_value('loading'),
            'loading_detail'      => set_value('loading_detail'),
            'operasional'         => set_value('operasional'),
            'biaya_operasional'   => set_value('biaya_operasional'),
            'keterangan'          => set_value('keterangan'),
            'status'              => set_value('status'),
            'tanggal'             => set_value('tanggal'),
            'tanggal_invoice'     => set_value('tanggal_invoice'),
            'tanggal_exp_invoice' => set_value('tanggal_exp_invoice'),
            'tanggal_final'       => set_value('tanggal_final'),
            'perusahaan'          => set_value('perusahaan'),
            'admin_by'            => set_value('admin_by'),
            'created_at'          => set_value('created_at'),
            'updated_at'          => set_value('updated_at'),
        );
        $this->render_view('kegiatan/kegiatan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama_kapal'          => $this->input->post('nama_kapal', true),
                'bendera'             => $this->input->post('bendera', true),
                'ukuran'              => $this->input->post('ukuran', true),
                'agen'                => $this->input->post('agen_kapal', true),
                'bongkar'             => $this->input->post('bongkar', true),
                'jumlah'              => $this->input->post('jumlah', true),
                'jumlah_real'         => $this->input->post('jumlah_real', true),
                'mulai'               => $this->input->post('mulai', true),
                'selesai'             => $this->input->post('selesai', true),
                'buruh'               => $this->input->post('buruh', true),
                'asal_brg'            => $this->input->post('asal_brg', true),
                'pemilik_brg'         => $this->input->post('pemilik_brg', true),
                'tujuan'              => $this->input->post('tujuan', true),
                'jenis'               => $this->input->post('jenis', true),
                'loading'             => $this->input->post('loading', true),
                'loading_detail'      => $this->input->post('loading_detail', true),
                'operasional'         => $this->input->post('operasional', true),
                'biaya_operasional'   => $this->input->post('biaya_operasional', true),
                'keterangan'          => $this->input->post('keterangan', true),
                'status'              => $this->input->post('status', true),
                'tanggal'             => $this->input->post('tanggal', true),
                'tanggal_invoice'     => $this->input->post('tanggal_invoice', true),
                'tanggal_exp_invoice' => $this->input->post('tanggal_exp_invoice', true),
                'tanggal_final'       => $this->input->post('tanggal_final', true),
                'perusahaan'          => $this->input->post('perusahaan', true),
                'admin_by'            => $this->input->post('admin_by', true),
                'created_at'          => $this->input->post('created_at', true),
                'updated_at'          => $this->input->post('updated_at', true),
            );

            $this->Rkbm_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rkbm'));
        }
    }

    public function update($id)
    {
        $row = $this->Rkbm_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'              => 'Update',
                'action'              => site_url('rkbm/update_action'),
                'id'                  => set_value('id', $row->id),
                'no_surat_rkbm'       => set_value('no_surat_rkbm', $row->no_surat_rkbm),
                'exp_id'              => set_value('exp_id', $row->exp_id),
                'no_rkbm'             => set_value('no_rkbm', $row->no_rkbm),
                'no_invoice'          => set_value('no_invoice', $row->no_invoice),
                'nama_kapal'          => set_value('nama_kapal', $row->nama_kapal),
                'bendera'             => set_value('bendera', $row->bendera),
                'ukuran'              => set_value('ukuran', $row->ukuran),
                'agen'                => set_value('agen', $row->agen),
                'bongkar'             => set_value('bongkar', $row->bongkar),
                'jumlah'              => set_value('jumlah', $row->jumlah),
                'jumlah_real'         => set_value('jumlah_real', $row->jumlah_real),
                'mulai'               => set_value('mulai', $row->mulai),
                'selesai'             => set_value('selesai', $row->selesai),
                'buruh'               => set_value('buruh', $row->buruh),
                'asal_brg'            => set_value('asal_brg', $row->asal_brg),
                'pemilik_brg'         => set_value('pemilik_brg', $row->pemilik_brg),
                'tujuan'              => set_value('tujuan', $row->tujuan),
                'jenis'               => set_value('jenis', $row->jenis),
                'loading'             => set_value('loading', $row->loading),
                'loading_detail'      => set_value('loading_detail', $row->loading_detail),
                'operasional'         => set_value('operasional', $row->operasional),
                'biaya_operasional'   => set_value('biaya_operasional', $row->biaya_operasional),
                'keterangan'          => set_value('keterangan', $row->keterangan),
                'status'              => set_value('status', $row->status),
                'tanggal'             => set_value('tanggal', $row->tanggal),
                'tanggal_invoice'     => set_value('tanggal_invoice', $row->tanggal_invoice),
                'tanggal_exp_invoice' => set_value('tanggal_exp_invoice', $row->tanggal_exp_invoice),
                'tanggal_final'       => set_value('tanggal_final', $row->tanggal_final),
                'perusahaan'          => set_value('perusahaan', $row->perusahaan),
                'admin_by'            => set_value('admin_by', $row->admin_by),
                'created_at'          => set_value('created_at', $row->created_at),
                'updated_at'          => set_value('updated_at', $row->updated_at),
            );
            $this->render_view('rkbm/rkbm_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'no_surat_rkbm'       => $this->input->post('no_surat_rkbm', true),
                'exp_id'              => $this->input->post('exp_id', true),
                'no_rkbm'             => $this->input->post('no_rkbm', true),
                'no_invoice'          => $this->input->post('no_invoice', true),
                'nama_kapal'          => $this->input->post('nama_kapal', true),
                'bendera'             => $this->input->post('bendera', true),
                'ukuran'              => $this->input->post('ukuran', true),
                'agen'                => $this->input->post('agen', true),
                'bongkar'             => $this->input->post('bongkar', true),
                'jumlah'              => $this->input->post('jumlah', true),
                'jumlah_real'         => $this->input->post('jumlah_real', true),
                'mulai'               => $this->input->post('mulai', true),
                'selesai'             => $this->input->post('selesai', true),
                'buruh'               => $this->input->post('buruh', true),
                'asal_brg'            => $this->input->post('asal_brg', true),
                'pemilik_brg'         => $this->input->post('pemilik_brg', true),
                'tujuan'              => $this->input->post('tujuan', true),
                'jenis'               => $this->input->post('jenis', true),
                'loading'             => $this->input->post('loading', true),
                'loading_detail'      => $this->input->post('loading_detail', true),
                'operasional'         => $this->input->post('operasional', true),
                'biaya_operasional'   => $this->input->post('biaya_operasional', true),
                'keterangan'          => $this->input->post('keterangan', true),
                'status'              => $this->input->post('status', true),
                'tanggal'             => $this->input->post('tanggal', true),
                'tanggal_invoice'     => $this->input->post('tanggal_invoice', true),
                'tanggal_exp_invoice' => $this->input->post('tanggal_exp_invoice', true),
                'tanggal_final'       => $this->input->post('tanggal_final', true),
                'perusahaan'          => $this->input->post('perusahaan', true),
                'admin_by'            => $this->input->post('admin_by', true),
                'created_at'          => $this->input->post('created_at', true),
                'updated_at'          => $this->input->post('updated_at', true),
            );

            $this->Rkbm_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rkbm'));
        }
    }

    public function delete($id)
    {
        $row = $this->Rkbm_model->get_by_id($id);

        if ($row) {
            $this->Rkbm_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rkbm'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('no_surat_rkbm', 'no surat rkbm', 'trim|required|numeric');
        $this->form_validation->set_rules('exp_id', 'exp id', 'trim|required|numeric');
        $this->form_validation->set_rules('no_rkbm', 'no rkbm', 'trim|required');
        $this->form_validation->set_rules('no_invoice', 'no invoice', 'trim|required');
        $this->form_validation->set_rules('nama_kapal', 'nama kapal', 'trim|required');
        $this->form_validation->set_rules('bendera', 'bendera', 'trim|required');
        $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required');
        $this->form_validation->set_rules('agen', 'agen', 'trim|required');
        $this->form_validation->set_rules('bongkar', 'bongkar', 'trim|required|numeric');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('jumlah_real', 'jumlah real', 'trim|required|numeric');
        $this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
        $this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
        $this->form_validation->set_rules('buruh', 'buruh', 'trim|required|numeric');
        $this->form_validation->set_rules('asal_brg', 'asal brg', 'trim|required|numeric');
        $this->form_validation->set_rules('pemilik_brg', 'pemilik brg', 'trim|required|numeric');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
        $this->form_validation->set_rules('loading', 'loading', 'trim|required|numeric');
        $this->form_validation->set_rules('loading_detail', 'loading detail', 'trim|required|numeric');
        $this->form_validation->set_rules('operasional', 'operasional', 'trim|required');
        $this->form_validation->set_rules('biaya_operasional', 'biaya operasional', 'trim|required|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('tanggal_invoice', 'tanggal invoice', 'trim|required');
        $this->form_validation->set_rules('tanggal_exp_invoice', 'tanggal exp invoice', 'trim|required');
        $this->form_validation->set_rules('tanggal_final', 'tanggal final', 'trim|required');
        $this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required|numeric');
        $this->form_validation->set_rules('admin_by', 'admin by', 'trim|required|numeric');
        $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
        $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Rkbm.php */
/* Location: ./application/controllers/Rkbm.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */
