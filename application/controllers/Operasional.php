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
        $bulan                    = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                    = urldecode($this->input->post('tahun', true)) ?? null;
        $perusahaan               = urldecode($this->input->post('perusahaan', true)) ?? null;
        $status                   = urldecode($this->input->post('status', true)) ?? null;
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

    public function tgl_in($date)
    {
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun  = substr($date, 0, 4);
        $bulan  = substr($date, 5, 2);
        $tgl    = substr($date, 8, 2);
        $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;
        return $result;
    }
    public function integerToRoman($integer)
    {
        $integer = intval($integer);
        $result  = '';
        $lookup  = array('M' => 1000,
            'CM'                 => 900,
            'D'                  => 500,
            'CD'                 => 400,
            'C'                  => 100,
            'XC'                 => 90,
            'L'                  => 50,
            'XL'                 => 40,
            'X'                  => 10,
            'IX'                 => 9,
            'V'                  => 5,
            'IV'                 => 4,
            'I'                  => 1);
        foreach ($lookup as $roman => $value) {
            $matches = intval($integer / $value);
            $result .= str_repeat($roman, $matches);
            $integer = $integer % $value;
        }
        return $result;
    }

    public function edit($id)
    {
        $row = $this->Permohonan_model->get_by_id($id);
        // var_dump($row);
        if ($row) {
            $data = array(
                'button'           => 'Update',
                'action'           => site_url('permohonan/update_action'),
                'id'               => set_value('id', $row->id),
                'parent'           => set_value('parent', $row->parent),
                'operasional'      => set_value('operasional', $row->operasional),
                'no_rkbm'          => set_value('no_rkbm', $row->no_rkbm),
                'mulai'            => set_value('mulai', $row->mulai),
                'selesai'          => set_value('selesai', $row->selesai),
                'kapal'            => set_value('kapal', $row->kapal),
                'tempat_muat'      => set_value('tempat_muat', $row->tempat_muat),
                'barang'           => set_value('barang', $row->barang),
                'tempat_bongkar'   => set_value('tempat_bongkar', $row->tempat_bongkar),
                'jumlah_muatan'    => set_value('jumlah_muatan', $row->jumlah_muatan),
                'jumlah_asli'      => set_value('jumlah_asli', $row->jumlah_asli),
                'jumlah_bongkar'   => set_value('jumlah_bongkar', $row->jumlah_bongkar),
                'status'           => set_value('status', $row->status),
                'permohonan_jenis' => set_value('permohonan_jenis', $row->permohonan_jenis),
            );
            $this->render_view('permohonan/permohonan_form', $data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('operasional'));
        }
    }
    public function load_no($id)
    {
        // echo $id;

        // $this->db->where('operasional', $id);
        // $result = $this->db->get('permohonan')->result();

        $start                   = urldecode($this->input->post('start', true));
        $length                  = urldecode($this->input->post('length', true));
        $search                  = urldecode($this->input->post('search[value]', true));
        $permohonan_jenis        = urldecode($this->input->post('jenis_permohonan', true)) ?? null;
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $status                  = urldecode($this->input->post('status', true)) ?? null;
        $kapal                   = urldecode($this->input->post('kapal', true)) ?? null;
        $barang                  = urldecode($this->input->post('barang', true)) ?? null;
        $tempat_muat             = urldecode($this->input->post('tempat_muat', true)) ?? null;
        $permohonan_modelnya     = $this->Permohonan_model->get_limit_data_array($id, $start, $length, $search, $permohonan_jenis, $bulan, $tahun, $status, $kapal, $barang, $tempat_muat);
        $get_all_data_permohonan = $this->Permohonan_model->get_all();
        $count_all_results       = count($permohonan_modelnya);
        $count_all_data          = count($get_all_data_permohonan);

        // var_dump($permohonan_modelnya);
        foreach ($permohonan_modelnya as $pal) {

            // if ($pal['permohonan_jenis'] == 1) {
            $tanggal_mulai = $pal['mulai'];
            // }
            // if ($pal['permohonan_jenis'] == 2) {
            //     $tanggal_mulai = $pal['selesai'];
            // }
            // var_dump($tanggal_mulai);
            // if ($tanggal_mulai == '0000-00-00') {
            //     echo 'Tanggal mulai salah';
            // }
            $ngaray['detail'] = $this->tgl_in($tanggal_mulai);
            $romawi           = $this->integerToRoman(date("m", strtotime($tanggal_mulai)));
            $taon             = date("Y", strtotime($tanggal_mulai));
            $this->db->where('id', $id);
            $get_operasional = $this->db->get('operasional')->row();
            // var_dump($get_operasional);
            $this->db->where('id', $get_operasional->perusahaan);
            $get_perusahaan = $this->db->get('perusahaan')->row();

            $perusahaan_mana = date("Y", strtotime($tanggal_mulai));
            $jesur           = '';
            $stasur          = '';
            $perke           = $pal['permohonan_ke'] == 0 ? '' : $pal['permohonan_ke'];

            if ($pal['status'] == 1) {
                $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">BARU</span>';
                $stasur = 'B';
            }
            if ($pal['status'] == 2) {
                $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">PERPANJANG</span>';
                $stasur = 'P';
            }
            if ($pal['status'] == 3) {
                $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">REVISI</span>';
                $stasur = 'PR';
            }
            if ($pal['status'] == 4) {
                $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">BATAL</span>';
                $stasur = 'X';
            }
            if ($pal['permohonan_jenis'] == 1) {
                $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">MUAT</span>';
                $jesur = 'M';
            }
            if ($pal['permohonan_jenis'] == 2) {
                $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">BONGKAR</span>';
                $jesur = 'B';
            }
            if ($pal['permohonan_jenis'] == 3) {
                $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">MUAT & BONGKAR</span>';
                $jesur = 'MB';
            }
            if ($pal['no_rkbm']) {
                $erkabem = $pal['no_rkbm'];
            } else {
                $erkabem = '<i class="fa fa-warning text-danger faa-flash faa-fast animated"></i> <code>belum ada</code>';
            }
            $ngaray['detail'] .= '
                            <div class="row mb-2">
                                <div class="col-auto border-right align-self-center">
                                    <div class="d-flex">
                                        <code>No Surat :<br> 0' . $pal['id'] . '/' . $jesur . '/' . $stasur . $perke . '/RKBM-' . $get_perusahaan->inisial . "/SMD/" . $romawi . '/' . $taon . '</code>
                                    </div>
                                </div>
                                <div class="col-auto" data-toggle="modal" data-target="#modal-norkbm" data-nosurat="' . $pal['id'] . '"><code>No RKBM :<br>
                                ' . $erkabem . '
                                </div>
                            </div>';

            $this->db->where('id', $pal['kapal']);
            $permohonan_kapal = $this->db->get('kapal')->row();
            $agen_kapal       = $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'agen_kapal', $permohonan_kapal->agen_kapal)->nama;

            $tempat_muat       = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->nama;
            $jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->jenis)->nama;

            $ngaray['deskripsi'] = '';
            $ngaray['deskripsi'] .= '
            <span class="ml-n2 text-left badge btn-outline-secondary">
            <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="' . strtoupper($agen_kapal) . '">Kapal</span> ' . $permohonan_kapal->nama . '<br>
            <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="' . strtoupper($jenis_tempat_muat) . '">Terminal Muat</span> ' . $tempat_muat . '<br>
            <span class="badge badge-light">Terminal Bongkar</span> ' . $pal['tempat_bongkar'] . '</span>';

            $ngaray['keterangan'] = '';
            $ngaray['keterangan'] .= '
            <span class="ml-n2 text-left badge btn-outline-secondary">
            <span class="badge badge-light">Muat Perkiraan</span> ' . number_format($pal['jumlah_muatan'], 0, ',', '.') . '<br>
            <span class="badge badge-light">Muat Asli</span> ' . number_format($pal['jumlah_asli'], 0, ',', '.') . '<br>
            <span class="badge badge-light">Bongkar</span> ' . number_format($pal['jumlah_bongkar'], 0, ',', '.') . '<br></span>';

            $ngaray['aksi'] = '';

            $warna = $pal['cetak'] ? 'info' : 'danger';
            $fa    = $pal['cetak'] ? 'check' : 'times';

            $id_jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->jenis)->id;
            $atribut_json         = json_encode(array("agen_kapal" => $permohonan_kapal->agen_kapal, 'jenis_tempat_muat' => $id_jenis_tempat_muat));

            $permohonan_jenis = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'permohonan_jenis', $pal['permohonan_jenis'])->nama;

            $ngaray['aksi'] .= '<span class="mr-1 btn-sm btn waves-effect btn-' . $warna . ' inpoice invoice' . $pal['id'] . '" data-id="' . $pal['id'] . '"> <i class="fa voice' . $pal['id'] . ' fa-' . $fa . ' mr-2"></i>Invoice</span>';
            $ngaray['aksi'] .= '<div class="ml-auto mt-1">
                                    <div class="category-selector btn-group">
                                        <a class="nav-link category-dropdown label-group p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <div class="category">
                                                <span class="btn-sm btn waves-effect btn-warning"><i class="fas fa-cog fa-spin"></i> Options</span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right category-menu shadow" style="">
                                            <a class="dropdown-item text-info" data-toggle="modal" data-target="#permohonanmodal" data-permohonan=' . "$atribut_json" . ' data-idpermohonan="' . $pal['id'] . '" href="javascript:void(0);"><i class="fa-duotone fa-edit  mr-1"></i> Ubah</a>
            <a class="dropdown-item text-success" href="' . base_url() . 'kegiatan/permohonan_cetak/' . $pal['id'] . '" target="_blank"><i class="fa-duotone fa-print  mr-1"></i>Cetak</a>
            <a class="dropdown-item text-danger menghapuspermohonan" id="' . $pal['id'] . '" data-idpermohonan="' . $pal['id'] . '" href="javascript:void(0);"><i class="fa-duotone fa-trash-alt  mr-1"></i>Hapus</a>
            </div>
            </div>
            </div>';
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
                'barang_asal'        => $this->input->post('asal_barang', true),
                'barang_pemilik'     => $this->input->post('pemilik_barang', true),
                'perusahaan'         => $this->input->post('perusahaan', true),
                'operasional_status' => $this->input->post('operasional_status', true),
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