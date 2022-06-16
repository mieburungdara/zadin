<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Laporan</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">




    <dvi class="card">
        <div class="col-12 mt-3">

            <?php
$this->db->select('id');
$check_jumlah_permohonan = $this->db->get('permohonan')->result();
$hitung_permohonan       = count($check_jumlah_permohonan);
$jumlah_baru             = count($this->db->query("SELECT id FROM permohonan where status = '1'")->result());
$jumlah_perpanjang       = count($this->db->query("SELECT id FROM permohonan where status = '2'")->result());
$jumlah_revisi           = count($this->db->query("SELECT id FROM permohonan where status = '3'")->result());
$jumlah_batal            = count($this->db->query("SELECT id FROM permohonan where status = '4'")->result());
$jumlah_muat             = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '1'")->result());
$jumlah_bongkar          = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '2'")->result());
?>

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
                <button class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3 cetaklaporan" data-link="" disabled><i class="fa-duotone fa-print  mr-1"></i>Cetak Laporan</button>
                <button class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3 cetaksurat" data-link="" disabled><i class="fa-duotone fa-print  mr-1"></i>Cetak Surat</button>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter Permohonan
                </a>
            </div>
        </div>

        <div class="col-12 ml-3 mt-3">
            <div class="collapse" id="collapseExample" style="">
                <div class="d-flex flex-wrap">
                    <div class="row">
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_perusahaan">Perusahaan</label>
                            <select class="custom-select mr-sm-2" id="filter_perusahaan" name="filter_perusahaan">
                                <option selected value="">Semua</option>
                                <?php
$perusahaan = $this->db->get('perusahaan')->result();
foreach ($perusahaan as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                            </select>
                        </div>

                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_bulan">Bulan</label>
                            <input type="text" class="form-control ngambilbulan" id="filter_bulan" name="filter_bulan">
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_tahun">Tahun</label>
                            <input type="text" class="form-control ngambitahun" id="filter_tahun" name="filter_tahun">
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_jenis_permohonan">Jenis Permohonan</label>
                            <select class="custom-select mr-sm-2" id="filter_jenis_permohonan" name="filter_jenis_permohonan">
                                <option selected value="">Semua</option>
                                <option value="1">Muat</option>
                                <option value="2">Bongkar</option>
                            </select>
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_status_permohonan">Status Permohonan</label>
                            <select class="custom-select mr-sm-2" id="filter_status_permohonan" name="filter_status_permohonan">
                                <option selected value="">Semua</option>
                                <option value="1">Baru</option>
                                <option value="2">Perpanjang</option>
                                <option value="3">Revisi</option>
                                <option value="4">Batal</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped table-hover table-responsive" style="width:100%">
                        <!-- <thead>
                            <tr>
                                <th>No</th>
                                <th>No.Surat</th>
                                <th>No.RKBM</th>
                                <th>Operasional</th>
                                <th>Kapal</th>
                                <th>Bendera</th>
                                <th>Ukuran</th>
                                <th>Agen Kapal</th>
                            </tr>
                        </thead> -->
                        <thead>
                            <tr role="row">
                                <th rowspan="1" colspan="1" style="width: 18px;" aria-label="No">No</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Admin: activate to sort column ascending">Status</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="No. RKBM: activate to sort column ascending">No. RKBM</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Nama Kapal: activate to sort column ascending">Nama Kapal</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Bendera: activate to sort column ascending">Bendera</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Ukuran: activate to sort column ascending">Ukuran</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Agen: activate to sort column ascending">Agen</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Bongkar: activate to sort column ascending">Bongkar</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Muat Akhir: activate to sort column ascending">Muat Akhir</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Muat: activate to sort column ascending">Muat</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Mulai: activate to sort column ascending">Mulai</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Selesai: activate to sort column ascending">Selesai</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Asal Barang: activate to sort column ascending">Asal Barang</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Tujuan: activate to sort column ascending">Tujuan</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Jenis: activate to sort column ascending">Jenis</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Terminal: activate to sort column ascending">Terminal</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Loading Point: activate to sort column ascending">Loading Point</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Pemilik: activate to sort column ascending">Pemilik</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Perusahaan: activate to sort column ascending">Perusahaan</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Tanggal Dibuat: activate to sort column ascending">Tanggal Dibuat</th>
                                <th tabindex="0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Admin</th>
                                <!-- <th rowspan="1" colspan="1" aria-label="Action">Action</th> -->
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
</div>

</div>
<script>
$(document).ready(function() {
    $('.page-wrapper').css("max-width", "100%");
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
    if (window.location.href == "<?=base_url(); ?>laporan/perusahaan" || window.location.href == "<?=base_url(); ?>laporan/perusahaan/") {
        var urel = "<?=base_url(); ?>laporan/load_perusahaan";
    }
    if (window.location.href == "<?=base_url(); ?>laporan/terminal" || window.location.href == "<?=base_url(); ?>laporan/terminal/") {
        var urel = "<?=base_url(); ?>laporan/load_terminal";
    }
    var t = $('#example').DataTable({

        responsive: true,
        "drawCallback": function(settings) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        },
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
            'url': urel,
            'type': 'post',
            'data': function(d) {
                d.bulan = $('input[name=filter_bulan]').val();
                d.tahun = $('input[name=filter_tahun]').val();
                d.perusahaan = $('select[name=filter_perusahaan]').val();
                d.status_permohonan = $('select[name=filter_status_permohonan]').val();
                d.jenis_permohonan = $('select[name=filter_jenis_permohonan]').val();
                // d.kapal = $('select[name=filter_kapal]').val();
                // d.tempat_muat = $('select[name=filter_tempat_muat]').val();
                // d.barang = $('select[name=filter_barang]').val();
            },
        },
        // lengthMenu: [
        //     [5, 10, 25, 50],
        //     [5, 10, 25, 50],
        // ],
        "columns": [{
                data: "no",
            },
            {
                data: "status",
            },
            {
                data: "no_rkbm",
            },
            {
                data: "kapal",
            },
            {
                data: "bendera",
            },
            {
                data: "ukuran",
            },
            {
                data: "agen",
            },
            {
                data: "jumlah_bongkar",
            },
            {
                data: "jumlah_asli",
            },
            {
                data: "jumlah_muatan",
            },
            {
                data: "mulai",
            },
            {
                data: "selesai",
            },
            {
                data: "asal_barang",
            },
            {
                data: "tujuan",
            },
            {
                data: "jenis",
            },
            {
                data: "shipper",
            },
            {
                data: "tempat_muat",
            },
            {
                data: "pemilik",
            },
            {
                data: "perusahaan",
            },
            {
                data: "mulai",
            },
            {
                data: "admin",
            },
            // {
            //     data: "aksi",
            // },
        ]
    });

    var cetaklaporan, cetaksurat, ngebulan, ngetahun, ngeper, ngejen, ngest;

    $('#filter_bulan').on('change', function(e) {
        t.draw();
        e.preventDefault();
        ngebulan = $('#filter_bulan').val() ? $('#filter_bulan').val() : undefined;
        // console.log(ngebulan);
    });

    $('#filter_tahun').on('change', function(e) {
        t.draw();
        e.preventDefault();
        ngetahun = $('#filter_tahun').val() ? $('#filter_tahun').val() : undefined;
        // console.log(ngetahun);
    });

    $('#filter_perusahaan').on('change', function(e) {
        t.draw();
        e.preventDefault();
        ngeper = $('#filter_perusahaan').val() ? $('#filter_perusahaan').val() : undefined;
        // console.log(ngeper);
    });
    $('#filter_status_permohonan').on('change', function(e) {
        t.draw();
        e.preventDefault();
        ngejen = $('#filter_status_permohonan').val() ? $('#filter_status_permohonan').val() : undefined;
        // console.log(ngeper);
    });
    $('#filter_jenis_permohonan').on('change', function(e) {
        t.draw();
        e.preventDefault();
        ngest = $('#filter_jenis_permohonan').val() ? $('#filter_jenis_permohonan').val() : undefined;
        // console.log(ngeper);
    });
    t.on('xhr', function(e, settings, json) {
        if (ngeper != undefined && ngetahun != undefined && ngebulan != undefined) {
            $(".cetaklaporan").prop("disabled", false);
            $(".cetaksurat").prop("disabled", false);
            cetaklaporan = "<?=base_url(); ?>laporan/cetak_perusahaan/" + ngeper + "/" + ngest + "/" + ngejen + "/" + ngebulan + "/" + ngetahun;
            cetaksurat = "<?=base_url(); ?>laporan/cetak_terminal/" + ngeper + "/" + ngest + "/" + ngejen + "/" + ngebulan + "/" + ngetahun;
            $(".cetaklaporan").attr('data-link', cetaklaporan);
            $(".cetaksurat").attr('data-link', cetaksurat);
            // console.log(ngeling);
        } else {
            $(".cetaklaporan").prop("disabled", true);
            $(".cetaksurat").prop("disabled", true);
            // ngeling = "<?=base_url(); ?>laporan/cetak/perusahaan/" + ngeper + "/" + ngebulan + "/" + ngetahun;
            // console.log(ngeling);
        }
        // var bulan = json.bulan;
        // var tahun = json.tahun;
        // console.log(json);
        // var perusahaan = json.perusahaan;
        // if (perusahaan == 0) {
        // $("#cetaks2").attr("href", '#')
        // $("#cetaks").attr("href", '#')

        // alert('kosong');

        // } else {
        // alert('ok');
        // $("#cetaks2").attr("href", 'https://zadin.co.id/admin/laporan/cetak/'+month+'/'+year+'/'+perusahaan)
        // $("#cetaks").attr("href", 'https://zadin.co.id/admin/laporan/cetak/data/'+month+'/'+year+'/'+perusahaan)
        // }
    });

    $(document).ready(function() {
        $(".cetaklaporan").on("click", function() {
            var linknya = $(this).attr("data-link");
            window.open(linknya, '_blank');
        });
        $(".cetaksurat").on("click", function() {
            var linknya = $(this).attr("data-link");
            window.open(linknya, '_blank');
        });
    });

});
</script>