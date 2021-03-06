<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{

    public $table = 'perusahaan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('inisial', $q);
	$this->db->or_like('kop', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('pelabuhan', $q);
	$this->db->or_like('sk_tuks', $q);
	$this->db->or_like('npwp', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('inisial', $q);
	$this->db->or_like('kop', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('pelabuhan', $q);
	$this->db->or_like('sk_tuks', $q);
	$this->db->or_like('npwp', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Perusahaan_model.php */
/* Location: ./application/models/Perusahaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */