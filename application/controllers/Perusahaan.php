<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Perusahaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'perusahaan/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'perusahaan/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'perusahaan/index';
            $config['first_url'] = base_url() . 'perusahaan/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Perusahaan_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $perusahaan = $this->Perusahaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'perusahaan_data' => $perusahaan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('perusahaan/perusahaan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Perusahaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'inisial' => $row->inisial,
		'kop' => $row->kop,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'pelabuhan' => $row->pelabuhan,
		'sk_tuks' => $row->sk_tuks,
		'npwp' => $row->npwp,
		'status' => $row->status,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('perusahaan/perusahaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('perusahaan/create_action'),
	    'id' => set_value('id'),
	    'inisial' => set_value('inisial'),
	    'kop' => set_value('kop'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'pelabuhan' => set_value('pelabuhan'),
	    'sk_tuks' => set_value('sk_tuks'),
	    'npwp' => set_value('npwp'),
	    'status' => set_value('status'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('perusahaan/perusahaan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'inisial' => $this->input->post('inisial',TRUE),
		'kop' => $this->input->post('kop',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'pelabuhan' => $this->input->post('pelabuhan',TRUE),
		'sk_tuks' => $this->input->post('sk_tuks',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Perusahaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('perusahaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('perusahaan/update_action'),
		'id' => set_value('id', $row->id),
		'inisial' => set_value('inisial', $row->inisial),
		'kop' => set_value('kop', $row->kop),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'pelabuhan' => set_value('pelabuhan', $row->pelabuhan),
		'sk_tuks' => set_value('sk_tuks', $row->sk_tuks),
		'npwp' => set_value('npwp', $row->npwp),
		'status' => set_value('status', $row->status),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('perusahaan/perusahaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'inisial' => $this->input->post('inisial',TRUE),
		'kop' => $this->input->post('kop',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'pelabuhan' => $this->input->post('pelabuhan',TRUE),
		'sk_tuks' => $this->input->post('sk_tuks',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Perusahaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('perusahaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Perusahaan_model->get_by_id($id);

        if ($row) {
            $this->Perusahaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('perusahaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('perusahaan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('inisial', 'inisial', 'trim|required');
	$this->form_validation->set_rules('kop', 'kop', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('pelabuhan', 'pelabuhan', 'trim|required');
	$this->form_validation->set_rules('sk_tuks', 'sk tuks', 'trim|required');
	$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Perusahaan.php */
/* Location: ./application/controllers/Perusahaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */