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

$this->db->where('id', $id);
$db_permohonan = $this->db->get('operasional')->row();

$this->db->where('id', $barang_asal);
$asal_barang      = $this->db->get('barang_asal')->row();
$asal_barang_nama = $asal_barang->nama;
$inisial          = $asal_barang->inisial;

$this->db->where('id', $barang_pemilik);
$barang_pemiliks = $this->db->get('barang_pemilik')->row();
$barang_pemilik  = $barang_pemiliks->nama;
$alamat_pemilik  = $barang_pemiliks->alamat;

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp  = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } elseif ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " Belas";
    } elseif ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
    } elseif ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } elseif ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
    } elseif ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } elseif ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
    } elseif ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
    } elseif ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " Miliar" . penyebut(fmod($nilai, 1000000000));
    } elseif ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

?>
<!-- <script src="<?=base_url(); ?>assets/dist/js/pages/samplepages/jquery.PrintArea.js"></script>> -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Permohonan RKBM</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
        <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                font-family: "Times New Roman", Times, serif !important;
                font-size: 12pt;
                color: black !important;
            }

            thead {
                background-color: #cfecfe !important;
            }

            td.dok {
                text-align: right;
                vertical-align: middle;
                /* border-left: none; */
            }
        }

        body {
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12pt;
            color: black !important;
            -webkit-print-color-adjust: exact;
        }
        </style>

    </head>

    <body>
        <div class="">

            <div class="p-4 invoice-inner-part">
                <div class="invoiceing-box" style="display: block;">
                    <div class="card card-body" id="printableArea">
                        <div class="invoice-header align-items-center" style="border-bottom: 3px solid black !important;">
                            <div class="col-auto pb-2 text-center">
                                <img src="https://yuvenil.my.id/kop-zadin.png" style="max-width: 100%;width:-webkit-fill-available;">
                            </div>
                        </div>
                        <div class="fonts" id="custom-invoice" style="display: block;">
                            <div class="invoice-123">
                                <div class="pt-3">
                                    <div class="col-12 mb-3">
                                        <div class="text-center">
                                            <h4 class="mb-0" style="font-weight: 1000 !important;color:black;">INVOICE</h4>
                                            <h5 style="color:black;" class="mb-0 font-weight-bold">NO 0<?=$id; ?>/<?=$inisial; ?>/ZMA-SMD/I/2022</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex col-12">
                                        <span class="pr-4">Kepada </span>
                                        <span class="pr-1">:</span>
                                        <span class=""><?=$asal_barang_nama; ?><br>Up <?=$barang_pemilik; ?></span>
                                    </div>
                                    <div class="d-flex col-12 pt-2">
                                        <span class="pr-4">Alamat </span>
                                        <span class="pr-1">:</span>
                                        <span class=""><?=$alamat_pemilik; ?></span>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive mt-3" style="clear: both;">
                                            <table class="table table-bordered table-sm" style="color:black;
  -webkit-print-color-adjust:exact;">
                                                <thead class="bg-light-info" style="background-color: #cfecfe;
  -webkit-print-color-adjust:exact; !important;">
                                                    <tr>
                                                        <th class="text-center" style="width: 1rem; font-weight: bold;">No</th>
                                                        <th class="text-center" style="font-weight: bold;" colspan="">Keterangan</th>
                                                        <th class="text-center" style="font-weight: bold;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="line-height: 15px;">
                                                    <?php
$this->db->where('cetak', 1);
$this->db->where('operasional', $db_permohonan->id);
$permohonans = $this->db->get('permohonan')->result();
$naik        = 1;
$sub_total   = 0;
foreach ($permohonans as $permohonan) {
// echo '<pre>';
    $peje = $permohonan->permohonan_jenis;
    if ($peje == 1) {
        $jusli      = $permohonan->jumlah_asli;
        $text_jusli = "Muat";
    }
    if ($peje == 2) {
        $jusli      = $permohonan->jumlah_bongkar;
        $text_jusli = "Bongkar";
    }
    if ($peje == 3) {
        $jusli      = $permohonan->jumlah_asli;
        $text_jusli = "Muat & Bongkar";
    }
    $status  = $permohonan->status;
    $payment = (int)$permohonan->payment;
    if (!is_null($permohonan->payment) || !empty($permohonan->payment) || $permohonan->payment != '0' || $permohonan->payment != 0) {
        $payment = $permohonan->payment;
    } else {
        $payment = '';
    }
    unset($tarif);
    unset($tarif_saja);
    // if ($payment) {
    //     echo 'ada';
    // } else {
    //     echo 'kosong';
    // }
    // var_dump($peje);
    // var_dump($jusli);
    if ($status == 1) {
        $status = 'Baru';
        if ($payment) {
            $tarif      = '';
            $tarif_saja = '';
            $total      = $payment;
        } else {
            $tarif      = '&ensp;x &ensp;Rp.' . $asal_barang->tarif_baru;
            $tarif_saja = $asal_barang->tarif_baru;
            $total      = (int)str_replace('000', '', $jusli) * $tarif_saja;
        }
    }
    if ($status == 2) {
        $status = 'Perpanjang';
        if ($payment) {
            $tarif      = '';
            $tarif_saja = $payment;
            $total      = $payment;
        } else {
            $tarif      = '&ensp;x &ensp;Rp.' . $asal_barang->tarif_perpanjang;
            $tarif_saja = $asal_barang->tarif_perpanjang;
            $total      = (int)str_replace('000', '', $jusli) * $tarif_saja;
        }
    }
    if ($status == 3) {
        $status = 'Revisi';
        if ($payment) {
            $tarif      = '';
            $tarif_saja = $payment;
            $total      = $payment;
        } else {
            $tarif      = '&ensp;x &ensp;Rp.' . $asal_barang->tarif_revisi;
            $tarif_saja = $asal_barang->tarif_revisi;
            $total      = (int)str_replace('000', '', $jusli) * $tarif_saja;
        }
    }
    if ($status == 4) {
        $status = 'Batal';
        if ($payment) {
            $tarif      = '';
            $tarif_saja = $payment;
            $total      = $payment;
        } else {
            $tarif      = '&ensp;x &ensp;Rp.' . $asal_barang->tarif_revisi;
            $tarif_saja = $asal_barang->tarif_revisi;
            $total      = (int)str_replace('000', '', $jusli) * $tarif_saja;
        }
    }
    $this->db->where('id', $permohonan->kapal);
    $nama_kapal = $this->db->get('kapal')->row()->nama;

    // var_dump($permohonan->id);
    // // var_dump($operasional->parent);
    // print'</pre>';
    // echo $tarif;
    // $sub_total += (int)str_replace('000', '', $jusli) * (int)$total;
    $sub_total += (int)$total;
    // $sub_total += '1'; ?>

                                                    <tr>
                                                        <th scope="row" style="text-align: center;vertical-align: middle;!important"><?=$naik++; ?></th>
                                                        <td colspan="1">
                                                            Jasa PBM <?=$text_jusli; ?> (RKBM <?=$status; ?>)<br>
                                                            No RKBM : <?=$permohonan->no_rkbm; ?><br>
                                                            Tanggal : <?=tgl_in($permohonan->mulai); ?><br>Nama Kapal : <?=$nama_kapal; ?><br>
                                                            Muatan : <?=number_format(str_replace('000', '', $jusli), 0, ',', '.'); ?>
                                                            &ensp;&ensp;&ensp;MT <?=$tarif; ?>
                                                        </td>
                                                        <td class="doks" style="text-align: left;vertical-align: middle;!important">
                                                            <div class="d-flex">
                                                                <div class="pull-left">Rp</div>
                                                                <div class="ml-auto"><?=number_format($total); ?></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php

}

?>
                                                    <tr>
                                                        <td colspan="2" style="text-align: right;!important">Sub Total<br><?=$asal_barang->total_pph > 0 ? 'PPh(' . $asal_barang->total_pph . '%)' : ''; ?><br><b style="font-weight: bold;">Total Tagihan</b></td>
                                                        <td style="text-align: left;border-right: white;!important">
                                                            <div class="d-flex">
                                                                <div class="">Rp<br>Rp<br>Rp</span>
                                                                </div>
                                                                <div class="ml-auto"><?=number_format($sub_total, 0, ',', '.'); ?><br><?=number_format(($sub_total * 2) / 100, 0, ',', '.'); ?><br><?=number_format($sub_total - (($sub_total * 2) / 100), 0, ',', '.'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="12">Terbilang : <i style="font-weight: bold;!important"><?=terbilang($sub_total - (($sub_total * 2) / 100)); ?> Rupiah</i></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <p>Pembayaran Dapat Ditransfer Melalui<br>
                                    Rekening Mandiri Cab. Samarinda Alaya<br><b style="font-weight: bold;!important">a/n : PT.ZADIN MITRA ABADI<br>A/C : 148-00-5382888-8 </b></p>

                                <br>
                                <div class="row fonts text-center">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6">
                                        <h5 style="font-weight: bold;color: black;" class="mb-5 mt-5">Hormat Kami,</h5>
                                        <h4 style="font-weight: bold;color: black;" class="mb-5"><u>Juspri Ardianus</u></h4>
                                    </div>
                                </div>
                            </div> <!-- ./(1) -->
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