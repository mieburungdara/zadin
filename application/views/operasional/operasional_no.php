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
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/typeahead.jquery.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/bloodhound.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/bootstrap-toaster/css/bootstrap-toaster.css">
<script src="<?=base_url(); ?>assets/js/bootstrap-add-clear.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="<?=base_url(); ?>assets/libs/sweetalert2/dist/sweetalert2.all.min.js" aria-hidden="true"></script>
<!-- <script src="<?=base_url(); ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
<script src="https://www.jqueryscript.net/demo/bootstrap-toaster/js/bootstrap-toaster.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/leader-line/leader-line.css">
<script src="https://anseki.github.io/leader-line/js/libs-d4667dd-211118164156.js"></script>
<script src="https://cdn.jsdelivr.net/npm/anim-event@1.0.16/anim-event.min.js"></script>


<div class="container-fluid bg-white overflow-auto mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title"><?=$nama; ?></h4>
                        <h6 class="card-subtitle"><?=$keterangan; ?></h6>
                        <small class="font-12 text-muted"><i class="icon-calender mr-1"></i><?=tgl_ind(date_format(date_create($created_at), "Y-m-d H:i:s")); ?></small>
                    </div>
                    <div class="ml-auto mr-2">
                        <a class="waves-effect waves-light btn btn-info " href="javascript: void(0)" id="add-task">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#permohonanmodal">Buat Permohonan</button>
            <a class="btn waves-effect waves-light btn-sm btn-info collapsed ml-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Cetak Invoice
            </a>
        </div>
        <div class="col-12 mt-3">
            <?php
$this->db->select('id');
$this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
$check_jumlah_permohonan = $this->db->get('permohonan')->result();
$hitung_permohonan       = count($check_jumlah_permohonan);
$jumlah_revisi           = count($this->db->query("SELECT id FROM permohonan where status = '3' and operasional = '$id'")->result());
$jumlah_perpanjang       = count($this->db->query("SELECT id FROM permohonan where status = '2' and operasional = '$id'")->result());
?>

            <div class="row justify-content-end pl-3 pt-3">
                <div class="col-auto">
                    <div class="card shadow">
                        <div class="card-body m-n2">
                            <div class="d-flex flex-row text-center">
                                <div class="p-2 border-right">
                                    <h6 class="font-weight-light">Permohonan</h6><b><?=$hitung_permohonan; ?></b>
                                </div>
                                <div class="p-2 border-right">
                                    <h6 class="font-weight-light">Revisi</h6><b><?=$jumlah_revisi; ?></b>
                                </div>
                                <div class="p-2">
                                    <h6 class="font-weight-light">Perpanjang</h6><b><?=$jumlah_perpanjang; ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <div class="kelasku row">
                <?php
// $this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
$result = $this->db->get('permohonan')->result();

// var_dump($result); ?>
                <?php
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
    $this->db->where('id', $permohonan->kapal);
    $permohonan_kapal = $this->db->get('kapal')->row();
    if ($permohonan->permohonan_jenis == 1) {
        $tanggal_mulai = $permohonan->mulai;
    } elseif ($permohonan->permohonan_jenis == 2) {
        $tanggal_mulai = $permohonan->selesai;
    } elseif ($permohonan->permohonan_jenis == 3) {
        $tanggal_mulai = $permohonan->mulai . ' - ' . $permohonan->selesai;
    }
    $permohonan_jenis     = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'permohonan_jenis', $permohonan->permohonan_jenis)->nama;
    $tempat_muat          = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->nama;
    $jenis_tempat_muat    = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->jenis)->nama;
    $id_jenis_tempat_muat = $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->jenis)->id;
    $agen_kapal           = $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'agen_kapal', $permohonan_kapal->agen_kapal)->nama;
    $this->db->where('id', $permohonan->operasional);
    $db_permohonan = $this->db->get('operasional')->row();
    $asal_barang   = $db_permohonan->barang_asal;
    $this->db->where('id', $asal_barang);
    $asal_barang  = $this->db->get('barang_asal')->row();
    $asal_barang  = $asal_barang->nama;
    $jenis_barang = $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'barang', $permohonan->barang)->nama;
    $atribut_json = json_encode(array("agen_kapal" => $permohonan_kapal->agen_kapal, 'jenis_tempat_muat' => $id_jenis_tempat_muat));
    ?>
                <div class="col-4  all-category <?=$status_permohonan; ?>">
                    <div class="card card-body shadow">
                        <span class="side-stick"></span>
                        <div class="col-12 px-0">
                            <div class="d-flex flex-wrap mb-2 ">
                                <div>
                                    <span class="mr-1">
                                        <?='<span class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-info" id="kolom' . $permohonan->id . '">' . strtoupper($espe) . ' </span><br>'; ?>
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
                                        <code>No Surat :<br> 0<?=$permohonan->id; ?>/RKBM-ZMA/SMD/<?=integerToRoman(date("m", strtotime($tanggal_mulai))); ?>/2022</code>
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
                                        <h4 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_muatan, 0, ',', '.'); ?>
                                        </h4><small>Muat Perkiraan</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h4 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_asli, 0, ',', '.'); ?>
                                        </h4><small>Muat Asli</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-3">
                                        <h4 class="mb-0 font-weight-light"><?=number_format($permohonan->jumlah_bongkar, 0, ',', '.'); ?>
                                        </h4><small>Bongkar</small>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex align-items-center mt-4">
                                <?php $warna = $permohonan->cetak ? 'info' : 'danger'; ?>
                                <?php $fa    = $permohonan->cetak ? 'check' : 'times'; ?>
                                <span class="mr-1 btn-sm btn waves-effect btn-<?=$warna; ?> inpoice invoice<?=$permohonan->id; ?>" data-id="<?=$permohonan->id; ?>"> <i class="fa voice<?=$permohonan->id; ?> fa-<?=$fa; ?> mr-2"></i>Invoice</span>
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
                                                        <td>0<?=$permohonan->id; ?>/ZMA/SMD/III/<?=date('Y'); ?></td>
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
                                                        <td><?=tgl_in($permohonan->mulai); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Tempat Muat</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper($tempat_muat); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Tempat Bongkar</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper($permohonan->tempat_bongkar); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Jenis Barang</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper($jenis_barang); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="pl-0">Qty</th>
                                                        <th>:</th>
                                                        <td><?=strtoupper($permohonan->jumlah_muatan); ?></td>
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
                            </div>

                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> -->
                                <a type="button" class="btn btn-outline-danger" href="<?=base_url('kegiatan/permohonan_cetak/' . $permohonan->id); ?>"><i class="fa fa-print"></i> Cetak Permohonan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
}
?>
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
                                    <label for="tanggal_muat">Rencana Mulai Muat/Bongkar</label>
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
                                        <label for="jumlah_muatan" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Jumlah Muatan Perkiraan</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_muatan" name="jumlah_muatan" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_asli" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Jumlah Muatan Sebenarnya</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_asli" name="jumlah_asli" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan bongkar">Jumlah Bongkaran Akhir</label>
                                        <input class="form-control hapus masinput" type="text" id="jumlah_bongkar" name="jumlah_bongkar" placeholder="Contoh: 7500">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="payment" data-toggle="tooltip" data-placement="top" title="" data-original-title="Terminal tempat memuat barang">Jenis Penagihan</label>
                                        <input class="form-control hapus masinput" type="text" id="payment" name="payment" placeholder="Kosongkan Jika Biaya Otomatis">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="payment" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jenis Permohonan">Jenis Permohonan</label>
                                        <select class="custom-select mr-sm-2" name="permohonan_jenis" id="permohonan_jenis" placeholder="Muat Atau Bongkar?">
                                            <option value="1">Muat</option>
                                            <option value="2">Bongkar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="action-form">
                                        <div class="form-group mb-0 text-right">
                                            <input type="hidden" name="operasional" value="<?php echo $id; ?>" />
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


    <div id="signup-modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <h4>Buat Permohona</h4>
                    </div>

                    <form action="rkbm/create_action" method="post">
                        <div class="card-body">
                            <div class="row mt-3">

                                <div class="col-sm-12 col-md-6">
                                    <label for="tanggal_muat">Rencana Muat / Mulai</label>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                        <input type="text" id="tanggal_muat" class=" form-control mydatepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                        <input type="text" id="tanggal_selesai" class="form-control mydatepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
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
                                        <label for="username">Nama Terminal</label>
                                        <select class="custom-select mr-sm-2" disabled name="nama_terminal" id="nama_terminal" placeholder="Nama Terminal">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="tujuan">Tempat Bongkar/Tujuan</label>
                                        <input class="form-control" type="text" id="tujuan" name="tujuan" placeholder="Pilih..">
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
                                        <label for="username" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Jumlah Muat</label>
                                        <input class="form-control" type="text" id="jumlah" name="jumlah" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah_real" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Jumlah Sebenarnya</label>
                                        <input class="form-control" type="text" id="jumlah_real" name="jumlah_real" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="RKBM bongkar">Jumlah Bongkaran</label>
                                        <input class="form-control" type="text" id="bongkar" name="bongkar" placeholder="Contoh: 7500">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="asal_brg">Asal Barang</label>
                                        <select class="custom-select mr-sm-2 wide" name="asal_brg" id="asal_brg" placeholder="Asal Barang">
                                            <option disabled <?php
echo 'selected="selected"';

?>>Choose...
                                            </option>
                                            <?php
$agen_kapals = $this->Asal_pemilik_model->get_asal();
foreach ($agen_kapals as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="perusahaan">Perusahaan PBM</label>
                                        <select class="custom-select mr-sm-2 wide" name="perusahaan" id="perusahaan" placeholder="Agen Kapal">
                                            <option disabled <?php
echo 'selected="selected"';

?>>Choose...
                                            </option>
                                            <?php
$agen_kapals = $this->Perusahaan_model->get_all();
foreach ($agen_kapals as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="action-form">
                                        <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?=site_url('rkbm'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



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
        </div>
    </div>
</div>


<script>
kkMessgae.uri = ' <?=base_url(); ?>assets/libs/jquery-kk-message/'; // this is the id of the form
$("#form-permohonan").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        dataType: "json",
        success: function(data) {
            if (data.status == 'success') {
                kkMessgae.success(data.data);
                // window.location.reload();
            } else {
                kkMessgae.error(data.data);
            }
        }
    });
});


$('.inpoice').click(function() {
    var id = $(this).attr('data-id');
    var invoice = '0';
    if ($(this).hasClass("btn-danger")) {
        invoice = 1;
    }
    if ($(this).hasClass("btn-info")) {
        invoice = 0;
    }
    $.getJSON("<?=base_url('kegiatan/update_cetak'); ?>", {
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

$("#form-rkbm").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
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
})


$("#jenis_terminal").change(function() {
    field = this.value;
    $('#nama_terminal').prop("disabled", false); // Element(s) are now enabled.
    $.ajax({
        type: "POST",
        data: {
            "id": field
        },
        url: "<?=base_url(); ?>terminal/read_json",
        success: function(data) {
            $("#nama_terminal").html(data);
        }
    });
});


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
        // modal.find('.jenismodal').text('Ubah Permohonan');
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
        });
    }
})
</script>
<script>
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

$(".masinput").inputmask("9.999.999");
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
$(document).ready(function() {

    $('#nama_kapal').change(function() {
        var ukuran = $(this).children('option:selected').attr('data-ukuran');
        var bendera = $(this).children('option:selected').attr('data-bendera');
        // alert($(this).children('option:selected').data('id'));
        $('#ket').html('' + bendera + ' ~ ' + ukuran + '');
    });

    $("#jumlah").inputmask("9.999.999");
    $("#jumlah_real").inputmask("9.999.999");
    $("#bongkar").inputmask("9.999.999");

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
    $('#tujuan').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        // name: 'states',
        source: substringMatcher(xer)
    });


});
</script>