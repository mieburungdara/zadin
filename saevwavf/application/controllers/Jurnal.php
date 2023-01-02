<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jurnal extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Permohonan_model');
    }

    public function index()
    {
        $this->render_view('laporan/laporan_index');
    }
}