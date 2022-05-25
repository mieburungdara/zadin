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
?>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/typeahead.jquery.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/bloodhound.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/bootstrap-toaster/css/bootstrap-toaster.css">
<script src="<?=base_url(); ?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url(); ?>assets/js/bootstrap-add-clear.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="<?=base_url(); ?>assets/libs/sweetalert2/dist/sweetalert2.all.min.js" aria-hidden="true"></script>
<!-- <script src="<?=base_url(); ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
<script src="https://www.jqueryscript.net/demo/bootstrap-toaster/js/bootstrap-toaster.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/leader-line/leader-line.css">
<script src="https://anseki.github.io/leader-line/js/libs-d4667dd-211118164156.js"></script>
<script src="https://cdn.jsdelivr.net/npm/anim-event@1.0.16/anim-event.min.js"></script>

<style>
.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0;
    border-bottom: 0;
    border-left: 0;
}

.dropdown-toggle:empty::after {
    margin-left: 0;
}

.form-control-clear {
    z-index: 10;
    pointer-events: auto;
    cursor: pointer;
}

.vertical-nav-menu {
    margin: 0;
    padding: 0;
    position: relative;
    list-style: none
}

.vertical-nav-menu::after {
    content: " ";
    pointer-events: none;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0
}

.vertical-nav-menu .mm-collapse:not(.mm-show) {
    display: none
}

.vertical-nav-menu .mm-collapsing {
    position: relative;
    height: 0;
    overflow: hidden;
    transition-timing-function: ease;
    transition-duration: .25s;
    transition-property: height, visibility
}

.vertical-nav-menu ul {
    margin: 0;
    padding: 0;
    position: relative;
    list-style: none
}

.vertical-nav-menu:before {
    opacity: 0;
    transition: opacity 300ms
}

.vertical-nav-menu li a {
    display: block;
    line-height: 2.4rem;
    height: 2.4rem;
    padding: 0 1.5rem 0 45px;
    position: relative;
    border-radius: .25rem;
    color: #343a40;
    white-space: nowrap;
    transition: all .2s;
    margin: .1rem 0
}

.vertical-nav-menu li a:hover {
    background: #e0f3ff;
    text-decoration: none
}

.vertical-nav-menu li a:hover i.metismenu-icon {
    opacity: .6
}

.vertical-nav-menu li a:hover i.metismenu-state-icon {
    opacity: 1
}

.vertical-nav-menu li.mm-active>a {
    font-weight: 700
}

.vertical-nav-menu li.mm-active>a i.metismenu-state-icon {
    transform: rotate(-180deg)
}

.vertical-nav-menu li a.mm-active {
    color: #3f6ad8;
    background: #e0f3ff;
    font-weight: 700
}

.vertical-nav-menu i.metismenu-state-icon,
.vertical-nav-menu i.metismenu-icon {
    text-align: center;
    width: 34px;
    height: 34px;
    line-height: 34px;
    position: absolute;
    left: 5px;
    top: 50%;
    margin-top: -17px;
    font-size: 1.5rem;
    opacity: .3;
    transition: color 300ms
}

.vertical-nav-menu i.metismenu-state-icon {
    transition: transform 300ms;
    left: auto;
    right: 0
}

.vertical-nav-menu ul {
    transition: padding 300ms;
    padding: .5em 0 0 2rem
}

.vertical-nav-menu ul:before {
    content: '';
    height: 100%;
    opacity: 1;
    width: 3px;
    background: #e0f3ff;
    position: absolute;
    left: 20px;
    top: 0;
    border-radius: 15px
}

.vertical-nav-menu ul>li>a {
    color: #6c757d;
    height: 2rem;
    line-height: 2rem;
    padding: 0 1.5rem
}

.vertical-nav-menu ul>li>a:hover {
    color: #3f6ad8
}

.vertical-nav-menu ul>li>a .metismenu-icon {
    display: none
}

.vertical-nav-menu ul>li>a.mm-active {
    color: #3f6ad8;
    background: #e0f3ff;
    font-weight: 700
}


.task-list {
    list-style: none;
    position: relative;
    margin: 0;
    padding: 30px 0 0;
}

.task-list:after {
    content: "";
    position: absolute;
    background: #ecedef;
    height: 100%;
    width: 2px;
    top: 0;
    left: 30px;
    z-index: 1;
}

.task-list li {
    margin-bottom: 30px;
    padding-left: 55px;
    position: relative;
}

.task-list li:last-child {
    margin-bottom: 0;
}

.task-list li .task-icon {
    position: absolute;
    left: -20px;
    /* left: 22px; */
    /* top: 13px; */
    /* border-radius: 50%;
        padding: 2px;
        width: 17px;
        height: 17px; */
    z-index: 2;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
}
</style>

<div class="email-app todo-box-container">
    <div class="left-part list-of-tasks">
        <a class="ti-close btn btn-success show-left-part d-block d-md-none ti-menu" href="javascript:void(0)"></a>
        <div class="scrollable ps-container" style="height:100%;">
            <div class="p-3 text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Buat Permohonan
                    </button>
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

    <div class="right-part bg-white overflow-auto">
        <div class="container-fluid">


            <div class="p-3 border-bottom">
                <div class="row">
                    <div class="col-auto">
                        <a class="waves-effect waves-light btn btn-info " href="<?=base_url('kegiatan'); ?>" id="add-task">Kembali</a>
                    </div>
                    <div class="col-auto">
                        <h3><?=$nama; ?>
                        </h3>
                        <h6><?=$keterangan; ?>
                        </h6>
                        <small class="font-12 text-muted"><i class="icon-calender mr-1"></i><?=tgl_ind(date_format(date_create($created_at), "Y-m-d H:i:s")); ?></small>
                    </div>
                </div>
            </div>
            <?php


$this->db->select('id');
$this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
$check_jumlah_permohonan = $this->db->get('permohonan')->result();
$hitung_permohonan = count($check_jumlah_permohonan);
$jumlah_revisi = count($this->db->query("SELECT id FROM permohonan where status = '3' and operasional = '$id'")->result());
$jumlah_perpanjang = count($this->db->query("SELECT id FROM permohonan where status = '2' and operasional = '$id'")->result());
?>
            <div class="row justify-content-start pl-3 pt-3">
                <div class="col-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex flex-row text-center">
                                <div class="p-2 border-right">
                                    <h6 class="font-weight-light">Permohonan</h6><b><?= $hitung_permohonan?></b>
                                </div>
                                <div class="p-2 border-right">
                                    <h6 class="font-weight-light">Revisi</h6><b><?= $jumlah_revisi?></b>
                                </div>
                                <div class="p-2">
                                    <h6 class="font-weight-light">Perpanjang</h6><b><?= $jumlah_perpanjang?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kelasku">
                <!-- <div class="row"> -->
                <?php

// $result = $this->db->query("SELECT  id, parent FROM test  ")->result_array();
// $this->db->where('parent IS NOT NULL', null, false);
$this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
// $this->db->order_by('id', 'DESC');
// $this->db->select('id');
// $this->db->select('parent');
$result = $this->db->get('permohonan')->result();
// $result = $this->db->get('permohonan')->result_array();

function tampilkan($result)
{
    $CI =& get_instance();
    foreach ($result as $key => $value) {
        if ($value->parent == null) {
            echo '<div class="row">';
        }
        echo '<div class="col-3 shadow border-dark rounded mx-3 my-3" id="kolom'.$value->id.'" >';
        echo $value->id;
        // print_r($value);
        echo '</div>';
        $CI->db->where('parent', $value->id);
        $child = $CI->db->get('test')->result();
        // $child = $CI->db->get('permohonan')->result_array();
        if ($child) {
            // echo '<div class="col-auto shadow mx-3 my-3 border-dark rounded">';
            echo '<div class="row col">';
            tampilkan($child);
            echo '</div>';
        }
        
        if ($value->parent == null) {
            echo '</div>';
        }
        if ($value->parent != null) {
            echo '<script>
            window.addEventListener("load", function() {
              "use strict";
            
             var garis'.$value->id.' = new LeaderLine(
                document.getElementById("kolom'.$value->parent.'"),
                document.getElementById("kolom'.$value->id.'"), 
                {
                    color: "#1e88e5",
                    path: "fluid",
                    startSocket: "bottom", 
                    endSocket: "left",
                    size: 4,
                }
              );
            
document.querySelector(".right-part").addEventListener("scroll", AnimEvent.add(function() {
    garis'.$value->id.'.position();
  }), false);

            });
            </script>';
        }
    }
}
function perlihatkan($result)
{
    $CI =& get_instance();
    foreach ($result as $key => $permohonan) {

        if ($permohonan->status == 1) {
            $status_permohonan = 'note-social';
            $espe              = 'baru';
        } elseif ($permohonan->status == 2) {
            $status_permohonan = 'note-business';
            $espe              = 'perpanjang';
        } elseif ($permohonan->status == 3) {
            $status_permohonan = 'note-important';
            $espe              = 'revisi';
        } else {
            $status_permohonan = '';
            $espe              = 'batal';
        }
        $CI->db->where('id', $permohonan->kapal);
        $permohonan_kapal = $CI->db->get('kapal')->row();

        if ($permohonan->permohonan_jenis == 1) {
            $tanggal_mulai = $permohonan->mulai;
        } elseif ($permohonan->permohonan_jenis == 2) {
            $tanggal_mulai = $permohonan->selesai;
        } elseif ($permohonan->permohonan_jenis == 3) {
            $tanggal_mulai = $permohonan->mulai . ' - ' . $permohonan->selesai;
        }
        $permohonan_jenis     = $CI->Reza_model->get_ref_val($CI->db->database, 'permohonan', 'permohonan_jenis', $permohonan->permohonan_jenis)->nama;
        $tempat_muat          = $CI->Reza_model->get_ref_val($CI->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->nama;
        $jenis_tempat_muat    = $CI->Reza_model->get_ref_val($CI->db->database, 'terminal', 'jenis', $CI->Reza_model->get_ref_val($CI->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->jenis)->nama;
        $id_jenis_tempat_muat = $CI->Reza_model->get_ref_val($CI->db->database, 'terminal', 'jenis', $CI->Reza_model->get_ref_val($CI->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->jenis)->id;
        $agen_kapal           = $CI->Reza_model->get_ref_val($CI->db->database, 'kapal', 'agen_kapal', $permohonan_kapal->agen_kapal)->nama;
        // $asal_barang           = $CI->Reza_model->get_ref_val($CI->db->database, 'operasional', 'barang_asal', $id)->nama;
        $CI->db->where('id', $permohonan->operasional);
        $db_permohonan = $CI->db->get('operasional')->row();
        $asal_barang = $db_permohonan->barang_asal;
        $CI->db->where('id', $asal_barang);
        $asal_barang = $CI->db->get('barang_asal')->row();
        $asal_barang = $asal_barang->nama;
        // $asal_barang           = $CI->Reza_model->get_ref_val($CI->db->database, 'operasional', 'barang_asal', $id)->nama;
        $jenis_barang           = $CI->Reza_model->get_ref_val($CI->db->database, 'permohonan', 'barang', $permohonan->barang)->nama;
        $atribut_json         = json_encode(array("agen_kapal" => $permohonan_kapal->agen_kapal, 'jenis_tempat_muat' => $id_jenis_tempat_muat));


        if ($permohonan->parent == null) {
            echo '<div class="col-12 mt-3 border-bottom">';
            echo '<div class="note-has-grid row">';
        }
        // echo '<div class="col-3 shadow border-dark rounded mx-3 my-3" >';
        // echo $permohonan->id;
        ?>

                <div class="col-auto  all-category <?=$status_permohonan; ?>">
                    <div class="card card-body shadow">
                        <span class="side-stick"></span>
                        <div class="col-12 px-0">
                            <div class="d-flex flex-wrap mb-2 ">
                                <div>
                                    <span class="mr-1">
                                        <?='<span class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info" id="kolom'.$permohonan->id.'">' . strtoupper($espe) . ' </span><br>'; ?>
                                    </span>
                                </div>
                                <div class="ml-auto text-center">
                                    <span class=""><?=tgl_in($tanggal_mulai); ?></span>
                                    <span class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info"><?=strtoupper($permohonan_jenis); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto border-right align-self-center">
                                    <div class="d-flex">
                                        <code>No Surat :<br> 0<?=$permohonan->id; ?>/RKBM-ZMA/SMD/XII/2022</code>
                                    </div>
                                </div>
                                <div class="col-auto" data-toggle="modal" data-target="#modal-norkbm" data-nosurat="<?=$permohonan->id; ?>"><code>No RKBM :<br>
                                            <?php
if ($permohonan->no_rkbm) {
            echo $permohonan->no_rkbm;
        } else {
            echo '<i class="fa fa-warning text-danger faa-flash faa-fast animated"></i> <code>belum ada</code>';
                                    } ?></code>
                                </div>
                            </div>
                            <div class="note-content">

                                <table class="table table-sm mt-2 table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-medium">Kapal</td>
                                            <td><span data-toggle="tooltip" data-placement="top" title="<?=strtoupper($agen_kapal); ?>"><?=$permohonan_kapal->nama; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-medium">Terminal Muat</td>
                                            <td><span data-toggle="tooltip" data-placement="top" title="<?=strtoupper($jenis_tempat_muat); ?>"><?=$tempat_muat; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-medium">Terminal Bongkar</td>
                                            <td><?=$permohonan->tempat_bongkar; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="row text-center mt-3 justify-content-center">
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_muatan, 0, ',', '.'); ?>
                                        </h3><small>Muat Perkiraan</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_asli, 0, ',', '.'); ?>
                                        </h3><small>Muat Asli</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h3 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_bongkar, 0, ',', '.'); ?>
                                        </h3><small>Bongkar</small>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex align-items-center mt-4">
                                <?php $warna = $permohonan->cetak ? 'info' : 'danger'; ?>
                                <?php $fa = $permohonan->cetak ? 'check' : 'times'; ?>
                                <span class="mr-1 btn-sm btn waves-effect btn-<?=$warna?> inpoice invoice<?=$permohonan->id?>" data-id="<?=$permohonan->id?>"> <i class="fa voice<?=$permohonan->id?> fa-<?=$fa?> mr-2"></i>Invoice</span>
                                <div class="ml-auto">
                                    <div class="category-selector btn-group">
                                        <a class="nav-link category-dropdown label-group p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <div class="category">
                                                <span class="more-options text-dark"><i class="icon-options-vertical"></i></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right category-menu shadow" style="">
                                            <a class="dropdown-item text-info" data-toggle="modal" data-target="#permohonanmodal" data-permohonan='<?=$atribut_json; ?>' data-jenis="ubah_<?=$permohonan_jenis; ?>" data-idpermohonan="<?=$permohonan->id; ?>" href="javascript:void(0);"><i class="fa-duotone fa-edit  mr-1"></i> Ubah</a>
                                            <a class="dropdown-item text-success" data-toggle="modal" data-target="#cetak-permohonan<?=$permohonan->id; ?>" data-permohonan='<?=$atribut_json; ?>' href="javascript:void(0);"><i class="fa-duotone fa-print  mr-1"></i>Cetak</a>
                                            <a class="dropdown-item text-primary" data-toggle="modal" data-target="#permohonanmodal" data-permohonan='<?=$atribut_json; ?>' data-jenis="revisi_<?=$permohonan_jenis; ?>" data-idpermohonan="<?=$permohonan->id; ?>" href="javascript:void(0);"><i class="fa-duotone fa-arrows-repeat  mr-1"></i> Revisi</a>
                                            <a class="dropdown-item text-primary" data-toggle="modal" data-target="#permohonanmodal" data-permohonan='<?=$atribut_json; ?>' data-jenis="perpanjang_<?=$permohonan_jenis; ?>" data-idpermohonan="<?=$permohonan->id; ?>" href="javascript:void(0);"><i class="fa-duotone fa-arrows-retweet  mr-1"></i> Perpanjang</a>
                                            <a class="dropdown-item text-danger menghapuspermohonan" id="<?=$permohonan->id; ?>" data-idpermohonan="<?=$permohonan->id; ?>" href="javascript:void(0);"><i class="fa-duotone fa-trash-alt  mr-1"></i>Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="cetak-permohonan<?=$permohonan->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Cetak Permohonan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="row mx-3">
                                    <div class="col-12">
                                        <img src="https://yuvenil.my.id/kop-zadin.png" class="card-img-top img-fluid">
                                    </div>
                                    <div class="col-12 my-3">
                                    </div>



                                    <div class="row p-3">
                                        <div class="col-12" style="">
                                            <div class="col-6"></div>
                                            <div class="col-6 float-right">
                                                <span style="font-weight: normal;">Samarinda, <?= tgl_in(date('Y-m-d')); ?></span>
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
                                                        <td>0<?=$permohonan->id; ?>/ZMA/SMD/III/<?= date('Y')?></td>
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
                                                                (RKBM) - <?= strtoupper( $permohonan_jenis)?>
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
                                                        <td><?= strtoupper($permohonan_kapal->nama); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Isi Kotor (GTR)</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $permohonan_kapal->ukuran); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Bendera</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $permohonan_kapal->bendera); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Rencana Muat</th>
                                                        <th>:</th>
                                                        <td><?= tgl_in($permohonan->mulai); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Tempat Muat</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $tempat_muat); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Tempat Bongkar</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $permohonan->tempat_bongkar); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Jenis Barang</th>
                                                        <th>:</th>
                                                        <td><?= strtoupper( $jenis_barang)?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Qty</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $permohonan->jumlah_muatan); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Agen</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $agen_kapal) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Asal Barang</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper( $asal_barang) ?></td>
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
                            </div>

                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> -->
                                <a type="button" class="btn btn-outline-danger" href="<?= base_url('kegiatan/permohonan_cetak/'. $permohonan->id)?>"><i class="fa fa-print"></i> Cetak Permohonan</a>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


                <?php
        // print_r($permohonan);
        // echo '</div>';
        $CI->db->where('parent', $permohonan->id);
        $child = $CI->db->get('permohonan')->result();
        // $child = $CI->db->get('permohonan')->result_array();
        if ($child) {
            // echo '<div class="col-auto shadow mx-3 my-3 border-dark rounded">';
            // echo '<div class="row col">';
            perlihatkan($child);
            // echo '</div>';
        }
        
        if ($permohonan->parent == null) {
            echo '</div>';
            echo '</div>';
        }
        if ($permohonan->parent != null) {
            echo '<script>
            window.addEventListener("load", function() {
              "use strict";
            
             var garis'.$permohonan->id.' = new LeaderLine(
                LeaderLine.mouseHoverAnchor(
                document.getElementById("kolom'.$permohonan->parent.'"), "draw",{
                    animOptions: {
                      duration: 1000
                    },style: {
                        backgroundColor: null,
                        backgroundImage: null,
                    },hoverStyle: {
                        backgroundColor: null
                    },
                }),LeaderLine.mouseHoverAnchor(
                document.getElementById("kolom'.$permohonan->id.'"), "draw",{
                    animOptions: {
                      duration: 1000
                    },style: {
                        backgroundColor: null,
                        backgroundImage: null,
                    },hoverStyle: {
                        backgroundColor: null
                    },
                }),
                // document.getElementById("kolom'.$permohonan->id.'"), 
                {
                    color: "#1e88e5",
                    path: "fluid",
                    startSocket: "right", 
                    endSocket: "top",
                    size: 4,
                    dash: {animation: true},
                }
              );
            
document.querySelector(".right-part").addEventListener("scroll", AnimEvent.add(function() {
    garis'.$permohonan->id.'.position();
  }), false);

            });
            </script>';
        }
    }
}
// echo '<pre>';
// var_dump($result);
perlihatkan($result);
// echo '</pre>';

?>
                <!-- </div>

        </div>
    </div> -->


            </div>
        </div>
    </div>
    <div id="permohonanmodal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <h4 class="jenismodal">Buat Permohonan</h4>
                    </div>

                    <form action="<?=base_url(); ?>kegiatan/permohonan_buat" method="post" id="form-permohonan">
                        <div class="card-body">
                            <div class="row mt-3">

                                <div class="col-sm-12 col-md-6">
                                    <label for="tanggal_muat">Rencana Muat / Mulai</label>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                        <input type="text" id="tanggal_muat" name="mulai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                        <input type="text" id="tanggal_selesai" name="selesai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="agen_kapal">Agen Kapal</label>
                                        <select class="custom-select mr-sm-2 wide" name="agen_kapal" id="agen_kapal" placeholder="Agen Kapal">
                                            <option disabled <?php
echo 'selected="selected"';
?>>Pilih...
                                            </option>
                                            <?php
$agen_kapals = $this->Agen_kapal_model->get_all();
foreach ($agen_kapals as $palu) {
    echo "<option value='" . $palu->id . "' >" . $palu->nama . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="nama_kapal">Nama Kapal</label>
                                        <code id="ket"></code>
                                        <select class="custom-select mr-sm-2" disabled name="nama_kapal" id="nama_kapal" placeholder="Nama Kapal">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_terminal">Jenis Terminal</label>
                                        <select class="custom-select mr-sm-2 wide" name="jenis_terminal" id="jenis_terminal" placeholder="Jenis Terminal">
                                            <option disabled <?php
echo 'selected="selected"';

?>>Pilih..
                                            </option>
                                            <?php
$agen_kapals = $this->Jenis_terminal_model->get_all();
foreach ($agen_kapals as $palu) {
    echo "<option value='" . $palu->id . "'>" . strtoupper($palu->nama) . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_muat" data-toggle="tooltip" data-placement="top" title="" data-original-title="Terminal tempat memuat barang">Tempat Muat</label>
                                        <select class="custom-select mr-sm-2" disabled name="tempat_muat" id="tempat_muat" placeholder="Pilih">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tempat barang dibongkar Atau Tujuan barang">Tempat Bongkar/Tujuan</label>
                                        <input class="form-control" type="text" id="tempat_bongkar" name="tempat_bongkar" placeholder="Pilih..">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="barang">Jenis Barang</label>
                                        <select class="custom-select mr-sm-2" name="barang" id="barang" placeholder="Nama Terminal">
                                            <option disabled <?php
echo 'selected="selected"';
?>>Pilih..
                                            </option>
                                            <?php
$agen_kapals = $this->Barang_model->jenis_barang();
foreach ($agen_kapals as $palu) {
    echo "<option value='" . $palu->id . "'>" . strtoupper($palu->nama) . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_muatan" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Jumlah Muatan</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_muatan" name="jumlah_muatan" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_asli" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Jumlah Sebenarnya</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_asli" name="jumlah_asli" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan bongkar">Jumlah Bongkaran</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_bongkar" name="jumlah_bongkar" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="asal_barang">Asal Barang</label>
                                        <select class="custom-select mr-sm-2 wide" name="asal_barang" id="asal_barang" placeholder="Asal Barang">
                                            <option disabled <?php
// echo 'selected="selected"';

?>>Choose...
                                            </option>
                                            <?php
$agen_kapals = $this->Asal_pemilik_model->get_asal();
foreach ($agen_kapals as $palu) {
    // echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="perusahaan">Perusahaan PBM</label>
                                        <select class="custom-select mr-sm-2 wide" name="perusahaan" id="perusahaan" placeholder="Agen Kapal">
                                            <option disabled <?php
// echo 'selected="selected"';

?>>Choose...
                                            </option>
                                            <?php
$agen_kapals = $this->Perusahaan_model->get_all();
foreach ($agen_kapals as $palu) {
    // echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="card-body">
                                    <div class="action-form">
                                        <div class="form-group mb-0 text-right">
                                            <input type="hidden" name="operasional" value="<?php echo $id; ?>" />
                                            <input type="hidden" name="permohonan_jenis" class="permohonan_jenis" value="" />
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-norkbm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="mySmallModalLabel">Small modal</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url(); ?>kegiatan/update_norkbm" id="form-rkbm" class="nyot">
                        <div class="input-group">
                            <input type="number" name="no_rkbm" class="form-control norkbm" value="">
                            <input type="number" name="id_rkbm" hidden class="form-control idrkbm" value="">
                            <div class="input-group-append">
                                <button class="btn btn-info simpanrkbm" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



    <script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

    <script>
    $('.inpoice').click(function() {
        var id = $(this).attr('data-id');
        var invoice = '0';
        if ($(this).hasClass("btn-danger")) {
            invoice = 1;
        }
        if ($(this).hasClass("btn-info")) {
            invoice = 0;
        }
        $.getJSON("<?=base_url('kegiatan/update_cetak')?>", {
            invoice: invoice,
            invoice_id: id
        }, function(data) {
            //   $( ".result" ).html( data );
            if (data.data == 1) {
                Toast.setPlacement(TOAST_PLACEMENT.MIDDLE_CENTER);
                Toast.setTheme(TOAST_THEME.DARK);

                Toast.create("Success", 'Permohonan dimasukkan ke dalam daftar cetak invoice..', TOAST_STATUS.SUCCESS, 3000);
                $('.invoice' + id).addClass("btn-info");
                $('.invoice' + id).removeClass("btn-danger");
                $('.voice' + id).removeClass("fa-times");
                $('.voice' + id).addClass("fa-check");
            }
            if (data.data == 0) {
                Toast.setPlacement(TOAST_PLACEMENT.MIDDLE_CENTER);
                Toast.setTheme(TOAST_THEME.DARK);

                Toast.create("Success", 'Permohonan dikeluarkan dalam daftar cetak invoice..', TOAST_STATUS.SUCCESS, 3000);
                $('.invoice' + id).addClass("btn-danger");
                $('.invoice' + id).removeClass("btn-info");
                $('.voice' + id).removeClass("fa-check");
                $('.voice' + id).addClass("fa-times");
            }
        });
    });


    $(".menghapuspermohonan").click(function() {
        var idpermohonan = $(this).attr("id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'mr-2 btn btn-danger'
            },
            buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
            title: 'Apa kamu yakin ingin menghapus permohonan ini?',
            text: "Permohonan yg dihapus tidak dapat dikembalikan lagi..",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak jadi!',
            // reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.getJSON("<?=base_url(); ?>permohonan/delete/" + idpermohonan, function(data, status) {
                    console.log(data);
                    if (data.status == 'success') {
                        swalWithBootstrapButtons.fire(
                            'Telah Dihapus!',
                            'Permohonan berhasil dihapus.',
                            'success'
                        );
                        location.reload();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Gagal..',
                            'Permohonan tidak dapat dihapus, mungkin permohonan ini memiliki perpanjang atau revisi, mohon hapus terlebih dahulu sebelum menghapus permohonan awal..',
                            'error'
                        )
                    }

                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan..',
                    'Permohonan tidak dihapus..',
                    'error'
                )
            }
        })
    });

    $("#form-rkbm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var actionUrl = form.attr('action');
        // alert(form.serialize());
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            dataType: "json",
            success: function(data) {
                if (data.status == 'success') {
                    kkMessgae.success(data.data);
                    window.location.reload();
                } else {
                    kkMessgae.error(data.data);
                }
            }
        });
    });

    $('#modal-norkbm').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('nosurat')
        var modal = $(this)
        modal.find('.modal-title').text('Ubah Nomor RKBM')
        $.get("<?=base_url(); ?>/kegiatan/read_norkbm/" + recipient, function(data, status) {
            modal.find('.idrkbm').val(recipient)
            modal.find('.norkbm').val(data.trim())
        });
    })

    $('#permohonanmodal').on('shown.bs.modal', function(event) {
        var memuat = '';
        var aseli = '';
        var bungkar = '';
        var button = $(event.relatedTarget)
        var jenis = button.data('jenis')
        var modal = $(this)

        $('#form-permohonan').trigger("reset");
        document.getElementById("nama_kapal").options.length = 0;
        $('#nama_kapal').prop('disabled', 'disabled');
        document.getElementById("tempat_muat").options.length = 0;
        $('#tempat_muat').prop('disabled', 'disabled');
        document.getElementById("ket").innerHTML = '';
        modal.find('.permohonan_jenis').val(jenis)
        if (jenis == 'muat' || jenis == 'bongkar') {
            modal.find('.jenismodal').text('Buat permohonan ' + jenis)
        } else {
            var idpermohonan = button.data('idpermohonan')
            var permohonan = button.data('permohonan')
            modal.find('.jenismodal').text('Ubah Permohonan');
            if (jenis == 'revisi_muat') {
                modal.find('.jenismodal').text('Revisi Permohonan Muat');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_revisi/' + idpermohonan);
            }
            if (jenis == 'revisi_bongkar') {
                modal.find('.jenismodal').text('Revisi Permohonan Bongkar');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_revisi/' + idpermohonan);
            }
            if (jenis == 'perpanjang_muat') {
                modal.find('.jenismodal').text('Perpanjang Permohonan Muat');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_perpanjang/' + idpermohonan);
            }
            if (jenis == 'perpanjang_bongkar') {
                modal.find('.jenismodal').text('Perpanjang Permohonan Bongkar');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_perpanjang/' + idpermohonan);
            }
            if (jenis == 'ubah_muat') {
                modal.find('.jenismodal').text('Ubah Perpanjang Permohonan Muat');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_update/' + idpermohonan);
            }
            if (jenis == 'ubah_bongkar') {
                modal.find('.jenismodal').text('Ubah Perpanjang Permohonan Bongkar');
                $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_update/' + idpermohonan);
            }
            $.getJSON("<?=base_url(); ?>permohonan/read_json/" + idpermohonan, function(data, status) {
                $('#agen_kapal').val(permohonan.agen_kapal).change();
                $('#jenis_terminal').val(permohonan.jenis_tempat_muat).change();
                $('#tanggal_muat').datepicker('update', data.mulai);
                $('#tanggal_selesai').datepicker('update', data.selesai);
                $(document).on("ajaxComplete", function(event, xhr, settings) {
                    if (settings.url == "<?=base_url(); ?>kapal/read_json") {
                        $('#nama_kapal').val(data.kapal).change();
                    }
                })
                $(document).on("ajaxComplete", function(event, xhr, settings) {
                    if (settings.url == "<?=base_url(); ?>terminal/read_json") {
                        $('#tempat_muat').val(data.tempat_muat).change();
                    }
                })
                if (data.jumlah_muatan == '0') {
                    memuat = '';
                } else {
                    memuat = data.jumlah_muatan;
                }
                if (data.jumlah_asli == '0') {
                    aseli = '';
                } else {
                    aseli = data.jumlah_asli;
                }
                if (data.jumlah_bongkar == '0') {
                    bungkar = '';
                } else {
                    bungkar = data.jumlah_bongkar;
                }
                $('#tempat_bongkar').val(data.tempat_bongkar);
                $('#barang').val(data.barang);
                $('#jumlah_muatan').val(memuat);
                $('#jumlah_asli').val(aseli);
                $('#jumlah_bongkar').val(bungkar);
                // $('#asal_barang').val(data.asal_barang);
                // $('#perusahaan').val(data.perusahaan);
            });
        }
    })
    </script>
    <script>
    $(".hapus").addClear({
        symbolClass: "fa-solid fa-xmark",
        top: 32,
        right: 25,
        // hideOnBlur: true,
        // returnFocus: false,
        color: "red"
    });



    // Date Picker
    jQuery('.mydatepicker').datepicker({
        maxViewMode: 2,
        todayBtn: "linked",
        clearBtn: true,
        language: "id",
        autoclose: true,
        todayHighlight: true
    });
    </script>
    <script>
    kkMessgae.uri = ' <?=base_url(); ?>assets/libs/jquery-kk-message/'; // this is the id of the form
    $(document).ready(function() {

        $("#form-permohonan").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var actionUrl = form.attr('action');
            // alert(form.serialize());
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                dataType: "json",
                success: function(data) {
                    if (data.status == 'success') {
                        kkMessgae.success(data.data);
                        window.location.reload();
                    } else {
                        kkMessgae.error(data.data);
                    }
                }
            });
        });

        $('#nama_kapal').change(function() {
            var ukuran = $(this).children('option:selected').attr('data-ukuran');
            var bendera = $(this).children('option:selected').attr('data-bendera');
            // alert($(this).children('option:selected').data('id'));
            $('#ket').html('' + bendera + ' ~ ' + ukuran + '');
        });

        $(".masinput").inputmask("9.999.999");

        $("#agen_kapal").change(function() {
            field = this.value;
            $('#nama_kapal').prop("disabled", false); // Element(s) are now enabled.
            $.ajax({
                type: "POST",
                data: {
                    "id": field
                },
                url: "<?=base_url(); ?>kapal/read_json",
                success: function(data) {
                    $("#nama_kapal").html(data);
                }
            });
        });

        $("#jenis_terminal").change(function() {
            field = this.value;
            $('#tempat_muat').prop("disabled", false); // Element(s) are now enabled.
            $.ajax({
                type: "POST",
                data: {
                    "id": field
                },
                url: "<?=base_url(); ?>terminal/read_json",
                success: function(data) {
                    $("#tempat_muat").html(data);
                }
            });
        });

        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });
                cb(matches);
            };
        };

        <?php

$this->db->select('tujuan');
$hasil = $this->db->get('rkbm')->result();
$ds    = array();
foreach ($hasil as $key => $value) {
    if (!in_array($value, $ds)) {
        $ds[$key] = $value;
    }
}
foreach ($ds as $item) {
    $dull[] = $item->tujuan;
}
$red = json_encode($dull);
?>
        var xer = <?php echo $red; ?>;
        $('#tempat_bongkar').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            // name: 'states',
            source: substringMatcher(xer)
        });


        <?php
// $this->db->select('jumlah');
// $sdnyulbd  = $this->db->get('rkbm')->result();
// $wftrtynbt = array();
// foreach ($sdnyulbd as $key => $value) {
//     if (!in_array($value, $wftrtynbt)) {
//         $wftrtynbt[$key] = $value;
//     }
// }
// foreach ($wftrtynbt as $ulikyjthtr) {
//     $jehbt[] = str_replace('.000', '', $ulikyjthtr->jumlah);
// }
// $ergvr = json_encode($jehbt);;; ?>
        // var dtp = <?php //echo //$ergvr;;; ?>;
        // $('#jumlah').typeahead({
        //     hint: true,
        //     highlight: true,
        //     minLength: 1
        // }, {
        //     // name: 'states',
        //     source: substringMatcher(dtp)
        // });

    });



    // var brg = ["BATU BARA"];
    // var ada = new Bloodhound({
    //     datumTokenizer: Bloodhound.tokenizers.whitespace,
    //     queryTokenizer: Bloodhound.tokenizers.whitespace,
    //     identify: function(obj) {
    //         return obj;
    //     },
    //     local: brg
    // });

    // function xs(q, sync) {
    //     if (q === '') {
    //         sync(ada.get('BATU BARA'));
    //     } else {
    //         ada.search(q, sync);
    //     }
    // }

    // $('#barang').typeahead({
    //     minLength: 0,
    //     hint: true,
    //     highlight: true
    // }, {
    //     source: xs
    // });
    </script>