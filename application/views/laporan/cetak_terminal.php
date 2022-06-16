<?php
setlocale(LC_ALL, 'id_ID');

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
function bulandathun($date)
{
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan tahun, bulan, hari, dan waktu
    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $Bulan[(int)$bulan - 1] . " " . $tahun;
    return $result;
}

function integerToRoman($integer)
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

?>

<html lang="en">

    <head>
        <title>Laporan Kegiatan Operasional</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
        .fonts {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
        }

        .noBorder {
            border: none !important;
            border-collapse: separate;
            border-spacing: 0px 15px;
        }

        @media print and (width: 21cm) and (height: 29.7cm) {
            @page {
                margin: 1cm;
            }

            html,
            body {
                height: 99%;
            }
        }

        @media print and (width: 8.5in) and (height: 11in) {
            @page {
                margin: 1in;
            }

            html,
            body {
                height: 99%;
            }
        }

        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        tr.separated td {
            /* set border style for separated rows */
            border-bottom: 1px solid black;
        }

        @media print {
            #breaks {
                page-break-before: always;
            }
        }

        #tables {
            border: 1px;
            color: black;
            border-style: solid;
        }

        #tables td,
        #tables th {
            border: 1px;
            color: black;
            border-style: solid;
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
            <div class="row fonts" style="margin-top; 5px; padding: 5px 5px 5px 5px;">
                <div class="col-md-12 col-xs-12 col-lg-12">
                    <img class="img-responsive" src="https://zadin.co.id/upload/kop/zma.jpg">

                    <div style="margin-top: 20px">
                        <span class="pull-right"> Samarinda, <?=tgl_in(date("Y-m-d")); ?></span>

                        <br><br>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <td style="padding-left: 10px"> :</td>

                                    <td style="padding-left: 10px"> Lap-PBM/ZMA/<?=integerToRoman($bulan); ?>/2022</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <td style="padding-left: 10px"> :</td>
                                    <td style="padding-left: 10px"> 1 (satu) berkas</td>
                                </tr>
                                <tr>
                                    <th>Perihal</th>
                                    <td style="padding-left: 10px"> :</td>
                                    <td style="padding-left: 10px" valign="top"><b>Laporan Kegiatan Operasional PBM</b></td>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        Kepada <br>
                        <b>Yth. Kepala Kantor KSOP Kelas II Samarinda<br></b>
                        di-<br>
                        <span style="margin-left: 30px">Tempat</span>

                        <br><br>
                        <div style="margin-top: 10px">
                            <div style="text-align: justify; text-justify: inter-word;">
                                Dengan Hormat,<br><br>
                                Bersama dengan ini, kami sampaikan laporan kegiatan operasional perusahaan bongkar muat
                                <!-- PT. Zadin Mitra Abadi untuk bulan <?=date("F Y", strtotime("$tahun-$bulan-07")); ?>, -->
                                PT. Zadin Mitra Abadi untuk bulan <?=bulandathun("$tahun-$bulan-07"); ?>,
                                dengan rekapitulasi sebagai berikut:<br><br>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>TUKS</th>
                                            <th style="text-align: center">Jumlah Kapal</th>
                                            <th>Jumlah B/M</th>
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

$total_permohoan = 0;

foreach ($permohonan as $perm) {
    $total_permohoan++;

    if (in_array($perm->id, $array)) {

        $datanya    = array();
        $datanyaaaa = array_reverse(rekursip($perm->id, $datanya));
        $dung       = array();
        foreach ($datanyaaaa as $dt) {
            // echo $dt;
            $this->db->where('id', $dt);
            $ngerow = $this->db->get('permohonan')->row();
            // $dung .= $ngerow->no_rkbm;
            array_push($dung, $ngerow->no_rkbm);
        }
        array_push($dung, $perm->no_rkbm);
        // var_dump($dung);
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

        $total_bongkar = ($total_bongkar + $perm->jumlah_kira);
        $total_muat    = ($total_muat + $perm->jumlah_kira);
        $total_asli    = ($total_asli + $perm->jumlah_asli);
    }
}

function object_to_array($data)
{
    if (is_array($data) || is_object($data)) {
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
        }
        return $result;
    }
    return $data;
}
$this->db->where_in('id', $array);
$semua = $this->db->get('permohonan')->result();

$semua         = object_to_array($semua);
$newPermohonan = array();

foreach ($semua as $value) {
    if (empty($newPermohonan[$value['tempat_muat']])) {
        $newPermohonan[$value['tempat_muat']] = $value;
    } else {
        $newPermohonan[$value['tempat_muat']]['jumlah_asli'] += $value['jumlah_asli'];
        $newPermohonan[$value['tempat_muat']]['cetak'] += $value['cetak'];
        $newPermohonan[$value['tempat_muat']]['inc'] += $value['inc'];

    }
}
foreach ($newPermohonan as $ogog) {

    $this->db->where('id', $ogog['tempat_muat']);
    $asdasdas = $this->db->get('terminal')->row();

    echo "<td>" . $nomor_ke++ . "</td>";
    echo "<td>" . strtoupper($asdasdas->nama) . "</td>";
    echo "<td>" . $ogog['inc'] . "</td>";
    echo "<td>" . number_format($ogog['jumlah_asli'], 0, ',', '.') . "</td>";
    echo '</tr>';

}
; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php

// echo "<pre>";
// var_dump($semua);

// $products = array(
//     array(
//         'cat'      => 1,
//         'products' => 1,
//     ),
//     array(
//         'cat'      => 1,
//         'products' => 11,
//     ),
//     array(
//         'cat'      => 3,
//         'products' => 3,
//     ),
// );

// var_dump($newPermohonan);

// $products = array(
//     array(
//         'cat'      => 1,
//         'products' => 1,
//     ),
//     array(
//         'cat'      => 1,
//         'products' => 11,
//     ),
//     array(
//         'cat'      => 3,
//         'products' => 3,
//     ),
// );
// $newProducts = array();

// foreach ($products as $value) {
//     if (empty($newProducts[$value['cat']])) {
//         $newProducts[$value['cat']] = $value;
//     } else {
//         $newProducts[$value['cat']]['products'] += $value['products'];
//     }
// }

// var_dump($newProducts);

// echo "</pre>";

; ?>
                            <br>Terlampir juga rincian rekapitulasi diatas yang merupakan satu kesatuan dengan
                            laporan ini.<br><br>
                            Demikian Permohonan ini Kami Buat, atas perhatian dan kerjasamanya kami
                            ucapkan terima kasih.<br><br>
                        </div>
                    </div>

                    <br>
                    <div class=" col-sm-12 col-xs-12 fonts" style="margin-top: 20px; font-size: 12pt">
                        <div class="col-xs-7" style="text-align: center">
                        </div>
                        <div class="col-xs-5" style="text-align: center">
                            Hormat Kami,<br>PT. Zadin Mitra Abadi
                            <div style="margin-top: 50px; text-align: center">
                                <strong><u>Syamsudin Murais</u><br></strong>
                                Direktur Utama
                            </div>
                        </div>
                    </div>
                    Tembusan disampaikan kepada yth:<br>
                    &nbsp; - &nbsp; Kepala Dinas Perhubungan Prov. Kaltim<br>
                    &nbsp; - &nbsp; DPW APBMI Kalimantan Timur Di Samarinda
                </div>
            </div>
        </div>
        <script>
        // window.print();
        </script>


        <div id="mttContainer" class="bootstrapiso" style="left: 0px; top: 0px; position: fixed; z-index: 100000200; width: 500px; margin-left: -250px; background-color: rgba(0, 0, 0, 0); pointer-events: none; transform: translate(292px, 485px);" data-original-title="" title=""></div>
    </body>

</html>