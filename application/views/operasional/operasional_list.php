<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <button type="button" class="btn waves-effect waves-light btn-sm btn-info collapsed ml-3" data-toggle="modal" data-target="#operasional-baru-modal">Buat Operasional Baru</button>
                            <a class="btn waves-effect waves-light btn-sm btn-info collapsed ml-3" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Filter Data Operasional
                            </a>
                        </div>
                        <div class="col-12">
                            <div class="collapse" id="collapseExample" style="">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <div class="ml-auto row">
                                            <div class="col-3 form-group mb-4">
                                                <label class="mr-sm-2" for="perusahaan">Perusahaan</label>
                                                <select class="custom-select mr-sm-2" id="perusahaan" name="perusahaan">
                                                    <option selected value="">Semua</option>
                                                    <?php
$perusahaan = $this->db->get('perusahaan')->result();
foreach ($perusahaan as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                                </select>
                                            </div>
                                            <div class="col-3 form-group mb-4">
                                                <label class="mr-sm-2" for="bulan">Bulan</label>
                                                <input type="text" class="form-control ngambilbulan" placeholder="Semua" id="bulan" name="bulan">
                                            </div>
                                            <div class="col-3 form-group mb-4">
                                                <label class="mr-sm-2" for="tahun">Tahun</label>
                                                <input type="text" class="form-control ngambitahun" placeholder="Semua" id="tahun" name="tahun">
                                            </div>
                                            <div class="col-3 form-group mb-4">
                                                <label class="mr-sm-2" for="status">Status</label>
                                                <select class="custom-select mr-sm-2" id="status" name="status">
                                                    <option selected value="">Semua</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Selesai</option>
                                                    <option value="3">Arsip</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <table id="example" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Operasional</th>
                                            <th>Deskripsi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="operasional-baru-modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <h4>Buat Operasional Baru</h4>
                    </div>
                    <form id="operasional_baru" class="pl-3 pr-3" action="<?=base_url('operasional/create_action'); ?>" method="post">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nama">Judul Operasional</label>
                                    <input class="form-control" type="text" id="nama" placeholder="Misal: nama perusahan / bapak/ibu atau sembarang sebagai judul operasional" name="nama">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input class="form-control" type="text" id="keterangan" name="keterangan" placeholder="Keterangan tentang operasional">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="asal_barang">Asal Barang</label>
                                    <select class="custom-select mr-sm-2 wide" name="asal_barang" id="asal_barang" placeholder="Asal Barang">
                                        <option disabled selected="selected">Pilih Asal Barang..</option>
                                        <?php
$asal   = $this->db->get('barang_asal')->result();
$lokasi = '';
foreach ($asal as $palu) {
$lokasi = '';

    if ($palu->lokasi) {
        $lokasi = ' (';
        $lokasi .= $palu->lokasi;
        $lokasi .= ')';
    }
    echo "<option value='" . $palu->id . "'>" . $palu->nama . $lokasi . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="asal_barang">Pemilik Barang</label>
                                    <select class="custom-select mr-sm-2 wide" name="pemilik_barang" id="pemilik_barang" placeholder="Pemilik Barang">
                                        <option disabled selected="selected">Pilih Pemilik Barang..</option>
                                        <?php
$pemilik = $this->db->get('barang_pemilik')->result();
foreach ($pemilik as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">

                                <div class="form-group">
                                    <label for="asal_barang">Perusahaan</label>
                                    <select class="custom-select mr-sm-2 wide" name="perusahaan" id="perusahaan" placeholder="Perusahaan">
                                        <option disabled selected="selected">Pilih Perusahaan Bongkar Muat..</option>
                                        <?php
$perusahaan = $this->db->get('perusahaan')->result();
foreach ($perusahaan as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Buat</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>



    <script>
    kkMessgae.uri = ' <?=base_url(); ?>assets/libs/jquery-kk-message/'; // this is the id of the form
    $("#operasional_baru").submit(function(e) {
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
                "zeroRecords": "Tidak ditemukan - sorry",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data ditemukan",
                "infoFiltered": "(Disaring dari _MAX_ data)"
            },
            serverSide: true,
            ajax: {
                'url': "<?=base_url(); ?>operasional/load_data",
                'type': 'post',
                'data': function(d) {
                    d.bulan = $('input[name=bulan]').val();
                    d.tahun = $('input[name=tahun]').val();
                    d.perusahaan = $('select[name=perusahaan]').val();
                    d.status = $('select[name=status]').val();
                },
            },
            "columns": [{
                    data: "id",
                },
                {
                    data: "status",
                },
                {
                    data: "operasional",
                },
                {
                    data: "deskripsi",
                },
                {
                    data: "keterangan",
                },
            ]
        });

        $('#bulan').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });

        $('#tahun').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });

        $('#perusahaan').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });
        $('#status').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });

        t.on('xhr', function(e, settings, json) {
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
        });

    });
    </script>