<?php
function tgl_ind($date)
{

    // array hari dan bulan
    $Hari  = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan tahun, bulan, hari, dan waktu
    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $waktu  = substr($date, 11, 5);
    $hari   = date("w", strtotime($date));
    $result = $waktu . " " . $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;
    return $result;
}
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
function romawi($number)
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

if ($status == 1) {
    $status_permohonan = 'note-social';
    $espe              = 'Permohonan';
    // $espe              = 'baru';
} elseif ($status == 2) {
    $status_permohonan = 'note-business';
    $espe              = 'Perpanjangan';
} elseif ($status == 3) {
    $status_permohonan = 'note-important';
    $espe              = 'Revisi';
} else {
    $status_permohonan = '';
    $espe              = 'Batal';
}
$this->db->where('id', $kapal);
$permohonan_kapal = $this->db->get('kapal')->row();

if ($permohonan_jenis == 1) {
    $tanggal_mulai = $mulai;
} elseif ($permohonan_jenis == 2) {
    $tanggal_mulai = $selesai;
} elseif ($permohonan_jenis == 3) {
    $tanggal_mulai = $mulai . ' - ' . $selesai;
}

$this->db->where('id', $permohonan_jenis);
$permohonan_jenis = $this->db->get('permohonan_jenis')->row()->nama;

$this->db->where('id', $tempat_muat);
$jenis_tempat_muat    = $this->db->get('terminal')->row();
$id_jenis_tempat_muat = $jenis_tempat_muat->id;
$jenis_tempat_muat    = $jenis_tempat_muat->nama;

// $permohonan_jenis     = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'permohonan_jenis', $permohonan_jenis)->nama;
$tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $tempat_muat)->nama;
// $jenis_tempat_muat    = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $tempat_muat)->jenis)->nama;
// $id_jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $tempat_muat)->jenis)->id;
$agen_kapal = $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'agen_kapal', $permohonan_kapal->agen_kapal)->nama;
$this->db->where('id', $operasional);
$db_permohonan = $this->db->get('operasional')->row();
$asal_barang   = $db_permohonan->barang_asal;
// var_dump($asal_barang);
$this->db->where('id', $asal_barang);
$asal_barang  = $this->db->get('barang_asal')->row();
$asal_barang  = $asal_barang->nama;
$jenis_barang = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'barang', $barang)->nama;
$atribut_json = json_encode(array("agen_kapal" => $permohonan_kapal->agen_kapal, 'jenis_tempat_muat' => $id_jenis_tempat_muat));

$ketsur = '';
$perke  = $permohonan_ke == 0 ? '' : $permohonan_ke;

if ($status == 1) {
    $ketsur = 'B';
}
if ($status == 2) {
    $ketsur = 'P';
}
if ($status == 3) {
    $ketsur = 'PR';
}
if ($status == 4) {
    $ketsur = 'X';
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Permohonan RKBM</title>
        <meta charset="UTF-8">
        <meta name=description content="">
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
    </head>

    <body>


        <!--div class="container">

<div class="row mx-3 fonts">
    <div class="col-12">
        <img src="https://yuvenil.my.id/kop-zadin.png" class="card-img-top img-fluid">
    </div>
    <div class="col-12 my-3">
    </div>



    <div class="row p-3">
        <div class="col-12" style="">
            <div class="col-6"></div>
            <div class="col-6 float-right">
                <span style="font-weight: normal;">Samarinda, <?=tgl_in(date('Y-m-d')); ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <p></p>
            <table class="table table-borderless table-responsive table-sm table-white" style="">
                <thead>
                    <tr> </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Nomor</b></td>
                        <td><b>:</b></td>
                        <td>0<?=$id; ?>/ZMA/SMD/III/<?=date('Y'); ?></td>
                    </tr>
                    <tr>
                        <td><b>Lampiran</b></td>
                        <td><b>:</b></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td><b>Perihal</b></td>
                        <td><b>:</b></td>
                        <td><b>Pemberitahuan Rencana
                                Kegiatan Bongkar Muat
                                (RKBM) - <?=strtoupper($permohonan_jenis); ?>
                            </b></td>
                    </tr>
                </tbody>
            </table>





        </div>

        <div class="col-md-6">
            <p></p>
            <div class="mb-1" style="text-align: left; line-height: 2rem;">Kepada
            </div>
            <div><b>Yth. Kepala Kantor Kesyahbandaran dan
                    Otoritas Pelabuhan Kelas II Samarinda&nbsp;</b>
                <div>di -<div>&nbsp; &nbsp; &nbsp; &nbsp; Tempat</div>
                </div>
            </div>



        </div>
        <div class="row" style=""></div>
        <div class="container" style="">
            <div class="mb-4 mt-3">Dengan Hormat,&nbsp;<div>
                    Bersama dengan ini, Mohon kiranya bapak berkenan memberi sesuai perihal diatas untuk kapal kami
                    tersebut dibawah:
                </div>
            </div>

            <table class="table table-borderless table-responsive table-sm table-white" style="">
                <tbody>
                    <tr>
                        <th class="pl-0">Nama Kapal</th>
                        <th>:</th>
                        <td><?=strtoupper($permohonan_kapal->nama); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Isi Kotor (GTR)</th>
                        <th>:</th>
                        <td><?=strtoupper($permohonan_kapal->ukuran); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Bendera</th>
                        <th>:</th>
                        <td><?=strtoupper($permohonan_kapal->bendera); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Rencana Muat</th>
                        <th>:</th>
                        <td><?=tgl_in($mulai); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Tempat Muat</th>
                        <th>:</th>
                        <td><?=strtoupper($tempat_muat); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Tempat Bongkar</th>
                        <th>:</th>
                        <td><?=strtoupper($tempat_bongkar); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Jenis Barang</th>
                        <th>:</th>
                        <td><?=strtoupper($jenis_barang); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Qty</th>
                        <th>:</th>
                        <td><?=strtoupper($jumlah_muatan); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Agen</th>
                        <th>:</th>
                        <td><?=strtoupper($agen_kapal); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">Asal Barang</th>
                        <th>:</th>
                        <td><?=strtoupper($asal_barang); ?></td>
                    </tr>
                    <tr>
                        <th class="pl-0">SIUPAL PBM</th>
                        <th>:</th>
                        <td>NO. 503/315/SIUPBM-HUB/DPMPTSP/III/2019</td>
                    </tr>
                </tbody>
            </table>


            <div class="mb-4 mt-4">
                Demikian Permohonan ini Kami Buat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
            </div>


            <div class="row text-center">
                <div class="col-6">
                </div>
                <div class="col-6">
                    <h6 class="mb-5 mt-5">Hormat Kami,</h6>
                    <h4 class="mb-5">Juspri Ardianus</h4>
                </div>
            </div>

        </div>
    </div>

</div>

</div -->




        <div class="container">
            <div class="row fonts" style="margin-top; 5px; padding: 5px 5px 5px 5px;">
                <div class="col-md-12 col-xs-12 col-lg-12">
                    <img class="img-responsive" src="https://yuvenil.my.id/kop-zma.jpg">
                    <div style="margin-top: 20px">
                        <div class="col-xs-6 col-sm-6">
                            <br /><br />
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nomor </th>
                                        <td style="padding-left: 10px"> : </td>
                                        <td style="padding-left: 10px">0<?=$id; ?>/<?=$ketsur; ?><?=$perke; ?>/<?=$perusahaan->inisial; ?>/SMD/<?=romawi(date("m")); ?>/<?=date('Y'); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <td style="padding-left: 10px"> : </td>
                                        <td style="padding-left: 10px"> -</td>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <td style="padding-left: 10px"> : </td>
                                        <td style="padding-left: 10px" valign="top"> <b><?=$espe; ?> Rencana</b></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td style="padding-left: 10px"> </td>
                                        <td style="padding-left: 10px" valign="top"> <b>Kegiatan Bongkar Muat (RKBM)</b></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                            <span>Samarinda, </span>
                            <span> <?=tgl_in(date('Y-m-d')); ?></span><br /><br />
                            Kepada <br />
                            <b>Yth. Kepala Kantor Kesyahbandaran dan<br />
                                Otoritas Pelabuhan<br /></b>
                            di-<br />
                            <span style="margin-left: 30px">Tempat</span>
                        </div><br /><br />
                        <div class="col-xs-12" style="margin-top: 20px">
                            <div style="text-align: justify; text-justify: inter-word;">
                                Dengan Hormat,<br />
                                Bersama dengan ini, Mohon kiranya bapak berkenan memberi sesuai perihal diatas untuk kapal kami
                                tersebut dibawah:
                            </div><br />
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Nama Kapal</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($permohonan_kapal->nama); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Isi Kotor (GTR)</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($permohonan_kapal->ukuran); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bendera</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($permohonan_kapal->bendera); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Rencana Muat</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px">
                                            <?=tgl_in($mulai); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Muat</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px">
                                            <?=strtoupper($tempat_muat); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Bongkar</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($tempat_bongkar); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Barang</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($jenis_barang); ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Qty</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=number_format(str_replace('00000', '00', $jumlah_muatan)); ?> MT</td>
                                    </tr>
                                    <tr>
                                        <th>Agen</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($agen_kapal); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Asal Barang</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> <?=strtoupper($asal_barang); ?></td>
                                    </tr>
                                    <tr>
                                        <th>SIUPAL PBM</th>
                                        <td style="padding-left: 50px"> : </td>
                                        <td style="padding-left: 20px"> NO. 503/315/SIUPBM-HUB/DPMPTSP/III/2019</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            Demikian Permohonan ini Kami Buat, atas perhatian dan kerjasamanya kami
                            ucapkan terima kasih.<br /><br />
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12 col-xs-12 fonts" style="margin-top: 20px; font-size: 12pt">
                        <div class="col-xs-7" style="text-align: center">
                        </div>
                        <div class="col-xs-5" style="text-align: center">
                            Hormat Kami,
                            <div style="margin-top: 50px; text-align: center">
                                <strong><u>Juspri Ardianus</u></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <script>
        window.print();
        </script>
    </body>

</html>