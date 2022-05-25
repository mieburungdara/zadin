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
?>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/typeahead.jquery.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/bloodhound.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

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

; ?>>Choose...
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

; ?>>Choose...
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

































<div class="email-app todo-box-container">
    <div class="right-part bg-white overflow-auto">
        <div class="container-fluid">


            <div class="row justify-content-end pt-3">
                <div class="border-start-primary col-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="ti-write text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1">24</h5>
                            <p class="text-muted mb-0">Total Projects</p>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="far fa-th text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1">18</h5>
                            <p class="text-muted mb-0">Completed Projects</p>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-file text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1">06</h5>
                            <p class="text-muted mb-0">Pending Projects</p>
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




<script>
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
// $ergvr = json_encode($jehbt);; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ?>
    // var dtp = <?php //echo //$ergvr;; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ; ?>;
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