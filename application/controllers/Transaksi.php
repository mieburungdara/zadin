<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends Admin_controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->render_view('transaksi/input');
    }
    public function input()
    {
        $this->render_view('transaksi/input');
    }
    public function daftar()
    {
        $this->render_view('transaksi/daftar');
    }
    public function akun_input()
    {

        $input_transaksi_akun            = urldecode($this->input->post('input_transaksi_akun', true)) ?? null;
        $input_tp2_akun                  = urldecode($this->input->post('input_tp2_akun', true)) ?? null;
        $input_keterangan_transaksi_akun = urldecode($this->input->post('input_keterangan_transaksi_akun', true)) ?? null;
        $transaksi_akun_kas              = urldecode($this->input->post('transaksi_akun_kas', true)) ?? null;
        $transaksi_akun_bank             = urldecode($this->input->post('transaksi_akun_bank', true)) ?? null;

        $transaksi_akun_kas  = str_replace(".", "", $transaksi_akun_kas);
        $transaksi_akun_bank = str_replace(".", "", $transaksi_akun_bank);

        if ($input_transaksi_akun && $input_tp2_akun && $input_keterangan_transaksi_akun) {
            $this->db->where('YEAR(tanggal)', date('Y', strtotime($input_tp2_akun)));
            $fef    = $this->db->get('transaksi')->result();
            $no_kas = count($fef) + 1;
            // var_dump($fef);

            $data = array(
                'no_kas'          => $no_kas,
                'tanggal'         => date('Y-m-d', strtotime($input_tp2_akun)),
                'no_akun'         => $input_transaksi_akun,
                'keterangan'      => $input_keterangan_transaksi_akun,
                'kas'             => $transaksi_akun_kas,
                'bank'            => $transaksi_akun_bank,
                'jenis_transaksi' => 2,
            );
            $this->db->insert('transaksi', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
        // $this->render_view('transaksi/index');
    }
    public function akun()
    {
        $input_akun      = urldecode($this->input->post('input_akun', true)) ?? null;
        $input_tanggal   = urldecode($this->input->post('input_tanggal', true)) ?? null;
        $nominal         = urldecode($this->input->post('nominal', true)) ?? null;
        $jenis_transaksi = urldecode($this->input->post('jenis_transaksi', true)) ?? null;
        $dana            = urldecode($this->input->post('dana', true)) ?? null;
        $keterangan      = urldecode($this->input->post('keterangan', true)) ?? null;

        $nominal = str_replace(".", "", $nominal);

        if ($input_akun && $input_tanggal && $nominal && $jenis_transaksi && $dana) {
            // $this->db->where('YEAR(tanggal)', date('Y', strtotime($input_tp2_akun)));
            // $fef    = $this->db->get('transaksi')->result();
            // $no_kas = count($fef) + 1;
            // var_dump($fef);

            
            $data = array(
                // 'no_kas'          => ,
                 'tanggal'    => date('Y-m-d h:i:s', strtotime($input_tanggal)),
                'akun_kode'  => $input_akun,
                'buku'       => $dana,
                'keterangan' => $keterangan,
                'dk'         => $jenis_transaksi,
                'nominal'    => $nominal,
                'terbayar'   => $nominal,
                'tersisa'    => 0,
            );
            $this->db->insert('transaksi', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
    }
    public function load_invoice()
    {
        // $this->db->where('kas_group', null);
        $fre            = $this->db->get('operasional')->result();
        $count_all_data = count($fre);

        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->limit($length, $start);
        $fr                = $this->db->get('operasional')->result();
        $count_all_results = count($fr);

        foreach ($fr as $rf) {
            $ngaray['inv'] = $rf->id;
            $this->db->where('id', $rf->kas_group);
            $ngerow = $this->db->get('transaksi')->row();
            // var_dump($ngerow);
            if ($ngerow) {
                $nokas = $ngerow->no_kas;
            } else {
                $nokas = '';
            }
            $ngaray['kas']        = $nokas;
            $ngaray['date']       = $rf->updated_at;
            $ngaray['keterangan'] = '<a href="' . base_url('operasional/no/' . $rf->id) . '">' . $rf->nama . '</a>';
            $ngaray['tagihan']    = number_format($rf->st, 0, ',', '.');
            $bum[]                = $ngaray;
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
    public function load_transaksi()
    {
        // $this->db->where('kas_group', null);
        $fre            = $this->db->get('transaksi')->result();
        $count_all_data = count($fre);

        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->limit($length, $start);
        $fr                = $this->db->get('transaksi')->result();
        $count_all_results = count($fr);
        $inc               = 1;
        if ($fr) {
            foreach ($fr as $rf) {
                $ngaray['no']         = $inc++;
                $ngaray['tanggal']    = $rf->tanggal;
                $ngaray['no_akun']    = $rf->akun_kode;
                $ngaray['keterangan'] = $rf->keterangan;
                $ngaray['jenis']      = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['nominal']    = number_format($rf->nominal, 0, ',', '.');
                $ngaray['dana']       = $rf->buku == 1 ? 'Kas' : 'Bank';
                $ngaray['transaksi']  = $this->db->get_where('akun_kode', array('id' => $rf->akun_kode))->row()->nama;
                // $ngaray['updated_at'] = $rf->updated_at;
                // $ngaray['inv'] = $rf->id;
                // $this->db->where('id', $rf->kas_group);
                // $ngerow = $this->db->get('transaksi')->row();
                // // var_dump($ngerow);
                // if ($ngerow) {
                //     $nokas = $ngerow->no_kas;
                // } else {
                //     $nokas = '';
                // }
                // $ngaray['kas']        = $nokas;
                // $ngaray['date']       = $rf->updated_at;
                // $ngaray['keterangan'] = '<a href="' . base_url('operasional/no/' . $rf->id) . '">' . $rf->nama . '</a>';
                // $ngaray['tagihan']    = number_format($rf->st, 0, ',', '.');
                $bum[] = $ngaray;
            }
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
    public function inventori_input()
    {
        $input_akun       = urldecode($this->input->post('input_akun', true)) ?? null;
        $input_tanggal    = urldecode($this->input->post('input_tanggal', true)) ?? null;
        $input_keterangan = urldecode($this->input->post('input_keterangan', true)) ?? null;
        $jb               = urldecode($this->input->post('jb', true)) ?? null;
        $hs               = urldecode($this->input->post('hs', true)) ?? null;
        $input_pembayaran = urldecode($this->input->post('input_pembayaran_apa', true)) ?? null;

        $jb = str_replace(".", "", $jb);
        $hs = str_replace(".", "", $hs);

        if ($input_akun && $input_tanggal && $input_keterangan && $jb && $hs && $input_pembayaran) {
            $this->db->where('YEAR(tanggal)', date('Y', strtotime($input_tanggal)));
            $fef    = $this->db->get('transaksi')->result();
            $no_kas = count($fef) + 1;
            // var_dump($fef);

            $data = array(
                'no_kas'          => $no_kas,
                'tanggal'         => date('Y-m-d', strtotime($input_tanggal)),
                'no_akun'         => $input_akun,
                'keterangan'      => $input_keterangan,
                'jumlah_barang'   => $jb,
                'harga_barang'    => $hs,
                'jenis_transaksi' => 3,
            );
            if ($input_pembayaran == 'bank') {
                $datas = array(
                    'bank' => $jb * $hs,
                );
            }
            if ($input_pembayaran == 'kas') {
                $datas = array(
                    'kas' => $jb * $hs,
                );
            }
            $data = array_merge($data, $datas);
            $this->db->insert('transaksi', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
        // $this->render_view('transaksi/index');
    }
    public function form_invoice()
    {
        $input_inv     = $this->input->post('input_inv', true) ?? null;
        $input_tanggal = urldecode($this->input->post('input_tanggal', true)) ?? null;
        // $input_nominal    = urldecode($this->input->post('input_nominal', true)) ?? null;
        $input_terbayar   = urldecode(trim($this->input->post('terbayar', true), '.')) ?? null;
        $jenis_transaksi  = urldecode($this->input->post('jenis_transaksi', true)) ?? null;
        $dana             = urldecode($this->input->post('dana', true)) ?? null;
        $input_keterangan = urldecode($this->input->post('keterangan', true)) ?? null;

        if ($input_inv && $input_tanggal && $input_terbayar && $jenis_transaksi && $dana) {
            // $this->db->where('YEAR(tanggal)', date('Y', strtotime($input_tanggal)));
            // $fef    = $this->db->get('transaksi')->result();
            // $no_kas = count($fef) + 1;
            // var_dump($input_inv);
            $input_terbayar  = str_replace('.', '', $input_terbayar);
            $jumlah_invoices = count($input_inv);
            $total_invoices  = 0;
            foreach ($input_inv as $invoice) {
                $this->db->where('id', $invoice);
                $hehe           = $this->db->get('operasional')->row();
                $total_invoices = $total_invoices + $hehe->tt;
            }
            $nominal        = $total_invoices;
            $input_terbayar = $input_terbayar;
            $tersisa        = (int)$nominal - (int)$input_terbayar;
            // var_dump($total_invoices);

            $data = array(
                // 'no_kas'          => ,
                 'tanggal'    => date('Y-m-d h:i:s', strtotime($input_tanggal)),
                'akun_kode'  => 2,
                'buku'       => $dana,
                'keterangan' => $input_keterangan,
                'dk'         => $jenis_transaksi,
                'nominal'    => $nominal,
                'terbayar'   => $input_terbayar,
                'tersisa'    => $tersisa,
            );
            $this->db->insert('transaksi', $data);
            if ($this->db->affected_rows() > 0) {
                $lastinsertid = $this->db->insert_id();
                foreach ($input_inv as $invoice) {
                    $invoice;
                    $this->db->set('id_transaksi', $lastinsertid);
                    $this->db->where('id', $invoice);
                    $this->db->update('operasional');
                    if ($this->db->affected_rows() == 0) {
                        echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
                    } else {
                        echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
                    }
                }

                // foreach ($input_inv as $invoice) {
                //     $kg = array(
                //         'kas_group' => $lastinsertid,
                //     );
                //     $this->db->where('id', $invoice);
                //     $result = $this->db->update('operasional', $kg);
                // }
                // $this->db->where('id', $lastinsertid);
                // echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
        // $this->render_view('transaksi/index');
    }
    public function get_invoice()
    {
        $input_inv = $this->input->post('name', true) ?? null;
        // var_dump($input_inv);
        if ($input_inv) {
            $jumlah_tt = 0;
            foreach ($input_inv as $invoice) {
                $this->db->where('id', $invoice);
                $inp       = $this->db->get('operasional')->row();
                $jumlah_tt = $jumlah_tt + $inp->tt;
            }
            echo ($jumlah_tt);
        }
    }
}

/* End of file Transaksi.php and path \application\controllers\Transaksi.php */