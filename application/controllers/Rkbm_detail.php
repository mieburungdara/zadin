<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rkbm_detail extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rkbm_detail_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'rkbm_detail/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'rkbm_detail/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'rkbm_detail/index';
            $config['first_url'] = base_url() . 'rkbm_detail/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Rkbm_detail_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $rkbm_detail = $this->Rkbm_detail_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'rkbm_detail_data' => $rkbm_detail,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('rkbm_detail/rkbm_detail_list', $data);
    }

    public function read($id)
    {
        $row = $this->Rkbm_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'rkbm_id' => $row->rkbm_id,
		'no' => $row->no,
		'price' => $row->price,
		'price_other' => $row->price_other,
		'mulai' => $row->mulai,
		'selesai' => $row->selesai,
		'status' => $row->status,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('rkbm_detail/rkbm_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm_detail'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('rkbm_detail/create_action'),
	    'id' => set_value('id'),
	    'rkbm_id' => set_value('rkbm_id'),
	    'no' => set_value('no'),
	    'price' => set_value('price'),
	    'price_other' => set_value('price_other'),
	    'mulai' => set_value('mulai'),
	    'selesai' => set_value('selesai'),
	    'status' => set_value('status'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('rkbm_detail/rkbm_detail_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'rkbm_id' => $this->input->post('rkbm_id',TRUE),
		'no' => $this->input->post('no',TRUE),
		'price' => $this->input->post('price',TRUE),
		'price_other' => $this->input->post('price_other',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
		'selesai' => $this->input->post('selesai',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Rkbm_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rkbm_detail'));
        }
    }

    public function update($id)
    {
        $row = $this->Rkbm_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rkbm_detail/update_action'),
		'id' => set_value('id', $row->id),
		'rkbm_id' => set_value('rkbm_id', $row->rkbm_id),
		'no' => set_value('no', $row->no),
		'price' => set_value('price', $row->price),
		'price_other' => set_value('price_other', $row->price_other),
		'mulai' => set_value('mulai', $row->mulai),
		'selesai' => set_value('selesai', $row->selesai),
		'status' => set_value('status', $row->status),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('rkbm_detail/rkbm_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm_detail'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'rkbm_id' => $this->input->post('rkbm_id',TRUE),
		'no' => $this->input->post('no',TRUE),
		'price' => $this->input->post('price',TRUE),
		'price_other' => $this->input->post('price_other',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
		'selesai' => $this->input->post('selesai',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Rkbm_detail_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rkbm_detail'));
        }
    }

    public function delete($id)
    {
        $row = $this->Rkbm_detail_model->get_by_id($id);

        if ($row) {
            $this->Rkbm_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rkbm_detail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rkbm_detail'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('rkbm_id', 'rkbm id', 'trim|required|numeric');
	$this->form_validation->set_rules('no', 'no', 'trim|required|numeric');
	$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
	$this->form_validation->set_rules('price_other', 'price other', 'trim|required|numeric');
	$this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
	$this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required|numeric');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Rkbm_detail.php */
/* Location: ./application/controllers/Rkbm_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */