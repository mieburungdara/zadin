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
$asal_barang = $this->db->get('barang_asal')->row();
$asal_barang_nama = $asal_barang->nama;

$this->db->where('id', $barang_pemilik);
$barang_pemiliks = $this->db->get('barang_pemilik')->row();
$barang_pemilik = $barang_pemiliks->nama;
$alamat_pemilik = $barang_pemiliks->alamat;

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Miliar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

?>
<script src="<?=base_url(); ?>assets/dist/js/pages/samplepages/jquery.PrintArea.js"></script>>

<style>
@media print {

    aside *,
    header *,
    footer *,
    /* .page-wrapper ,  */
    .left-part {
        display: none;
    }

    /* .invoiceing-box * {
        display: block;
    } */

    .fonts {
        font-family: "Times New Roman", Times, serif !important;
        font-size: 11pt;
        color: black !important;
    }
}

@media print and (width: 21cm) and (height: 29.7cm) {
    @page {
        /* margin: 1cm; */
    }

    html,
    body {
        /* height: 99%; */
    }
}

@media print and (width: 8.5in) and (height: 11in) {
    @page {
        margin: 1in;
    }

    /* html,
    body {
        height: 99%;
    } */
}

@page {
    size: A4 portrait;
    margin: 1cm;
}

.fonts {
    font-family: "Times New Roman", Times, serif !important;
    font-size: 11pt;
    color: black !important;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #212529;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 1px;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #212529;
}
</style>

<div class="email-app todo-box-container">
    <div class="left-part list-of-tasks">
        <a class="ti-close btn btn-success show-left-part d-block d-md-none ti-menu" href="javascript:void(0)"></a>
        <div class="scrollable ps-container" style="height:100%;">
            <div class="p-3 text-center">
                <div class="btn-group">
                    <a class="waves-effect waves-light btn btn-info " href="<?=base_url('kegiatan'); ?>" id="add-task">Kembali</a>
                    <div class="dropdown-menu" style="">
                        <h6 class="dropdown-header">Jenis Permohonan</h6>
                        <span class="dropdown-item" data-toggle="modal" data-target="#permohonanmodal" data-jenis="muat">Muat</span>
                        <span class="dropdown-item" data-toggle="modal" data-target="#permohonanmodal" data-jenis="bongkar">Bongkar</span>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <ul class="list-group pt-3">
                <li>
                    <small class="p-3 ">Permohonan &amp; Invoice</small>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="<?= base_url('kegiatan/permohonan/'.$id) ?>" class="list-group-item-action p-3 d-block "><i class="mdi mdi-format-list-bulleted"></i> Permohonan <span class="todo-badge badge badge-info float-right"></span></a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="<?= base_url('kegiatan/invoice/'.$id) ?>" class="list-group-item-action p-3 d-block"> <i class="mdi mdi-book"></i> Invoice <span class="todo-badge badge badge-warning float-right"></span></a>
                </li>
            </ul>
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </div>
    </div>

    <div class="right-part invoice-box" style="height: 100%;">
        <div class="p-4 invoice-inner-part">
            <div class="invoiceing-box" style="display: block;width:  21.0cm;height: 100%;">
                <div class="card card-body" id="printableArea">
                    <div class="invoice-header align-items-center" style="border-bottom: 3px solid black !important;">
                        <div class="col-auto pb-2 text-center">
                            <img src="https://yuvenil.my.id/kop-zadin.png" style="max-width: 100%;width:-webkit-fill-available;">
                        </div>
                    </div>
                    <div class="fonts" id="custom-invoice" style="display: block;">
                        <div class="invoice-123">
                            <div class="row pt-3">
                                <div class="col-12 mb-3">
                                    <div class="text-center">
                                        <h4 class="mb-0" style="font-weight: 1000 !important;color:black;">INVOICE</h4>
                                        <h5 style="color:black;" class="mb-0 font-weight-bold">NO 0<?= $id?>/IBP/ZMA-SMD/I/2022</h5>
                                    </div>
                                </div>
                                <div class="d-flex col-12">
                                    <span class="pr-4">Kepada </span>
                                    <span class="pr-1">:</span>
                                    <span class=""><?= $asal_barang_nama ?><br>Up <?= $barang_pemilik ?></span>
                                </div>
                                <div class="d-flex col-12 pt-2">
                                    <span class="pr-4">Alamat </span>
                                    <span class="pr-1">:</span>
                                    <span class=""><?= $alamat_pemilik ?></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive mt-3" style="clear: both;">
                                        <table class="table table-bordered table-sm" style="color:black;">
                                            <thead class="bg-light-info" style="background-color: #cfecfe !important;">
                                                <tr>
                                                    <th class="text-center" style="width: 1rem; font-weight: bold;">No</th>
                                                    <th class="text-center" style="font-weight: bold;" colspan="9">Keterangan</th>
                                                    <th class="text-center" style="font-weight: bold;" colspan="2">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody style="line-height: 15px;">
                                                <?php
$this->db->where('cetak', 1);
$this->db->where('operasional', $db_permohonan->id);
$permohonan = $this->db->get('permohonan')->result();
$naik = 1;
$sub_total = 0;
foreach ($permohonan as $permohonan){
// echo '<pre>';
$status = $permohonan->status;

if($status == 1){
    $status = 'Baru';
    $tarif = '&ensp;x &ensp;'.$asal_barang->tarif_baru;
    $tarif_saja = $asal_barang->tarif_baru;
}
if($status == 2){
    $status = 'Perpanjang';
    $tarif = '&ensp;x &ensp;'.$asal_barang->tarif_perpanjang;
    $tarif_saja = $asal_barang->tarif_perpanjang;
}
if($status == 3){
    $status = 'Revisi';
    $tarif = '&ensp;x &ensp;'.$asal_barang->tarif_revisi;
    $tarif_saja = $asal_barang->tarif_revisi;
}
$this->db->where('id', $permohonan->kapal);
$nama_kapal = $this->db->get('kapal')->row()->nama;

// var_dump($permohonan->id);
// // var_dump($operasional->parent);
// print'</pre>';
// echo $tarif;
$sub_total += (int)str_replace('000','',$permohonan->jumlah_asli) * (int)$tarif_saja;
?>

                                                <tr>
                                                    <th scope="row" style="text-align: center;vertical-align: middle;"><?= $naik++ ?></th>
                                                    <td colspan="9">Jasa PBM (RKBM <?= $status?>)<br>No RKBM : <?= $permohonan->no_rkbm?><br>Tanggal : <?= tgl_in($permohonan->mulai) ?><br>Nama Kapal : <?= $nama_kapal?><br>Muatan : <?=number_format(str_replace('000','',$permohonan->jumlah_asli), 0, ',', '.'); ?>&ensp;&ensp;&ensp;MT <?= $tarif ?></td>
                                                    <td style="text-align: left;vertical-align: middle;border-right: white;">Rp</td>
                                                    <td style="text-align: right;vertical-align: middle;border-left: white;"><?=  number_format((int)str_replace('000','',$permohonan->jumlah_asli) * (int)$tarif_saja, 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php 
}

                                        ?>
                                                <tr>
                                                    <td colspan="10" style="text-align: right;">Sub Total<br><?= $asal_barang->total_pph > 0 ? 'PPh('.$asal_barang->total_pph.'%)': ''?><br><b style="font-weight: bold;">Total Tagihan</b></td>
                                                    <td style="width: 1%;text-align: left;border-right: white;"><span class="pull-left">Rp</span><br><span class="pull-left">Rp</span><br><span class="pull-left">Rp</span></td>
                                                    <td style="width: 25%;text-align: right;border-left: white;" class=""><span class="pull-right"><?= number_format($sub_total, 0, ',', '.');?></span><br><span class="pull-right"><?= number_format(($sub_total * 2) / 100, 0, ',', '.');?></span><br><span class="pull-right"><?= number_format($sub_total - (($sub_total * 2) / 100), 0, ',', '.');?></span></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="12">Terbilang : <i style="font-weight: bold;"><?= terbilang($sub_total - (($sub_total * 2) / 100))?> Rupiah</i></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <p>Pembayaran Dapat Ditransfer Melalui<br>
                                Rekening Mandiri Cab. Samarinda Alaya<br><b style="font-weight: bold;">a/n : PT.ZADIN MITRA ABADI<br>A/C : 148-00-5382888-8 </b></p>

                            <br>
                            <div class="row fonts text-center">
                                <div class="col-6">
                                </div>
                                <div class="col-6">
                                    <h5 style="font-weight: bold;color: black;" class="mb-5 mt-5">Hormat Kami,</h5>
                                    <h4 style="font-weight: bold;color: black;" class="mb-5"><u>Juspri Ardianus</u></h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-right">
                                    <a class="btn btn-default print-page notprintable" href="<?= base_url('kegiatan/invoice_cetak/'. $id)?>"> <span><i class="fa fa-print"></i> Print</span> </a>
                                    <!-- <button class="btn btn-default print-page notprintable" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> -->
                                </div>
                            </div>
                        </div> <!-- ./(1) -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ./Right Part -->
    </div>


    <script>
    // Print
    $(".print-page").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div#printableArea").printArea(options);
    });
    </script>