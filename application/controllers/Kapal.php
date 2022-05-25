<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kapal extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kapal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q     = urldecode($this->input->get('q', true));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'kapal/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kapal/index?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'kapal/index';
            $config['first_url'] = base_url() . 'kapal/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Kapal_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $kapal                       = $this->Kapal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kapal_data' => $kapal,
            'q'          => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start'      => $start,
        );
        $this->render_view('kapal/kapal_list', $data);
    }

    public function read($id)
    {
        $row = $this->Kapal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'         => $row->id,
                'nama'       => $row->nama,
                'agen_kapal' => $row->agen_kapal,
                'bendera'    => $row->bendera,
                'ukuran'     => $row->ukuran,
                'status'     => $row->status,
            );
            $this->render_view('kapal/kapal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kapal'));
        }
    }
    public function read_json()
    {
        $id = trim($this->input->post('id', true));
        $this->db->where('agen_kapal', $id);
        $kapals = $this->db->get('kapal')->result();
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
                echo "<option value='" . $kapal->id . "' data-id='" . $kapal->ukuran . "' data-ukuran='" . $kapal->ukuran . "' data-bendera='" . strtoupper($kapal->bendera) . "'>" . $kapal->nama . "</>";
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
        $this->load->model('Agen_kapal_model');
        $data = array(
            'button'     => 'Create',
            'action'     => site_url('kapal/create_action'),
            'id'         => set_value('id'),
            'nama'       => set_value('nama'),
            'agen_kapal' => trim(set_value('agen_kapal')),
            'bendera'    => trim(set_value('bendera')),
            'ukuran'     => trim(set_value('ukuran')),
        );
        $this->render_view('kapal/kapal_form', $data);
    }

    public function create_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama'       => trim($this->input->post('nama', true)),
                'agen_kapal' => trim($this->input->post('agen_kapal', true)),
                'bendera'    => trim($this->input->post('bendera', true)),
                'ukuran'     => trim($this->input->post('ukuran', true)),
            );

            $this->Kapal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kapal'));
        }
    }

    public function update($id)
    {
        $row = $this->Kapal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'     => 'Update',
                'action'     => site_url('kapal/update_action'),
                'id'         => set_value('id', $row->id),
                'nama'       => set_value('nama', $row->nama),
                'agen_kapal' => set_value('agen_kapal', $row->agen_kapal),
                'bendera'    => set_value('bendera', $row->bendera),
                'ukuran'     => set_value('ukuran', $row->ukuran),
                'status'     => set_value('status', $row->status),
            );
            $this->render_view('kapal/kapal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kapal'));
        }
    }

    public function update_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'       => $this->input->post('nama', true),
                'agen_kapal' => $this->input->post('agen_kapal', true),
                'bendera'    => $this->input->post('bendera', true),
                'ukuran'     => $this->input->post('ukuran', true),
            );

            $this->Kapal_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kapal'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kapal_model->get_by_id($id);

        if ($row) {
            $this->Kapal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kapal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kapal'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('agen_kapal', 'agen kapal', 'trim|required|numeric');
        $this->form_validation->set_rules('bendera', 'bendera', 'trim|required');
        $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kapal.php */
/* Location: ./application/controllers/Kapal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-25 09:27:42 */
/* http://harviacode.com */
