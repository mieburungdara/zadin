<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Terminal extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Terminal';

        $this->load->model('Terminal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));
        if ($q != '') {
            $config['base_url']  = base_url() . 'terminal/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'terminal/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'terminal/index';
            $config['first_url'] = base_url() . 'terminal/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Terminal_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $terminal                    = $this->Terminal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'terminal_data' => $terminal,
            'q'             => $q,
            'pagination'    => $this->pagination->create_links(),
            'total_rows'    => $config['total_rows'],
            'start'         => $start,
        );
        $this->render_view('terminal/terminal_list', $data);
    }

    public function read($id)
    {
        $row = $this->Terminal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'         => $row->id,
                'nama'       => $row->nama,
                'lokasi'     => $row->lokasi,
                'pelabuhan'  => $row->pelabuhan,
                'sk_tuks'    => $row->sk_tuks,
                'npwp'       => $row->npwp,
                'jenis'      => $row->jenis,
                'status'     => $row->status,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            );
            $this->render_view('terminal/terminal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('terminal'));
        }
    }

    public function read_json()
    {
        $id = $this->input->post('id', true);
        $this->db->where('jenis', $id);
        $kapals = $this->db->get('terminal')->result();
        if ($kapals) {
            // $data = array(
            //     'id'         => $row->id,
            //     'nama'       => $row->nama,
            //     'agen_kapal' => $row->agen_kapal,
            //     'bendera'    => $row->bendera,
            //     'ukuran'     => $row->ukuran,
            //     'status'     => $row->status,
            // );
            foreach ($kapals as $kapal) {
                echo "<option value='" . $kapal->id . "'>" . $kapal->nama . "</>";
            }
            // $this->render_view('kapal/kapal_read', $data);
            // echo json_encode($data);
        } else {
            // $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('kapal'));
        }
    }
    public function create()
    {
        $data = array(
            'button'     => 'Create',
            'action'     => site_url('terminal/create_action'),
            'id'         => set_value('id'),
            'nama'       => set_value('nama'),
            'lokasi'     => set_value('lokasi'),
            'pelabuhan'  => set_value('pelabuhan'),
            'sk_tuks'    => set_value('sk_tuks'),
            'npwp'       => set_value('npwp'),
            'jenis'      => set_value('jenis'),
            'status'     => set_value('status'),
            'created_at' => set_value('created_at'),
            'updated_at' => set_value('updated_at'),
        );
        $this->render_view('terminal/terminal_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama'       => $this->input->post('nama', true),
                'lokasi'     => $this->input->post('lokasi', true),
                'pelabuhan'  => $this->input->post('pelabuhan', true),
                'sk_tuks'    => $this->input->post('sk_tuks', true),
                'npwp'       => $this->input->post('npwp', true),
                'jenis'      => $this->input->post('jenis', true),
                'status'     => $this->input->post('status', true),
                'created_at' => $this->input->post('created_at', true),
                'updated_at' => $this->input->post('updated_at', true),
            );

            $this->Terminal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('terminal'));
        }
    }

    public function update($id)
    {
        $row = $this->Terminal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'     => 'Update',
                'action'     => site_url('terminal/update_action'),
                'id'         => set_value('id', $row->id),
                'nama'       => set_value('nama', $row->nama),
                'lokasi'     => set_value('lokasi', $row->lokasi),
                'pelabuhan'  => set_value('pelabuhan', $row->pelabuhan),
                'sk_tuks'    => set_value('sk_tuks', $row->sk_tuks),
                'npwp'       => set_value('npwp', $row->npwp),
                'jenis'      => set_value('jenis', $row->jenis),
                'status'     => set_value('status', $row->status),
                'created_at' => set_value('created_at', $row->created_at),
                'updated_at' => set_value('updated_at', $row->updated_at),
            );
            $this->render_view('terminal/terminal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('terminal'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'       => $this->input->post('nama', true),
                'lokasi'     => $this->input->post('lokasi', true),
                'pelabuhan'  => $this->input->post('pelabuhan', true),
                'sk_tuks'    => $this->input->post('sk_tuks', true),
                'npwp'       => $this->input->post('npwp', true),
                'jenis'      => $this->input->post('jenis', true),
                'status'     => $this->input->post('status', true),
                'created_at' => $this->input->post('created_at', true),
                'updated_at' => $this->input->post('updated_at', true),
            );

            $this->Terminal_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('terminal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Terminal_model->get_by_id($id);

        if ($row) {
            $this->Terminal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('terminal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('terminal'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
        $this->form_validation->set_rules('pelabuhan', 'pelabuhan', 'trim|required');
        $this->form_validation->set_rules('sk_tuks', 'sk tuks', 'trim|required');
        $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
        $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Terminal.php */
/* Location: ./application/controllers/Terminal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */
