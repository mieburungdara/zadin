<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Barang_asal extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_asal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // $q     = urldecode($this->input->get('q', true));
        // $start = intval($this->input->get('start'));

        // if ($q != '') {
        //     $config['base_url']  = base_url() . 'barang_asal/index?q=' . urlencode($q);
        //     $config['first_url'] = base_url() . 'barang_asal/index?q=' . urlencode($q);
        // } else {
        //     $config['base_url']  = base_url() . 'barang_asal/index';
        //     $config['first_url'] = base_url() . 'barang_asal/index';
        // }

        // $config['per_page']          = 10;
        // $config['page_query_string'] = true;
        // $config['total_rows']        = $this->Barang_asal_model->total_rows($q);
        // $config['attributes']        = array('class' => 'page-link');
        // $barang_asal                 = $this->Barang_asal_model->get_limit_data($config['per_page'], $start, $q);

        // $this->load->library('pagination');
        // $this->pagination->initialize($config);

        // $data = array(
        //     'barang_asal_data' => $barang_asal,
        //     'q'                => $q,
        //     'pagination'       => $this->pagination->create_links(),
        //     'total_rows'       => $config['total_rows'],
        //     'start'            => $start,
        // );
        // $this->render_view('barang_asal/barang_asal_list', $data);
        $this->render_view('barang_asal/barang_asal_list');
    }

    public function load()
    {
        $start                    = urldecode($this->input->post('start', true));
        $length                   = urldecode($this->input->post('length', true));
        $search                   = urldecode($this->input->post('search[value]', true));
        $operasional              = $this->Barang_asal_model->get_limit_data_array($length, $start, $search);
        $get_all_data_operasional = $this->Barang_asal_model->get_all();
        $count_all_results        = $this->Barang_asal_model->total_rows($search);
        $count_all_data           = count($get_all_data_operasional);

        foreach ($operasional as $pal) {

            $ngaray['nama'] = '';
            $ngaray['nama'] .= $pal->nama;

            $ngaray['inisial'] = '';
            $ngaray['inisial'] .= $pal->inisial;

            $ngaray['alamat'] = '';
            $ngaray['alamat'] .= $pal->alamat;

            $ngaray['skb'] = '';
            $ngaray['skb'] .= $pal->sk_brg;

            $ngaray['npwp'] = '';
            $ngaray['npwp'] .= $pal->npwp;

            $ngaray['pph'] = '';
            $ngaray['pph'] .= $pal->npwp ? 'Ya' : 'Tidak';

            $ngaray['total_pph'] = '';
            $ngaray['total_pph'] .= $pal->total_pph ? $pal->total_pph . '%' : '';

            $ngaray['tb'] = '';
            $ngaray['tb'] .= $pal->tarif_baru;

            $ngaray['tp'] = '';
            $ngaray['tp'] .= $pal->tarif_perpanjang;

            $ngaray['tr'] = '';
            $ngaray['tr'] .= $pal->tarif_revisi;

            $ngaray['opsi'] = '';
            $ngaray['opsi'] .= anchor(site_url('barang_asal/update/' . $pal->id), 'Ubah', 'class="btn btn-xs waves-effect waves-light btn-outline-warning"');
            $ngaray['opsi'] .= anchor(site_url('barang_asal/delete/' . $pal->id), 'Hapus', 'class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"');

            $bum[] = $ngaray;
        }
        $bum    = $bum ?? null;
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
            "data"            => $bum,
        );

        echo json_encode($output);
    }

    public function read($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'               => $row->id,
                'nama'             => $row->nama,
                'alamat'           => $row->alamat,
                'sk_brg'           => $row->sk_brg,
                'npwp'             => $row->npwp,
                'jenis'            => $row->jenis,
                'pph'              => $row->pph,
                'total_pph'        => $row->total_pph,
                'unix'             => $row->unix,
                'data_status'      => $row->data_status,
                'tarif_baru'       => $row->tarif_baru,
                'tarif_perpanjang' => $row->tarif_perpanjang,
                'tarif_revisi'     => $row->tarif_revisi,
                'created_at'       => $row->created_at,
                'updated_at'       => $row->updated_at,
            );
            $this->render_view('barang_asal/barang_asal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function create()
    {
        $data = array(
            'button'           => 'Create',
            'action'           => site_url('barang_asal/create_action'),
            'id'               => set_value('id'),
            'nama'             => set_value('nama'),
            'alamat'           => set_value('alamat'),
            'sk_brg'           => set_value('sk_brg'),
            'npwp'             => set_value('npwp'),
            'jenis'            => set_value('jenis'),
            'pph'              => set_value('pph'),
            'total_pph'        => set_value('total_pph'),
            'unix'             => set_value('unix'),
            'data_status'      => set_value('data_status'),
            'tarif_baru'       => set_value('tarif_baru'),
            'tarif_perpanjang' => set_value('tarif_perpanjang'),
            'tarif_revisi'     => set_value('tarif_revisi'),
            'created_at'       => set_value('created_at'),
            'updated_at'       => set_value('updated_at'),
        );
        $this->render_view('barang_asal/barang_asal_form', $data);
    }

    public function create_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama'             => $this->input->post('nama', true),
                'inisial'          => $this->input->post('inisial', true),
                'alamat'           => $this->input->post('alamat', true),
                'sk_brg'           => $this->input->post('sk_brg', true),
                'npwp'             => $this->input->post('npwp', true),
                // 'jenis'            => $this->input->post('jenis', true),
                 'pph'              => $this->input->post('pph', true),
                'total_pph'        => $this->input->post('total_pph', true),
                // 'unix'             => $this->input->post('unix', true),
                 // 'data_status'      => $this->input->post('data_status', true),
                 'tarif_baru'       => $this->input->post('tarif_baru', true),
                'tarif_perpanjang' => $this->input->post('tarif_perpanjang', true),
                'tarif_revisi'     => $this->input->post('tarif_revisi', true),
                // 'created_at'       => $this->input->post('created_at', true),
                // 'updated_at'       => $this->input->post('updated_at', true),
            );

            $this->Barang_asal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_asal'));
        }
    }

    public function update($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'           => 'Update',
                'action'           => site_url('barang_asal/update_action'),
                'id'               => set_value('id', $row->id),
                'nama'             => set_value('nama', $row->nama),
                'inisial'          => set_value('inisial', $row->inisial),
                'alamat'           => set_value('alamat', $row->alamat),
                'sk_brg'           => set_value('sk_brg', $row->sk_brg),
                'npwp'             => set_value('npwp', $row->npwp),
                'pph'              => set_value('pph', $row->pph),
                'total_pph'        => set_value('total_pph', $row->total_pph),
                // 'unix'             => set_value('unix', $row->unix),
                 //  'data_status'      => set_value('data_status', $row->data_status),
                 'tarif_baru'       => set_value('tarif_baru', $row->tarif_baru),
                'tarif_perpanjang' => set_value('tarif_perpanjang', $row->tarif_perpanjang),
                'tarif_revisi'     => set_value('tarif_revisi', $row->tarif_revisi),
                // 'created_at'       => set_value('created_at', $row->created_at),
                // 'updated_at'       => set_value('updated_at', $row->updated_at),
            );
            $this->render_view('barang_asal/barang_asal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function update_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'             => $this->input->post('nama', true),
                'inisial'          => $this->input->post('inisial', true),
                'alamat'           => $this->input->post('alamat', true),
                'sk_brg'           => $this->input->post('sk_brg', true),
                'npwp'             => $this->input->post('npwp', true),
                // 'jenis'            => $this->input->post('jenis', true),
                 'pph'              => $this->input->post('pph', true),
                'total_pph'        => $this->input->post('total_pph', true),
                // 'unix'             => $this->input->post('unix', true),
                 // 'data_status'      => $this->input->post('data_status', true),
                 'tarif_baru'       => $this->input->post('tarif_baru', true),
                'tarif_perpanjang' => $this->input->post('tarif_perpanjang', true),
                'tarif_revisi'     => $this->input->post('tarif_revisi', true),
                // 'created_at'       => $this->input->post('created_at', true),
                // 'updated_at'       => $this->input->post('updated_at', true),
            );

            $res = $this->Barang_asal_model->update($this->input->post('id', true), $data);
            if ($res) {
                $error = $this->db->error();
                var_dump($error);
            } else {
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('barang_asal'));
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Barang_asal_model->get_by_id($id);

        if ($row) {
            $this->Barang_asal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_asal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_asal'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required', array('required' => 'tidak boleh kosong.'));
        $this->form_validation->set_rules('inisial', 'inisial', 'trim|required', array('required' => 'tidak boleh kosong.'));
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required', array('required' => 'tidak boleh kosong.'));
        $this->form_validation->set_rules('sk_brg', 'sk brg', 'trim|required', array('required' => 'tidak boleh kosong.'));
        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required', array('required' => 'tidak boleh kosong.'));
        // $this->form_validation->set_rules('jenis', 'jenis', 'trim|required|numeric');
        // $this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
        $this->form_validation->set_rules('total_pph', 'total pph', 'trim|required|numeric', array('required' => 'tidak boleh kosong.'));
        // $this->form_validation->set_rules('unix', 'unix', 'trim|required');
        // $this->form_validation->set_rules('data_status', 'data status', 'trim|required|numeric');
        // $this->form_validation->set_rules('tarif_baru', 'tarif baru', 'trim|required|numeric');
        // $this->form_validation->set_rules('tarif_perpanjang', 'tarif perpanjang', 'trim|required|numeric');
        // $this->form_validation->set_rules('tarif_revisi', 'tarif revisi', 'trim|required|numeric');
        // $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
        // $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Barang_asal.php */
/* Location: ./application/controllers/Barang_asal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-10 10:55:45 */
/* http://harviacode.com */