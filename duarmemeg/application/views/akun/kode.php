<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <form>
                <div class="card-body">
                    <h4 class="card-title">Daftar Akun</h4>
                    <!-- <h6 class="card-subtitle mb-0">To use add class <code>.action-form</code> at which side you want to add buttons.</h6> -->
                </div>
                <!-- <hr> -->
                <!-- <hr> -->
                <div class="card-body">
                    <div class="row m-auto">
                        <div class="col-12">
                            <?php
$posts = $this->db->get('akun_group')->result_array();
?>
                            <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 mr-2" data-toggle="modal" data-target="#bs-example-modal-lg">Tambah Akun</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!-- <th scope="col">ID</th> -->
                                            <th scope="col" class="text-center">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kelompok</th>
                                            <th scope="col">Keterangan</th>
                                            <th class="text-center" scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
// $hitung = 1;
foreach ($this->db->get('akun_kode')->result() as $akl) {
    echo '<tr id="table_row_' . $akl->id . '">';
    echo '<td>' . $akl->id . '</td>';
    // echo '<td  class="text-center">' . $akl->kode . '</td>';
    echo '<td>' . $akl->nama . '</td>';
    $this->db->where('id', $akl->kelompok);
    // debugx($akl->kelompok);
    $get_kelompok = $this->db->get('akun_tipe')->row();
    echo '<td>[<code><b>' . $get_kelompok->id . '</b></code>] ' . $get_kelompok->nama . '</td>';
    echo '<td>' . $akl->keterangan . '</td>';
    echo '<td class="text-center"><span class="badge badge-warning mr-1 editbtn">Edit</span><span class="badge badge-danger" onclick="deleteRecord(' . $akl->id . ');">Hapus</span></td>';
    echo '</tr>';
} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Kode Akun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <code class="text-center"><p id="show_message" style="display: none">Kode akun ebrhasil ditambakan..</p></code>
                <code class="text-center"><p id="error" style="display: none"></p></code>
                <form action="javascript:void(0)" method="post" id="ajax-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="input_kelompok" class="control-label col-form-label">Kelompok Akun</label>
                                    <select class="custom-select mr-sm-2" name="input_kelompok" id="input_kelompok" required>
                                        <option disabled value="" selected>Pilih..</option>
                                        <?php
foreach ($this->db->get('akun_tipe')->result() as $ka) {
    echo '<option value="' . $ka->id . '">' . $ka->id . ' - ' . $ka->nama . '</option>';
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="input_kode" class="control-label col-form-label">Kode</label>
                                    <input type="number" class="form-control" id="input_kode" name="input_kode" required>
                                    <small class="form-text text-muted">Kode Akun</small>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="input_name" class="control-label col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="input_name" name="input_name" placeholder="Nama Akun" required>
                                    <!-- <small class="form-text text-muted">Nama Akun</small> -->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="input_keterangan" class="control-label col-form-label">Keterangan</label>
                                    <textarea class="form-control" id="input_keterangan" name="input_keterangan" rows="3" placeholder="Keterangan tentang Kode akun.."></textarea>
                                    <small class="form-text text-muted">Boleh Dikosongkan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="action-form">
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Ubah Akun </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?=base_url('akun/kode_ubah'); ?>" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="update_id" id="update_id">

                    <div class="form-group">
                        <label> Nama Akun </label>
                        <input type="text" name="edit_nama" id="edit_nama" class="form-control" placeholder="Nama AKun">
                    </div>
                    <div class="form-group">
                        <label> Kode Akun </label>
                        <input type="number" name="edit_kode" id="edit_kode" class="form-control" placeholder="Kode AKun">
                    </div>

                    <div class="form-group">
                        <label for="edit_kelompok" class="control-label col-form-label">Kelompok Akun</label>
                        <select class="custom-select mr-sm-2" name="edit_kelompok" id="edit_kelompok" required>
                            <option disabled value="" selected>Pilih..</option>
                            <?php
foreach ($this->db->get('akun_tipe')->result() as $ka) {
    echo '<option value="' . $ka->id . '">' . $ka->id . ' - ' . $ka->nama . '</option>';
}
?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_keterangan" class="control-label col-form-label">Keterangan</label>
                        <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3" placeholder="Keterangan tentang Kode akun.."></textarea>
                        <small class="form-text text-muted">Boleh Dikosongkan</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    $('.editbtn').on('click', function() {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);
        var regex = /\[([0-9]+)\]/;
        var matches = data[2].match(regex);
        // console.log(matches[1]);

        $('#update_id').val(data[0]);
        $('#edit_kode').val(data[0]);
        $('#edit_nama').val(data[1]);
        $('#edit_kelompok').val(matches[1]);
        $('#edit_keterangan').val(data[3]);
    });
});
</script>
<script>
function deleteRecord(id) {
    if (confirm("Apa kamu yakin ingin menhhgapus baris Kode akun ini?")) {
        $.ajax({
            url: "<?=base_url('akun/kode_hapus'); ?>",
            type: "POST",
            data: 'id=' + id,
            success: function(data) {
                console.log(data.trim());
                $("#table_row_" + data.trim()).remove();
            }
        });
    }
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
            url: "<?=base_url('akun/kode_tambah'); ?>",
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