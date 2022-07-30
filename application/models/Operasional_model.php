<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Operasional_model extends CI_Model
{

    public $table = 'operasional';
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
        return $this->db->get($this->table)->result_array();
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
        $this->db->or_like('nama', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('operasional_status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('operasional_status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // get data with limit and search
    public function get_limit_data_array($limit, $start = 0, $q = null, $perusahaan = null, $bulan = null, $tahun = null, $status = null)
    {
        $this->db->order_by($this->id, $this->order);
        if ($perusahaan != null) {
            $this->db->where('perusahaan', $perusahaan);
        }
        if ($bulan != null) {
            $this->db->where('MONTH(updated_at)', $bulan);
        }
        if ($tahun != null) {
            $this->db->where('YEAR(updated_at)', $tahun);
        }
        if ($status != null) {
            $this->db->where('operasional_status', $status);
        }
        if ($q != null) {
            $this->db->like('id', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('keterangan', $q);
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
    }
    // get data search
    public function get_total_data_array($q = null, $perusahaan = null, $bulan = null, $tahun = null, $status = null)
    {
        $this->db->order_by($this->id, $this->order);
        if ($perusahaan != null) {
            $this->db->where('perusahaan', $perusahaan);
        }
        if ($bulan != null) {
            $this->db->where('MONTH(updated_at)', $bulan);
        }
        if ($tahun != null) {
            $this->db->where('YEAR(updated_at)', $tahun);
        }
        if ($status != null) {
            $this->db->where('operasional_status', $status);
        }
        if ($q != null) {
            $this->db->like('id', $q);
            $this->db->or_like('nama', $q);
            $this->db->or_like('keterangan', $q);
        }
        // $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Operasional_model.php */
/* Location: ./application/models/Operasional_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-27 05:31:40 */
/* http://harviacode.com */