<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Barang_asal_model extends CI_Model
{

    public $table = 'barang_asal';
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
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('sk_brg', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('pph', $q);
        $this->db->or_like('total_pph', $q);
        $this->db->or_like('tarif_baru', $q);
        $this->db->or_like('tarif_perpanjang', $q);
        $this->db->or_like('tarif_revisi', $q);

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('sk_brg', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('jenis', $q);
        $this->db->or_like('pph', $q);
        $this->db->or_like('total_pph', $q);
        $this->db->or_like('unix', $q);
        $this->db->or_like('data_status', $q);
        $this->db->or_like('tarif_baru', $q);
        $this->db->or_like('tarif_perpanjang', $q);
        $this->db->or_like('tarif_revisi', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('updated_at', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_limit_data_array($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('sk_brg', $q);
        $this->db->or_like('npwp', $q);
        $this->db->or_like('pph', $q);
        $this->db->or_like('total_pph', $q);
        $this->db->or_like('tarif_baru', $q);
        $this->db->or_like('tarif_perpanjang', $q);
        $this->db->or_like('tarif_revisi', $q);
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Barang_asal_model.php */
/* Location: ./application/models/Barang_asal_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-10 10:55:45 */
/* http://harviacode.com */