<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 mt-3 mb-3 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Laporan Terminal</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">




    <dvi class="card">
        <div class="col-12 mt-3">

            <?php
$this->db->select('id');
$terminal        = $this->db->get('terminal')->result();
$hitung_terminal = count($terminal);
$jumlah_umum     = count($this->db->query("SELECT id FROM terminal where jenis = '1'")->result());
$jumlah_tuks     = count($this->db->query("SELECT id FROM terminal where jenis = '2'")->result());
$jumlah_tersus   = count($this->db->query("SELECT id FROM terminal where jenis = '3'")->result());
?>

            <div class="col-12 mt-3">
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Terminal <span class="badge badge-light"><?=$hitung_terminal; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">UMUM <span class="badge badge-light"><?=$jumlah_umum; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">TUKS <span class="badge badge-light"><?=$jumlah_tuks; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">TERSUS <span class="badge badge-light"><?=$jumlah_tersus; ?></span></span>
            </div>
        </div>

        <div class="col-12 ml-3 mt-3">
            <div class="row">
                <div class="col-auto form-group mb-4">
                    <label class="mr-sm-2" for="filter_bulan">Bulan</label>
                    <input type="text" class="form-control ngambilbulan" id="filter_bulan" name="filter_bulan">
                </div>
                <div class="col-auto form-group mb-4">
                    <label class="mr-sm-2" for="filter_tahun">Tahun</label>
                    <input type="text" class="form-control ngambitahun" id="filter_tahun" name="filter_tahun">
                </div>

            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Jenis Terminal</th>
                                <th style="text-align: center;">Nama Terminal</th>
                                <th style="text-align: center;">Jumlah Kapal</th>
                                <th style="text-align: center;">Jumlah BM</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
</div>

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

$(document).ready(function() {
    // $('.page-wrapper').css("max-width", "100%");
    $("#example > tbody > tr > td:nth-child(4)").each(function() {
        $(this).css({
            "text-align": "center"
        });
    })
});


var t = $('#example').DataTable({
    responsive: true,
    "drawCallback": function(settings) {
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });
    },
    "searching": false,
    paging: false,
    ordering: false,
    info: false,
    processing: true,
    "language": {
        // "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
        // "search": "Pencarian:",
        // "zeroRecords": "Tidak ditemukan",
        // "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
        // "infoEmpty": "Tidak ada data ditemukan",
        // "infoFiltered": "(Disaring dari _MAX_ data)"
    },
    serverSide: true,
    ajax: {
        'url': "<?=base_url(); ?>laporan/load_terminal",
        'type': 'post',
        'data': function(d) {
            d.bulan = $('input[name=filter_bulan]').val();
            d.tahun = $('input[name=filter_tahun]').val();
        },
    },
    "columns": [{
            data: "no",
        },
        {
            data: "jenis",
        },
        {
            data: "terminal",
        },
        {
            data: "kapal",
        },
        {
            data: "bm",
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
</script>