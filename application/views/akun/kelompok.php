<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <form>
                <div class="card-body">
                    <h4 class="card-title">Kelompok Akun</h4>
                    <h6 class="card-subtitle mb-0">To use add class <code>.action-form</code> at which side you want to add buttons.</h6>
                </div>
                <!-- <hr> -->
                <!-- <hr> -->
                <div class="card-body">
                    <div class="row m-auto">
                        <div class="col-12">
                            <?php
$posts = $this->db->get('akun_kelompok')->result_array();
?>
                            <div class="btn btn-info waves-effect waves-light btn-sm mb-2" id="add-more" onclick="createNew();">Tambah</div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="table-header">No</th>
                                            <th class="table-header">Kelompok Akun</th>
                                            <th class="table-header">Keterangan</th>
                                            <th class="table-header">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <?php
if (!empty($posts)) {
    // $countplus = 1;
    foreach ($posts as $k => $v) {
        ?>
                                        <tr class="table-row" id="table-row-<?php echo $posts[$k]["id"]; ?>">
                                            <th scope="row"><?php echo $posts[$k]["id"]; ?></th>
                                            <td contenteditable="true" onBlur="saveToDatabase(this,'nama','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["nama"]; ?></td>
                                            <td contenteditable="true" onBlur="saveToDatabase(this,'keterangan','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["keterangan"]; ?></td>
                                            <td><span class="badge badge-danger" onclick="deleteRecord(<?php echo $posts[$k]['id']; ?>);">Hapus</span></td>
                                        </tr>
                                        <?php
}
}
?>
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


<script>
function createNew() {
    $("#add-more").hide();
    var data = '<tr class="table-row" id="new_row_ajax">' +
        '<td contenteditable="false"></td>' +
        '<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'nama\')" onClick="editRow(this);" style="border: dotted;"></td>' +
        '<td contenteditable="true" id="txt_description" onBlur="addToHiddenField(this,\'keterangan\')" onClick="editRow(this);"  style="border: dotted;"></td>' +
        '<td><input type="hidden" id="nama" /><input type="hidden" id="keterangan" /><span id="confirmAdd"><span onClick="addToDatabase()" class="badge badge-info mr-1">Simpan</span> <span onclick="cancelAdd();" class="badge badge-danger">Batal</span></span></td>' +
        '</tr>';
    $("#table-body").append(data);
}

function cancelAdd() {
    $("#add-more").show();
    $("#new_row_ajax").remove();
}

function editRow(editableObj) {
    $(editableObj).css("background", "#FFF");
}

function addToDatabase() {
    var title = $("#nama").val();
    var description = $("#keterangan").val();

    $("#confirmAdd").html('<img src="https://phppot.com/demo/jquery-ajax-add-edit-modal-window/LoaderIcon.gif" />');
    $.ajax({
        url: "<?=base_url('akun/kelompok_tambah'); ?>",
        type: "POST",
        data: 'nama=' + title + '&keterangan=' + description,
        success: function(data) {
            $("#new_row_ajax").remove();
            $("#add-more").show();
            $("#table-body").append(data);
        }
    });
}

function addToHiddenField(addColumn, hiddenField) {
    var columnValue = $(addColumn).text();
    $("#" + hiddenField).val(columnValue);
}
</script>
<script>
function saveToDatabase(editableObj, column, id) {
    $(editableObj).css("background", "#fff8a5 url(https://phppot.com/demo/jquery-ajax-add-edit-modal-window/LoaderIcon.gif) no-repeat right");
    $.ajax({
        url: "<?=base_url('akun/kelompok_ubah'); ?>",
        type: "POST",
        data: 'column=' + column + '&editval=' + $(editableObj).text() + '&id=' + id,
        success: function(data) {
            $(editableObj).css("background", "#FDFDFD");
        }
    });
}

function deleteRecord(id) {
    if (confirm("Apa kamu yakin ingin menhhgapus baris kelompok akun ini?")) {
        $.ajax({
            url: "<?=base_url('akun/kelompok_hapus'); ?>",
            type: "POST",
            data: 'id=' + id,
            success: function(data) {
                $("#table-row-" + id).remove();
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
        //name required
        var name = $("input#name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nama tidak boleh kosong..");
            $("input#name").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "<?=base_url('akun/kelompok_tambah'); ?>",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                if (data == 1) {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun Kelompok');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(e.responseText);
                    console.log("ERROR : ", e);
                }
                // console.log("SUCCESS : ", data);
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