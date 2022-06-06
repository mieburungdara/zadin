<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Barang_pemilik extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_pemilik_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'barang_pemilik/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang_pemilik/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'barang_pemilik/index';
            $config['first_url'] = base_url() . 'barang_pemilik/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Barang_pemilik_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $barang_pemilik              = $this->Barang_pemilik_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_pemilik_data' => $barang_pemilik,
            'q'                   => $q,
            'pagination'          => $this->pagination->create_links(),
            'total_rows'          => $config['total_rows'],
            'start'               => $start,
        );
        $this->render_view('barang_pemilik/barang_pemilik_list', $data);
    }

    public function read($id)
    {
        $row = $this->Barang_pemilik_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'          => $row->id,
                'nama'        => $row->nama,
                'alamat'      => $row->alamat,
                'sk_brg'      => $row->sk_brg,
                'npwp'        => $row->npwp,
                'pph'         => $row->pph,
                'total_pph'   => $row->total_pph,
                'unix'        => $row->unix,
                'data_status' => $row->data_status,
                'created_at'  => $row->created_at,
                'updated_at'  => $row->updated_at,
            );
            $this->render_view('barang_pemilik/barang_pemilik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_pemilik'));
        }
    }

    public function create()
    {
        $data = array(
            'button'      => 'Create',
            'action'      => site_url('barang_pemilik/create_action'),
            'id'          => set_value('id'),
            'nama'        => set_value('nama'),
            'alamat'      => set_value('alamat'),
            'sk_brg'      => set_value('sk_brg'),
            'npwp'        => set_value('npwp'),
            'pph'         => set_value('pph'),
            'total_pph'   => set_value('total_pph'),
            'unix'        => set_value('unix'),
            'data_status' => set_value('data_status'),
        );
        $this->render_view('barang_pemilik/barang_pemilik_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama'        => $this->input->post('nama', true),
                'alamat'      => $this->input->post('alamat', true),
                'sk_brg'      => $this->input->post('sk_brg', true),
                'npwp'        => $this->input->post('npwp', true),
                'pph'         => $this->input->post('pph', true),
                'total_pph'   => $this->input->post('total_pph', true),
                'unix'        => $this->input->post('unix', true),
                'data_status' => $this->input->post('data_status', true),
            );

            $this->Barang_pemilik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_pemilik'));
        }
    }

    public function update($id)
    {
        $row = $this->Barang_pemilik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'      => 'Update',
                'action'      => site_url('barang_pemilik/update_action'),
                'id'          => set_value('id', $row->id),
                'nama'        => set_value('nama', $row->nama),
                'alamat'      => set_value('alamat', $row->alamat),
                'sk_brg'      => set_value('sk_brg', $row->sk_brg),
                'npwp'        => set_value('npwp', $row->npwp),
                'pph'         => set_value('pph', $row->pph),
                'total_pph'   => set_value('total_pph', $row->total_pph),
                'unix'        => set_value('unix', $row->unix),
                'data_status' => set_value('data_status', $row->data_status),
            );
            $this->render_view('barang_pemilik/barang_pemilik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_pemilik'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'        => $this->input->post('nama', true),
                'alamat'      => $this->input->post('alamat', true),
                'sk_brg'      => $this->input->post('sk_brg', true),
                'npwp'        => $this->input->post('npwp', true),
                'pph'         => $this->input->post('pph', true),
                'total_pph'   => $this->input->post('total_pph', true),
                'unix'        => $this->input->post('unix', true),
                'data_status' => $this->input->post('data_status', true),
            );

            $this->Barang_pemilik_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang_pemilik'));
        }
    }

    public function delete($id)
    {
        $row = $this->Barang_pemilik_model->get_by_id($id);

        if ($row) {
            $this->Barang_pemilik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_pemilik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_pemilik'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('sk_brg', 'sk brg', 'trim|required');
        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
        $this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
        $this->form_validation->set_rules('total_pph', 'total pph', 'trim|required|numeric');
        $this->form_validation->set_rules('unix', 'unix', 'trim|required');
        $this->form_validation->set_rules('data_status', 'data status', 'trim|required|numeric');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Barang_pemilik.php */
/* Location: ./application/controllers/Barang_pemilik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-10 10:55:35 */
/* http://harviacode.com */