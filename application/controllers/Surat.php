<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Surat extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Surat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'surat/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'surat/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'surat/index';
            $config['first_url'] = base_url() . 'surat/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Surat_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $surat = $this->Surat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'surat_data' => $surat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('surat/surat_list', $data);
    }

    public function read($id)
    {
        $row = $this->Surat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no' => $row->no,
		'jenis' => $row->jenis,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('surat/surat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('surat/create_action'),
	    'id' => set_value('id'),
	    'no' => set_value('no'),
	    'jenis' => set_value('jenis'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('surat/surat_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Surat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('surat'));
        }
    }

    public function update($id)
    {
        $row = $this->Surat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('surat/update_action'),
		'id' => set_value('id', $row->id),
		'no' => set_value('no', $row->no),
		'jenis' => set_value('jenis', $row->jenis),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('surat/surat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Surat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('surat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Surat_model->get_by_id($id);

        if ($row) {
            $this->Surat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('surat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('no', 'no', 'trim|required|numeric');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */