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

    public function romawi($number)
    {
        $map         = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
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
                // echo $barang_asal;
                $this->db->where('id', $barang_asal);
                $get_barang_asal  = $this->db->get('barang_asal')->row();
                $nama_barang_asal = $get_barang_asal->nama;
                // echo $barang_asal;
                $this->db->where('id', $barang_pemilik);
                $get_barang_pemilik = $this->db->get('barang_pemilik')->row();
                if ($get_barang_pemilik) {
                    $nama_barang_pemilik = $get_barang_pemilik->nama;
                } else {
                    $nama_barang_pemilik = '';
                }

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

        $this->db->where('operasional_status', 3);
        $operasional_list = $this->db->get('operasional')->result();
        if ($operasional_list) {
            foreach ($operasional_list as $opol) {
                $idlist[] = $opol->id;
            }
            $this->db->where_in('operasional', $idlist);
        }

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
            $this->db->where('operasional_status', 3);
            $get_operasional = $this->db->get('operasional')->result();
            if ($get_operasional) {
                // echo $permohonan;
                foreach ($get_operasional as $operasional_item) {
                    // $this->db->where('operasional', $operasional_item->id);
                    $aray_operitem_id[] = $operasional_item->id;
                }
                if ($aray_operitem_id) {
                    $popo = $this->db->where_in('operasional', $aray_operitem_id);
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
                // echo $this->db->last_query();
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

    public function operasional()
    {
        $this->render_view('laporan/laporan_biaya_operasional');
    }
    public function load_biaya_operasional()
    {
        $jenis      = urldecode($this->input->post('jenis', true)) ?? null;
        $bulan      = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun      = urldecode($this->input->post('tahun', true)) ?? null;
        $perusahaan = urldecode($this->input->post('perusahaan', true)) ?? null;
        if (!empty($bulan)) {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $this->db->where('YEAR(created_at)', $tahun);
        }
        if (!empty($jenis)) {
            if ($jenis == 1) {
                $this->db->where('biaya_operasional != ', 0);
            }
            if ($jenis == 2) {
                $this->db->where('biaya_honor != ', 0);
            }
            if ($jenis == 3) {
                $this->db->where('biaya_konsumsi != ', 0);
            }
            if ($jenis == 4) {
                $this->db->where('biaya_kapal != ', 0);
            }
            if ($jenis == 5) {
                $this->db->where('biaya_dozer != ', 0);
            }
            if ($jenis == 6) {
                $this->db->where('biaya_speedboat_antar != ', 0);
            }
            if ($jenis == 7) {
                $this->db->where('biaya_speedboat_jemput != ', 0);
            }
        }
        if (!empty($perusahaan)) {
            $this->db->where('perusahaan', $perusahaan);
            $get_perusahaan_data = $this->db->get('operasional')->result();
            foreach ($get_perusahaan_data as $gpd) {
                $gpd_list[] = $gpd->id;
            }
            $this->db->where_in('no_operasional', $gpd_list);
        }
        $get_biaya_operasional = $this->db->get('biaya_operasional')->result();
        $count_all_results     = count($get_biaya_operasional);
        $nomor_ke              = 0;
        if ($get_biaya_operasional) {
            foreach ($get_biaya_operasional as $gogo) {
                $this->db->where('id', $gogo->no_operasional);
                $get_operasional              = $this->db->get('operasional')->row();
                $get_operasional->barang_asal = $get_operasional->barang_asal;
                $this->db->where('id', $get_operasional->barang_asal);
                $get_barang_asal_data = $this->db->get('barang_asal')->row();
                $this->db->where('id', $get_operasional->perusahaan);
                $get_perusahaan_data = $this->db->get('perusahaan')->row();

                if ($get_operasional->operasional_status == 1) {
                    $ngaray['status'] = 'Belum Bayar';
                }
                if ($get_operasional->operasional_status == 2) {
                    $ngaray['status'] = 'Sudah Bayar';
                }
                if ($get_operasional->operasional_status == 3) {
                    $ngaray['status'] = 'Selesai';
                }
                $this->db->where('id', $gogo->no_permohonan);
                $get_permohonan = $this->db->get('permohonan')->row();
                $this->db->where('id', $get_permohonan->kapal);
                $get_kapal = $this->db->get('kapal')->row();
                $this->db->where('id', $get_permohonan->tempat_muat);
                $get_terminal = $this->db->get('terminal')->row();
                $this->db->where('id', $gogo->created_by);
                $get_users         = $this->db->get('users')->row();
                $ngaray['no']      = ++$nomor_ke;
                $ngaray['tanggal'] = $this->tgl_in($get_permohonan->mulai);
                $no_rkbm           = explode('.', $get_permohonan->no_rkbm);
// var_dump(ltrim($no_rkbm[3], '0'));
                $no_rkbm = ltrim($no_rkbm[3], '0');

                $ngaray['no_rkbm']                = $no_rkbm;
                $ngaray['pbm']                    = $get_perusahaan_data->nama;
                $ngaray['terminal']               = $get_terminal->nama;
                $ngaray['perusahaan']             = $get_barang_asal_data->nama;
                $ngaray['kapal']                  = $get_kapal->nama;
                $ngaray['biaya_operasional']      = number_format($gogo->biaya_operasional, 0, ',', '.');
                $ngaray['biaya_honor']            = number_format($gogo->biaya_honor, 0, ',', '.');
                $ngaray['biaya_konsumsi']         = number_format($gogo->biaya_konsumsi, 0, ',', '.');
                $ngaray['biaya_kapal']            = number_format($gogo->biaya_kapal, 0, ',', '.');
                $ngaray['biaya_dozer']            = number_format($gogo->biaya_dozer, 0, ',', '.');
                $ngaray['biaya_speedboat_antar']  = number_format($gogo->biaya_speedboat_antar, 0, ',', '.');
                $ngaray['biaya_speedboat_jemput'] = number_format($gogo->biaya_speedboat_jemput, 0, ',', '.');
                $ngaray['admin']                  = $get_users->firstname . ' ' . $get_users->lastname;
                $bum[]                            = $ngaray;
            }
        } else {
            $count_all_results = 0;
        }
        $count_all_data = count($get_biaya_operasional);
        $bum            = $bum ?? null;
        $output         = array(
            "draw"            => $_POST['draw'],
            "data"            => $bum,
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
        );
        echo json_encode($output);
    }
    public function operasional_rekap($bulan = null, $tahun = null, $jenis = null, $perusahaan = null)
    {
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;
        $jenis      = $jenis == 'undefined' || !is_numeric($jenis) ? null : $jenis;
        $perusahaan = $perusahaan == 'undefined' || !is_numeric($perusahaan) ? null : $perusahaan;

        if (!empty($bulan)) {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $this->db->where('YEAR(created_at)', $tahun);
        }

        if (!empty($jenis)) {
            if ($jenis == 1) {
                $this->db->where('biaya_operasional != ', 0);
            }
            if ($jenis == 2) {
                $this->db->where('biaya_honor != ', 0);
            }
            if ($jenis == 3) {
                $this->db->where('biaya_konsumsi != ', 0);
            }
            if ($jenis == 4) {
                $this->db->where('biaya_kapal != ', 0);
            }
            if ($jenis == 5) {
                $this->db->where('biaya_dozer != ', 0);
            }
            if ($jenis == 6) {
                $this->db->where('biaya_speedboat_antar != ', 0);
            }
            if ($jenis == 7) {
                $this->db->where('biaya_speedboat_jemput != ', 0);
            }
        }

        $get_biaya_operasional = $this->db->get('biaya_operasional')->result();
        $nomor_ke              = 0;
        if ($get_biaya_operasional) {
            foreach ($get_biaya_operasional as $gogo) {
                $this->db->where('id', $gogo->no_operasional);
                $get_operasional              = $this->db->get('operasional')->row();
                $get_operasional->barang_asal = $get_operasional->barang_asal;
                $this->db->where('id', $get_operasional->barang_asal);
                $get_barang_asal_data = $this->db->get('barang_asal')->row();
                $this->db->where('id', $get_operasional->perusahaan);
                $get_perusahaan_data = $this->db->get('perusahaan')->row();

                if ($get_operasional->operasional_status == 1) {
                    $ngaray['status'] = '<t style="background-color: orangered;">Sudah bayar</t>';
                }
                if ($get_operasional->operasional_status == 2) {
                    $ngaray['status'] = '<t style="background-color: skyblue;">Sudah bayar</t>';
                }
                if ($get_operasional->operasional_status == 3) {
                    $ngaray['status'] = '<t style="background-color: aquamarine;">Selesai</t>';
                }

                $this->db->where('id', $gogo->no_permohonan);
                $get_permohonan = $this->db->get('permohonan')->row();
                $this->db->where('id', $get_permohonan->kapal);
                $get_kapal = $this->db->get('kapal')->row();
                $this->db->where('id', $get_permohonan->tempat_muat);
                $get_terminal = $this->db->get('terminal')->row();
                $this->db->where('id', $gogo->created_by);
                $get_users            = $this->db->get('users')->row();
                $ngaray['no']         = ++$nomor_ke;
                $ngaray['tanggal']    = $this->tgl_in($gogo->created_at);
                $ngaray['perusahaan'] = $get_barang_asal_data->nama;

                $no_rkbm = explode('.', $get_permohonan->no_rkbm);
                // var_dump(ltrim($no_rkbm[3], '0'));
                $no_rkbm = ltrim($no_rkbm[3], '0');

                $ngaray['no_rkbm']  = $no_rkbm;
                $ngaray['pbm']      = $get_perusahaan_data->nama;
                $ngaray['terminal'] = $get_terminal->nama;
                $ngaray['kapal']    = $get_kapal->nama;
                $judul              = '';
                if (!empty($jenis)) {
                    if ($jenis == 1) {
                        $judul = "Operasional";
                    }
                    if ($jenis == 2) {
                        $judul = "Honor Foreman";
                    }
                    if ($jenis == 3) {
                        $judul = "Konsumsi Foreman";
                    }
                    if ($jenis == 4) {
                        $judul = "Kapal";
                    }
                    if ($jenis == 5) {
                        $judul = "Dozer";
                    }
                    if ($jenis == 6) {
                        $judul = "Speedboat Antar";
                    }
                    if ($jenis == 7) {
                        $judul = "Speedboat Jemput";
                    }
                } else {
                    $judul = "Semua Operasional";
                }
                $ngaray['biaya_operasional']      = $gogo->biaya_operasional;
                $ngaray['biaya_honor']            = $gogo->biaya_honor;
                $ngaray['biaya_konsumsi']         = $gogo->biaya_konsumsi;
                $ngaray['biaya_kapal']            = $gogo->biaya_kapal;
                $ngaray['biaya_dozer']            = $gogo->biaya_dozer;
                $ngaray['biaya_speedboat_antar']  = $gogo->biaya_speedboat_antar;
                $ngaray['biaya_speedboat_jemput'] = $gogo->biaya_speedboat_jemput;
                // $ngaray['admin']                  = $get_users->firstname . ' ' . $get_users->lastname;
                $bum[] = $ngaray;
            }
        } else {
        }
        $bum  = $bum ?? null;
        $data = array(
            'datalist' => $bum,
            'judul'    => $judul,
            'jenis'    => $jenis,
        );
        $this->load->view('cetak/laporan_biaya_operasional_rekap', $data);

    }

    public function invoice()
    {
        $this->render_view('laporan/laporan_invoice');
    }
    public function load_invoice()
    // public function load_invoice($bulan = null, $tahun = null, $jenis = null, $perusahaan = null)
    {

        $limit      = urldecode($this->input->post('length', true)) ?? null;
        $start      = urldecode($this->input->post('start', true)) ?? null;
        $jenis      = urldecode($this->input->post('jenis', true)) ?? null;
        $perusahaan = urldecode($this->input->post('perusahaan', true)) ?? null;
        $bulan = urldecode($this->input->post('bulan', true)) ?? null;
        $tahun = urldecode($this->input->post('tahun', true)) ?? null;
        // $bulan      = urldecode($this->input->post('bulan', true)) == 'undefined' || !is_numeric(urldecode($this->input->post('bulan', true))) ? idate("m") : urldecode($this->input->post('bulan', true));
        // $tahun      = urldecode($this->input->post('tahun', true)) == 'undefined' || !is_numeric(urldecode($this->input->post('tahun', true))) ? idate("Y") : urldecode($this->input->post('tahun', true));
        // $jenis      = $jenis == 'undefined' || !is_numeric($jenis) ? null : $jenis;
        // $perusahaan = $perusahaan == 'undefined' || !is_numeric($perusahaan) ? null : $perusahaan;

        $get_operasional_s = $this->db->get('operasional')->result();

        if (!empty($bulan)) {
            $ngaray['bulan'] = $bulan;
            $this->db->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $ngaray['tahun'] = $tahun;
            $this->db->where('YEAR(created_at)', $tahun);
        }

        if (!empty($jenis)) {
            if ($jenis == 1) {
                $this->db->where('operasional_status', 1);
            }
            if ($jenis == 2) {
                $this->db->where('operasional_status', 2);
            }
            if ($jenis == 3) {
                $this->db->where('operasional_status', 3);
            }
        }
        if (!empty($perusahaan)) {
            $this->db->where('perusahaan', $perusahaan);
        }

        $this->db->limit($limit, $start);
        $get_operasional   = $this->db->get('operasional')->result();
        $count_all_results = count($get_operasional_s);
        $nomor_ke          = 0;  
              $bruto          = 0;
              $pphnya          = 0;
              $neto          = 0;
        $bum               = array();
        if ($get_operasional) {
            foreach ($get_operasional as $gogo) {
                $this->db->where('id', $gogo->perusahaan);
                $get_perusahaan_data = $this->db->get('perusahaan')->row();

                if ($gogo->operasional_status == 1) {
                    $ngaray['status'] = '<t style="background-color: orangered;">Belum bayar</t>';
                }
                if ($gogo->operasional_status == 2) {
                    $ngaray['status'] = '<t style="background-color: yellow;">Sudah bayar</t>';
                }
                if ($gogo->operasional_status == 3) {
                    $ngaray['status'] = '<t style="background-color: palegreen;">Selesai</t>';
                }
                $ngaray['no']      = ++$nomor_ke;
                $ngaray['tanggal'] = date_format(date_create($gogo->created_at), "d/m/y");
                $ngaray['shipper'] = $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->inisial;
                $total_pph         = $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->total_pph;

                $ngaray['invoice'] = $gogo->id
                . '/' .
                $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->inisial
                . '/' .
                $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'perusahaan', $gogo->perusahaan)->inisial
                . '-SMD' . '/' .
                $this->romawi(date('m', strtotime($gogo->created_at)))
                . '/' .
                explode(' ', (int)$gogo->created_at)[0];

                $ngaray['pbm'] = $get_perusahaan_data->nama;

                $this->db->where('operasional', $gogo->id);
                $this->db->where('cetak', 1);
                $get_permohonan_list = $this->db->get('permohonan')->result();
                $jumlahnya           = (int) 0;
                foreach ($get_permohonan_list as $gpl) {
                    if ($gpl->payment > 0 || !empty($gpl->payment)) {
                        $jumlahnya += (int)$gpl->payment;
                    } else {
                        if ($gpl->status == 1) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_baru);
                        }
                        if ($gpl->status == 2) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_perpanjang);
                        }
                        if ($gpl->status == 3) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_revisi);
                        }
                    }
                }
                // var_dump($total_pph);
                if ($total_pph > 0) {
                    $jumlahnyas = ((int)$total_pph * (int)$jumlahnya) / 100;
                    $bruto  = $jumlahnya;
                    $pphnya  = $jumlahnyas;
                    $neto  = $bruto - $jumlahnyas;
                }
                // $ngaray['biaya'] = $jumlahnya;
                $ngaray['bruto'] = number_format($bruto, 0, ',', '.');
                $ngaray['pph'] = number_format($pphnya, 0, ',', '.');
                $ngaray['neto'] = number_format($neto, 0, ',', '.');
                $bum[]           = $ngaray;
            }
        } else {
            $count_all_results = 0;
        }

        $bum            = $bum ?? null;
        $count_all_data = count($get_operasional);
        $output         = array(
            "draw"            => $_POST['draw'],
            "data"            => $bum,
            "recordsTotal"    => $count_all_data,
            "recordsFiltered" => $count_all_results,
        );
        echo json_encode($output);
    }

    public function invoice_rekap($bulan = null, $tahun = null, $jenis = null, $perusahaan = null)
    {
        // $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? idate("m") : $bulan;
        // $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? idate("Y") : $tahun;
        $tahun      = $tahun == 'undefined' || !is_numeric($tahun) ? null : $tahun;
        $bulan      = $bulan == 'undefined' || !is_numeric($bulan) ? null : $bulan;
        $jenis      = $jenis == 'undefined' || !is_numeric($jenis) ? null : $jenis;
        $perusahaan = $perusahaan == 'undefined' || !is_numeric($perusahaan) ? null : $perusahaan;

        if (!empty($bulan)) {
            $ngaray['bulan'] = $bulan;
            $this->db->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $ngaray['tahun'] = $tahun;
            $this->db->where('YEAR(created_at)', $tahun);
        }

        if (!empty($jenis)) {
            if ($jenis == 1) {
                $this->db->where('operasional_status', 1);
            }
            if ($jenis == 2) {
                $this->db->where('operasional_status', 2);
            }
            if ($jenis == 3) {
                $this->db->where('operasional_status', 3);
            }
        }
        if (!empty($perusahaan)) {
            $this->db->where('perusahaan', $perusahaan);
        }

        $get_operasional = $this->db->get('operasional')->result();
        $nomor_ke        = 0;
        
        if ($get_operasional) {
            foreach ($get_operasional as $gogo) {
                $this->db->where('id', $gogo->perusahaan);
                $get_perusahaan_data = $this->db->get('perusahaan')->row();

                if ($gogo->operasional_status == 1) {
                    $ngaray['status'] = '<t style="background-color: orangered;">Belum bayar</t>';
                }
                if ($gogo->operasional_status == 2) {
                    $ngaray['status'] = '<t style="background-color: yellow;">Sudah bayar</t>';
                }
                if ($gogo->operasional_status == 3) {
                    $ngaray['status'] = '<t style="background-color: palegreen;">Selesai</t>';
                }
                $ngaray['no']      = ++$nomor_ke;
                $ngaray['tanggal'] = date_format(date_create($gogo->created_at), "d/m/y");
                $ngaray['shipper'] = $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->inisial;
                $total_pph         = $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->total_pph;

                $ngaray['invoice'] = $gogo->id
                . '/' .
                $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $gogo->barang_asal)->inisial
                . '/' .
                $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'perusahaan', $gogo->perusahaan)->inisial
                . '-SMD' . '/' .
                $this->romawi(date('m', strtotime($gogo->created_at)))
                . '/' .
                explode(' ', (int)$gogo->created_at)[0];

                $ngaray['pbm'] = $get_perusahaan_data->nama;

                $this->db->where('operasional', $gogo->id);
                $this->db->where('cetak', 1);
                $get_permohonan_list = $this->db->get('permohonan')->result();
                $jumlahnya           = (int) 0;
                foreach ($get_permohonan_list as $gpl) {
                    if ($gpl->payment > 0 || !empty($gpl->payment)) {
                        $jumlahnya += (int)$gpl->payment;
                    } else {
                        if ($gpl->status == 1) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_baru);
                        }
                        if ($gpl->status == 2) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_perpanjang);
                        }
                        if ($gpl->status == 3) {
                            $this->db->where('id', $gogo->barang_asal);
                            $bas       = $this->db->get('barang_asal')->row();
                            $jumlahnya = $jumlahnya + ((int)substr($gpl->jumlah_kira, 0, -3) * (int)$bas->tarif_revisi);
                        }
                    }
                }
                // var_dump($total_pph);
                if ($total_pph > 0) {
                    $jumlahnyas = ((int)$total_pph * (int)$jumlahnya) / 100;
                    $bruto  = $jumlahnya;
                    $pphnya  = $jumlahnyas;
                    $neto  = $bruto - $jumlahnyas;
                }
                // $ngaray['biaya'] = $jumlahnya;
                $ngaray['bruto'] = $bruto;
                $ngaray['pph'] = $pphnya;
                $ngaray['neto'] = $neto;
                $bum[]           = $ngaray;
            }

        } else {
        }
        $judul = '';
        if (!empty($bulan)) {
            $judul .= date('F', strtotime('2022-' . $bulan . '-05'));
        }

        if (!empty($tahun)) {
            $judul .= ' ' . date('Y', strtotime($tahun . '06-05'));
        }
        $bum  = $bum ?? null;
        $data = array(
            'datalist' => $bum,
            'judul'    => $judul,
            'jenis'    => $jenis,
        );
        $this->load->view('cetak/laporan_invoice_rekap', $data);
    }
}
