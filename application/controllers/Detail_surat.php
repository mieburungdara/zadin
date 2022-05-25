<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Detail_surat extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_surat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'detail_surat/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'detail_surat/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'detail_surat/index';
            $config['first_url'] = base_url() . 'detail_surat/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Detail_surat_model->total_rows($q);
        $config['attributes'] = array('class' => 'page-link');
        $detail_surat = $this->Detail_surat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'detail_surat_data' => $detail_surat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->render_view('detail_surat/detail_surat_list', $data);
    }

    public function read($id)
    {
        $row = $this->Detail_surat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no' => $row->no,
		'perusahaan' => $row->perusahaan,
		'jenis' => $row->jenis,
		'bulan' => $row->bulan,
		'tahun' => $row->tahun,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->render_view('detail_surat/detail_surat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_surat'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('detail_surat/create_action'),
	    'id' => set_value('id'),
	    'no' => set_value('no'),
	    'perusahaan' => set_value('perusahaan'),
	    'jenis' => set_value('jenis'),
	    'bulan' => set_value('bulan'),
	    'tahun' => set_value('tahun'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->render_view('detail_surat/detail_surat_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'perusahaan' => $this->input->post('perusahaan',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'bulan' => $this->input->post('bulan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Detail_surat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('detail_surat'));
        }
    }

    public function update($id)
    {
        $row = $this->Detail_surat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('detail_surat/update_action'),
		'id' => set_value('id', $row->id),
		'no' => set_value('no', $row->no),
		'perusahaan' => set_value('perusahaan', $row->perusahaan),
		'jenis' => set_value('jenis', $row->jenis),
		'bulan' => set_value('bulan', $row->bulan),
		'tahun' => set_value('tahun', $row->tahun),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->render_view('detail_surat/detail_surat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_surat'));
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
		'perusahaan' => $this->input->post('perusahaan',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'bulan' => $this->input->post('bulan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Detail_surat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('detail_surat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Detail_surat_model->get_by_id($id);

        if ($row) {
            $this->Detail_surat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('detail_surat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('detail_surat'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('no', 'no', 'trim|required|numeric');
	$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required|numeric');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required|numeric');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Detail_surat.php */
/* Location: ./application/controllers/Detail_surat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */