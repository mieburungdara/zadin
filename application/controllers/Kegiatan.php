<?php

class Kegiatan extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Kegiatan';

        $this->load->model('model_groups');
        $this->load->model('Jenis_terminal_model');
        $this->load->model('Agen_kapal_model');
        $this->load->model('Operasional_model');
        $this->load->model('Asal_pemilik_model');
        $this->load->model('Perusahaan_model');
        $this->load->model('Barang_model');
        $this->load->model('Permohonan_model');
        $this->load->model('Semua_model');
    }

    public function index()
    {
        $q      = urldecode($this->input->get('q', true));
        $start  = intval($this->input->get('start'));
        $status = intval($this->input->get('status'));

        if ($q != '' && $status != '') {
            $config['base_url']  = base_url() . 'operasional/index?q=' . urlencode($q) . '&status=' . urlencode($status);
            $config['first_url'] = base_url() . 'operasional/index?q=' . urlencode($q) . '&status=' . urlencode($status);
        } elseif ($q != '') {
            $config['base_url']  = base_url() . 'operasional/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'operasional/index?q=' . urlencode($q);
        } elseif ($status != '') {
            $config['base_url']  = base_url() . 'operasional/index?status=' . urlencode($status);
            $config['first_url'] = base_url() . 'operasional/index?status=' . urlencode($status);
        } else {
            $config['base_url']  = base_url() . 'operasional/index';
            $config['first_url'] = base_url() . 'operasional/index';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = true;
        $config['total_rows']        = $this->Operasional_model->total_rows($q);
        $config['attributes']        = array('class' => 'page-link');
        $operasional                 = $this->Operasional_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'operasional_data' => $operasional,
            'q'                => $q,
            'status'           => $status,
            'pagination'       => $this->pagination->create_links(),
            'total_rows'       => $config['total_rows'],
            'start'            => $start,
        );
        $this->render_view('kegiatan/kegiatan_index', $data);
    }
    public function permohonan($id)
    {
        $row = $this->Operasional_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'                 => $row->id,
                'nama'               => $row->nama,
                'keterangan'         => $row->keterangan,
                'operasional_status' => $row->operasional_status,
                'created_at'         => $row->created_at,
            );
            $this->render_view('kegiatan/permohonan_lihat', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }
    public function invoice($id)
    {
        $row = $this->Operasional_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'                 => $row->id,
                'nama'               => $row->nama,
                'keterangan'         => $row->keterangan,
                'barang_asal'        => $row->barang_asal,
                'barang_pemilik'     => $row->barang_pemilik,
                'perusahaan'         => $row->perusahaan,
                'keterangan'         => $row->keterangan,
                'operasional_status' => $row->operasional_status,
                'created_at'         => $row->created_at,
            );
            $this->render_view('kegiatan/invoice_lihat', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function read_norkbm($id)
    {
        echo trim($this->Semua_model->get_by_id('permohonan', $id)->no_rkbm);
        // echo '<input type="number" class="form-control" value="'.$this->Semua_model->get_by_id('permohonan', $id)->no_rkbm.'">';
    }
    public function update_norkbm()
    {
        $data = array(
            'no_rkbm' => $this->input->post('no_rkbm', true),
        );
        $this->db->where('id', $this->input->post('id_rkbm', true));
        $this->db->update('permohonan', $data);
        echo json_encode(array('status' => 'success', 'data' => 'No RKBM Berhasil diperbarui menjadi ' . $this->input->post('no_rkbm', true) . ''));
    }
    public function update_cetak()
    {
        $data = array(
            'cetak' => $this->input->get('invoice', true),
        );
        $this->db->where('id', $this->input->get('invoice_id', true));
        $this->db->update('permohonan', $data);
        echo json_encode(array('status' => 'success', 'data' => $this->input->get('invoice', true)));
    }
    public function permohonan_buat()
    {
        $this->permohonan_rules();

        if ($this->form_validation->run() == false) {
            echo json_encode(array('status' => 'error', 'data' => validation_errors()));
            // exit;
        } else {
            $permohonan_jenis = $this->input->post('permohonan_jenis', true);
            $pj_txt           = '';
            if ($permohonan_jenis == 1) {
                $pj_txt = 'muat';
            }
            if ($permohonan_jenis == 2) {
                $pj_txt = 'bongkar';
            }
            $this->db->select('no_surat');
            $this->db->order_by('no_surat', 'desc');
            $nomor_surat = $this->db->get('permohonan')->row()->no_surat;
            // var_dump($nomor_surat);
            $payment = str_replace('.', '', $this->input->post('jumlah_bongkar', true)) ?? null;
            $data    = array(
                'operasional'      => $this->input->post('operasional', true),
                'no_surat'         => ++$nomor_surat,
                'mulai'            => $this->input->post('mulai', true),
                'selesai'          => $this->input->post('selesai', true),
                'kapal'            => $this->input->post('nama_kapal', true),
                'tempat_muat'      => $this->input->post('tempat_muat', true),
                'barang'           => $this->input->post('barang', true),
                'tempat_bongkar'   => $this->input->post('tempat_bongkar', true),
                'jumlah_muatan'    => str_replace('.', '', $this->input->post('jumlah_muatan', true)),
                'jumlah_asli'      => str_replace('.', '', $this->input->post('jumlah_asli', true)),
                'jumlah_bongkar'   => str_replace('.', '', $this->input->post('jumlah_bongkar', true)),
                'payment'          => $payment,
                'permohonan_jenis' => $this->input->post('permohonan_jenis', true),
            );
            $res = $this->db->insert('permohonan', $data);
            if (!$res) {
                // $error = $this->db->error();
                echo json_encode(array('status' => 'error', 'data' => 'error'));
            } else {
                echo json_encode(array('status' => 'success', 'data' => 'Permohonan ' . $pj_txt . ' berhasil dibuat'));
            }
        }
    }

    public function permohonan_ubah($id)
    {
        $this->permohonan_rules();

        if ($this->form_validation->run() == false) {
            echo json_encode(array('status' => 'error', 'data' => validation_errors()));
        } else {
            $permohonan_jenis = $this->input->post('permohonan_jenis', true);
            // $pj_txt           = $permohonan_jenis;
            if ($permohonan_jenis == 1) {
                $pj_txt = 'muat';
            }
            if ($permohonan_jenis == 2) {
                $pj_txt = 'bongkar';
            }
            $data = array(
                'mulai'            => $this->input->post('mulai', true),
                'status'           => $this->input->post('status_permohonan', true),
                'permohonan_ke'    => $this->input->post('permohonan_ke', true),

                'mulai'            => $this->input->post('mulai', true),
                'selesai'          => $this->input->post('selesai', true),
                'kapal'            => $this->input->post('nama_kapal', true),
                'tempat_muat'      => $this->input->post('tempat_muat', true),
                'barang'           => $this->input->post('barang', true),
                'tempat_bongkar'   => $this->input->post('tempat_bongkar', true),
                'jumlah_muatan'    => str_replace('.', '', $this->input->post('jumlah_muatan', true)),
                'jumlah_asli'      => str_replace('.', '', $this->input->post('jumlah_asli', true)),
                'jumlah_bongkar'   => str_replace('.', '', $this->input->post('jumlah_bongkar', true)),
                'payment'          => str_replace('.', '', $this->input->post('payment', true)),
                'permohonan_jenis' => $permohonan_jenis,
            );
            $this->db->where('id', $id);
            $this->db->where('operasional', $this->input->post('operasional', true));
            $res = $this->db->update('permohonan', $data);
            if (!$res) {
                $error = $this->db->error();
                echo json_encode(array('status' => 'error', 'data' => print_r($error)));
            } else {
                echo json_encode(array('status' => 'success', 'data' => 'Permohonan ' . $pj_txt . ' berhasil dibuat'));
            }

            // echo json_encode(array('status' => 'success', 'data' => 'Permohonan ' . $pj_txt . ' berhasil diupdate'));
        }
    }

    public function permohonan_update($id)
    {
        $this->permohonan_rules();

        if ($this->form_validation->run() == false) {
            echo json_encode(array('status' => 'error', 'data' => validation_errors()));
        } else {
            $this->db->where('id', $id);
            $get_permohonan    = $this->db->get('permohonan')->row();
            $status_permohonan = $this->input->post('status_permohonan', true);
            $permohonan_ke     = $get_permohonan->permohonan_ke;
            $permohonan_ke     = $permohonan_ke ? (intval($permohonan_ke) + (int) 1) : 1;
            $permohonan_jenis  = $this->input->post('permohonan_jenis', true);
            $pj_txt            = $permohonan_jenis;
            if ($permohonan_jenis == 1) {
                $pj_txt = 'muat';
            }
            if ($permohonan_jenis == 2) {
                $pj_txt = 'bongkar';
            }
            $sp_txt = $status_permohonan;
            if ($status_permohonan == 2) {
                $sp_txt = 'Perpanjang';
            }
            if ($status_permohonan == 3) {
                $sp_txt = 'Revisi';
            }
            if ($status_permohonan == 4) {
                $sp_txt = 'Batal';
            }
            $data = array(
                'parent'           => $get_permohonan->id,
                'no_surat'         => $get_permohonan->no_surat,
                'operasional'      => $get_permohonan->operasional,
                'no_rkbm'          => '',
                'status'           => $status_permohonan,
                'permohonan_ke'    => $permohonan_ke,
                'mulai'            => $this->input->post('mulai', true),
                'selesai'          => $this->input->post('selesai', true),
                'kapal'            => $this->input->post('nama_kapal', true),
                'tempat_muat'      => $this->input->post('tempat_muat', true),
                'barang'           => $this->input->post('barang', true),
                'tempat_bongkar'   => $this->input->post('tempat_bongkar', true),
                'jumlah_muatan'    => str_replace('.', '', $this->input->post('jumlah_muatan', true)),
                'jumlah_asli'      => str_replace('.', '', $this->input->post('jumlah_asli', true)),
                'jumlah_bongkar'   => str_replace('.', '', $this->input->post('jumlah_bongkar', true)),
                'payment'          => str_replace('.', '', $this->input->post('payment', true)),
                'permohonan_jenis' => $permohonan_jenis,
            );
            // var_dump($data);
            $apdet = $this->db->insert('permohonan', $data);
            if (!$apdet) {
                $error = $this->db->error();
                echo json_encode(array('status' => 'error', 'data' => print_r($error)));
            } else {
                echo json_encode(array('status' => 'success', 'data' => 'Permohonan ' . $pj_txt . ' berhasil di' . $sp_txt));
            }
        }
    }

    public function permohonan_rules()
    {
        $this->form_validation->set_rules('status_permohonan', 'Status Permohonan', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('operasional', 'Judul Operasional', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('nama_kapal', 'Nama Kapal', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('tempat_muat', 'Tempat Muat', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('barang', 'Jenis Barang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('tempat_bongkar', 'Tempat Bongkar', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('jumlah_muatan', 'jumlah_muatan', 'trim');
        $this->form_validation->set_rules('jumlah_asli', 'jumlah_asli', 'trim');
        $this->form_validation->set_rules('jumlah_bongkar', 'jumlah_bongkar', 'trim');
        $this->form_validation->set_rules('permohonan_jenis', 'Jenis Permohonan', 'trim|required', array('required' => '%s harus jelas.'));
    }

    public function cetak_permohonan($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        if ($row) {
            // echo json_encode($data);
            // return $row;
            //     $data = array(
            // 'id' => $row->id,
            // 'parent' => $row->parent,
            // 'operasional' => $row->operasional,
            // 'no_rkbm' => $row->no_rkbm,
            // 'mulai' => $row->mulai,
            // 'selesai' => $row->selesai,
            // 'kapal' => $row->kapal,
            // 'tempat_muat' => $row->tempat_muat,
            // 'barang' => $row->barang,
            // 'tempat_bongkar' => $row->tempat_bongkar,
            // 'jumlah_muatan' => $row->jumlah_muatan,
            // 'jumlah_asli' => $row->jumlah_asli,
            // 'jumlah_bongkar' => $row->jumlah_bongkar,
            // 'asal_barang' => $row->asal_barang,
            // 'perusahaan' => $row->perusahaan,
            // 'status' => $row->status,
            // 'permohonan_jenis' => $row->permohonan_jenis,
            // );
            // $this->render_view('permohonan/permohonan_read', $data);
            // echo json_encode($data);
        } else {
            echo 'Permohonan tidak ada..';
        }

    }
    public function permohonan_cetak($id)
    {

        $row = $this->Permohonan_model->get_by_id($id);
        if ($row) {
            $op = $this->Operasional_model->get_by_id($row->operasional);

            $this->db->where('id', $op->perusahaan);
            $get_perusahaan = $this->db->get('perusahaan')->row();

            $data = array(
                'id'               => $row->id,
                'parent'           => $row->parent,
                'operasional'      => $row->operasional,
                'no_rkbm'          => $row->no_rkbm,
                'mulai'            => $row->mulai,
                'selesai'          => $row->selesai,
                'kapal'            => $row->kapal,
                'tempat_muat'      => $row->tempat_muat,
                'barang'           => $row->barang,
                'tempat_bongkar'   => $row->tempat_bongkar,
                'jumlah_muatan'    => $row->jumlah_muatan,
                'jumlah_asli'      => $row->jumlah_asli,
                'jumlah_bongkar'   => $row->jumlah_bongkar,
                // 'payment'          => $row->payment,
                 'permohonan_ke'    => $row->permohonan_ke,
                'status'           => $row->status,
                'permohonan_jenis' => $row->permohonan_jenis,
                'nama'             => $op->nama,
                'barang_asal'      => $op->barang_asal,
                'barang_pemilik'   => $op->barang_pemilik,
                'perusahaan'       => $get_perusahaan,
                'created_by'       => $op->created_by,
            );
            $this->load->view('cetak/permohonan', $data);
            // echo json_encode($data);
        } else {
            echo 'Permohonan tidak ada..';
        }

    }

    public function invoice_cetak($id)
    {
        $row = $this->Operasional_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'                 => $row->id,
                'nama'               => $row->nama,
                'keterangan'         => $row->keterangan,
                'barang_asal'        => $row->barang_asal,
                'barang_pemilik'     => $row->barang_pemilik,
                'perusahaan'         => $row->perusahaan,
                'keterangan'         => $row->keterangan,
                'operasional_status' => $row->operasional_status,
                'created_at'         => $row->created_at,
            );
            $this->load->view('cetak/invoice', $data);
            // echo json_encode($data);
        } else {
            echo 'Invoice tidak ada..';
        }

    }
}
