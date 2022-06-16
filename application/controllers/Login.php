<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('dashboard', 'refresh');
        } else {
            $this->load->view('login/login');
        }
    }
    public function process()
    {
        // $this->load->view('login/login');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->aauth->login($username, $password)) {
            redirect('dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('error', "Username atau Password tidak sesuai..");
            redirect('login', 'refresh');
        }
        $this->aauth->print_errors();
    }
    public function logout()
    {
        $this->aauth->logout();
        redirect('login', 'refresh');
    }
}

/* End of file Login.php and path \application\controllers\Login.php */