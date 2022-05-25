<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permohonan_jenis extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_jenis_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'permohonan_jenis/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'permohonan_jenis/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'permohonan_jenis/index';
            $config['first_url'] = base_url() . 'permohonan_jenis/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Permohonan_jenis_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $permohonan_jenis = $this->Permohonan_jenis_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'permohonan_jenis_data' => $permohonan_jenis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('permohonan_jenis/permohonan_jenis_list', $data);
    }

    public function read($id)
    {
        $row = $this->Permohonan_jenis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
	    );
            $this->render_view('permohonan_jenis/permohonan_jenis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_jenis'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('permohonan_jenis/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	);
        $this->render_view('permohonan_jenis/permohonan_jenis_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Permohonan_jenis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('permohonan_jenis'));
        }
    }

    public function update($id)
    {
        $row = $this->Permohonan_jenis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('permohonan_jenis/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
	    );
            $this->render_view('permohonan_jenis/permohonan_jenis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_jenis'));
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
	    );

            $this->Permohonan_jenis_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('permohonan_jenis'));
        }
    }

    public function delete($id)
    {
        $row = $this->Permohonan_jenis_model->get_by_id($id);

        if ($row) {
            $this->Permohonan_jenis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('permohonan_jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('permohonan_jenis'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Permohonan_jenis.php */
/* Location: ./application/controllers/Permohonan_jenis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-03 10:40:32 */
/* http://harviacode.com */