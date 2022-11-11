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
    public function ps()
    {
        $input_tanggal = urldecode($this->input->post('input_tanggal', true)) ?? null;
        $nominal       = urldecode($this->input->post('nominal', true)) ?? null;
        $dana          = urldecode($this->input->post('dana', true)) ?? null;
        $keterangan    = urldecode($this->input->post('keterangan', true)) ?? null;
        $nominal       = str_replace(".", "", $nominal);
        if ($input_tanggal && $nominal && $keterangan && $dana) {
            $data = array(
                'tanggal'    => date('Y-m-d h:i:s', strtotime($input_tanggal)),
                'akun_kode'  => 19,
                'buku'       => $dana,
                'keterangan' => $keterangan,
                'dk'         => 2,
                'nominal'    => $nominal,
                'terbayar'   => 0,
                'tersisa'    => $nominal,
            );
            $this->db->insert('transaksi', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
            } else {
                echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
            }
        }
    }

    public function pk()
    {
        $input_akun      = urldecode($this->input->post('input_akun', true)) ?? null;
        $input_tanggal   = urldecode($this->input->post('input_tanggal', true)) ?? null;
        $nominal         = urldecode($this->input->post('nominal', true)) ?? null;
        $jenis_transaksi = urldecode($this->input->post('jenis_transaksi', true)) ?? null;
        $dana            = urldecode($this->input->post('dana', true)) ?? null;
        $keterangan      = urldecode($this->input->post('keterangan', true)) ?? null;
        $nominal         = str_replace(".", "", $nominal);

        if ($input_akun && $input_tanggal && $nominal && $jenis_transaksi && $dana) {
            $data = array(
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

    public function load_invoices()
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
        $this->db->order_by('tanggal', 'desc');
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
    public function load_laporan_transaksi()
    {
        // $this->db->where('kas_group', null);
        $fre            = $this->db->get('transaksi')->result();
        $count_all_data = count($fre);

        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->limit($length, $start);
        $this->db->order_by('tanggal', 'desc');
        $fr                = $this->db->get('transaksi')->result();
        $count_all_results = count($fr);
        // $inc               = 1;
        if ($fr) {
            foreach ($fr as $rf) {
                // $ngaray['no']         = $inc++;
                $ngaray['tanggal']    = $rf->tanggal;
                $ngaray['no_akun']    = $rf->akun_kode;
                $ngaray['keterangan'] = $rf->keterangan;
                // $jenis      = $rf->dk == 1 ? 'Debit' : 'Kredit';
                // $ngaray['jenis']      = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['no_kas']  = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['debit']   = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['credit']  = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['saldo']   = $rf->dk == 1 ? 'Debit' : 'Kredit';
                $ngaray['nominal'] = number_format($rf->nominal, 0, ',', '.');
                $ngaray['dana']    = $rf->buku == 1 ? 'Kas' : 'Bank';
                $ngaray['no_akun'] = $this->db->get_where('akun_kode', array('id' => $rf->akun_kode))->row()->nama;
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
    public function load_umum()
    {
        $this->db->where('umum', 1);
        $akun_kode = $this->db->get('akun_kode')->result();
        foreach ($akun_kode as $akun) {
            $sut[] = $akun->id;
        }
        $this->db->or_where_in('akun_kode', $sut);
        // $this->db->where('kas_group', null);
        $fre = $this->db->get('transaksi')->result();
        // var_dump($fre);
        $count_all_data = count($fre);

        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->where('umum', 1);
        $akun_kode = $this->db->get('akun_kode')->result();
        foreach ($akun_kode as $akun) {
            $sut[] = $akun->id;
        }
        $this->db->or_where_in('akun_kode', $sut);
        $this->db->limit($length, $start);
        $this->db->order_by('tanggal', 'desc');
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
    public function load_invoice()
    {
        // $this->db->where('umum', 1);
        // $akun_kode = $this->db->get('akun_kode')->result();
        // foreach ($akun_kode as $akun) {
        //     $sut[] = $akun->id;
        // }
        // $this->db->or_where_in('akun_kode', $sut);
        // $this->db->where('kas_group', null);
        $this->db->where('akun_kode', 101);
        $fre = $this->db->get('transaksi')->result();
        // var_dump($fre);
        $count_all_data = count($fre);

        $this->db->where('akun_kode', 101);
        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->limit($length, $start);
        $this->db->order_by('tanggal', 'desc');
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
    public function load_operasional()
    {
        // $this->db->where('umum', 1);
        // $akun_kode = $this->db->get('akun_kode')->result();
        // foreach ($akun_kode as $akun) {
        //     $sut[] = $akun->id;
        // }
        // $this->db->or_where_in('akun_kode', $sut);
        // $this->db->where('kas_group', null);
        $this->db->where('akun_kode', 18);
        $fre = $this->db->get('transaksi')->result();
        // var_dump($fre);
        $count_all_data = count($fre);

        $this->db->where('akun_kode', 18);
        $start  = urldecode($this->input->post('start', true));
        $length = urldecode($this->input->post('length', true));
        // $this->db->where('kas_group', null);
        $this->db->limit($length, $start);
        $this->db->order_by('tanggal', 'desc');
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
        $input_terbayar   = urldecode(trim($this->input->post('terbayar_invoice', true), '.')) ?? null;
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
                'akun_kode'  => 101,
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
    public function operasional()
    {
        $input_inv     = $this->input->post('input_op', true) ?? null;
        $input_tanggal = urldecode($this->input->post('input_tanggal', true)) ?? null;
        // $input_nominal    = urldecode($this->input->post('input_nominal', true)) ?? null;
        $input_terbayar   = urldecode(trim($this->input->post('terbayar_operasional', true), '.')) ?? null;
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
                $hehe           = $this->db->get('biaya_operasional')->row();
                $total_invoices = $total_invoices + $hehe->biaya;
            }
            $nominal        = $total_invoices;
            $input_terbayar = $input_terbayar;
            $tersisa        = (int)$nominal - (int)$input_terbayar;
            // var_dump($total_invoices);

            $data = array(
                // 'no_kas'          => ,
                 'tanggal'    => date('Y-m-d h:i:s', strtotime($input_tanggal)),
                'akun_kode'  => 18,
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
                    $this->db->update('biaya_operasional');
                    if ($this->db->affected_rows() == 0) {
                        echo json_encode(array('status' => 'no', 'data' => $this->db->error()));
                    } else {
                        // echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
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
                echo json_encode(array('status' => 'ok', 'data' => 'Berhasil..'));
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
    public function get_operasional()
    {
        $input_inv = $this->input->post('name', true) ?? null;
        // var_dump($input_inv);
        if ($input_inv) {
            $jumlah_tt = 0;
            foreach ($input_inv as $invoice) {
                $this->db->where('id', $invoice);
                $inp       = $this->db->get('biaya_operasional')->row();
                $jumlah_tt = $jumlah_tt + $inp->biaya;
            }
            echo ($jumlah_tt);
        }
    }

    public function hitung_transaksi()
    {
        //cari kode akun yg dihitung
        $this->db->where('hitung', 1);
        $akun_kode = $this->db->get('akun_kode')->result();
        // pre($akun_kode);
        foreach ($akun_kode as $aknkde) {
            //cari sesuai id kode akun di table transaksi
            $this->db->where('akun_kode', $aknkde->id);
            $transaksi = $this->db->get('transaksi')->result();
            if (empty($transaksi)) {
            } else {
                foreach ($transaksi as $tran) {
                    $id_transaksi = $tran->id;
                    $akun_kode    = $tran->akun_kode;
                    $buku         = $tran->buku;
                    $tanggal      = getDate(strtotime($tran->tanggal))['mday'];
                    $bulan        = getDate(strtotime($tran->tanggal))['mon'];
                    $tahun        = getDate(strtotime($tran->tanggal))['year'];
                    $dk           = $tran->dk;
                    $saldo        = $tran->terbayar;

                    $this->db->where('id_transaksi', $id_transaksi);
                    $hitungz = $this->db->get('laporan_transaksi')->row();
                    if ($hitungz) {
                        unset($data);
                        $data = array(
                            'akun_kode' => $akun_kode,
                            'buku'      => $buku,
                            'tanggal'   => $tanggal,
                            'bulan'     => $bulan,
                            'tahun'     => $tahun,
                            'dk'        => $dk,
                            'saldo'     => $saldo,
                        );
                        $this->db->where('id_transaksi', $id_transaksi);
                        $this->db->update('laporan_transaksi', $data);
                    } else {
                        unset($data);
                        $data = array(
                            'id_transaksi' => $id_transaksi,
                            'akun_kode'    => $akun_kode,
                            'buku'         => $buku,
                            'tanggal'      => $tanggal,
                            'bulan'        => $bulan,
                            'tahun'        => $tahun,
                            'dk'           => $dk,
                            'saldo'        => $saldo,
                        );
                        $this->db->insert('laporan_transaksi', $data);
                    }
                }
            }
        }
    }

    public function fix_laporan_transaksi_id()
    {
        $this->db->order_by('bulan ASC', 'tahun ASC');
        // $this->db->order_by('bulan', 'asc');
        // $this->db->order_by('tahun', 'asc');
        $laporan_transaksi = $this->db->get('laporan_transaksi')->result();
        pre($laporan_transaksi);
        $i = 1;
        // $i = count($laporan_transaksi);
        foreach ($laporan_transaksi as $lt) {
            $this->db->set('id', $i++);
            $this->db->where('id', $lt->id);
            // $this->db->where('id_transaksi', $lt->id);
            $this->db->update('laporan_transaksi');
        }
    }

    public function hitung_saldo_awal()
    {
        // $this->db->order_by('tahun', 'asc');
        // $this->db->order_by('bulan', 'asc');
        $this->db->where_in('akun_kode', array(22, 21));
        $laporan_transaksi = $this->db->get('laporan_transaksi')->result();
        // pre($laporan_transaksi);
        if (empty($laporan_transaksi)) {
            $this->db->where_in('akun_kode', array(22, 21));
            $saldo_awal = $this->db->get('transaksi')->result();
            // pre($saldo_awal);
            foreach ($saldo_awal as $sa) {
                $id_transaksi = $sa->id;
                $akun_kode    = $sa->akun_kode;
                $buku         = $sa->buku;
                $tanggal      = getDate(strtotime($sa->tanggal))['mday'];
                $bulan        = getDate(strtotime($sa->tanggal))['mon'];
                $tahun        = getDate(strtotime($sa->tanggal))['year'];
                $dk           = $sa->dk;
                $saldo        = $sa->terbayar;
                $data         = array(
                    'id_transaksi' => $id_transaksi,
                    'akun_kode'    => $akun_kode,
                    'buku'         => $buku,
                    'tanggal'      => $tanggal,
                    'bulan'        => $bulan,
                    'tahun'        => $tahun,
                    'dk'           => $dk,
                    'saldo'        => $saldo,
                );
                $this->db->insert('laporan_transaksi', $data);
            }
        } else {
            echo 'ada';
        }

        // $this->db->where('month(tanggal)', date('m'));
        // $this->db->where('year(tanggal)', date('Y'));
        // $this->db->where('akun_kode', 25);
        // $result1 = $this->db->get('transaksi')->row();
        // echo $this->db->last_query();

        // pre($result1);
        // if(empty($result)){
        //     $this->db->where('akun_kode', 23);
        //     $result2 = $this->db->get('transaksi')->row();
        //     pre($result2);
        //     if(empty($result2)){
        //         $this->db->where('akun_kode', 21);
        //         $result3 = $this->db->get('transaksi')->row();
        //         pre($result3);
        //         if(empty($result3)){
        //             echo 'belum memasukkan saldo awal, mohon masukkan terlebih dahulu';
        //         }else{
        //             $this->db->set('akun_kode', 23);
        //             $this->db->set

        //         }
        //     }
        // }
        // echo date('Y-m');
        // exit();
    }
    public function hitung_saldo_tiap_akhir_bulan()
    {
        $this->db->group_by('bulan');
        $this->db->group_by('tahun');
        $laporan_transaksi = $this->db->get('laporan_transaksi')->result();
        // pre($laporan_transaksi);
        if (empty($laporan_transaksi)) {
        } else {
            foreach ($laporan_transaksi as $lt) {
                $bulan = $lt->bulan;
                $tahun = $lt->tahun;
                $this->db->where('bulan', $bulan);
                $this->db->where('tahun', $tahun);
                $result = $this->db->get('laporan_transaksi')->result();
                // pre($result);
                $saldo_kas  = 0;
                $saldo_bank = 0;
                foreach ($result as $res) {
                    if ($res->buku == 1) {
                        // pre($res);
                        if ($res->dk == 1) {
                            $saldo_kas += $res->saldo;
                        }
                        if ($res->dk == 2) {
                            $saldo_kas -= $res->saldo;
                        }
                    }
                    if ($res->buku == 2) {
                        // pre($res);
                        if ($res->dk == 1) {
                            $saldo_bank += $res->saldo;
                        }
                        if ($res->dk == 2) {
                            $saldo_bank -= $res->saldo;
                        }
                    }
                }

                $this->db->where('bulan', $bulan);
                $this->db->where('tahun', $tahun);
                $this->db->where('akun_kode', 23);
                $result23 = $this->db->get('laporan_transaksi')->row();
                if ($result23) {
                    // pre($result23);
                    $this->db->set('saldo', $saldo_kas);
                    $this->db->where('id', $result23->id);
                    $this->db->update('laporan_transaksi');
                } else {
                    $this->db->set('bulan', $bulan);
                    $this->db->set('tahun', $tahun);
                    $this->db->set('buku', 1);
                    $this->db->set('akun_kode', 23);
                    $this->db->set('saldo', $saldo_kas);
                    $this->db->insert('laporan_transaksi');
                }

                $this->db->where('bulan', $bulan);
                $this->db->where('tahun', $tahun);
                $this->db->where('akun_kode', 24);
                $result24 = $this->db->get('laporan_transaksi')->row();
                if ($result24) {
                    pre($result24);
                    $this->db->set('saldo', $saldo_bank);
                    $this->db->where('id', $result24->id);
                    $this->db->update('laporan_transaksi');
                } else {
                    $this->db->set('bulan', $bulan);
                    $this->db->set('tahun', $tahun);
                    $this->db->set('buku', 2);
                    $this->db->set('akun_kode', 24);
                    $this->db->set('saldo', $saldo_bank);
                    $this->db->insert('laporan_transaksi');
                }
                // pre($saldo_kas);
                echo '<br>';
                // pre($saldo_bank);
                echo '==';
                echo '<br>';
            }

        }
    }
    public function total_invoice_perbulan()
    {
        // $this->db->select('*, MONTH(tanggal) as bulan');
        // $this->db->select('tanggal, akun_kode, buku,dk');
        $this->db->where('akun_kode', 101);
        $this->db->order_by('MONTH(tanggal)', 'asc');
        $this->db->group_by('MONTH(tanggal)');
        $result1 = $this->db->get('transaksi')->result();
        // pre($result1);
        foreach ($result1 as $row1) {
            $tanggal = getDate(strtotime($row1->tanggal))['mday'];
            $bulan   = getDate(strtotime($row1->tanggal))['mon'];
            $tahun   = getDate(strtotime($row1->tanggal))['year'];
        }
        $this->load->library('table');

        $this->table->set_heading('Name', 'Color', 'Size');
        echo '<style>
    body{
        width: 21cm;
        height: 29.7cm;
        margin-left: auto;
        margin-right: auto;
        /*margin: 30mm 45mm 30mm 45mm;
         change the margins as you want them to be. */
   }
</style>';
        $this->table->add_row('Fred', 'Blue', 'Small');
        $this->table->add_row('Mary', 'Red', 'Large');
        $this->table->add_row('John', 'Green', 'Medium');
        $this->table->set_caption('Colors');
        $template = array(
            'table_open'         => '<table width="100%" border="1" cellpadding="4" cellspacing="0">',

            'thead_open'         => '<thead bgcolor="#0bb31e">',
            'thead_close'        => '</thead>',

            'heading_row_start'  => '<tr>',
            'heading_row_end'    => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end'   => '</th>',

            'tbody_open'         => '<tbody>',
            'tbody_close'        => '</tbody>',

            'row_start'          => '<tr>',
            'row_end'            => '</tr>',
            'cell_start'         => '<td>',
            'cell_end'           => '</td>',

            'row_alt_start'      => '<tr>',
            'row_alt_end'        => '</tr>',
            'cell_alt_start'     => '<td>',
            'cell_alt_end'       => '</td>',

            'table_close'        => '</table>',
        );

        $this->table->set_template($template);
        echo $this->table->generate();

    }

    public function hitung()
    {
        // $this->hitung_transaksi();
        // $this->hitung_saldo_awal();
        // $this->hitung_saldo_tiap_akhir_bulan();
        // sleep(1);
        // $this->fix_laporan_transaksi_id();
        $this->total_invoice_perbulan();
    }
}

/* End of file Transaksi.php and path \application\controllers\Transaksi.php */