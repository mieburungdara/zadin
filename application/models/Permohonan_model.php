<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permohonan_model extends CI_Model
{
    public $table = 'permohonan';
    public $id    = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('parent', $q);
        $this->db->or_like('operasional', $q);
        $this->db->or_like('no_rkbm', $q);
        $this->db->or_like('mulai', $q);
        $this->db->or_like('selesai', $q);
        $this->db->or_like('kapal', $q);
        $this->db->or_like('tempat_muat', $q);
        $this->db->or_like('barang', $q);
        $this->db->or_like('tempat_bongkar', $q);
        $this->db->or_like('jumlah_muatan', $q);
        $this->db->or_like('jumlah_asli', $q);
        $this->db->or_like('jumlah_bongkar', $q);
        $this->db->or_like('asal_barang', $q);
        $this->db->or_like('perusahaan', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('permohonan_jenis', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get total rows
    public function read_total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('tempat_bongkar', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function read_get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('tempat_bongkar', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    public function get_limit_data_array($id, $start = 0, $limit, $q = null, $perusahaan = null, $bulan = null, $tahun = null, $status = null, $kapal = null, $barang = null, $no_rkbm = null, $tempat_muat = null, $permohonan_jenis = null)
    {
        $this->db->where('operasional', $id);
        $this->db->order_by($this->id, "ASC");
        if ($perusahaan != null) {
            $this->db->where('perusahaan', $perusahaan);
        }
        if ($bulan != null) {
            $this->db->where('MONTH(mulai)', $bulan);
        }
        if ($tahun != null) {
            $this->db->where('YEAR(mulai)', $tahun);
        }
        if ($status != null) {
            $this->db->where('status', $status);
        }
        if ($kapal != null) {
            $this->db->where('kapal', $kapal);
        }
        if ($barang != null) {
            $this->db->where('barang', $barang);
        }
        if ($no_rkbm != null) {
            $this->db->where('no_rkbm', $no_rkbm);
        }
        if ($permohonan_jenis != null) {
            $this->db->where('permohonan_jenis', $permohonan_jenis);
        }
        if ($tempat_muat != null) {
            $this->db->where('tempat_muat', $tempat_muat);
        }
        if ($q != null) {
            $this->db->like('id', $q);
            $this->db->or_like('tempat_bongkar', $q);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('parent', $q);
        $this->db->or_like('operasional', $q);
        $this->db->or_like('no_rkbm', $q);
        $this->db->or_like('mulai', $q);
        $this->db->or_like('selesai', $q);
        $this->db->or_like('kapal', $q);
        $this->db->or_like('tempat_muat', $q);
        $this->db->or_like('barang', $q);
        $this->db->or_like('tempat_bongkar', $q);
        $this->db->or_like('jumlah_muatan', $q);
        $this->db->or_like('jumlah_asli', $q);
        $this->db->or_like('jumlah_bongkar', $q);
        $this->db->or_like('asal_barang', $q);
        $this->db->or_like('perusahaan', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('permohonan_jenis', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    public function delete($id)
    {

        if (!$this->db->delete('permohonan', array('id' => $id))) {

            $error = $this->db->error();
            // var_dump($error);
            if ($error['code'] == 1451) {
                return 'foreign_key';
            }
            return $error;
        }
        // $this->db->where($this->id, $id);
        // $hapus = $this->db->delete($this->table);
        // // var_dump($hapus);
        // if ($hapus) {
        //     return true;
        // } else {
        //     if ($this->db->_error_number() == 1451) {
        //         echo  'foreign_key';
        //     }
        // }
    }
}