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
<script src="<?=base_url(); ?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


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
            <?php
$this->db->select('id');
$this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
$check_jumlah_permohonan = $this->db->get('permohonan')->result();
$hitung_permohonan       = count($check_jumlah_permohonan);
$jumlah_revisi           = count($this->db->query("SELECT id FROM permohonan where status = '3' and operasional = '$id'")->result());
$jumlah_perpanjang       = count($this->db->query("SELECT id FROM permohonan where status = '2' and operasional = '$id'")->result());
$jumlah_muat             = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '1' and operasional = '$id'")->result());
$jumlah_bongkar          = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '2' and operasional = '$id'")->result());
// $jumlah_muat_bongkar     = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '3' and operasional = '$id'")->result()); ?>

            <div class="col-12 mt-3">
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#permohonanmodal">Buat Permohonan</button>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed ml-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Cetak Invoice
                </a>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed ml-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter Permohonan
                </a>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed ml-3">Permohonan <span class="badge badge-light"><?=$hitung_permohonan; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed ml-3">Revisi <span class="badge badge-light"><?=$jumlah_revisi; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed ml-3">Perpanjang <span class="badge badge-light"><?=$jumlah_perpanjang; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed ml-3">Muat <span class="badge badge-light"><?=$jumlah_muat; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed ml-3">Bongkar <span class="badge badge-light"><?=$jumlah_bongkar; ?></span></span>
                <!-- <span class="btn waves-effect waves-light btn-sm btn-danger collapsed ml-3">Muat & Bongar <span class="badge badge-light"><?=$jumlah_muat_bongkar; ?></span></span> -->
            </div>













            <div class="col-12 mt-3">
                <div class="collapse" id="collapseExample" style="">
                    <div class="d-flex flex-wrap">
                        <div class="row">
                            <div class="col-1 form-group mb-4">
                                <label class="mr-sm-2" for="bulan">Bulan</label>
                                <input type="text" class="form-control ngambilbulan" id="bulan" name="bulan">
                            </div>
                            <div class="col-1 form-group mb-4">
                                <label class="mr-sm-2" for="tahun">Tahun</label>
                                <input type="text" class="form-control ngambitahun" id="tahun" name="tahun">
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="select_perusahaan">Perusahaan</label>
                                <select class="custom-select mr-sm-2" id="select_perusahaan" name="select_perusahaan">
                                    <option selected value="">Semua</option>
                                    <?php
$perusahaan = $this->db->get('perusahaan')->result();
foreach ($perusahaan as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                </select>
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="select_kapal">Kapal</label>
                                <select class="custom-select mr-sm-2" id="select_kapal" name="select_kapal">
                                    <option selected value="">Semua/Kosong</option>
                                    <?php
$this->db->select('kapal');
$this->db->where('operasional', $id);
$kapals = $this->db->get('permohonan')->result();
$cruiut = array();
foreach ($kapals as $entry => $tery) {
    if (!in_array($tery->kapal, $cruiut)) {
        $cruiut[] = $tery->kapal;
    }
}
foreach ($cruiut as $crui) {
    $this->db->select('id');
    $this->db->select('nama');
    $this->db->where('id', $crui);
    $palu = $this->db->get('kapal')->result();
    foreach ($palu as $key) {
        echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
    }
}
?>
                                </select>
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="select_tempat_muat">Terminal Muat</label>
                                <select class="custom-select mr-sm-2" id="select_tempat_muat" name="select_tempat_muat">
                                    <option selected value="">Semua/Kosong</option>
                                    <?php
$this->db->select('tempat_muat');
$this->db->where('operasional', $id);
$kapals = $this->db->get('permohonan')->result();
$cruiut = array();
foreach ($kapals as $entry => $tery) {
    if (!in_array($tery->tempat_muat, $cruiut)) {
        $cruiut[] = $tery->tempat_muat;
    }
}
foreach ($cruiut as $crui) {
    $this->db->select('id');
    $this->db->select('nama');
    $this->db->where('id', $crui);
    $palu = $this->db->get('terminal')->result();
    foreach ($palu as $key) {
        echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
    }
}
?>
                                </select>
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="select_barang">Barang</label>
                                <select class="custom-select mr-sm-2" id="select_barang" name="select_barang">
                                    <option selected value="">Semua/Kosong</option>
                                    <?php
$this->db->select('barang');
$this->db->where('operasional', $id);
$kapals = $this->db->get('permohonan')->result();
$cruiut = array();
foreach ($kapals as $entry => $tery) {
    if (!in_array($tery->barang, $cruiut)) {
        $cruiut[] = $tery->barang;
    }
}
foreach ($cruiut as $crui) {
    $this->db->select('id');
    $this->db->select('nama');
    $this->db->where('id', $crui);
    $palu = $this->db->get('barang_jenis')->result();
    foreach ($palu as $key) {
        echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
    }
}
?>
                                </select>
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="select_permohonan_jenis">Jenis Permohonan</label>
                                <select class="custom-select mr-sm-2" id="select_permohonan_jenis" name="select_permohonan_jenis">
                                    <option selected value="">Semua/Kosong</option>
                                    <?php
$this->db->select('permohonan_jenis');
$this->db->where('operasional', $id);
$kapals = $this->db->get('permohonan')->result();
$cruiut = array();
foreach ($kapals as $entry => $tery) {
    if (!in_array($tery->permohonan_jenis, $cruiut)) {
        $cruiut[] = $tery->permohonan_jenis;
    }
}
foreach ($cruiut as $crui) {
    $this->db->select('id');
    $this->db->select('nama');
    $this->db->where('id', $crui);
    $palu = $this->db->get('permohonan_jenis')->result();
    foreach ($palu as $key) {
        echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
    }
}
?>
                                </select>
                            </div>
                            <!-- <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="status">Status</label>
                            <select class="custom-select mr-sm-2" id="status" name="status">
                                <option selected value="">Semua</option>
                                <option value="1">Active</option>
                                <option value="2">Selesai</option>
                                <option value="3">Arsip</option>
                            </select>
                        </div> -->
                        </div>
                    </div>
                </div>
                <table id="example" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Deskripsi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>


            <script>
            function AddFeedVotes(e) {
                let id = e.dataset.id;
                var invoice = '0';
                if ($(e).hasClass("btn-danger")) {
                    invoice = 1;
                }
                if ($(e).hasClass("btn-info")) {
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
            }
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

            jQuery('.ngambilbulan').datepicker({
                orientation: "bottom",
                maxViewMode: 2,
                todayBtn: "linked",
                clearBtn: true,
                language: "id",
                autoclose: true,
                format: "mm",
                startView: "months",
                minViewMode: "months",
                todayHighlight: true
            });
            jQuery('.ngambitahun').datepicker({
                orientation: "bottom",
                maxViewMode: 2,
                todayBtn: "linked",
                clearBtn: true,
                language: "id",
                autoclose: true,
                format: "yyyy",
                startView: "years",
                minViewMode: "years",
                todayHighlight: true
            });


            $(function() {
                var t = $('#example').DataTable({
                    "drawCallback": function(settings) {
                        $('[data-toggle="tooltip"]').tooltip({
                            container: 'body'
                        });
                    },
                    processing: true,
                    "language": {
                        "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
                        "search": "Pencarian:",
                        "zeroRecords": "Tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
                        "infoEmpty": "Tidak ada data ditemukan",
                        "infoFiltered": "(Disaring dari _MAX_ data)"
                    },
                    serverSide: true,
                    ajax: {
                        'url': "<?=base_url(); ?>operasional/load_no/<?=$id; ?>",
                        'type': 'post',
                        'data': function(d) {
                            // d.bulan = $('input[name=bulan]').val();
                            // d.tahun = $('input[name=tahun]').val();
                            // d.perusahaan = $('select[name=perusahaan]').val();
                            // d.status = $('select[name=status]').val();
                        },
                    },
                    "columns": [{
                            data: "detail",
                        },
                        {
                            data: "deskripsi",
                        },
                        {
                            data: "keterangan",
                        },
                        {
                            data: "aksi",
                        },
                    ]
                });

                // $('#bulan').on('change', function(e) {
                //     t.draw();
                //     e.preventDefault();
                // });

                // $('#tahun').on('change', function(e) {
                //     t.draw();
                //     e.preventDefault();
                // });

                // $('#perusahaan').on('change', function(e) {
                //     t.draw();
                //     e.preventDefault();
                // });
                // $('#status').on('change', function(e) {
                //     t.draw();
                //     e.preventDefault();
                // });

                // t.on('xhr', function(e, settings, json) {
                //     var month = json.month;
                //     var year = json.year;
                //     var perusahaan = json.perusahaan;
                //     if (perusahaan == 0) {
                //         // $("#cetaks2").attr("href", '#')
                //         // $("#cetaks").attr("href", '#')

                //         alert('kosong');

                //     } else {
                //         // alert('ok');
                //         // $("#cetaks2").attr("href", 'https://zadin.co.id/admin/laporan/cetak/'+month+'/'+year+'/'+perusahaan)
                //         // $("#cetaks").attr("href", 'https://zadin.co.id/admin/laporan/cetak/data/'+month+'/'+year+'/'+perusahaan)
                //     }
                // });

            });
            </script>

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
                                        <div class="form-group">
                                            <label for="status_permohonan" data-toggle="tooltip" data-placement="top" title="" data-original-title="Status Permohonan">Status Permohonan</label>
                                            <select class="custom-select mr-sm-2" name="status_permohonan" id="status_permohonan" placeholder="Baru / Perpanjang / Revisi">
                                                <option value="1">Baru</option>
                                                <option value="2">Perpanjang</option>
                                                <option value="3">Revisi</option>
                                                <option value="4">Batal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="permohonan_ke" data-toggle="tooltip" data-placement="top" title="" data-original-title="Permohonan Ke?">Permohonan Ke</label>
                                            <input type="number" class="form-control" value="" name="permohonan_ke" id="permohonan_ke" placeholder="Kosongkan jika permohonan baru">
                                        </div>
                                    </div>

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
                                            <label for="jumlah_muatan" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Muatan Perkiraan</label>
                                            <input class="form-control hapus masinput" type="text" id="jumlah_muatan" name="jumlah_muatan">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_asli" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Muatan Sebenarnya</label>
                                            <input class="form-control hapus masinput" type="text" id="jumlah_asli" name="jumlah_asli">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan bongkar">Bongkaran Akhir</label>
                                            <input class="form-control hapus masinput" type="text" id="jumlah_bongkar" name="jumlah_bongkar">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="payment" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masukkan jumlah biaya manual">Penagihan</label>
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
        alert('yes');
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

    $('#permohonanmodal').on('shown.bs.modal', function(event) {
        var memuat = '';
        var aseli = '';
        var bungkar = '';
        var button = $(event.relatedTarget)
        var modal = $(this)
        var idpermohonan = button.data('idpermohonan')
        $('#form-permohonan').trigger("reset");
        document.getElementById("nama_kapal").options.length = 0;
        $('#nama_kapal').prop('disabled', 'disabled');
        document.getElementById("tempat_muat").options.length = 0;
        $('#tempat_muat').prop('disabled', 'disabled');
        if (!idpermohonan) {
            $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_buat');
            document.getElementById("ket").innerHTML = '';
        } else {
            document.getElementById("ket").innerHTML = '';
            var permohonan = button.data('permohonan')
            modal.find('.jenismodal').text('Ubah Permohonan');
            $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_revisi/' + idpermohonan);
            $.getJSON("<?=base_url(); ?>permohonan/read_json/" + idpermohonan, function(data, status) {
                $('#agen_kapal').val(permohonan.agen_kapal).change();
                $('#jenis_terminal').val(permohonan.jenis_tempat_muat).change();
                $('#tanggal_muat').datepicker('update', data.mulai);
                if (data.mulai != "0000-00-00") {
                    $('#tanggal_mulai').datepicker('update', data.mulai);
                }
                if (data.selesai != "0000-00-00") {
                    $('#tanggal_selesai').datepicker('update', data.selesai);
                }
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
                $('#permohonan_ke').val(data.permohonan_ke);
                $('#barang').val(data.barang);
                $('#permohonan_jenis').val(data.permohonan_jenis);
                $('#payment').val(data.payment);
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