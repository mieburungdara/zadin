<html lang="en">
    <?php

date_default_timezone_set('Asia/Makassar');

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

    <head>
        <title>Laporan Data TUKS JETTY Barhind</title>
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
            font-size: 14px;
        }

        .bootstrapiso .tooltip-inner {
            max-width: 200px;
        }
        </style>
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="true">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swa">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="text-align: center"><strong>LAPORAN KEGIATAN TERMINAL UNTUK KEPENTINGAN SENDIRI (TUKS)</strong></h5>
                    <br>
                    <?php
// echo '<pre>';
// var_dump($datalist);
// echo '</pre>';
; ?>
                    <?php
$this->db->where('id', $tempat_muat);
$get_terminal_data_row = $this->db->get('terminal')->row();
// echo ; ?>
                    <table style="font-size: 11px">
                        <tbody>
                            <tr style="height: 16px;">
                                <th>Nama Terminal</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><strong><?=$get_terminal_data_row->nama; ?></strong></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Alamat Perusahaan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_terminal_data_row->lokasi; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Pelabuhan Bongkar Muat</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_terminal_data_row->pelabuhan; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor SIUP PBM</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_terminal_data_row->sk_tuks; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Nomor Pokok Wajib Pajak</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_terminal_data_row->npwp; ?></td>
                            </tr>
                            <tr style="height: 16px;">
                                <th>Laporan Bulan</th>
                                <td style="padding-left: 10px"> : </td>
                                <?php
$bulan = date('F', strtotime("2000-$bulan-01"));
?>
                                <td style="padding-left: 10px"><?=$bulan; ?> <?=$tahun; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="datatables" class="table table-bordered" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>

                            </tr>
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
$no            = 1;
$total_bongkar = 0;
$total_muat    = 0;
$total_asli    = 0;
$total_inc     = 0;
foreach ($datalist as $datas) {
    // var_dump($datas);
    $this->db->where('id', $datas['id']);
    $get_permohonan = $this->db->get('permohonan')->row();
    $this->db->where('id', $get_permohonan->kapal);
    $get_kapal = $this->db->get('kapal')->row();

    $this->db->where('id', $get_permohonan->operasional);
    $get_operasional = $this->db->get('operasional')->row();
    $barang_asal     = $get_operasional->barang_asal;
    $barang_pemilik  = $get_operasional->barang_pemilik;
    $perusahaan_data = $get_operasional->perusahaan;
    $id_created_by   = $get_operasional->created_by;

    $this->db->where('id', $get_kapal->agen_kapal);
    $get_agen_kapal = $this->db->get('agen_kapal')->row();

    $tanggal_mulai   = $get_permohonan->mulai != '0000-00-00' ? tgl_in($get_permohonan->mulai) : 'BELUM DI ISI';
    $tanggal_selesai = $get_permohonan->selesai != '0000-00-00' ? tgl_in($get_permohonan->selesai) : 'BELUM DI ISI';

    $this->db->where('id', $get_permohonan->tempat_muat);
    $get_terminal   = $this->db->get('terminal')->row();
    $terminal_jenis = $get_terminal->jenis;
    $tempat_muatnya = $get_terminal->nama;

    $this->db->where('id', $perusahaan_data);
    $get_perusahaan = $this->db->get('perusahaan')->row();

    $this->db->where('id', $get_permohonan->barang);
    $get_barang_jenis = $this->db->get('barang_jenis')->row();

    // echo $get_permohonan->id;
    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $get_kapal->nama . '</td>';
    echo "<td>" . strtoupper($get_kapal->bendera) . "</td>";
    echo "<td>" . $get_kapal->ukuran . "</td>";
    echo "<td>" . $get_agen_kapal->nama . "</td>";

    echo "<td>" . number_format($get_permohonan->jumlah_bongkar, 0, ',', '.') . "</td>";
    echo "<td>" . number_format($get_permohonan->jumlah_muatan, 0, ',', '.') . "</td>";
    $total_bongkar = ($total_bongkar + $get_permohonan->jumlah_bongkar);
    $total_muat    = ($total_muat + $get_permohonan->jumlah_muatan);
    echo "<td>" . $tanggal_mulai . "</td>";
    echo "<td>" . $tanggal_selesai . "</td>";

    echo "<td>" . strtoupper($tempat_muatnya) . "</td>";
    echo '<td>' . $get_permohonan->tempat_bongkar . '</td>';
    echo "<td>" . strtoupper($get_barang_jenis->nama) . "</td>";
    echo "<td>" . ($get_perusahaan->nama) . "</td>";
    echo '<td style="white-space:pre-wrap; word-break:break-word">' . ($datas['no_rkbm']) . "</td>";
    echo "<td>" . number_format($datas['jumlah_asli'], 0, ',', '.') . "</td>";
    $total_asli = ($total_asli + $datas['jumlah_asli']);
    $total_inc  = ($total_inc + $datas['inc']);

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
                                <td><strong><?=$total_inc; ?></strong></td>
                                <td><strong><?=number_format($total_asli, 0, ',', '.'); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    <br>
                    <div class="col-sm-12 col-xs-12" style="margin-top: 20px; font-size: 11px">
                        <div class="col-xs-5" style="text-align: left">
                            An. Kepala Kantor<br>
                            Kesyahbandaran dan Otoritas Pelabuhan Kelas II Samarinda<br>
                            Kasilala dan Usaha Kepelabuhan
                            <div style="margin-top: 50px;">
                                <strong><u>Capt. ARI WIBOWO S.SiT., M.Mar., MM</u></strong><br>
                                <strong>Penata Tk.1 (III/c)<br>NIP. 19770705 201912 1 003</strong>
                            </div>
                        </div>
                        <div class="col-xs-3" style="text-align: center">

                            <div style="margin-top: 50px; text-align: center">


                                <?php
// $dateYmd = date('d Mm Y');
; ?>
                            </div>
                        </div>
                        <div class="col-xs-4" style="text-align: left">
                            Samarinda, <?=tgl_in(date('Y-m-d')); ?><br>
                            <?=$get_terminal_data_row->nama; ?>
                            <div style="margin-top: 50px; text-align: left">
                                <br>
                                <br>
                                Direktur Utama
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        window.print();
        </script>


        <div id="mttContainer" class="bootstrapiso" style="left: 0px; top: 0px; position: fixed; z-index: 100000200; width: 500px; margin-left: -250px; background-color: rgba(0, 0, 0, 0); pointer-events: none; transform: translate(941px, 567px);" data-original-title="" title=""></div>
    </body>

</html>