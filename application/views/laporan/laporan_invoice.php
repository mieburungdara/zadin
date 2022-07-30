<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 col-12 mb-3 align-self-center">
        <h3 class="text-themecolor mb-0">Laporan Invoice</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">




    <dvi class="card">
        <div class="col-12 mt-3">

            <?php
// $this->db->select('id');
// $check_jumlah_biaya_operasional  = $this->db->get('biaya_operasional')->result();
// $hitung_jumlah_biaya_operasional = count($check_jumlah_biaya_operasional);
// $jumlah_baru                     = count($this->db->query("SELECT id FROM permohonan where status = '1'")->result());
// $jumlah_perpanjang               = count($this->db->query("SELECT id FROM permohonan where status = '2'")->result());
// $jumlah_revisi                   = count($this->db->query("SELECT id FROM permohonan where status = '3'")->result());
// $jumlah_batal                    = count($this->db->query("SELECT id FROM permohonan where status = '4'")->result());
// $jumlah_muat                     = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '1'")->result());
// $jumlah_bongkar                  = count($this->db->query("SELECT id FROM permohonan where permohonan_jenis = '2'")->result());
; ?>

            <!-- <div class="col-12 mt-3">
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">RKBM <span class="badge badge-light"><?=$hitung_jumlah_biaya_operasional; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Baru <span class="badge badge-light"><?=$jumlah_baru; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Perpanjang <span class="badge badge-light"><?=$jumlah_perpanjang; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Revisi <span class="badge badge-light"><?=$jumlah_revisi; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-success collapsed mr-3">Batal <span class="badge badge-light"><?=$jumlah_batal; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Muat <span class="badge badge-light"><?=$jumlah_muat; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Bongkar <span class="badge badge-light"><?=$jumlah_bongkar; ?></span></span>
                <span class="btn waves-effect waves-light btn-sm btn-danger collapsed mr-3">Muat & Bongar <span class="badge badge-light"><?=$jumlah_muat_bongkar; ?></span></span>
            </div> -->

            <div class="col-12 mt-3">
                <button class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3 cetaklaporan" data-link="" disabled><i class="fa-duotone fa-print  mr-1"></i>Cetak Laporan</button>
                <a class="btn waves-effect waves-light btn-sm btn-info collapsed mr-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter Permohonan
                </a>
            </div>
        </div>

        <div class="col-12 ml-3 mt-3">
            <div class="collapse" id="collapseExample" style="">
                <div class="d-flex flex-wrap">
                    <div class="row">
                        <!-- <div class="col-auto form-group mb-4">
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
                        </div> -->

                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_bulan">Bulan</label>
                            <input type="text" class="form-control ngambilbulan" id="filter_bulan" name="filter_bulan">
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_tahun">Tahun</label>
                            <input type="text" class="form-control ngambitahun" id="filter_tahun" name="filter_tahun">
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_status">Status</label>
                            <select class="custom-select mr-sm-2" id="filter_status" name="filter_status">
                                <option selected value="">Semua</option>
                                <option value="1">Belum dibayar</option>
                                <option value="2">Sudah dibayar</option>
                                <option value="3">Selesai</option>
                            </select>
                        </div>
                        <div class="col-auto form-group mb-4">
                            <label class="mr-sm-2" for="filter_perusahaan">Perusahaan</label>
                            <select class="custom-select mr-sm-2" id="filter_perusahaan" name="filter_perusahaan">
                                <option selected value="">Semua</option>
                                <?php
foreach ($this->db->get('perusahaan')->result() as $perper) {
    echo '<option value="' . $perper->id . '">' . $perper->nama . '</option>';
}
?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Invoice</th>
                                <th>PBM</th>
                                <th>Shipper</th>
                                <th>Bruto</th>
                                <th>PPH</th>
                                <th>Netto</th>
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
    var t = $('#example').DataTable({
        "ordering": false,
        "searching": false,
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
            'url': "<?=base_url(); ?>laporan/load_invoice",
            'type': 'post',
            'data': function(d) {
                d.bulan = $('input[name=filter_bulan]').val();
                d.tahun = $('input[name=filter_tahun]').val();
                d.jenis = $('select[name=filter_status]').val();
                d.perusahaan = $('select[name=filter_perusahaan]').val();
                // d.perusahaan = $('select[name=filter_perusahaan]').val();
                // d.status_permohonan = $('select[name=filter_status_permohonan]').val();
                // d.jenis_permohonan = $('select[name=filter_jenis_permohonan]').val();
                // d.kapal = $('select[name=filter_kapal]').val();
                // d.tempat_muat = $('select[name=filter_tempat_muat]').val();
                // d.barang = $('select[name=filter_barang]').val();
            },
        },
        // lengthMenu: [
        // [5, 10, 25, 50],
        // [5, 10, 25, 50],
        // ],
        "columns": [{
                data: "no",
            },
            {
                data: "tanggal",
            },
            {
                data: "status",
            },
            {
                data: "invoice",
            },
            {
                data: "pbm",
            },
            {
                data: "shipper",
            },
            {
                data: "bruto",
            },
            {
                data: "pph",
            },
            {
                data: "neto",
            },
        ]
    });

    var cetaklaporan, cetaksurat, ngebulan, ngetahun, filter_status, filter_perusahaan;

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
    $('#filter_status').on('change', function(e) {
        t.draw();
        e.preventDefault();
        filter_status = $('#filter_status').val() ? $('#filter_status').val() : undefined;
        // console.log(ngetahun);
    });

    $('#filter_perusahaan').on('change', function(e) {
        t.draw();
        e.preventDefault();
        filter_perusahaan = $('#filter_perusahaan').val() ? $('#filter_perusahaan').val() : undefined;
        // console.log(ngeper);
    });
    // $('#filter_status_permohonan').on('change', function(e) {
    // t.draw();
    // e.preventDefault();
    // ngejen = $('#filter_status_permohonan').val() ? $('#filter_status_permohonan').val() : undefined;
    // // console.log(ngeper);
    // });
    // $('#filter_jenis_permohonan').on('change', function(e) {
    // t.draw();
    // e.preventDefault();
    // ngest = $('#filter_jenis_permohonan').val() ? $('#filter_jenis_permohonan').val() : undefined;
    // // console.log(ngeper);
    // });
    t.on('xhr', function(e, settings, json) {
        // console.log(ngebulan);
        if (ngetahun != undefined || ngebulan != undefined) {
            $(".cetaklaporan").prop("disabled", false);
            // $(".cetaksurat").prop("disabled", false);
            cetaklaporan = "<?=base_url(); ?>laporan/invoice_rekap/" + ngebulan + "/" + ngetahun + "/" + filter_status + "/" + filter_perusahaan;
            // cetaksurat = "<?=base_url(); ?>laporan/cetak_terminal/" + ngeper + "/" + ngest + "/" + ngejen + "/" + ngebulan + "/" + ngetahun;
            $(".cetaklaporan").attr('data-link', cetaklaporan);
            // $(".cetaksurat").attr('data-link', cetaksurat);
            // console.log(ngeling);
        } else {
            $(".cetaklaporan").prop("disabled", true);
            // $(".cetaksurat").prop("disabled", true);
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
        // $(".cetaksurat").on("click", function() {
        // var linknya = $(this).attr("data-link");
        // window.open(linknya, '_blank');
        // });
    });

});
</script>