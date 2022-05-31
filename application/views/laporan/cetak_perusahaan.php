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
            size: A4 landscape;
            margin: 5%;
        }

        @media print {
            tfoot {
                display: table-row-group;
                bottom: 0;
                height: 50px;
                width: 100%;
                position: sticky;

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
                                <td style="padding-left: 10px"><strong>PT. Zadin Mitra Abadi</strong></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Alamat Perusahaan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px">Jl. Gunung Cermai Gg. 2 No. 65, Samarinda</td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Pelabuhan Bongkar Muat</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px">Pelabuhan Samarinda</td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor SIUP PBM</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px">NO. 503/315/SIUPBM-HUB/DPMPTSP/III/2019</td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor Pokok Wajib Pajak</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px">90.537.956.6-741.000</td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Laporan Bulan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px">Mei 2022</td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="datatables" class="table table-bordered table-striped" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;" width="5%">No</th>
                                <th rowspan="2" style="vertical-align: middle;" width="20%">Nama Kapal</th>
                                <th rowspan="2" style="vertical-align: middle;" width="5%">Bendera</th>
                                <th rowspan="2" style="vertical-align: middle;" width="10%">Ukuran</th>
                                <th rowspan="2" style="vertical-align: middle;" width="20%">Nama Agen</th>
                                <th style="text-align: center" colspan="2" width="5%">Jumlah</th>
                                <th rowspan="2" style="vertical-align: middle;" width="10%">Mulai</th>
                                <th rowspan="2" style="vertical-align: middle;" width="10%">Selesai</th>
                                <th rowspan="2" style="vertical-align: middle;" width="10%">Asal Barang</th>
                                <th rowspan="2" style="vertical-align: middle;" width="20%">Tujuan</th>
                                <th rowspan="2" style="vertical-align: middle;" width="20%">Jenis</th>
                                <th rowspan="2" style="vertical-align: middle;" width="20%">Penunjukan PBM (Shipper)</th>
                                <th style="text-align: center" colspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th width="10%">Bongkar</th>
                                <th width="10%">Muat</th>
                                <th width="10%">RKBM</th>
                                <th rowspan="10" width="10%">MT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
// echo '<pre>';
// var_dump($permohonan);
// echo '</pre>';

$nomor_ke      = 1;
$total_bongkar = 0;
$total_muat    = 0;
$total_asli    = 0;
foreach ($permohonan as $perm) {

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

    $total_bongkar = ($total_bongkar + $perm->jumlah_bongkar);
    $total_muat    = ($total_muat + $perm->jumlah_muatan);
    $total_asli    = ($total_asli + $perm->jumlah_asli);

    echo '<tr>';
    echo "<td>" . $nomor_ke++ . "</td>";
    echo "<td>" . $get_kapal->nama . "</td>";
    echo "<td>" . strtoupper($get_kapal->bendera) . "</td>";
    echo "<td>" . $get_kapal->ukuran . "</td>";
    echo "<td>" . $get_agen_kapal->nama . "</td>";
    echo "<td>" . number_format($perm->jumlah_bongkar, 0, ',', '.') . "</td>";
    echo "<td>" . number_format($perm->jumlah_muatan, 0, ',', '.') . "</td>";
    echo "<td>" . $tanggal_mulai . "</td>";
    echo "<td>" . $tanggal_selesai . "</td>";
    echo "<td>" . $get_barang_asal->nama . "</td>";
    echo "<td>" . $perm->tempat_bongkar . "</td>";
    echo "<td>" . strtoupper($get_barang_jenis->nama) . "</td>";
    echo "<td>" . strtoupper($tempat_muatnya) . "</td>";
    echo "<td>" . strtoupper($perm->no_rkbm) . "</td>";
    echo "<td>" . number_format($perm->jumlah_asli, 0, ',', '.') . "</td>";
    echo '</tr>';

}
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
                                <td><strong></strong></td>
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
                                <td><strong>35</strong></td>
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
                            Samarinda, 30 Mei 2022<br>
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