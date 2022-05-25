<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'invoice/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'invoice/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'invoice/index';
            $config['first_url'] = base_url() . 'invoice/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Invoice_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $invoice = $this->Invoice_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'invoice_data' => $invoice,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('invoice/invoice_list', $data);
    }

    public function read($id)
    {
        $row = $this->Invoice_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'other_key' => $row->other_key,
		'no' => $row->no,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('invoice/invoice_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('invoice/create_action'),
	    'id' => set_value('id'),
	    'other_key' => set_value('other_key'),
	    'no' => set_value('no'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('invoice/invoice_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'other_key' => $this->input->post('other_key',TRUE),
		'no' => $this->input->post('no',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Invoice_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('invoice'));
        }
    }

    public function update($id)
    {
        $row = $this->Invoice_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('invoice/update_action'),
		'id' => set_value('id', $row->id),
		'other_key' => set_value('other_key', $row->other_key),
		'no' => set_value('no', $row->no),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('invoice/invoice_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'other_key' => $this->input->post('other_key',TRUE),
		'no' => $this->input->post('no',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Invoice_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('invoice'));
        }
    }

    public function delete($id)
    {
        $row = $this->Invoice_model->get_by_id($id);

        if ($row) {
            $this->Invoice_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('invoice'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('other_key', 'other key', 'trim|required|numeric');
	$this->form_validation->set_rules('no', 'no', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */