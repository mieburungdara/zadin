<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
    }
    public function kode()
    {
        $this->render_view('akun/kode');
    }
    public function kode_tambah()
    {
        $name       = urldecode($this->input->post('input_name', true)) ?? null;
        $kelompok   = urldecode($this->input->post('input_kelompok', true)) ?? null;
        $kode       = urldecode($this->input->post('input_kode', true)) ?? null;
        $keterangan = urldecode($this->input->post('input_keterangan', true)) ?? null;
        if ($name && $kelompok && $kode) {
            $data = array(
                'kode'       => $kode,
                'nama'       => $name,
                'keterangan' => $keterangan,
                'kelompok'   => $kelompok,
            );
            $this->db->insert('akun_kode', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
    }
    public function kode_ubah()
    {
        $id         = urldecode($this->input->post('update_id', true)) ?? null;
        $name       = urldecode($this->input->post('edit_nama', true)) ?? null;
        $kelompok   = urldecode($this->input->post('edit_kelompok', true)) ?? null;
        $kode       = urldecode($this->input->post('edit_kode', true)) ?? null;
        $keterangan = urldecode($this->input->post('edit_keterangan', true)) ?? null;
        if ($id && $name && $kelompok && $kode) {
            $data = array(
                'kode'       => $kode,
                'nama'       => $name,
                'keterangan' => $keterangan,
                'kelompok'   => $kelompok,
            );
            $this->db->where('id', $id);
            $this->db->update('akun_kode', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
    }
    public function kode_hapus()
    {
        $id = urldecode($this->input->post('id', true)) ?? null;
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete('akun_kode');
            if ($this->db->affected_rows() > 0) {
                echo $id;
            }
        }
    }
    public function kelompok()
    {
        $this->render_view('akun/kelompok');
    }
    public function group()
    {
        $this->render_view('akun/group');
    }
    public function get_kelompok($id = null)
    {
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $akl = $this->db->get('akun_kelompok')->result();
        echo json_encode($akl);
    }
    public function kelompok_tambah()
    {
        $name       = urldecode($this->input->post('nama', true)) ?? null;
        $keterangan = urldecode($this->input->post('keterangan', true)) ?? null;
        if ($name) {
            $data = array(
                'nama'       => $name,
                'keterangan' => $keterangan,
            );
            $this->db->insert('akun_kelompok', $data);
            if ($this->db->affected_rows() > 0) {
                $id = $this->db->insert_id();

                echo '<tr class="table-row" id="table-row-' . $id . '">
                                                <th scope="row">' . $id . '</th>
                                                <td contenteditable="true" onblur="saveToDatabase(this,"nama","' . $id . '")" onclick="editRow(this);">' . $name . '</td>
                                                <td contenteditable="true" onblur="saveToDatabase(this,"keterangan","' . $id . '")" onclick="editRow(this);">' . $keterangan . '</td>
                                                <td><span class="badge badge-danger" onclick="deleteRecord(' . $id . ');">Hapus</span></td>
                                            </tr>';
            } else {
            }
        }
    }
    public function kelompok_hapus()
    {
        $id = urldecode($this->input->post('id', true)) ?? null;
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete('akun_kelompok');
            if ($this->db->affected_rows() > 0) {
                echo $id;
            }
        }
    }
    public function group_tambah()
    {
        $name       = urldecode($this->input->post('nama', true)) ?? null;
        $keterangan = urldecode($this->input->post('keterangan', true)) ?? null;
        if ($name) {
            $data = array(
                'nama'       => $name,
                'keterangan' => $keterangan,
            );
            $this->db->insert('akun_group', $data);
            if ($this->db->affected_rows() > 0) {
                $id = $this->db->insert_id();

                echo '<tr class="table-row" id="table-row-' . $id . '">
                                                <th scope="row">' . $id . '</th>
                                                <td contenteditable="true" onblur="saveToDatabase(this,"nama","' . $id . '")" onclick="editRow(this);">' . $name . '</td>
                                                <td contenteditable="true" onblur="saveToDatabase(this,"keterangan","' . $id . '")" onclick="editRow(this);">' . $keterangan . '</td>
                                                <td><span class="badge badge-danger" onclick="deleteRecord(' . $id . ');">Hapus</span></td>
                                            </tr>';
            } else {
            }
        }
    }
    public function group_hapus()
    {
        $id = urldecode($this->input->post('id', true)) ?? null;
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete('akun_group');
            if ($this->db->affected_rows() > 0) {
                echo trim($id);
            }
        }
    }
}

/* End of file Akun.php and path \application\controllers\Akun.php */