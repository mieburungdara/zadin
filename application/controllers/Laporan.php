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
    public function object_to_array($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = [];
            foreach ($data as $key => $value) {
                $result[$key] = (is_array($value) || is_object($value)) ? $this->object_to_array($value) : $value;
            }
            return $result;
        }
        return $data;
    }
    public function rekursip($id, $datanya)
    {
        $this->db->where('id', $id);
        $permohonan = $this->db->get('permohonan')->row();
        if ($permohonan) {
            if ($permohonan->parent) {
                $datanya[] = $permohonan->parent;
                return $this->rekursip($permohonan->parent, $datanya);
            }
        }
        return $datanya;
    }
    public function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    public function load_perusahaan()
    {
        $start                   = urldecode($this->input->post('start', true));
        $length                  = urldecode($this->input->post('length', true));
        $search                  = urldecode($this->input->post('search[value]', true));
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $perusahaan              = urldecode($this->input->post('perusahaan', true)) ?? null;
        $status_permohonan       = urldecode($this->input->post('status_permohonan', true)) ?? null;
        $jenis_permohonan        = urldecode($this->input->post('jenis_permohonan', true)) ?? null;
        $permohonan_modelnya     = $this->Laporan_model->get_perusahaan_data($start, $length, $bulan, $tahun, $perusahaan, $search, $status_permohonan, $jenis_permohonan);
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

                $ngaray['ukuran'] = $get_kapal->ukuran;
                $ngaray['status'] = '';

                $permohonan_jenis = $pal['permohonan_jenis'];
                if ($permohonan_jenis == 1) {
                    $ngaray['jumlah_bongkar'] = 0;
                    $ngaray['jumlah_muatan']  = number_format($pal['jumlah_kira'], 0, ',', '.');
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-danger">Muat</span>';
                }
                if ($permohonan_jenis == 2) {
                    $ngaray['jumlah_bongkar'] = 0;
                    $ngaray['jumlah_muatan']  = number_format($pal['jumlah_kira'], 0, ',', '.');
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-danger">Bongkar JETTY</span>';
                }
                if ($permohonan_jenis == 3) {
                    $ngaray['jumlah_muatan']  = 0;
                    $ngaray['jumlah_bongkar'] = number_format($pal['jumlah_kira'], 0, ',', '.');
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-danger">Bongkar STS</span>';
                }
                if ($permohonan_jenis == 4) {
                    $ngaray['jumlah_muatan']  = 0;
                    $ngaray['jumlah_bongkar'] = number_format($pal['jumlah_kira'], 0, ',', '.');
                    $ngaray['status'] .= '<span class="badge ml-2 mr-1 badge-danger">Batal</span>';
                }
                $ngaray['jumlah_asli'] = number_format($pal['jumlah_asli'], 0, ',', '.');
                $ngaray['mulai']       = $pal['mulai'] != '0000-00-00' ? $this->tgl_in($pal['mulai']) : 'BELUM ADA TANGGAL MULAI';
                $ngaray['selesai']     = $pal['selesai'] != '0000-00-00' ? $this->tgl_in($pal['selesai']) : 'BELUM ADA TANGGAL SELESAI';
                $ngaray['asal_barang'] = $nama_barang_asal; //pemilik barang
                $ngaray['tujuan']      = $pal['tempat_bongkar'];
                $ngaray['jenis']       = $nama_get_barang_jenis; // barang
                $ngaray['shipper']     = strtoupper($jenis_terminal_jenis); //jenis_terminal
                $ngaray['tempat_muat'] = $tempat_muatnya; //tempat_muat
                $ngaray['pemilik']     = $nama_barang_pemilik;
                $ngaray['perusahaan']  = $get_perusahaan->nama;
                $ngaray['admin']       = $created_by;

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
    // public function buka_perusahaan($start = null, $length = null, $bulan = null, $tahun = null)
    public function buka_perusahaan($bulan = null, $tahun = null)
    {

        if ($bulan != null) {
            $this->db->where('MONTH(mulai)', $bulan);
        }
        if ($tahun != null) {
            $this->db->where('YEAR(mulai)', $tahun);
        }

        $get_perusahaan_list = $this->db->get('permohonan')->result();
        $list_surat          = [];
        foreach ($get_perusahaan_list as $get_perusahaan) {
            $list_surat[] = $get_perusahaan->no_surat;
        }
        // var_dump(array_unique($list_surat));
        $list_surat      = array_unique($list_surat);
        $list_permohonan = [];
        foreach ($list_surat as $surat) {
            $this->db->order_by('id', 'desc');
            $this->db->where_in('no_surat', $surat);
            $get_perusahaan_list = $this->db->get('permohonan')->row();
            $list_permohonan[]   = array('id' => $get_perusahaan_list->id, 'tempat_muat' => $get_perusahaan_list->tempat_muat, 'inc' => $get_perusahaan_list->inc, 'jumlah_asli' => $get_perusahaan_list->jumlah_asli);
        }

        $semua         = $this->object_to_array($list_permohonan);
        $newPermohonan = array();

        foreach ($semua as $value) {
            if (empty($newPermohonan[$value['tempat_muat']])) {
                $newPermohonan[$value['tempat_muat']] = $value;
            } else {
                $newPermohonan[$value['tempat_muat']]['jumlah_asli'] += $value['jumlah_asli'];
                $newPermohonan[$value['tempat_muat']]['inc'] += $value['inc'];
            }
        }

        // $this->dd($newPermohonan);
        return $newPermohonan;

        // $this->db->where_in('no_surat', $list_surat);
        // $get_perusahaan_list = $this->db->get('permohonan')->row();
        // var_dump($get_perusahaan_list);

    }
    public function load_terminal()
    {
        $bulan                   = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun                   = urldecode($this->input->post('tahun', true)) ?? null;
        $get_permohonan_filtered = $this->buka_perusahaan($bulan, $tahun);
        $count_all_results       = count($get_permohonan_filtered);
        $nomor_ke                = 0;

        if ($get_permohonan_filtered) {
            foreach ($get_permohonan_filtered as $pal) {
                $ngaray['no'] = ++$nomor_ke;
                $this->db->where('id', $pal['tempat_muat']);
                $get_terminal = $this->db->get('terminal')->row();
                $this->db->where('id', $get_terminal->jenis);
                $get_jenis_terminal = $this->db->get('jenis_terminal')->row();
                $ngaray['jenis']    = strtoupper($get_jenis_terminal->nama);
                $ngaray['terminal'] = $get_terminal->nama;
                $ngaray['kapal']    = $pal['inc'];
                $ngaray['bm']       = number_format($pal['jumlah_asli'], 0, ',', '.');
                $ngaray['aksi']     = 'Bulan & Tahun Kosong';
                if ($bulan && $tahun) {
                    $ngaray['aksi'] = '<a target="_blank"  href="' . base_url() . 'laporan/terminal_rekap/' . $pal['tempat_muat'] . '/' . $bulan . '/' . $tahun . '" class="btn waves-effect waves-light btn-sm btn-info mr-3" ><i class="fa-duotone fa-print  mr-1"></i> Rekap</a>';
                    $ngaray['aksi'] .= '<a target="_blank" href="' . base_url() . 'laporan/terminal_data/' . $pal['tempat_muat'] . '/' . $bulan . '/' . $tahun . '" class="btn waves-effect waves-light btn-sm btn-info mr-3"><i class="fa-duotone fa-print  mr-1"></i> Data</a>';
                }
                $bum[] = $ngaray;
            }
        } else {
            $count_all_results = 0;
        }
        $count_all_data = count($get_permohonan_filtered);

        $bum    = $bum ?? null;
        $output = array(
            "draw" => $_POST['draw'],
            "data" => $bum,
        );
        echo json_encode($output);
    }

    public function terminal_rekap($terminal, $bulan, $tahun)
    {

        $this->db->where('tempat_muat', $terminal);
        $this->db->where('MONTH(mulai)', $bulan);
        $this->db->where('YEAR(mulai)', $tahun);
        $get_perusahaan_list = $this->db->get('permohonan')->result();
        $list_surat          = [];
        foreach ($get_perusahaan_list as $get_perusahaan) {
            $list_surat[] = $get_perusahaan->no_surat;
        }
        $list_surat = array_unique($list_surat);
        // var_dump(($list_surat));
        $list_permohonan = [];
        foreach ($list_surat as $surat) {
            $this->db->order_by('id', 'desc');
            $this->db->where_in('no_surat', $surat);
            $get_perusahaan_list = $this->db->get('permohonan')->row();
            $list_permohonan[]   = array('id' => $get_perusahaan_list->id, 'tempat_muat' => $get_perusahaan_list->tempat_muat, 'inc' => $get_perusahaan_list->inc, 'jumlah_asli' => $get_perusahaan_list->jumlah_asli, 'operasional' => $get_perusahaan_list->operasional);
        }

        $semua         = $this->object_to_array($list_permohonan);
        $newPermohonan = array();

        foreach ($semua as $value) {
            if (empty($newPermohonan[$value['tempat_muat']])) {
                $newPermohonan[$value['tempat_muat']] = $value;
            } else {
                $newPermohonan[$value['tempat_muat']]['jumlah_asli'] += $value['jumlah_asli'];
                $newPermohonan[$value['tempat_muat']]['inc'] += $value['inc'];
            }
        }

        // $this->dd($newPermohonan);

        // return $newPermohonan;

        // $bum    = $newPermohonan;
        // $output = array(
        //     // "draw" => $_POST['draw'],
        //      "data" => $bum,
        // );
        // echo json_encode($output);
        $data = array(
            'tempat_muat' => $terminal,
            'bulan'       => $bulan,
            'tahun'       => $tahun,
            'datalist'    => $newPermohonan,
        );
        $this->load->view('cetak/laporan_terminal_rekap', $data);

    }
    public function terminal_data($terminal, $bulan, $tahun)
    {

        $this->db->where('tempat_muat', $terminal);
        $this->db->where('MONTH(mulai)', $bulan);
        $this->db->where('YEAR(mulai)', $tahun);
        $get_perusahaan_list = $this->db->get('permohonan')->result();
        $list_surat          = [];
        foreach ($get_perusahaan_list as $get_perusahaan) {
            $list_surat[] = $get_perusahaan->no_surat;
        }
        $list_surat = array_unique($list_surat);
        // $this->dd($list_surat);

        // var_dump(($list_surat));
        $list_permohonan = [];
        foreach ($list_surat as $surat) {
            $this->db->order_by('id', 'asc');
            $this->db->where_in('no_surat', $surat);
            $get_perusahaan_list = $this->db->get('permohonan')->result();
            foreach ($get_perusahaan_list as $getperlist) {
                $norkbm = $getperlist->no_rkbm;
                $ngrien = explode('.', $norkbm);
                $ooenr  = ltrim($ngrien[3], 0);

                $list_permohonan[] = array('id' => $getperlist->id, 'inc' => $getperlist->inc, 'tempat_muat' => $getperlist->tempat_muat, 'no_surat' => $getperlist->no_surat, 'no_rkbm' => $ooenr, 'jumlah_kira' => $getperlist->jumlah_kira, 'jumlah_asli' => $getperlist->jumlah_asli, 'operasional' => $getperlist->operasional);
            }
        }

        $semua = $this->object_to_array($list_permohonan);
        // $this->dd($semua);
        $newPermohonan = array();

        foreach ($semua as $value) {
            if (empty($newPermohonan[$value['no_surat']])) {
                $newPermohonan[$value['no_surat']] = $value;
            } else {
                // $newPermohonan[$value['no_surat']]['jumlah_asli'] += $value['jumlah_asli'];
                $newPermohonan[$value['no_surat']]['inc'] += $value['inc'];
                $newPermohonan[$value['no_surat']]['no_rkbm'] .= ',' . $value['no_rkbm'];
            }
        }

        // $this->dd($newPermohonan);

        // return $newPermohonan;

        // $bum    = $newPermohonan;
        // $output = array(
        //     // "draw" => $_POST['draw'],
        //      "data" => $bum,
        // );
        // echo json_encode($output);
        $data = array(
            'tempat_muat' => $terminal,
            'bulan'       => $bulan,
            'tahun'       => $tahun,
            'datalist'    => $newPermohonan,
        );
        $this->load->view('cetak/laporan_terminal_data', $data);

    }

    public function cetak_perusahaan($perusahaan, $permohonan, $status, $bulan, $tahun)
    {
        $perusahaan = $perusahaan ?? null;
        $permohonan = $permohonan ?? null;
        $status     = $status ?? null;
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;

        // if (is_null($bulan) || is_null($tahun)) {
        // echo $month = idate("yyyy");
        // }
        // $permohonan = '';
        if ($perusahaan) {
            $this->db->where('perusahaan', $perusahaan);
            $get_operasional = $this->db->get('operasional')->result();
            if ($get_operasional) {
                // echo $permohonan;
                foreach ($get_operasional as $operasional_item) {
                    $this->db->where('operasional', $operasional_item->id);
                }
                if ($permohonan == 1) {
                    $this->db->where_in('permohonan_jenis', array(1, 2));
                }
                if ($permohonan == 2) {
                    $this->db->where('permohonan_jenis', 3);
                }
                if ($permohonan == 3) {
                    $this->db->where('permohonan_jenis', 4);
                }
                if ($status != null) {
                    if ($status == 1) {
                        // baru
                        $this->db->where('status', 1);
                    }
                    if ($status == 2) {
                        //perpanjang
                        $this->db->where('status', 2);
                    }
                    if ($status == 3) {
                        // revisi
                        $this->db->where('status', 3);
                    }
                    if ($status == 4) {
                        //batal
                        $this->db->where('status', 4);
                    }
                }

                $this->db->where('MONTH(mulai)', $bulan);
                $this->db->where('YEAR(mulai)', $tahun);
                $permohonan = $this->db->get('permohonan')->result();
                // echo '<pre>';
                // var_dump($permohonan);
                // echo '</pre>';
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
    public function cetak_terminal($perusahaan, $permohonan, $status, $bulan, $tahun)
    {
        $perusahaan = $perusahaan ?? null;
        $permohonan = $permohonan ?? null;
        $status     = $status ?? null;
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;

        // if (is_null($bulan) || is_null($tahun)) {
        // echo $month = idate("yyyy");
        // }
        // $permohonan = '';
        if ($perusahaan) {
            $this->db->where('perusahaan', $perusahaan);
            $get_operasional = $this->db->get('operasional')->result();
            if ($get_operasional) {
                foreach ($get_operasional as $operasional_item) {
                    $this->db->where('operasional', $operasional_item->id);
                }
                if ($permohonan == 1) {
                    $this->db->where_in('permohonan_jenis', array(1, 2));
                }
                if ($permohonan == 2) {
                    $this->db->where('permohonan_jenis', 3);
                }
                if ($permohonan == 3) {
                    $this->db->where('permohonan_jenis', 4);
                }
                if ($status != null) {
                    if ($status == 1) {
                        // baru
                        $this->db->where('status', 1);
                    }
                    if ($status == 2) {
                        //perpanjang
                        $this->db->where('status', 2);
                    }
                    if ($status == 3) {
                        // revisi
                        $this->db->where('status', 3);
                    }
                    if ($status == 4) {
                        //batal
                        $this->db->where('status', 4);
                    }
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