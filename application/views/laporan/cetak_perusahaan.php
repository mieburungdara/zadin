<?php

function tgl_in($date)
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

?>

<html lang="en">

    <head>
        <title>Laporan Data PT. Zadin Mitra Abadi</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
        .fonts {
            font-family: "Times New Roman", Times, serif;
        }

        .noBorder {
            border: none !important;
            border-collapse: separate;
            border-spacing: 0px 15px;
        }

        @media print and (width: 21cm) and (height: 29.7cm) {
            @page {
                margin: 0.5cm;
            }
        }

        @page {
            /* size: F4 landscape; */
            size: A4 landscape;
            margin: 5%;
        }

        @media print {
            tfoot {
                display: table-row-group;
                bottom: 0;
                height: 50px;
                width: 100%;
                /* position: sticky; */

            }

            #datatables>th>td {
                border: solid black !important;
                border-width: 1px 1px 1px 1px !important;
            }
        }
        </style>
        <style>
        .bootstrapiso .tooltip {
            font-size: 15px;
        }

        .bootstrapiso .tooltip-inner {
            max-width: 200px;
        }
        </style>
    </head>
    <?php
$this->db->where('id', $perusahaan);
$get_perusahaan = $this->db->get('perusahaan')->row();
// echo ; ?>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="text-align: center"><strong>LAPORAN KEGIATAN PERUSAHAAN BONGKAR MUAT</strong></h5>
                    <br>
                    <table style="font-size: 11px">
                        <tbody>
                            <tr style="height: 16px;">
                                <th>Nama Perusahaan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><strong><?=$get_perusahaan->nama; ?></strong></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Alamat Perusahaan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_perusahaan->alamat; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Pelabuhan Bongkar Muat</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_perusahaan->pelabuhan; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor SIUP PBM</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_perusahaan->sk_tuks; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor Pokok Wajib Pajak</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_perusahaan->npwp; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Laporan Bulan</th>
                                <td style="padding-left: 10px"> : </td>
                                <?php
$bulan = date('F', strtotime($bulan));
?>
                                <td style="padding-left: 10px"><?=$bulan; ?> <?=$tahun; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="datatables" class="table table-bordered table-striped" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;">No</th>
                                <th rowspan="2" style="vertical-align: middle;">Nama Kapal</th>
                                <!-- <th rowspan="2" style="vertical-align: middle;" width="5%">Bendera</th> -->
                                <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                <th rowspan="2" style="vertical-align: middle;">Nama Agen</th>
                                <th style="text-align: center" colspan="2">Jumlah</th>
                                <th rowspan="2" style="vertical-align: middle;">Mulai</th>
                                <th rowspan="2" style="vertical-align: middle;">Selesai</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center">Asal Barang</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center">Tujuan</th>
                                <th rowspan="2" style="vertical-align: middle;">Jenis</th>
                                <th rowspan="2" style="vertical-align: middle;text-align: center">Tempat Muat</th>
                                <th style="text-align: center" colspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th>Bongkar</th>
                                <th>Muat</th>
                                <th>RKBM</th>
                                <th rowspan="10">MT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

$nomor_ke      = 1;
$total_bongkar = 0;
$total_muat    = 0;
$total_asli    = 0;
$ortu          = array();
$anak          = array();
$daftar_tampil = array();
foreach ($permohonan as $perm) {
    $anak[] = $perm->id;
    $ortu[] = $perm->parent;

}
$array = (array_diff($anak, $ortu));
// $datanya;
function rekursip($id, $datanya)
{
    // global $datanya;
    // $datanya = array();
    $ci =& get_instance();
    $ci->db->where('id', $id);
    $permohonan = $ci->db->get('permohonan')->row();
    // var_dump($ci->db->last_query());
    if ($permohonan) {
        if ($permohonan->parent) {
            // var_dump($permohonan->parent);
            $datanya[] = $permohonan->parent;
            // var_dump($datanya);
            // array_merge($datanya, rekursip($permohonan->parent));
            return rekursip($permohonan->parent, $datanya);
        }
    }
    return $datanya;
}
// echo '<pre>';
// $datanya    = array();
// $datanyaaaa = array_reverse(rekursip(63, $datanya));
// var_dump(rekursip(63));
// print_r($datanyaaaa);
// $dung = '';
// foreach ($datanyaaaa as $dt) {
//     // echo $dt;
//     $this->db->where('id', $dt);
//     $ngerow = $this->db->get('permohonan')->row();
//     $dung .= $ngerow->no_rkbm . ',';
// }
// var_dump($dung);
// var_dump($permohonan);
// echo '</pre>';

$total_permohoan = 0;

foreach ($permohonan as $perm) {
    // $total_permohoan++;

    if (in_array($perm->id, $array)) {

        $datanya    = array();
        $datanyaaaa = array_reverse(rekursip($perm->id, $datanya));
        $dung       = array();
        foreach ($datanyaaaa as $dt) {
            // echo $dt;
            $this->db->where('id', $dt);
            $ngerow = $this->db->get('permohonan')->row();
            // $dung .= $ngerow->no_rkbm;
            $eksplut = explode('.', $ngerow->no_rkbm);
            array_push($dung, ltrim($eksplut[3], 0));
        }
        $expl = explode('.', $perm->no_rkbm);
        array_push($dung, ltrim($expl[3], 0));
        $total_permohoan = count($dung);
        // var_dump(count($dung));
        $this->db->where('id', $perm->kapal);
        $get_kapal = $this->db->get('kapal')->row();

        $this->db->where('id', $get_kapal->agen_kapal);
        $get_agen_kapal  = $this->db->get('agen_kapal')->row();
        $tanggal_mulai   = $perm->mulai != '0000-00-00' ? tgl_in($perm->mulai) : 'BELUM DI ISI';
        $tanggal_selesai = $perm->selesai != '0000-00-00' ? tgl_in($perm->selesai) : 'BELUM DI ISI';

        $this->db->where('id', $perm->operasional);
        $get_operasional = $this->db->get('operasional')->row();
        $barang_asal     = $get_operasional->barang_asal;
        $barang_pemilik  = $get_operasional->barang_pemilik;
        $perusahaan_data = $get_operasional->perusahaan;
        $id_created_by   = $get_operasional->created_by;

        $this->db->where('id', $barang_asal);
        $get_barang_asal = $this->db->get('barang_asal')->row();

        $this->db->where('id', $perm->barang);
        $get_barang_jenis = $this->db->get('barang_jenis')->row();

        $this->db->where('id', $perm->tempat_muat);
        $get_terminal   = $this->db->get('terminal')->row();
        $terminal_jenis = $get_terminal->jenis;
        $tempat_muatnya = $get_terminal->nama;
        if ($perm->permohonan_jenis == 1) {
            // if ($perm->status == 4) {
            //     $total_muat        = 0;
            //     $jumlah_muatnya    = 0;
            //     $jumlah_bongkarnya = 0;
            // } else {
            $total_muat        = ($total_muat + $perm->jumlah_asli);
            $jumlah_muatnya    = $perm->jumlah_asli;
            $jumlah_bongkarnya = 0;
            // }
        }
        if ($perm->permohonan_jenis == 2) {
            // if ($perm->status == 4) {
            //     $total_muat        = 0;
            //     $jumlah_muatnya    = 0;
            //     $jumlah_bongkarnya = 0;
            // } else {
            $total_bongkar     = ($total_bongkar + $perm->jumlah_asli);
            $jumlah_bongkarnya = $perm->jumlah_asli;
            $jumlah_muatnya    = 0;
            // }
        }
        if ($perm->permohonan_jenis == 3) {
            // if ($perm->status == 4) {
            //     $total_bongkar     = 0;
            //     $jumlah_bongkarnya = 0;
            //     $jumlah_muatnya    = 0;
            // } else {
            $total_bongkar     = ($total_bongkar + $perm->jumlah_asli);
            $jumlah_bongkarnya = $perm->jumlah_asli;
            $jumlah_muatnya    = 0;
            // }
        }
        if ($perm->status == 4) {
            $total_bongkar     = 0;
            $jumlah_bongkarnya = 0;
            $total_muat        = 0;
            $jumlah_muatnya    = 0;
        }

        // $total_bongkar = ($total_bongkar + $perm->jumlah_bongkar);
        // $total_muat    = ($total_muat + $perm->jumlah_muatan);
        $total_asli = ($total_asli + $perm->jumlah_kira);

        echo '<tr>';
        echo "<td>" . $nomor_ke++ . "</td>";
        echo "<td>" . $get_kapal->nama . "</td>";
        // echo "<td>" . strtoupper($get_kapal->bendera) . "</td>";
        echo "<td>" . $get_kapal->ukuran . "</td>";
        echo "<td>" . $get_agen_kapal->nama . "</td>";
        echo "<td>" . number_format($jumlah_bongkarnya, 0, ',', '.') . "</td>";
        echo "<td>" . number_format($jumlah_muatnya, 0, ',', '.') . "</td>";
        echo "<td>" . $tanggal_mulai . "</td>";
        echo "<td>" . $tanggal_selesai . "</td>";
        echo "<td>" . $get_barang_asal->nama . "</td>";
        echo "<td>" . $perm->tempat_bongkar . "</td>";
        echo "<td>" . strtoupper($get_barang_jenis->nama) . "</td>";
        echo "<td>" . strtoupper($tempat_muatnya) . "</td>";
        echo "<td>" . implode(', ', $dung) . "</td>";
        echo "<td>" . number_format($perm->jumlah_kira, 0, ',', '.') . "</td>";
        echo '</tr>';
    }

}
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <!-- <td><strong></strong></td> -->
                                <td><strong></strong></td>
                                <td><strong>Total: </strong></td>
                                <td><strong><?=number_format($total_bongkar, 0, ',', '.'); ?></strong></td>
                                <td><strong><?=number_format($total_muat, 0, ',', '.'); ?></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong><?=$total_permohoan; ?></strong></td>
                                <td><strong><?=number_format($total_asli, 0, ',', '.'); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    <br>
                    <div class="col-sm-12 col-xs-12" style="margin-top: 20px; font-size: 11px">
                        <div class="col-xs-5" style="text-align: left">







                        </div>
                        <div class="col-xs-3" style="text-align: center">

                            <div style="margin-top: 50px; text-align: center">


                            </div>
                        </div>
                        <div class="col-xs-4" style="text-align: left">
                            <?php
date_default_timezone_set('Asia/Makassar');
// $dateYmd = date('d Mm Y');
; ?>
                            Samarinda, <?=tgl_in(date('Y-m-d')); ?><br>
                            PT. Zadin Mitra Abadi
                            <div style="margin-top: 50px; text-align: left">
                                <strong>Syamsudin Murais</strong><br>
                                Direktur Utama
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        // window.print();
        </script>


    </body>

</html>