<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan_pengiriman extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Perusahaan_pengiriman_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'perusahaan_pengiriman/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'perusahaan_pengiriman/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'perusahaan_pengiriman/index';
            $config['first_url'] = base_url() . 'perusahaan_pengiriman/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Perusahaan_pengiriman_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $perusahaan_pengiriman = $this->Perusahaan_pengiriman_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'perusahaan_pengiriman_data' => $perusahaan_pengiriman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('perusahaan_pengiriman/perusahaan_pengiriman_list', $data);
    }

    public function read($id)
    {
        $row = $this->Perusahaan_pengiriman_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'sk' => $row->sk,
		'npwp' => $row->npwp,
		'pph' => $row->pph,
		'total_pph' => $row->total_pph,
		'unix' => $row->unix,
		'status' => $row->status,
	    );
            $this->render_view('perusahaan_pengiriman/perusahaan_pengiriman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan_pengiriman'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('perusahaan_pengiriman/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'sk' => set_value('sk'),
	    'npwp' => set_value('npwp'),
	    'pph' => set_value('pph'),
	    'total_pph' => set_value('total_pph'),
	    'unix' => set_value('unix'),
	    'status' => set_value('status'),
	);
        $this->render_view('perusahaan_pengiriman/perusahaan_pengiriman_form', $data);
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
		'sk' => $this->input->post('sk',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'pph' => $this->input->post('pph',TRUE),
		'total_pph' => $this->input->post('total_pph',TRUE),
		'unix' => $this->input->post('unix',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Perusahaan_pengiriman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('perusahaan_pengiriman'));
        }
    }

    public function update($id)
    {
        $row = $this->Perusahaan_pengiriman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('perusahaan_pengiriman/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'sk' => set_value('sk', $row->sk),
		'npwp' => set_value('npwp', $row->npwp),
		'pph' => set_value('pph', $row->pph),
		'total_pph' => set_value('total_pph', $row->total_pph),
		'unix' => set_value('unix', $row->unix),
		'status' => set_value('status', $row->status),
	    );
            $this->render_view('perusahaan_pengiriman/perusahaan_pengiriman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan_pengiriman'));
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
		'sk' => $this->input->post('sk',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'pph' => $this->input->post('pph',TRUE),
		'total_pph' => $this->input->post('total_pph',TRUE),
		'unix' => $this->input->post('unix',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Perusahaan_pengiriman_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('perusahaan_pengiriman'));
        }
    }

    public function delete($id)
    {
        $row = $this->Perusahaan_pengiriman_model->get_by_id($id);

        if ($row) {
            $this->Perusahaan_pengiriman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perusahaan_pengiriman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan_pengiriman'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('sk', 'sk', 'trim|required');
	$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
	$this->form_validation->set_rules('pph', 'pph', 'trim|required|numeric');
	$this->form_validation->set_rules('total_pph', 'total pph', 'trim|required|numeric');
	$this->form_validation->set_rules('unix', 'unix', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Perusahaan_pengiriman.php */
/* Location: ./application/controllers/Perusahaan_pengiriman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 17:17:47 */
/* http://harviacode.com */