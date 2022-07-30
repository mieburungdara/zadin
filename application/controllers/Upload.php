<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index()
    {
        // $this->load->view('upload_form', array('error' => ' '));
    }

    public function pdfupload()
    {
        $rkbm = explode('/', $_SERVER['HTTP_REFERER']);
        $rkbm = end($rkbm);
        // exit;
        $config['upload_path']      = 'file/rkbm';
        $config['allowed_types']    = 'pdf';
        $config['file_name']        = 'rkbm_' . $rkbm;
        $config['file_ext_tolower'] = true;
        $config['overwrite']        = true;
        $this->upload->initialize($config);

        // $config['remove_spaces']        = true;
        // $config['max_size']      = 100;

        if (!$this->upload->do_upload('pdffile')) {
            $error = array('error' => $this->upload->display_errors());
            // var_dump($rkbm);
            // $this->load->view('upload_form', $error);
            // echo 'gagal';
            $this->session->set_flashdata('error', 'Gagal Meng-upload file..');
            redirect(base_url() . 'operasional/no/' . $rkbm, 'refresh');
        } else {
            // $data = array('upload_data' => $this->upload->data());
            // var_dump($data);
            $this->session->set_flashdata('success', 'Berhasil Diupload');
            redirect(base_url() . 'operasional/no/' . $rkbm, 'refresh');
            // echo 'sukses';
            // $data = array('upload_data' => $this->upload->data());

            // $this->load->view('upload_success', $data);
        }
    }
}

/* End of file Upload.php and path \application\controllers\Upload.php */