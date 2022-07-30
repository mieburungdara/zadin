<div class="row mt-3">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Invoice</h4>
                <div class="text-right"><button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-example-modal-lg">Verifikasi Invoice</button></div>
                <!-- <p class="text-muted">
                    Verifikasi invoice yg sudah dibayar..
                </p> -->
                <div class="table-responsive table-bordered table-sm">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.Inv</th>
                                <th scope="col" class="text-center">No.Kas</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$this->db->where('kas_group', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $rf) {

    ?>
                            <tr>
                                <td class="text-center"><?=$rf->id; ?></td>
                                <td class="text-center"><?=$rf->kas_group; ?></td>
                                <td class="text-center"><?=$rf->updated_at; ?></td>
                                <td><?=$rf->nama; ?></td>
                            </tr>
                            <?php
}
?>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Verifikasi Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <code class="text-center"><p id="show_message" style="display: none">Invoice ebrhasil ditambakan..</p></code>
                        <code class="text-center"><p id="error" style="display: none"></p></code>
                        <form action="javascript:void(0)" method="post" id="ajax-form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="input_kelompok" class="control-label col-form-label">Nomor Invoice</label>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
                                            <script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
                                            <select class="selectpicker" name="input_inv" id="input_inv" required multiple data-live-search="true">
                                                <?php
$this->db->where('kas_group', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $row) {
    echo '<option data-subtext="' . $row->nama . '" value="' . $row->id . '">' . $row->id . '</option>';
}
?>
                                            </select>
                                            <!-- <button type="button" class="btn btn-sm btn-primary create-permission" id="btn_save" value="Save" onclick="sendFunc()">Show Selected Option</button> -->
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="input_tp" class="control-label col-form-label">Tanggal Pembayaran</label>
                                        <div class="input-group">
                                            <input type="text" required class="form-control" id="input_tp" name="input_tanggal" placeholder="dd mm yyyy">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                        <script>
                                        jQuery('#input_tp').datepicker({
                                            autoclose: true,
                                            format: 'dd-mm-yyyy',
                                            todayHighlight: true
                                        });
                                        </script>
                                    </div>
                                    <div class="col-3">
                                        <label class="control-label col-form-label">Jenis Pembayaran</label>
                                        <input name="input_pembayaran" value="bank" required type="radio" id="radio_30" class="with-gap material-inputs material-inputs radio-col-red">
                                        <label for="radio_30">Bank / Transfer</label>
                                        <br>
                                        <br>
                                        <input name="input_pembayaran" value="tunai" type="radio" id="radio_35" class="with-gap material-inputs material-inputs radio-col-blue">
                                        <label for="radio_35">Kas / Tunai</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="input_keterangan" class="control-label col-form-label">Keterangan</label>
                                            <textarea class="form-control" required id="input_keterangan" name="input_keterangan" rows="3" placeholder=".."></textarea>
                                            <small class="form-text text-muted">Boleh Dikosongkan</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Arus Akun</h4>
                <div class="text-right"><button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-akun-modal-lg">Transaksi Akun</button></div>
                <div class="table-responsive table-bordered table-sm">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Akun</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col" class="text-center">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$this->db->where('kas_group', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $rf) {
    ?>
                            <!-- <tr>
                                <td class="text-center"><?=$rf->id; ?></td>
                                <td class="text-center"><?=$rf->kas_group; ?></td>
                                <td><?=$rf->nama; ?></td>
                            </tr> -->
                            <?php
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="bs-akun-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Transaksi Akun</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <code class="text-center"><p id="show_message" style="display: none">Invoice ebrhasil ditambakan..</p></code>
                    <code class="text-center"><p id="error" style="display: none"></p></code>
                    <form action="javascript:void(0)" method="post" id="ajax-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="input_kelompok" class="control-label col-form-label">Nomor Akun</label><br>
                                        <select class="selectpicker" name="input_akun" id="input_akun" data-show-subtext="true" required>
                                            <?php
// $this->db->where('kas_group', null);
$fr = $this->db->get('akun_kelompok')->result();
foreach ($fr as $row) {
    echo '<optgroup label="' . $row->nama . '">';
    $this->db->where('kelompok', $row->id);
    $fe = $this->db->get('akun_kode')->result();
    foreach ($fe as $de) {
        echo '<option data-subtext="' . $de->nama . '" value="' . $de->id . '">' . $de->id . '</option>';
    }
    echo '</optgroup>';
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="input_tp" class="control-label col-form-label">Tanggal Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" required class="form-control" id="input_tp2" name="input_tanggal" placeholder="dd mm yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>
                                    <script>
                                    jQuery('#input_tp2').datepicker({
                                        autoclose: true,
                                        format: 'dd-mm-yyyy',
                                        todayHighlight: true
                                    });
                                    </script>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="input_keterangan" class="control-label col-form-label">Keterangan</label>
                                        <textarea class="form-control" required id="input_keterangan" name="input_keterangan" rows="3" placeholder=".. .."></textarea>
                                        <small class="form-text text-muted">Boleh Dikosongkan</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kas">Kas </label>
                                        <input type="text" class="form-control masinput" name="kas" id="kas" placeholder="Pembayaran Tunai" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="bank">Bank </label>
                                        <input type="text" class="form-control masinput" name="kas" id="kas" placeholder="Pembayaran Bank" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="bs-inv-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Transaksi Inventori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <code class="text-center"><p id="show_message" style="display: none">Invoice ebrhasil ditambakan..</p></code>
                    <code class="text-center"><p id="error" style="display: none"></p></code>
                    <form action="javascript:void(0)" method="post" id="ajax-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="input_kelompok" class="control-label col-form-label">Nomor Akun</label><br>
                                        <select class="selectpicker" name="input_akun" id="input_akun" data-show-subtext="true" required>
                                            <?php
// $this->db->where('kas_group', null);
$fr = $this->db->get('akun_kelompok')->result();
foreach ($fr as $row) {
    echo '<optgroup label="' . $row->nama . '">';
    $this->db->where('kelompok', $row->id);
    $fe = $this->db->get('akun_kode')->result();
    foreach ($fe as $de) {
        echo '<option data-subtext="' . $de->nama . '" value="' . $de->id . '">' . $de->id . '</option>';
    }
    echo '</optgroup>';
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="input_tp" class="control-label col-form-label">Tanggal Pembayaran</label>
                                    <div class="input-group">
                                        <input type="text" required class="form-control" id="input_tp2" name="input_tanggal" placeholder="dd mm yyyy">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>
                                    <script>
                                    jQuery('#input_tp2').datepicker({
                                        autoclose: true,
                                        format: 'dd-mm-yyyy',
                                        todayHighlight: true
                                    });
                                    </script>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="input_keterangan" class="control-label col-form-label">Keterangan</label>
                                        <textarea class="form-control" required id="input_keterangan" name="input_keterangan" required rows="3" placeholder=".. .."></textarea>
                                        <small class="form-text text-muted">Tidak Boleh Kosong</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="jb">Jumlah Barang </label>
                                                <input type="number" class="form-control" name="jb" required id="jb" placeholder="Jumlah barang" value="">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="hs">Harga Satuan </label>
                                                <input type="text" class="form-control masinput" name="hs" required id="hs" placeholder="Harga Satuan" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Inventori</h4>
                <div class="text-right"><button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-inv-modal-lg">Transaksi Inventori</button></div>
                <div class="table-responsive table-bordered table-sm">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col" class="text-center">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$this->db->where('kas_group', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $rf) {
    ?>
                            <!-- <tr>
                                <td class="text-center"><?=$rf->id; ?></td>
                                <td class="text-center"><?=$rf->kas_group; ?></td>
                                <td><?=$rf->nama; ?></td>
                            </tr> -->
                            <?php
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
$('input.masinput').keyup(function(event) {
    if (event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
});

$(document).ready(function() {
    $('.page-wrapper').css("max-width", "100%");
});
</script>

<script>
$('select').selectpicker();

function sendFunc() {
    var value = $('select').selectpicker().val();
    console.log(value);
    // $('.selectpicker').selectpicker('val', value);
}
</script>

<script>
$(document).ready(function($) {
    // hide messages
    $("#error").hide();
    $("#show_message").hide();
    // on submit...
    $('#ajax-form').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var kode = $("input#input_kode").val();
        if (kode == "") {
            $("#error").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_kode").focus();
            return false;
        }
        var kelompok = $("select#input_kelompok").val();
        if (kelompok == "") {
            $("#error").fadeIn().text("Kelompok tidak boleh kosong..");
            $("select#input_kelompok").focus();
            return false;
        }
        var name = $("input#input_name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nama tidak boleh kosong..");
            $("input#input_name").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "http://localhost/zadin/transaksi/invoice",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});
</script>