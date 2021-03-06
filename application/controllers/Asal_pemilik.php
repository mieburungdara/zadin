<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asal_pemilik extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Asal_pemilik_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'asal_pemilik/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'asal_pemilik/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'asal_pemilik/index';
            $config['first_url'] = base_url() . 'asal_pemilik/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Asal_pemilik_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $asal_pemilik = $this->Asal_pemilik_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'asal_pemilik_data' => $asal_pemilik,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('asal_pemilik/asal_pemilik_list', $data);
    }

    public function read($id)
    {
        $row = $this->Asal_pemilik_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'sk_brg' => $row->sk_brg,
		'npwp' => $row->npwp,
		'jenis' => $row->jenis,
		'pph' => $row->pph,
		'total_pph' => $row->total_pph,
		'unix' => $row->unix,
		'status' => $row->status,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('asal_pemilik/asal_pemilik_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asal_pemilik'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('asal_pemilik/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'sk_brg' => set_value('sk_brg'),
	    'npwp' => set_value('npwp'),
	    'jenis' => set_value('jenis'),
	    'pph' => set_value('pph'),
	    'total_pph' => set_value('total_pph'),
	    'unix' => set_value('unix'),
	    'status' => set_value('status'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('asal_pemilik/asal_pemilik_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'sk_brg' => $this->input->post('sk_brg',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'pph' => $this->input->post('pph',TRUE),
		'total_pph' => $this->input->post('total_pph',TRUE),
		'unix' => $this->input->post('unix',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Asal_pemilik_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('asal_pemilik'));
        }
    }

    public function update($id)
    {
        $row = $this->Asal_pemilik_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('asal_pemilik/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'sk_brg' => set_value('sk_brg', $row->sk_brg),
		'npwp' => set_value('npwp', $row->npwp),
		'jenis' => set_value('jenis', $row->jenis),
		'pph' => set_value('pph', $row->pph),
		'total_pph' => set_value('total_pph', $row->total_pph),
		'unix' => set_value('unix', $row->unix),
		'status' => set_value('status', $row->status),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('asal_pemilik/asal_pemilik_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asal_pemilik'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'sk_brg' => $this->input->post('sk_brg',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'pph' => $this->input->post('pph',TRUE),
		'total_pph' => $this->input->post('total_pph',TRUE),
		'unix' => $this->input->post('unix',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Asal_pemilik_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('asal_pemilik'));
        }
    }

    public function delete($id)
    {
        $row = $this->Asal_pemilik_model->get_by_id($id);

        if ($row) {
            $this->Asal_pemilik_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('asal_pemilik'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('asal_pemilik'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('sk_brg', 'sk brg', 'trim|required');
	$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required|numeric');
	$this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
	$this->form_validation->set_rules('total_pph', 'total pph', 'trim|required|numeric');
	$this->form_validation->set_rules('unix', 'unix', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required|numeric');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Asal_pemilik.php */
/* Location: ./application/controllers/Asal_pemilik.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */