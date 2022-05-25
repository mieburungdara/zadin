<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reza_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_tbl($table_schema)
    {
        $db2 = $this->load->database('root', true);
        return $db2->query("SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$table_schema' AND REFERENCED_TABLE_NAME IS NOT NULL")->result();

    }
    public function get_tbl_fk($table_schema, $table_name)
    {
        $db2 = $this->load->database('root', true);
        return $db2->query("SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND REFERENCED_TABLE_NAME IS NOT NULL")->result();

    }
    public function check_tbl_fk_exist($table_schema, $table_name, $COLUMN_NAME)
    {
        $db2    = $this->load->database('root', true);
        $adakah = $db2->query("SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$COLUMN_NAME'")->row();
        // return $adakah;
        return $adakah ? true : false;
    }
    public function get_tbl_fk_col($table_schema, $table_name, $referencedTableName)
    {
        $db2    = $this->load->database('root', true);
        $adakah = $db2->query("SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND REFERENCED_TABLE_NAME = '$referencedTableName'")->row();
        return $adakah ? $adakah->REFERENCED_COLUMN_NAME : '';
    }
    public function get_col_type($table_schema, $table_name, $column_name)
    {
        $db2    = $this->load->database('root', true);
        $adakah = $db2->query("SELECT DATA_TYPE FROM `COLUMNS` WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")->row();
        return $adakah ? $adakah->DATA_TYPE : '';
    }
    public function show_ref($table_schema, $table_name, $column_name)
    {
        $db2 = $this->load->database('root', true);
        $ada = $this->check_tbl_fk_exist($table_schema, $table_name, $column_name);
        if ($ada) {
            $adakah = $db2->query("SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM `KEY_COLUMN_USAGE` WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")->row();
            $adakah = array("table" => $adakah->REFERENCED_TABLE_NAME, "column" => $adakah->REFERENCED_COLUMN_NAME);
            return $adakah;
        } else {
            return false;
        }
    }
    public function get_ref_val($table_schema, $table_name, $column_name, $value)
    {
        $db2 = $this->load->database('root', true);
        $ada = $this->show_ref($table_schema, $table_name, $column_name);
        if ($ada) {
            $this->db->where($ada['column'], $value);
            $adakah = $this->db->get($ada['table'])->row();
        } else {
            $adakah = false;
        }
        return $adakah;
    }
    public function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array(1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        );

        $bulan = array(1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

}