<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_terminal extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_terminal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_terminal/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_terminal/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis_terminal/index';
            $config['first_url'] = base_url() . 'jenis_terminal/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_terminal_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $jenis_terminal = $this->Jenis_terminal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_terminal_data' => $jenis_terminal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('jenis_terminal/jenis_terminal_list', $data);
    }

    public function read($id)
    {
        $row = $this->Jenis_terminal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'keterangan' => $row->keterangan,
		'css' => $row->css,
	    );
            $this->render_view('jenis_terminal/jenis_terminal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_terminal'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_terminal/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'keterangan' => set_value('keterangan'),
	    'css' => set_value('css'),
	);
        $this->render_view('jenis_terminal/jenis_terminal_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'css' => $this->input->post('css',TRUE),
	    );

            $this->Jenis_terminal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_terminal'));
        }
    }

    public function update($id)
    {
        $row = $this->Jenis_terminal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_terminal/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'css' => set_value('css', $row->css),
	    );
            $this->render_view('jenis_terminal/jenis_terminal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_terminal'));
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
		'keterangan' => $this->input->post('keterangan',TRUE),
		'css' => $this->input->post('css',TRUE),
	    );

            $this->Jenis_terminal_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_terminal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jenis_terminal_model->get_by_id($id);

        if ($row) {
            $this->Jenis_terminal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_terminal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_terminal'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('css', 'css', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_terminal.php */
/* Location: ./application/controllers/Jenis_terminal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-25 11:13:53 */
/* http://harviacode.com */