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
<link rel="stylesheet" type="text/css" href="https://fooplugins.github.io/FooTable/compiled/footable.bootstrap.min.css">
<script src="<?=base_url(); ?>assets/js/bootstrap-add-clear.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="<?=base_url(); ?>assets/libs/sweetalert2/dist/sweetalert2.all.min.js" aria-hidden="true"></script>
<script src="<?=base_url(); ?>assets/easytable/paginathing.js"></script>
<!-- <script src="<?=base_url(); ?>assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
<script src="https://www.jqueryscript.net/demo/bootstrap-toaster/js/bootstrap-toaster.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/leader-line/leader-line.css"> -->
<!-- <script src="https://anseki.github.io/leader-line/js/libs-d4667dd-211118164156.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/anim-event@1.0.16/anim-event.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="https://fooplugins.github.io/FooTable/compiled/footable.js"></script> -->
<script src="https://cdnout.com/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.6/footable.min.js"></script>


<div class="container-fluid bg-white overflow-auto mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title"><?=$nama; ?>
                        </h4>
                        <h6 class="card-subtitle"><?=$keterangan; ?>
                        </h6>
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
// $this->db->where('parent IS NULL', null, false);
$this->db->where('operasional', $id);
$check_jumlah_permohonan = $this->db->get('permohonan')->result();
$hitung_permohonan       = count($check_jumlah_permohonan);
$jumlah_baru             = count($this->db->query("SELECT id FROM permohonan where status = '1' and operasional = '$id'")->result());
$jumlah_perpanjang       = count($this->db->query("SELECT id FROM permohonan where status = '2' and operasional = '$id'")->result());
$jumlah_revisi           = count($this->db->query("SELECT id FROM permohonan where status = '3' and operasional = '$id'")->result());
$jumlah_batal            = count($this->db->query("SELECT id FROM permohonan where status = '4' and operasional = '$id'")->result());
$jumlah_muat_jetty       = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '1' and operasional = '$id'")->result());
$jumlah_muat_bongkar     = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '2' and operasional = '$id'")->result());
$jumlah_muat             = count($this->db->query("SELECT id FROM `permohonan` WHERE `operasional` = $id AND `permohonan_jenis` IN (1,2)")->result());
$jumlah_bongkar_jetty    = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '3' and operasional = '$id'")->result());
$jumlah_bongkar_sts      = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '4' and operasional = '$id'")->result());
$jumlah_bongkar          = count($this->db->query("SELECT id FROM `permohonan` WHERE `operasional` = $id AND `permohonan_jenis` IN (3,4)")->result());

// $jumlah_muat_bongkar     = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '3' and operasional = '$id'")->result()); ?>

            <div class="col-12 mt-3">
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Permohonan <span class="badge badge-light"><?=$hitung_permohonan; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Baru <span class="badge badge-light"><?=$jumlah_baru; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Perpanjang <span class="badge badge-light"><?=$jumlah_perpanjang; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Revisi <span class="badge badge-light"><?=$jumlah_revisi; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Batal <span class="badge badge-light"><?=$jumlah_batal; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Muat <span class="badge badge-light"><?=$jumlah_muat; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Bongkar <span class="badge badge-light"><?=$jumlah_bongkar; ?></span></span>
                <!-- <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Muat & Bongar <span class="badge badge-light"><?=$jumlah_muat_bongkar; ?></span></span> -->
            </div>

            <div class="col-12 mt-3">
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#permohonanmodal">Buat Permohonan</button>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3" href="<?=base_url(); ?>kegiatan/invoice_cetak/<?=$id; ?>" target="_blank"><i class="fa-duotone fa-print  mr-1"></i>Cetak Invoice</a>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter Permohonan
                </a>
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#uploadrkbmmodal">Upload RKBM</button>
                <?php if ($this->session->flashdata('success')) { ?>
                <br>
                <br>
                <br>
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success - </strong> <?=$this->session->flashdata('success'); ?>
                </div>
                <?php
}
?>
                <?php if ($this->session->flashdata('error')) { ?>
                <br>
                <br>
                <br>
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error - </strong> <?=$this->session->flashdata('danger'); ?>
                </div>
                <?php
}
?>
            </div>













            <div class="col-12 mt-3">
                <div class="collapse" id="collapseExample" style="">
                    <div class="d-flex flex-wrap">
                        <div class="row">
                            <div class="col-1 form-group mb-4">
                                <label class="mr-sm-2" for="filter_bulan">Bulan</label>
                                <input type="text" class="form-control ngambilbulan" id="filter_bulan" name="filter_bulan">
                            </div>
                            <div class="col-1 form-group mb-4">
                                <label class="mr-sm-2" for="filter_tahun">Tahun</label>
                                <input type="text" class="form-control ngambitahun" id="filter_tahun" name="filter_tahun">
                            </div>

                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="filter_permohonan_jenis">Jenis Permohonan</label>
                                <select class="custom-select mr-sm-2" id="filter_permohonan_jenis" name="filter_permohonan_jenis">
                                    <option selected value="">Semua</option>
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

                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="filter_status">Status</label>
                                <select class="custom-select mr-sm-2" id="filter_status" name="filter_status">
                                    <option selected value="">Semua</option>
                                    <?php
$perusahaan = $this->db->get('permohonan_status')->result();
foreach ($perusahaan as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                </select>
                            </div>
                            <div class="col-2 form-group mb-4">
                                <label class="mr-sm-2" for="filter_kapal">Kapal</label>
                                <select class="custom-select mr-sm-2" id="filter_kapal" name="filter_kapal">
                                    <option selected value="">Semua</option>
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
                                <label class="mr-sm-2" for="filter_tempat_muat">Terminal Muat</label>
                                <select class="custom-select mr-sm-2" id="filter_tempat_muat" name="filter_tempat_muat">
                                    <option selected value="">Semua</option>
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
                                <label class="mr-sm-2" for="filter_barang">Barang</label>
                                <select class="custom-select mr-sm-2" id="filter_barang" name="filter_barang">
                                    <option selected value="">Semua</option>
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

                        if (document.querySelector(".nowraptd")) {
                            document.querySelector(".nowraptd").parentElement.style.whiteSpace = "nowrap";
                        }
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
                            d.bulan = $('input[name=filter_bulan]').val();
                            d.tahun = $('input[name=filter_tahun]').val();
                            d.jenis_permohonan = $('select[name=filter_permohonan_jenis]').val();
                            d.status = $('select[name=filter_status]').val();
                            d.kapal = $('select[name=filter_kapal]').val();
                            d.tempat_muat = $('select[name=filter_tempat_muat]').val();
                            d.barang = $('select[name=filter_barang]').val();
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

                $('#filter_bulan').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });

                $('#filter_tahun').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });

                $('#filter_permohonan_jenis').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });
                $('#filter_status').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });
                $('#filter_kapal').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });
                $('#filter_tempat_muat').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });
                $('#filter_barang').on('change', function(e) {
                    t.draw();
                    e.preventDefault();
                });

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


        <div id="uploadrkbmmodal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">RKBM</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="text-center mt-2 mb-4">
                            <h4 class="jenismodal">Upload RKBM</h4>
                        </div> -->

                        <div class="card-body">
                            <!-- <h4 class="card-title">Custom File Upload with Button Right</h4> -->
                            <!-- <h6 class="card-subtitle">To use add <code>.input-group-append</code> class to the div</h6> -->
                            <form class="mt-4" action="<?=base_url(); ?>upload/pdfupload" method="post" id="form-permohonan_upload" enctype='multipart/form-data'>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="pdffile" name="pdffile">
                                        <label class="custom-file-label" for="pdffile">Upload RKBM..</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>

                            <canvas id="pdfViewer"></canvas>


                            <div id="tombolnekprep" style="display:none;">
                                <button id="prev">Previous</button>
                                <button id="next">Next</button>
                                &nbsp; &nbsp;
                                <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                            </div>

                            <canvas id="the-canvas"></canvas>

                            <!-- <canvas id="the-canvas"></canvas> -->

                            <!-- <div class="progress">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div> -->

                            <div id="status"></div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script src="https://malsup.github.io/jquery.form.js"></script>
        <script>
        $(document).ready(function() {
            $('#form-permohonan_upload').submit(function() {
                var bar = $('.bar');
                var percent = $('.percent');
                var status = $('#status');
                $(this).ajaxForm({
                    beforeSend: function() {
                        status.html();
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    complete: function(xhr) {
                        status.html(xhr.responseText);
                    }
                });
            });
        });


        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

        <?php
if (file_exists(base_url() . 'file/rkbm/rkbm_' . $id . '.pdf')) {
} else {
    ?>
        var pdfurl = '<?=base_url() . 'file/rkbm/rkbm_' . $id . '.pdf'; ?>';
        // var loadingTask = pdfjsLib.getDocument(pdfurl);

        $('#tombolnekprep').show();
        pdfjsLib.getDocument(pdfurl).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
        // loadingTask.promise.then(function(pdf) {
        //     console.log('PDF loaded');

        //     // Fetch the first page
        //     var pageNumber = 1;
        //     // pdf.getPage(pageNumber).then(function(page) {
        //     console.log('Page loaded');

        //     var scale = 0.8;
        //     var viewport = page.getViewport({
        //         scale: scale
        //     });

        //     // Prepare canvas using PDF page dimensions
        //     var canvas = document.getElementById('the-canvas');
        //     var context = canvas.getContext('2d');
        //     canvas.height = viewport.height;
        //     canvas.width = viewport.width;

        //     // Render PDF page into canvas context
        //     var renderContext = {
        //         canvasContext: context,
        //         viewport: viewport
        //     };
        //     var renderTask = page.render(renderContext);
        //     renderTask.promise.then(function() {
        //         console.log('Page rendered');
        //     });
        //     // });
        // }, function(reason) {
        //     // PDF loading error
        //     console.error(reason);
        // });
        <?php
} ?>

        $('#uploadrkbmmodal').on('show.bs.modal', function(e) {
            // do something...
            console.log(pdfurl);
        })


        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.2,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }



        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        // pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        //     pdfDoc = pdfDoc_;
        //     document.getElementById('page_count').textContent = pdfDoc.numPages;

        //     // Initial/first page rendering
        //     renderPage(pageNum);
        // });


        $("#pdffile").on("change", function(e) {
            var file = e.target.files[0]
            if (file.type == "application/pdf") {
                var fileReader = new FileReader();
                fileReader.onload = function() {
                    var pdfData = new Uint8Array(this.result);



                    /**
                     * Asynchronously downloads PDF.
                     */
                    $('#tombolnekprep').show();
                    pdfjsLib.getDocument(pdfData).promise.then(function(pdfDoc_) {
                        pdfDoc = pdfDoc_;
                        document.getElementById('page_count').textContent = pdfDoc.numPages;

                        // Initial/first page rendering
                        renderPage(pageNum);
                    });


                    // Using DocumentInitParameters object to load binary data.
                    // var loadingTask = pdfjsLib.getDocument({
                    //     data: pdfData
                    // });
                    // loadingTask.promise.then(function(pdf) {
                    //     console.log('PDF loaded');

                    //     // Fetch the first page
                    //     var pageNumber = 1;
                    //     pdf.getPage(pageNumber).then(function(page) {
                    //         console.log('Page loaded');

                    //         var scale = 0.9;
                    //         var viewport = page.getViewport({
                    //             scale: scale
                    //         });

                    //         // Prepare canvas using PDF page dimensions
                    //         var canvas = $("#pdfViewer")[0];
                    //         var context = canvas.getContext('2d');
                    //         canvas.height = viewport.height;
                    //         canvas.width = viewport.width;

                    //         // Render PDF page into canvas context
                    //         var renderContext = {
                    //             canvasContext: context,
                    //             viewport: viewport
                    //         };
                    //         var renderTask = page.render(renderContext);
                    //         renderTask.promise.then(function() {
                    //             console.log('Page rendered');
                    //         });
                    //     });
                    // }, function(reason) {
                    //     // PDF loading error
                    //     console.error(reason);
                    // });
                };
                fileReader.readAsArrayBuffer(file);
            }
        });





























        $('#uploadrkbmmodal').on('shown.bs.modal', function(event) {
            var memuat = '';
            var aseli = '';
            var bungkar = '';
            var button = $(event.relatedTarget)
            var modal = $(this)
            var idpermohonan = button.data('idpermohonan');
            console.log(idpermohonan);

        })
        </script>

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
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_kira" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Jumlah Perkiraan</label>
                                            <input class="form-control hapus masinput" type="text" id="jumlah_kira" name="jumlah_kira">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_asli" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Jumlah Asli</label>
                                            <input class="form-control hapus masinput" type="text" id="jumlah_asli" name="jumlah_asli">
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
                                            <label for="permohonan_jenis" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muat Atau Bongkar?">Jenis Permohonan</label>
                                            <select class="custom-select mr-sm-2" name="permohonan_jenis" id="permohonan_jenis" placeholder="Muat Atau Bongkar?">
                                                <?php
$palu = $this->db->get('permohonan_jenis')->result();
foreach ($palu as $key) {
    echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
}
?>
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

        <style>
        .blink {
            animation: blinkMe 0.5s linear infinite;
        }

        @keyframes blinkMe {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
        </style>



        <div id="permohonan_update" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="text-center mt-2 mb-4">
                            <h4 class="jenismodal">Update Permohonan</h4>
                        </div>

                        <form action="" method="post" id="form-permohonan_update">
                            <div class="card-body">
                                <div class="row mt-3">

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_status_permohonan" data-toggle="tooltip" data-placement="top" title="" data-original-title="Status Permohonan" class="text-danger blink">Status Permohonan</label>
                                            <select class="custom-select mr-sm-2" name="status_permohonan" id="update_status_permohonan" placeholder="Perpanjang / Revisi">
                                                <option value="2">Perpanjang</option>
                                                <option value="3">Revisi</option>
                                                <option value="4">Batal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_permohonan_ke" data-toggle="tooltip" data-placement="top" title="" data-original-title="Permohonan Ke?">Permohonan (Perpanjang/Revisi) Ke</label>
                                            <input type="number" class="form-control" disabled value="" name="permohonan_ke" id="update_permohonan_ke" placeholder="Akan Terisi Otomatis">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <label for="update_tanggal_muat">Rencana Mulai Muat/Bongkar</label>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calender"></i></span>
                                            </div>
                                            <input type="text" id="update_tanggal_muat" name="mulai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="update_tanggal_selesai">Tanggal Selesai</label>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-calender"></i></span>
                                            </div>
                                            <input type="text" id="update_tanggal_selesai" name="selesai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_agen_kapal">Agen Kapal</label>
                                            <select class="custom-select mr-sm-2 wide" name="agen_kapal" id="update_agen_kapal" placeholder="Agen Kapal">
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
                                            <label for="update_nama_kapal">Nama Kapal</label>
                                            <code id="update_ket"></code>
                                            <select class="custom-select mr-sm-2" disabled name="nama_kapal" id="update_nama_kapal" placeholder="Nama Kapal">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_jenis_terminal">Jenis Terminal</label>
                                            <select class="custom-select mr-sm-2 wide" name="jenis_terminal" id="update_jenis_terminal" placeholder="Jenis Terminal">
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
                                            <label for="update_tempat_muat" data-toggle="tooltip" data-placement="top" title="" data-original-title="Terminal tempat memuat barang">Tempat Muat</label>
                                            <select class="custom-select mr-sm-2" disabled name="tempat_muat" id="update_tempat_muat" placeholder="Pilih">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_tempat_bongkar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tempat barang dibongkar Atau Tujuan barang">Tempat Bongkar/Tujuan</label>
                                            <input class="form-control" type="text" id="update_tempat_bongkar" name="tempat_bongkar" placeholder="Pilih..">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_barang">Jenis Barang</label>
                                            <select class="custom-select mr-sm-2" name="barang" id="update_barang" placeholder="Nama Terminal">
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
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="update_jumlah_kira" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang direncanakan">Muatan Perkiraan</label>
                                            <input class="form-control hapus masinput" type="text" id="update_jumlah_kira" name="jumlah_kira">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="update_jumlah_asli" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muatan yang sebenarnya">Muatan Asli</label>
                                            <input class="form-control hapus masinput" type="text" id="update_jumlah_asli" name="jumlah_asli">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_payment" data-toggle="tooltip" data-placement="top" title="" data-original-title="Masukkan jumlah biaya manual">Penagihan</label>
                                            <input class="form-control hapus masinput" type="text" id="update_payment" name="payment" placeholder="Kosongkan Jika Biaya Otomatis">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="update_permohonan_jenis" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Muat Atau Bongkar?">Jenis Permohonan</label>
                                            <select class="custom-select mr-sm-2" name="permohonan_jenis" id="update_permohonan_jenis" placeholder="Muat Atau Bongkar?">
                                                <?php
$palu = $this->db->get('permohonan_jenis')->result();
foreach ($palu as $key) {
    echo "<option value='" . $key->id . "'>" . $key->nama . "</option>";
}
?>
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
                </div>
            </div>
        </div>




    </div>



    <div class="modal fade" id="modal_biaya_operasional" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="mySmallModalLabel">Biaya</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div id="content"></div>
                    <!-- <table id="tabeloperasional" class="table" data-paging="true" data-sorting="true"> -->

                    <!-- <thead>
                            <tr>
                                <th data-breakpoints="xs sm md">Keterangan</th>
                                <th data-breakpoints="xs sm md">Operasional</th>
                                <th data-breakpoints="xs sm md">Pembayaran</th>
                                <th data-breakpoints="xs sm md">Biaya</th>
                                <th data-breakpoints="xs sm md">Tanggal</th>
                            </tr>
                        </thead> -->

                    <!-- </table> -->
                    <form action="<?=base_url(); ?>operasional/biaya_operasional" method="post" id="form_biaya_operasional">
                        <div class="card-body">
                            <div class="form-group row align-items-center mb-0">
                                <label for="biaya" class="col-md-3 text-right control-label col-form-label">Pengeluaran Operasional</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <code class="text-center"><p id="error_biaya">test</p></code>
                                    <select class="custom-select mr-sm-2 wide" name="jenis_biaya" id="jenis_biaya" placeholder="Biaya" required>
                                        <option value="" disabled selected>Pilih..</option>
                                        <option value="1">Biaya Operasional</option>
                                        <option value="2">Honor Foreman</option>
                                        <option value="3">Konsumsi Foreman</option>
                                        <option value="4">Sewa Kapal</option>
                                        <option value="5">Sewa Dozer</option>
                                        <option value="6">Speedboat Mengantar</option>
                                        <option value="7">Speedboat Menjemput</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-0">
                                <label for="input_tp" class="col-md-3 text-right control-label col-form-label">Tanggal Pembayaran</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <input type="text" autocomplete="off" required class="mydatepicker form-control" id="tanggal_bayar" name="tanggal_bayar" placeholder="hari/bulan/tahun">
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-0">
                                <label for="biaya" class="col-md-3 text-right control-label col-form-label">Biaya</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <input class="form-control hapus masinput" type="text" id="biaya" required name="biaya" placeholder="Masukkan Jumlah Biaya">
                                </div>
                            </div>

                            <div class="col-12 ml-auto mr-5 mt-3">
                                <div class="form-group text-center">
                                    <input type="hidden" name="operasional" value="<?php echo $id; ?>" />
                                    <input type="hidden" id="id_biaya_operasional" name="id_biaya_operasional" value="">
                                    <button class="btn btn-info" type="submit">Simapn</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    jQuery(function($) {
        $(document).on('click', '.hapusoperasional', function() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'mr-2 btn btn-danger'
                },
                buttonsStyling: false,
            })

            var idoper = $(this).attr("data-id");
            // console.log(idoper);

            $.getJSON("<?=base_url(); ?>operasional/hapusbiayaoperasional/" + idoper, function(data, status) {
                console.log(data);
                if (data.status == 'success') {
                    swalWithBootstrapButtons.fire(
                        'Telah Dihapus!',
                        'Biaya berhasil dihapus.',
                        'success'
                    );
                    location.reload();
                } else {
                    swalWithBootstrapButtons.fire(
                        'Gagal..',
                        'Biaya tidak dapat dihapus..',
                        'error'
                    )
                }

            });
        });
    });

    // jQuery('#tanggal_bayar').datepicker({
    //     autoclose: true,
    //     format: 'dd-mm-yyyy',
    //     todayHighlight: true
    // });
    </script>
    <script>
    $("#form_biaya_operasional").submit(function(e) {
        $("#error_biaya").hide();
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        // var biaya = $("select#biaya").val();
        // var biaya = $('select[name="biaya"]').val();
        // if (biaya == "") {
        //     $("#error_biaya").show().text("Kode tidak boleh kosong..");
        //     $("select#biaya").focus();
        //     return false;
        // }
        var actionUrl = form.attr('action');
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
    </script>
    <script>
    $('#modal_biaya_operasional').on('show.bs.modal', function(event) {
        $("#error_biaya").hide();
        if (event.relatedTarget != null) {
            document.getElementById("form_biaya_operasional").reset();
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('idoperasional')
            // console.log(recipient);
            $("#id_biaya_operasional").val(recipient);
            var modal = $(this)
            modal.find('#id_biaya_operasional').val(recipient)
            if (recipient) {
                $.ajax({
                    url: '<?=base_url(); ?>operasional/get_rows/' + recipient,
                    beforeSend: function() {
                        // $("#content").html('<img src="ajax-icon-from-www.ajaxload.info">');
                    },
                    success: function(html) {
                        $("#content").html(html);
                    }
                });
                // $('#tabeloperasional').footable({
                //     // "useParentWidth": true,
                //     "columns": $.get('<?=base_url(); ?>operasional/get_col'),
                //     "rows": $.get('<?=base_url(); ?>operasional/get_rows/' + recipient)
                // });

                // $.get("<?=base_url(); ?>/operasional/get_biaya_operasional/" + recipient, function(data, status) {
                // var json_parse = JSON.parse(data);
                document.getElementById("form_biaya_operasional").reset();
                // modal.reset();
                // modal.find('#jenis_biaya').val(json_parse.jenis_biaya)
                // modal.find('#biaya').val(json_parse.biaya != 0 ? json_parse.biaya.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // modal.find('#biaya_konsumsi').val(json_parse.biaya_konsumsi != 0 ? json_parse.biaya_konsumsi.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // modal.find('#biaya_kapal').val(json_parse.biaya_kapal != 0 ? json_parse.biaya_kapal.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // modal.find('#biaya_dozer').val(json_parse.biaya_dozer != 0 ? json_parse.biaya_dozer.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // modal.find('#biaya_antar').val(json_parse.biaya_speedboat_antar != 0 ? json_parse.biaya_speedboat_antar.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // modal.find('#biaya_jemput').val(json_parse.biaya_speedboat_jemput != 0 ? json_parse.biaya_speedboat_jemput.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '')
                // console.log(json_parse.biaya_honor)
                // console.log(data.id);
                //     modal.find('.idrkbm').val(recipient)
                //     modal.find('.norkbm').val(data.trim())
                // });
            }
        }
    })
    </script>



    <div class="modal fade" id="modal-norkbm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="mySmallModalLabel">Small modal</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url(); ?>kegiatan/update_norkbm" id="form-rkbm" class="nyot">
                        <div class="input-group">
                            <input type="text" name="no_rkbm" class="form-control norkbm" value="">
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

    <?php
$this->db->select('tempat_bongkar');
$hasil = $this->db->get('permohonan')->result();
$ds    = array();
foreach ($hasil as $key => $value) {
    if (!in_array($value, $ds)) {
        $ds[$key] = $value;
    }
}
foreach ($ds as $item) {
    $dull[] = $item->tempat_bongkar;
}
$red = json_encode($dull);
?>

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
                    window.location.reload();
                } else {
                    kkMessgae.error(data.data);
                }
            }
        });
    });
    $("#form-permohonan_update").submit(function(e) {
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
                    window.location.reload();
                } else {
                    kkMessgae.error(data.data);
                }
            }
        });
    });
    $(document).on('click', '.menghapuspermohonan', function() {
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

    $(document).on('click', '.inpoice', function() {
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
    $("#update_jenis_terminal").change(function() {
        field = this.value;
        $('#update_tempat_muat').prop("disabled", false); // Element(s) are now enabled.
        $.ajax({
            type: "POST",
            data: {
                "id": field
            },
            url: "<?=base_url(); ?>terminal/read_json",
            success: function(data) {
                $("#update_tempat_muat").html(data);
            }
        });
    });

    function getNumberWithCommas(number) {
        return parseInt(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#permohonanmodal').on('shown.bs.modal', function(event) {
        var memuat = '';
        var aseli = '';
        var bungkar = '';
        var button = $(event.relatedTarget)
        var modal = $(this)
        var idpermohonan = button.data('idpermohonan');
        console.log(idpermohonan);
        $('#form-permohonan').trigger("reset");
        document.getElementById("nama_kapal").options.length = 0;
        $('#nama_kapal').prop('disabled', 'disabled');
        document.getElementById("tempat_muat").options.length = 0;
        $('#tempat_muat').prop('disabled', 'disabled');
        if (idpermohonan == null) {
            $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_buat');
            document.getElementById("ket").innerHTML = '';
            modal.find('.jenismodal').text('Buat Permohonan');
        } else {
            document.getElementById("ket").innerHTML = '';
            var permohonan = button.data('permohonan')
            modal.find('.jenismodal').text('Ubah Permohonan');
            $('#form-permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_ubah/' + idpermohonan);
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
                if (data.jumlah_kira == '0' || data.jumlah_kira == 0 || data.jumlah_kira == '' || data.jumlah_kira == null || data.jumlah_kira == undefined) {
                    memuat = '';
                } else {
                    memuat = getNumberWithCommas(data.jumlah_kira);
                }
                if (data.jumlah_asli == '' || data.jumlah_asli == 0 || data.jumlah_asli == '0' || data.jumlah_asli == null || data.jumlah_asli == undefined) {
                    aseli = '';
                } else {
                    aseli = getNumberWithCommas(data.jumlah_asli);
                }
                if (data.payment == 0 || data.payment == '0' || data.payment == '' || data.payment == null || data.payment == undefined) {
                    pemen = '';
                } else {
                    pemen = getNumberWithCommas(data.payment);
                }
                $('#tempat_bongkar').val(data.tempat_bongkar);
                $('#status_permohonan').val(data.status);
                $('#permohonan_ke').val(data.permohonan_ke);
                $('#barang').val(data.barang);
                $('#permohonan_jenis').val(data.permohonan_jenis);
                $('#payment').val(pemen);
                $('#jumlah_kira').val(memuat);
                $('#jumlah_asli').val(aseli);
                // $('#asal_barang').val(data.asal_barang);
                // $('#perusahaan').val(data.perusahaan);
            });
        }
    })

    $('#permohonan_update').on('shown.bs.modal', function(event) {
        var memuat = '';
        var aseli = '';
        var bungkar = '';
        var button = $(event.relatedTarget)
        var modal = $(this)
        var idpermohonan = button.data('idpermohonan')
        $('#form-update_permohonan').trigger("reset");
        document.getElementById("update_nama_kapal").options.length = 0;
        $('#update_nama_kapal').prop('disabled', 'disabled');
        document.getElementById("update_tempat_muat").options.length = 0;
        $('#update_tempat_muat').prop('disabled', 'disabled');
        if (!idpermohonan) {
            $('#form-update_permohonan').attr('action', '<?=base_url(); ?>kegiatan/permohonan_update');
            document.getElementById("ket").innerHTML = '';
        } else {
            document.getElementById("ket").innerHTML = '';
            var permohonan = button.data('permohonan')
            $('#form-permohonan_update').attr('action', '<?=base_url(); ?>kegiatan/permohonan_update/' + idpermohonan);
            $.getJSON("<?=base_url(); ?>permohonan/read_json/" + idpermohonan, function(data, status) {
                $('#update_agen_kapal').val(permohonan.agen_kapal).change();
                $('#update_jenis_terminal').val(permohonan.jenis_tempat_muat).change();
                $('#update_tanggal_muat').datepicker('update', data.mulai);
                if (data.mulai != "0000-00-00") {
                    $('#update_tanggal_mulai').datepicker('update', data.mulai);
                }
                if (data.selesai != "0000-00-00") {
                    $('#update_tanggal_selesai').datepicker('update', data.selesai);
                }
                $(document).on("ajaxComplete", function(event, xhr, settings) {
                    if (settings.url == "<?=base_url(); ?>kapal/read_json") {
                        $('#update_nama_kapal').val(data.kapal).change();
                    }
                })
                $(document).on("ajaxComplete", function(event, xhr, settings) {
                    if (settings.url == "<?=base_url(); ?>terminal/read_json") {
                        $('#update_tempat_muat').val(data.tempat_muat).change();
                    }
                })
                if (data.jumlah_kira == '0' || data.jumlah_kira == 0 || data.jumlah_kira == '' || data.jumlah_kira == null || data.jumlah_kira == undefined) {
                    memuat = '';
                } else {
                    memuat = getNumberWithCommas(data.jumlah_kira);
                }
                if (data.jumlah_asli == '' || data.jumlah_asli == 0 || data.jumlah_asli == '0' || data.jumlah_asli == null || data.jumlah_asli == undefined) {
                    aseli = '';
                } else {
                    aseli = getNumberWithCommas(data.jumlah_asli);
                }
                if (data.payment == 0 || data.payment == '0' || data.payment == '' || data.payment == null || data.payment == undefined) {
                    pemen = '';
                } else {
                    pemen = getNumberWithCommas(data.payment);
                }
                $('#update_tempat_bongkar').val(data.tempat_bongkar);
                $('#update_status_permohonan').val(data.status);
                $('#update_permohonan_ke').val(data.permohonan_ke);
                $('#update_barang').val(data.barang);
                $('#update_permohonan_ke').val(data.permohonan_ke ? ++data.permohonan_ke : 1);
                $('#update_permohonan_jenis').val(data.permohonan_jenis);
                $('#update_payment').val(pemen);
                $('#update_jumlah_kira').val(memuat);
                $('#update_jumlah_asli').val(aseli);
            });
        }
    })

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

    $('input.masinput').keyup(function(event) {
        if (event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });
    // $('.masinput').inputmask({
    //     alias: 'numeric',
    //     allowMinus: false,
    //     digits: 3,
    //     max: '999.999.999.999'
    // });
    // $(".masinput").numeric({
    //     decimal: ".",
    //     negative: false,
    //     scale: 3
    // });
    // $('.masinput').inputmask("Z", {
    //     translation: {
    //         'Z': {
    //             pattern: /[0-9,.]/,
    //             recursive: true
    //         }
    //     }
    // });
    // $(".masinput").inputmask("decimal", {
    //     rightAlign: true
    // });
    // Inputmask("decimal", {
    //     positionCaretOnClick: "radixFocus",
    //     radixPoint: ".",
    //     _radixDance: true,
    //     numericInput: true,
    //     placeholder: "0",
    //     definitions: {
    //         "0": {
    //             validator: "[0-9\uFF11-\uFF19]"
    //         }
    //     }
    // }).mask(".masinput");

    var xer = <?php echo $red; ?>;
    $('#tempat_bongkar').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: substringMatcher(xer)
    });
    $('#update_tempat_bongkar').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: substringMatcher(xer)
    });

    jQuery('.mydatepicker').datepicker({
        maxViewMode: 2,
        todayBtn: "linked",
        clearBtn: true,
        language: "id",
        autoclose: true,
        todayHighlight: true
    });

    $(document).ready(function() {

        $('#nama_kapal').change(function() {
            var ukuran = $(this).children('option:selected').attr('data-ukuran');
            var bendera = $(this).children('option:selected').attr('data-bendera');
            $('#ket').html('' + bendera + ' ~ ' + ukuran + '');
        });
        $('#update_nama_kapal').change(function() {
            var ukuran = $(this).children('option:selected').attr('data-ukuran');
            var bendera = $(this).children('option:selected').attr('data-bendera');
            $('#update_ket').html('' + bendera + ' ~ ' + ukuran + '');
        });

        // $("#jumlah").inputmask("9.999.999");
        // $("#jumlah_real").inputmask("9.999.999");
        // $("#bongkar").inputmask("9.999.999");

        // $("#update_jumlah").inputmask("9.999.999");
        // $("#update_jumlah_real").inputmask("9.999.999");
        // $("#update_bongkar").inputmask("9.999.999");

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
        $("#update_agen_kapal").change(function() {
            field = this.value;
            $('#update_nama_kapal').prop("disabled", false); // Element(s) are now enabled.
            $.ajax({
                type: "POST",
                data: {
                    "id": field
                },
                url: "<?=base_url(); ?>kapal/read_json",
                success: function(data) {
                    $("#update_nama_kapal").html(data);
                }
            });
        });

    });
    </script>