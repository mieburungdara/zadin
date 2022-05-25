<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/tabulator/css/tabulator.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/tabulator/css/tabulator_bootstrap4.min.css">
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Daftar Operasional</h3>
    </div>
    <div class="col-md-7 col-12 align-self-center d-none d-md-block">
        <div class="d-flex mt-2 justify-content-end">
            <div class="d-flex mr-3 ml-2">

                <form action="<?php echo site_url("operasional/index"); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
if ($q != "") {
    ?>
                            <a href="<?php echo site_url("operasional"); ?>" class="btn btn-default">Reset</a>
                            <?php
}
?>
                            <button class="btn btn-info" type="submit"> Pencarian</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="d-flex ml-2">
                <div class="p-3 text-center">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#operasional-baru-modal">Buat Operasional Baru</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                <div>
                                    <h3 class="card-title">Sales Overview</h3>
                                    <h6 class="card-subtitle">Ample Admin Vs Pixel Admin</h6>
                                </div>
                                <div class="ml-auto">
                                    <ul class="list-inline">
                                        <li class="list-inline-item px-2">
                                            <h6 class="text-success" onclick="load_data()"><i class="fa fa-circle font-10 mr-2 "></i>Ample</h6>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <h6 class="text-info"><i class="fa fa-circle font-10 mr-2"></i>Pixel</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Operasional</th>
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

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "ajax": {
            "url": "<?=base_url(); ?>operasional/load_data",
            "dataSrc": ""
        },
        "columns": [{
                "data": "id"
            },
            {
                "data": "nama"
            },
            {
                "data": "keterangan"
            },
        ],
        "columnDefs": [{
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function(data, type, row) {
                    console.log(row);

                    return data + '<br/>' + '<small class="text-muted">' + row['keterangan'] + '</small>';
                },
                "targets": 1
            },
            {
                "visible": false,
                "targets": [2]
            }
        ]
    });
});
// var table = $('#example').DataTable({
//     ajax: "<?=base_url(); ?>operasional/load_data"
// });

// table.on('xhr', function() {
//     var json = table.ajax.json();
//     // alert(json.length + ' row(s) were loaded');
// })
</script>





<div class="email-app todo-box-container">

    <div class="right-part mail-list bg-white overflow-auto">



        <div id="todo-list-container">
            <div style="min-height: calc(100vh - 180px);">
                <div class="col-12 p-0">
                    <div class="card">
                        <div class="card-body p-0">

                            <div class="todo-listing">
                                <div class="table-responsive">
                                    <table class="table stylish-table mt-4 no-wrap v-middle">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-muted font-weight-medium" style="width:90px;">Status</th>
                                                <th class="border-0 text-muted font-weight-medium">Operasional</th>
                                                <th class="border-0 text-muted font-weight-medium">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
foreach ($operasional_data as $operasional) {
    ?>
                                            <tr>
                                                <td>
                                                    <div class="ml-auto">
                                                        <div class="dropdown-action">
                                                            <div class="dropdown todo-action-dropdown">
                                                                <span class="badge badge-info p-1 dropdown-toggle text-decoration-none todo-action-dropdown" type="button" id="more-action-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fas fa-cog fa-spin"></i> <?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "operasional_status") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'operasional_status', $operasional->operasional_status)->nama : $operasional->operasional_status; ?>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more-action-1" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-136px, 31px, 0px);">
                                                                    <a class="edit dropdown-item" href="<?=site_url('operasional/update/' . $operasional->id); ?>"><i class="fas fa-edit text-warning mr-1"></i> Ubah</a>
                                                                    <a class="important dropdown-item" href="javascript:void(0);"><i class="fas fa-check text-success mr-1"></i> Selesai</a>
                                                                    <a class="remove dropdown-item" href="<?=site_url('operasional/delete/' . $operasional->id); ?>"><i class="fa fa-archive text-danger mr-1"></i>Arsipkan</a>
                                                                    <a class="permanent-delete dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt text-danger mr-1"></i>Hapus Permanent</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 font-weight-medium"><a href="<?=site_url('kegiatan/permohonan/' . $operasional->id); ?>" class="link"><?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'nama', $operasional->nama)->nama : $operasional->nama; ?></a></h6>
                                                    <small class="text-muted"><?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "keterangan") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'keterangan', $operasional->keterangan)->nama : $operasional->keterangan; ?></small>

                                                </td>
                                                <td>
                                                    <b>Asal barang :</b> <?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "barang_asal") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_asal', $operasional->barang_asal)->nama : $operasional->barang_asal; ?><br>
                                                    <b>Pemilik barang :</b> <?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "barang_pemilik") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'barang_pemilik', $operasional->barang_pemilik)->nama : $operasional->barang_pemilik; ?><br>
                                                    <b>Perusahaan PBM :</b> <?php echo $this->Reza_model->show_ref($this->db->database, "operasional", "perusahaan") ? $this->Reza_model->get_ref_val($this->db->database, 'operasional', 'perusahaan', $operasional->perusahaan)->nama : $operasional->perusahaan; ?><br>
                                                </td>
                                            </tr>
                                            <?php
} ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="badge badge-info">Jumlah Data <span class="badge badge-light"><?php echo $total_rows; ?></span></span>

                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php echo $pagination; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>


</div>


<div id="signup-modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <h4>Buat Permohona</h4>
                </div>

                <form class="pl-3 pr-3" action="#">

                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6">
                            <label for="username">Rencana Muat / Mulai</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                                <input type="text" id="tanggal_muat" class=" form-control mydatepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="username">Tanggal Selesai</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                                <input type="text" id="tanggal_selesai" class="form-control mydatepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Agen Kapal</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="agen_kapal" id="agen_kapal" placeholder="Agen Kapal">
                                    <option disabled <?php if (!$agen_kapal) {
    echo 'selected="selected"';
}
?>>Choose...
                                    </option>
                                    <?php
$agen_kapals = $this->Agen_kapal_model->get_all();
foreach ($agen_kapals as $palu) {
    $selected = $agen_kapal == $palu->id ? ' selected="selected"' : '';
    echo "<option value='" . $palu->id . "' " . $selected . ">" . $palu->nama . "</option>";
}
?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Nama Kapal</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Jenis Terminal</label>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Nama Terminal</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Tempat Bongkar/Tujuan</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Jenis Barang</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Jumlah Muatan</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username">Asal Barang</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Sign Up
                            Free</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="operasional-baru-modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <h4>Buat Operasional Baru</h4>
                </div>
                <form id="operasional_baru" class="pl-3 pr-3" action="operasional/create_action" method="post">
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
$asal = $this->db->get('barang_asal')->result();
foreach ($asal as $palu) {
    echo "<option value='" . $palu->id . "'>" . $palu->nama . "</option>";
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
                                    <option disabled selected="selected">Pilih Asal Barang..</option>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
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