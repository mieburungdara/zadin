<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Operasional extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Operasional_model');
        $this->load->library('form_validation');
        $this->load->model('model_groups');
        $this->load->model('Jenis_terminal_model');
        $this->load->model('Agen_kapal_model');
        $this->load->model('Asal_pemilik_model');
        $this->load->model('Perusahaan_model');
        $this->load->model('Barang_model');
        $this->load->model('Permohonan_model');
    }

    public function index()
    {
        $this->render_view('operasional/operasional_list');
    }

    public function load_data()
    {
        $start                    = urldecode($this->input->post('start', true));
        $length                   = urldecode($this->input->post('length', true));
        $search                   = urldecode($this->input->post('search[value]', true));
        $perusahaan               = urldecode($this->input->post('perusahaan', true)) ?? null;
        $status                   = urldecode($this->input->post('status', true)) ?? null;
        $bulan                    = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                    = urldecode($this->input->post('tahun', true)) ?? null;
        $operasional              = $this->Operasional_model->get_limit_data_array($length, $start, $search, $perusahaan, $bulan, $tahun, $status);
        $get_all_data_operasional = $this->Operasional_model->get_all();
        $count_all_results        = count($operasional);
        $count_all_data           = count($get_all_data_operasional);

        foreach ($operasional as $pal) {
            $this->db->where('id', $pal['created_by']);
            $created_by = $this->db->get('users')->row()->username;
            if ($pal['operasional_status'] == 1) {
                $ngaray['status'] = '<span class="badge badge-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Active <i class="fas fa-cog fa-spin"></i></span>';
            }
            if ($pal['operasional_status'] == 2) {
                $ngaray['status'] = '<span class="badge badge-success faa-parent animated-hover" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Selesai <i class="fa fa-check faa-vertical faa-fast"></i></span>';
            }
            if ($pal['operasional_status'] == 3) {
                $ngaray['status'] = '<span class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Arsip</span>';
            }
            $this->db->where('operasional', $pal['id']);
            $this->db->where('status', 1);
            $count_new = $this->db->get('permohonan')->result();
            $count_new = count($count_new) ?? 0;

            $this->db->where('operasional', $pal['id']);
            $this->db->where('status', 2);
            $count_pan = $this->db->get('permohonan')->result();
            $count_pan = count($count_pan) ?? 0;

            $this->db->where('operasional', $pal['id']);
            $this->db->where('status', 3);
            $count_rev = $this->db->get('permohonan')->result();
            $count_rev = count($count_rev) ?? 0;

            $this->db->where('operasional', $pal['id']);
            $this->db->where('status', 4);
            $count_can = $this->db->get('permohonan')->result();
            $count_can = count($count_can) ?? 0;

            $ngaray['status'] .= '<br>';
            $ngaray['status'] .= '<span class="ml-n2 text-left badge btn-outline-secondary"><span class="badge badge-light">' . $count_new . '</span> Baru<br>';
            $ngaray['status'] .= '<span class="badge badge-light">' . $count_pan . '</span> Perpanjang<br>';
            $ngaray['status'] .= '<span class="badge badge-light">' . $count_rev . '</span> Revisi<br>';
            $ngaray['status'] .= '<span class="badge badge-light">' . $count_can . '</span> Batal</span>';
            $ngaray['id']          = $pal['id'];
            $ngaray['operasional'] = '<code>' . date('h:i:s') . ' ' . $this->Reza_model->tanggal_indo(date('Y-m-d', strtotime($pal['updated_at'])), true) . '</code><h5 class="card-title mt-2"><a href="' . base_url() . 'kegiatan/permohonan/' . $pal['id'] . '" class="link">' . $pal['nama'] . '</a></h5><h6 class="card-subtitle">' . $pal['keterangan'] . '</h6>';

            $this->db->where('id', $pal['barang_asal']);
            $barang_asal = $this->db->get('barang_asal')->row();
            $this->db->where('id', $pal['barang_pemilik']);
            $barang_pemilik = $this->db->get('barang_pemilik')->row();
            $this->db->where('id', $pal['perusahaan']);
            $perusahaan = $this->db->get('perusahaan')->row();

            $ngaray['deskripsi']  = '<b>Asal barang :</b> ' . $barang_asal->nama . '<br>' . '<b>Pemilik Barang :</b> ' . $barang_pemilik->nama . '<br>' . '<b>Perusahaan :</b> ' . $perusahaan->nama . '<br>';
            $ngaray['keterangan'] = '<a href="' . base_url() . 'operasional/no/' . $pal['id'] . '" class="badge badge-info">Lihat</a>';
            $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/update/' . $pal['id'] . '" class="ml-1 badge badge-warning">Edit</a>';
            $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/delete/' . $pal['id'] . '" class="ml-1 badge badge-danger" onclick="return confirm(' . "'Apa kamu yakin ingin menghapus opersional ini?'" . ');">Hapus</a>';

            $bum[] = $ngaray;
        }
        $bum    = $bum ?? null;
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
            "data"            => $bum,
        );

        echo json_encode($output);
    }
    public function load_no($id)
    {
        // echo $id;

        $this->db->where('operasional', $id);
        $result = $this->db->get('permohonan')->result();

        $start                   = urldecode($this->input->post('start', true));
        $length                  = urldecode($this->input->post('length', true));
        $search                  = urldecode($this->input->post('search[value]', true));
        $perusahaan              = urldecode($this->input->post('perusahaan', true)) ?? null;
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $status                  = urldecode($this->input->post('status', true)) ?? null;
        $kapal                   = urldecode($this->input->post('kapal', true)) ?? null;
        $barang                  = urldecode($this->input->post('barang', true)) ?? null;
        $tempat_muat             = urldecode($this->input->post('tempat_muat', true)) ?? null;
        $no_rkbm                 = urldecode($this->input->post('no_rkbm', true)) ?? null;
        $permohonan_jenis        = urldecode($this->input->post('permohonan_jenis', true)) ?? null;
        $permohonan_modelnya     = $this->Permohonan_model->get_limit_data_array($start, $length, $search, $perusahaan, $bulan, $tahun, $status, $kapal, $barang, $no_rkbm, $tempat_muat, $permohonan_jenis);
        $get_all_data_permohonan = $this->Permohonan_model->get_all();
        $count_all_results       = count($permohonan_modelnya);
        $count_all_data          = count($get_all_data_permohonan);

        foreach ($permohonan_modelnya as $pal) {
            //     $this->db->where('id', $pal['created_by']);
            //     $created_by = $this->db->get('users')->row()->username;
            //     if ($pal['operasional_status'] == 1) {
            //         $ngaray['status'] = '<span class="badge badge-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Active <i class="fas fa-cog fa-spin"></i></span>';
            //     }
            //     if ($pal['operasional_status'] == 2) {
            //         $ngaray['status'] = '<span class="badge badge-success faa-parent animated-hover" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Selesai <i class="fa fa-check faa-vertical faa-fast"></i></span>';
            //     }
            //     if ($pal['operasional_status'] == 3) {
            //         $ngaray['status'] = '<span class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="Dibuat oleh ' . $created_by . '">Arsip</span>';
            //     }
            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 1);
            //     $count_new = $this->db->get('permohonan')->result();
            //     $count_new = count($count_new) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 2);
            //     $count_pan = $this->db->get('permohonan')->result();
            //     $count_pan = count($count_pan) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 3);
            //     $count_rev = $this->db->get('permohonan')->result();
            //     $count_rev = count($count_rev) ?? 0;

            //     $this->db->where('operasional', $pal['id']);
            //     $this->db->where('status', 4);
            //     $count_can = $this->db->get('permohonan')->result();
            //     $count_can = count($count_can) ?? 0;

            //     $ngaray['status'] .= '<br>';
            //     $ngaray['status'] .= '<span class="ml-n2 text-left badge btn-outline-secondary"><span class="badge badge-light">' . $count_new . '</span> Baru<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_pan . '</span> Perpanjang<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_rev . '</span> Revisi<br>';
            //     $ngaray['status'] .= '<span class="badge badge-light">' . $count_can . '</span> Batal</span>';
            //     $ngaray['id']          = $pal['id'];
            //     $ngaray['operasional'] = '<code>' . date('h:i:s') . ' ' . $this->Reza_model->tanggal_indo(date('Y-m-d', strtotime($pal['updated_at'])), true) . '</code><h5 class="card-title mt-2"><a href="' . base_url() . 'kegiatan/permohonan/' . $pal['id'] . '" class="link">' . $pal['nama'] . '</a></h5><h6 class="card-subtitle">' . $pal['keterangan'] . '</h6>';

            //     $this->db->where('id', $pal['barang_asal']);
            //     $barang_asal = $this->db->get('barang_asal')->row();
            //     $this->db->where('id', $pal['barang_pemilik']);
            //     $barang_pemilik = $this->db->get('barang_pemilik')->row();
            //     $this->db->where('id', $pal['perusahaan']);
            //     $perusahaan = $this->db->get('perusahaan')->row();

            //     $ngaray['deskripsi']  = '<b>Asal barang :</b> ' . $barang_asal->nama . '<br>' . '<b>Pemilik Barang :</b> ' . $barang_pemilik->nama . '<br>' . '<b>Perusahaan :</b> ' . $perusahaan->nama . '<br>';
            //     $ngaray['keterangan'] = '<a href="' . base_url() . 'operasional/no/' . $pal['id'] . '" class="badge badge-info">Lihat</a>';
            //     $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/update/' . $pal['id'] . '" class="ml-1 badge badge-warning">Edit</a>';
            //     $ngaray['keterangan'] .= '<a href="' . base_url() . 'operasional/delete/' . $pal['id'] . '" class="ml-1 badge badge-danger" onclick="return confirm(' . "'Apa kamu yakin ingin menghapus opersional ini?'" . ');">Hapus</a>';

            //     $bum[] = $ngaray;
        }
        // $bum    = $bum ?? null;
        // $output = array(
        //     "draw"            => $_POST['draw'],
        //     "recordsTotal"    => $count_all_data,
        //     "recordsFiltered" => $count_all_results,
        //     "data"            => $bum,
        // );

        echo json_encode($result);
        // echo json_encode($output);
    }

    public function no($id)
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
            $this->render_view('operasional/operasional_no', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('operasional'));
        }
    }

    public function create()
    {
        $data = array(
            'button'             => 'Create',
            'action'             => site_url('operasional/create_action'),
            'id'                 => set_value('id'),
            'nama'               => set_value('nama'),
            'keterangan'         => set_value('keterangan'),
            'operasional_status' => set_value('operasional_status'),
        );
        $this->render_view('operasional/operasional_form', $data);
    }

    public function create_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            // $this->create();
            echo json_encode(array('status' => 'error', 'data' => validation_errors()));
            exit;
        } else {
            $data = array(
                'nama'           => $this->input->post('nama', true),
                'keterangan'     => $this->input->post('keterangan', true),
                'barang_asal'    => $this->input->post('asal_barang', true),
                'barang_pemilik' => $this->input->post('pemilik_barang', true),
                'perusahaan'     => $this->input->post('perusahaan', true),
                'created_by'     => $this->session->userdata('id'),
            );
            $this->Operasional_model->insert($data);
            echo json_encode(array('status' => 'success', 'data' => 'Berhasil..'));
            // exit;
            // $this->session->set_flashdata('message', 'Create Record Success');
            // redirect(site_url('operasional'));
        }
    }

    public function update($id)
    {
        $row = $this->Operasional_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'             => 'Update',
                'action'             => site_url('operasional/update_action'),
                'id'                 => set_value('id', $row->id),
                'nama'               => set_value('nama', $row->nama),
                'keterangan'         => set_value('keterangan', $row->keterangan),
                'asal_barang'        => set_value('asal_barang', $row->barang_asal),
                'pemilik_barang'     => set_value('asal_barang', $row->barang_pemilik),
                'perusahaan'         => set_value('asal_barang', $row->perusahaan),
                'operasional_status' => set_value('operasional_status', $row->operasional_status),
            );
            $this->render_view('operasional/operasional_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('operasional'));
        }
    }

    public function update_action()
    {
        $this->rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama'               => $this->input->post('nama', true),
                'keterangan'         => $this->input->post('keterangan', true),
                'operasional_status' => $this->input->post('operasional_status', true),
                'barang_asal'        => $this->input->post('asal_barang', true),
                'barang_pemilik'     => $this->input->post('pemilik_barang', true),
                'perusahaan'         => $this->input->post('perusahaan', true),
            );

            $this->Operasional_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('operasional'));
        }
    }

    public function delete($id)
    {
        $row = $this->Operasional_model->get_by_id($id);

        if ($row) {
            $this->Operasional_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('operasional'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('operasional'));
        }
    }

    public function rules()
    {
        $this->form_validation->set_rules('nama', 'Judul Operasional', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
        $this->form_validation->set_rules('asal_barang', 'Asal Barang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('pemilik_barang', 'Pemilik Barang', 'trim|required', array('required' => '%s tidak boleh kosong.'));
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'trim|required', array('required' => '%s tidak boleh kosong.'));

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}