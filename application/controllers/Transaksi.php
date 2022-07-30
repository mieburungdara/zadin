<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends Admin_controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->render_view('transaksi/index');
    }
}

/* End of file Transaksi.php and path \application\controllers\Transaksi.php */