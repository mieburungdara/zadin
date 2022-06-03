<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan_model extends CI_Model
{
    public $table = 'permohonan';
    public $id    = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_limit_data_array($start = 0, $limit, $q = null, $permohonan_jenis = null, $bulan = null, $tahun = null, $status = null, $kapal = null, $barang = null, $tempat_muat = null)
    {
        $this->db->order_by($this->id, "DESC");
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

    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('operasional', $q);
        $this->db->or_like('tempat_bongkar', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_perusahaan_data($start = 0, $limit, $bulan = null, $tahun = null, $perusahaan = null, $search = null)
    {
        $this->db->order_by($this->id, "DESC");
        if ($perusahaan != null) {
            $this->db->where('id', $perusahaan);
            $perusahaan_data = $this->db->get('perusahaan')->row();
            if ($perusahaan_data) {
                $this->db->where('perusahaan', $perusahaan_data->id);
                $operasional_data = $this->db->get('operasional')->result();
                if ($operasional_data) {
                    if ($search != null) {
                        $this->db->or_like('tempat_bongkar', $search);
                    }
                    if ($bulan != null) {
                        $this->db->where('MONTH(mulai)', $bulan);
                    }
                    if ($tahun != null) {
                        $this->db->where('YEAR(mulai)', $tahun);
                    }
                    foreach ($operasional_data as $opeitem) {
                        $this->db->where('operasional', $opeitem->id);
                    }
                    $this->db->limit($limit, $start);
                    return $this->db->get('permohonan')->result_array();
                }
            }
        } else {
            if ($search != null) {
                $this->db->or_like('tempat_bongkar', $search);
            }
            if ($bulan != null) {
                $this->db->where('MONTH(mulai)', $bulan);
            }
            if ($tahun != null) {
                $this->db->where('YEAR(mulai)', $tahun);
            }
            $this->db->limit($limit, $start);
            return $this->db->get($this->table)->result_array();
        }
    }
    public function get_terminal_data($start = 0, $limit, $bulan = null, $tahun = null)
    {
        $this->db->order_by($this->id, "DESC");
        if ($bulan != null) {
            $this->db->where('MONTH(mulai)', $bulan);
        }
        if ($tahun != null) {
            $this->db->where('YEAR(mulai)', $tahun);
        }
        $this->db->limit($limit, $start);
        return $this->db->get('permohonan')->result_array();
    }
}