<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Laporan extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Permohonan_model');
    }

    public function index()
    {
        $this->render_view('laporan/laporan_index');
    }
    public function perusahaan()
    {
        $this->render_view('laporan/laporan_perusahaan');
    }
    public function terminal()
    {
        $this->render_view('laporan/laporan_terminal');
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
    public function load_perusahaan()
    {
        $start                   = urldecode($this->input->post('start', true));
        $length                  = urldecode($this->input->post('length', true));
        $search                  = urldecode($this->input->post('search[value]', true));
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $perusahaan              = urldecode($this->input->post('perusahaan', true)) ?? null;
        $permohonan_modelnya     = $this->Laporan_model->get_perusahaan_data($start, $length, $bulan, $tahun, $perusahaan, $search);
        $get_all_data_permohonan = $this->Permohonan_model->get_all();
        // var_dump($permohonan_modelnya);

        $nomor_ke = $start;

        if ($permohonan_modelnya) {
            foreach ($permohonan_modelnya as $pal) {
                $ngaray['no'] = ++$nomor_ke;

                $ngaray['no_rkbm'] = $pal['no_rkbm'];

                $this->db->where('id', $pal['kapal']);
                $get_kapal         = $this->db->get('kapal')->row();
                $ngaray['kapal']   = $get_kapal->nama;
                $ngaray['bendera'] = $get_kapal->bendera;

                $this->db->where('id', $get_kapal->agen_kapal);
                $get_agen_kapal = $this->db->get('agen_kapal')->row();
                $ngaray['agen'] = $get_agen_kapal->nama;

                $this->db->where('id', $pal['operasional']);
                $get_operasional = $this->db->get('operasional')->row();
                $barang_asal     = $get_operasional->barang_asal;
                $barang_pemilik  = $get_operasional->barang_pemilik;
                $perusahaan_data = $get_operasional->perusahaan;
                $id_created_by   = $get_operasional->created_by;

                $this->db->where('id', $id_created_by);
                $users_data = $this->db->get('users')->row();
                $created_by = $users_data->firstname . ' ' . $users_data->lastname;

                $this->db->where('id', $perusahaan_data);
                $get_perusahaan = $this->db->get('perusahaan')->row();

                $this->db->where('id', $barang_asal);
                $get_barang_asal  = $this->db->get('barang_asal')->row();
                $nama_barang_asal = $get_barang_asal->nama;

                $this->db->where('id', $barang_pemilik);
                $get_barang_pemilik  = $this->db->get('barang_pemilik')->row();
                $nama_barang_pemilik = $get_barang_pemilik->nama;

                $this->db->where('id', $pal['barang']);
                $get_barang_jenis      = $this->db->get('barang_jenis')->row();
                $nama_get_barang_jenis = $get_barang_jenis->nama;

                $this->db->where('id', $pal['tempat_muat']);
                $get_terminal   = $this->db->get('terminal')->row();
                $terminal_jenis = $get_terminal->jenis;
                $tempat_muatnya = $get_terminal->nama;

                $this->db->where('id', $terminal_jenis);
                $get_jenis_terminal   = $this->db->get('jenis_terminal')->row();
                $jenis_terminal_jenis = $get_jenis_terminal->nama;

                $this->db->where('id', $pal['status']);
                $get_jpermohonan_status = $this->db->get('permohonan_status')->row();
                $status_permohonan      = $get_jpermohonan_status->nama;

                $ngaray['ukuran']         = $get_kapal->ukuran;
                $ngaray['jumlah_bongkar'] = number_format($pal['jumlah_bongkar'], 0, ',', '.');
                $ngaray['jumlah_muatan']  = number_format($pal['jumlah_muatan'], 0, ',', '.');
                $ngaray['jumlah_asli']    = number_format($pal['jumlah_asli'], 0, ',', '.');
                $ngaray['mulai']          = $pal['mulai'] != '0000-00-00' ? $this->tgl_in($pal['mulai']) : 'BELUM ADA TANGGAL MULAI';
                $ngaray['selesai']        = $pal['selesai'] != '0000-00-00' ? $this->tgl_in($pal['selesai']) : 'BELUM ADA TANGGAL SELESAI';
                $ngaray['asal_barang']    = $nama_barang_asal; //pemilik barang
                $ngaray['tujuan']         = $pal['tempat_bongkar'];
                $ngaray['jenis']          = $nama_get_barang_jenis; // barang
                $ngaray['shipper']        = strtoupper($jenis_terminal_jenis); //jenis_terminal
                $ngaray['tempat_muat']    = $tempat_muatnya; //tempat_muat
                $ngaray['pemilik']        = $nama_barang_pemilik;
                $ngaray['perusahaan']     = $get_perusahaan->nama;
                $ngaray['admin']          = $created_by;

                $ngaray['status'] = '';

                if ($pal['status'] == 1) {
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-info">BARU</span>';
                }
                if ($pal['status'] == 2) {
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-success">PERPANJANG</span>';
                }
                if ($pal['status'] == 3) {
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-warning">REVISI</span>';
                }
                if ($pal['status'] == 4) {
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-danger">BATAL</span>';
                }
                $bum[] = $ngaray;
            }
            if (!empty($perusahaan)) {
                $count_all_results = count($permohonan_modelnya);
            } else {
                $count_all_results = $this->Laporan_model->total_rows($search);

            }

        } else {
            $count_all_results = 0;
        }
        $count_all_data = count($get_all_data_permohonan);

        $bum    = $bum ?? null;
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
            "data"            => $bum,
        );
        echo json_encode($output);
    }
    public function load_terminal()
    {
        $start                   = urldecode($this->input->post('start', true));
        $length                  = urldecode($this->input->post('length', true));
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $perusahaan              = urldecode($this->input->post('perusahaan', true)) ?? null;
        $permohonan_modelnya     = $this->Laporan_model->get_perusahaan_data($start, $length, $bulan, $tahun, $perusahaan);
        $get_all_data_permohonan = $this->Permohonan_model->get_all();
        // $count_all_results       = $this->Permohonan_model->total_rows($search);

        $count_all_results = count($permohonan_modelnya);
        $count_all_data    = count($get_all_data_permohonan);
        $nomor_ke          = 0;
        var_dump($permohonan_modelnya);
        foreach ($permohonan_modelnya as $pal) {

            // if ($pal['permohonan_jenis'] == 1) {
            // $tanggal_mulai = $pal['mulai'];
            // }
            // if ($pal['permohonan_jenis'] == 2) {
            //     $tanggal_mulai = $pal['selesai'];
            // }
            // var_dump($tanggal_mulai);
            // if ($tanggal_mulai == '0000-00-00') {
            //     echo 'Tanggal mulai salah';
            // }
            $ngaray['no']       = ++$nomor_ke;
            $ngaray['no_surat'] = $pal['id'];

            $ngaray['no_rkbm'] = $pal['no_rkbm'];

            $this->db->where('id', $pal['operasional']);
            $get_operasional       = $this->db->get('operasional')->row();
            $ngaray['operasional'] = $get_operasional->nama;

            // $ngaray['detail'] = $this->tgl_in($tanggal_mulai);
            // $romawi           = $this->integerToRoman(date("m", strtotime($tanggal_mulai)));
            // $taon             = date("Y", strtotime($tanggal_mulai));
            // $this->db->where('id', $id);
            // $get_operasional = $this->db->get('operasional')->row();
            // // var_dump($get_operasional);
            // $this->db->where('id', $get_operasional->perusahaan);
            // $get_perusahaan = $this->db->get('perusahaan')->row();

            // $perusahaan_mana = date("Y", strtotime($tanggal_mulai));
            // $jesur           = '';
            // $stasur          = '';
            // $perke           = $pal['permohonan_ke'] == 0 ? '' : $pal['permohonan_ke'];

            // if ($pal['status'] == 1) {
            //     $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">BARU</span>';
            //     $stasur = 'B';
            // }
            // if ($pal['status'] == 2) {
            //     $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">PERPANJANG</span>';
            //     $stasur = 'P';
            // }
            // if ($pal['status'] == 3) {
            //     $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">REVISI</span>';
            //     $stasur = 'PR';
            // }
            // if ($pal['status'] == 4) {
            //     $ngaray['detail'] .= '<span class="badge ml-2 mr-1 badge-success">BATAL</span>';
            //     $stasur = 'X';
            // }
            // if ($pal['permohonan_jenis'] == 1) {
            //     $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">MUAT</span>';
            //     $jesur = 'M';
            // }
            // if ($pal['permohonan_jenis'] == 2) {
            //     $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">BONGKAR</span>';
            //     $jesur = 'B';
            // }
            // if ($pal['permohonan_jenis'] == 3) {
            //     $ngaray['detail'] .= '<span class="badge mr-1 badge-danger">MUAT & BONGKAR</span>';
            //     $jesur = 'MB';
            // }
            // if ($pal['no_rkbm']) {
            //     $erkabem = $pal['no_rkbm'];
            // } else {
            //     $erkabem = '<i class="fa fa-warning text-danger faa-flash faa-fast animated"></i> <code>belum ada</code>';
            // }
            // $ngaray['detail'] .= '
            //                 <div class="row mb-2">
            //                     <div class="col-auto border-right align-self-center">
            //                         <div class="d-flex">
            //                             <code>No Surat :<br> 0' . $pal['id'] . '/' . $jesur . '/' . $stasur . $perke . '/RKBM-' . $get_perusahaan->inisial . "/SMD/" . $romawi . '/' . $taon . '</code>
            //                         </div>
            //                     </div>
            //                     <div class="col-auto" data-toggle="modal" data-target="#modal-norkbm" data-nosurat="' . $pal['id'] . '"><code>No RKBM :<br>
            //                     ' . $erkabem . '
            //                     </div>
            //                 </div>';

            // $this->db->where('id', $pal['kapal']);
            // $permohonan_kapal = $this->db->get('kapal')->row();
            // $agen_kapal       = $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'agen_kapal', $permohonan_kapal->agen_kapal)->nama;

            // $tempat_muat       = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->nama;
            // $jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->jenis)->nama;

            // $ngaray['deskripsi'] = '';
            // $ngaray['deskripsi'] .= '
            // <span class="ml-n2 text-left badge btn-outline-secondary">
            // <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="' . strtoupper($agen_kapal) . '">Kapal</span> ' . $permohonan_kapal->nama . '<br>
            // <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="' . strtoupper($jenis_tempat_muat) . '">Terminal Muat</span> ' . $tempat_muat . '<br>
            // <span class="badge badge-light">Terminal Bongkar</span> ' . $pal['tempat_bongkar'] . '</span>';

            // $ngaray['keterangan'] = '';
            // $ngaray['keterangan'] .= '
            // <span class="ml-n2 text-left badge btn-outline-secondary">
            // <span class="badge badge-light">Muat Perkiraan</span> ' . number_format($pal['jumlah_muatan'], 0, ',', '.') . '<br>
            // <span class="badge badge-light">Muat Asli</span> ' . number_format($pal['jumlah_asli'], 0, ',', '.') . '<br>
            // <span class="badge badge-light">Bongkar</span> ' . number_format($pal['jumlah_bongkar'], 0, ',', '.') . '<br></span>';

            // $ngaray['aksi'] = '';

            // $warna = $pal['cetak'] ? 'info' : 'danger';
            // $fa    = $pal['cetak'] ? 'check' : 'times';

            // $id_jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $pal['tempat_muat'])->jenis)->id;
            // $atribut_json         = json_encode(array("agen_kapal" => $permohonan_kapal->agen_kapal, 'jenis_tempat_muat' => $id_jenis_tempat_muat));

            // $permohonan_jenis = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'permohonan_jenis', $pal['permohonan_jenis'])->nama;

            // $ngaray['aksi'] .= '<span class="mr-1 btn-sm btn waves-effect btn-' . $warna . ' inpoice invoice' . $pal['id'] . '" data-id="' . $pal['id'] . '"> <i class="fa voice' . $pal['id'] . ' fa-' . $fa . ' mr-2"></i>Invoice</span>';
            // $ngaray['aksi'] .= '<div class="ml-auto mt-1">
            //                         <div class="category-selector btn-group">
            //                             <a class="nav-link category-dropdown label-group p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            //                                 <div class="category">
            //                                     <span class="btn-sm btn waves-effect btn-warning"><i class="fas fa-cog fa-spin"></i> Options</span>
            //                                 </div>
            //                             </a>
            //                             <div class="dropdown-menu dropdown-menu-right category-menu shadow" style="">
            //                                 <a class="dropdown-item text-info" data-toggle="modal" data-target="#permohonanmodal" data-permohonan=' . "$atribut_json" . ' data-idpermohonan="' . $pal['id'] . '" href="javascript:void(0);"><i class="fa-duotone fa-edit  mr-1"></i> Ubah</a>
            // <a class="dropdown-item text-success" href="' . base_url() . 'kegiatan/permohonan_cetak/' . $pal['id'] . '" target="_blank"><i class="fa-duotone fa-print  mr-1"></i>Cetak</a>
            // <a class="dropdown-item text-danger menghapuspermohonan" id="' . $pal['id'] . '" data-idpermohonan="' . $pal['id'] . '" href="javascript:void(0);"><i class="fa-duotone fa-trash-alt  mr-1"></i>Hapus</a>
            // </div>
            // </div>
            // </div>';
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

    public function cetak_perusahaan($perusahaan, $bulan, $tahun)
    {
        $perusahaan = $perusahaan ?? null;
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;

        // if (is_null($bulan) || is_null($tahun)) {
        // echo $month = idate("yyyy");
        // }
        $permohonan = '';
        if ($perusahaan) {
            $this->db->where('perusahaan', $perusahaan);
            $get_operasional = $this->db->get('operasional')->result();
            if ($get_operasional) {
                foreach ($get_operasional as $operasional_item) {
                    $this->db->where('operasional', $operasional_item->id);
                }
                $this->db->where('MONTH(mulai)', $bulan);
                $this->db->where('YEAR(mulai)', $tahun);
                $permohonan = $this->db->get('permohonan')->result();
                // var_dump($permohonan);
            }
        }
        // $permohonan =
        $data = array(
            "bulan"      => $bulan,
            "tahun"      => $tahun,
            "perusahaan" => $perusahaan,
            "bulan"      => $bulan,
            "tahun"      => $tahun,
            "permohonan" => $permohonan,
        );
        $this->load->view('laporan/cetak_perusahaan', $data);
    }
    public function cetak_terminal($perusahaan, $bulan, $tahun)
    {
        $perusahaan = $perusahaan ?? null;
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;

        // if (is_null($bulan) || is_null($tahun)) {
        // echo $month = idate("yyyy");
        // }
        $permohonan = '';
        if ($perusahaan) {
            $this->db->where('perusahaan', $perusahaan);
            $get_operasional = $this->db->get('operasional')->result();
            if ($get_operasional) {
                foreach ($get_operasional as $operasional_item) {
                    $this->db->where('operasional', $operasional_item->id);
                }
                $this->db->where('MONTH(mulai)', $bulan);
                $this->db->where('YEAR(mulai)', $tahun);
                $permohonan = $this->db->get('permohonan')->result();
                // var_dump($bulan);
            }
        }
        // $permohonan =
        $data = array(
            "bulan"      => $bulan,
            "tahun"      => $tahun,
            "perusahaan" => $perusahaan,
            "bulan"      => $bulan,
            "tahun"      => $tahun,
            "permohonan" => $permohonan,
        );
        $this->load->view('laporan/cetak_terminal', $data);
    }
}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-24 11:40:37 */
/* http://harviacode.com */