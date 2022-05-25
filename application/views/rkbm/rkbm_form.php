<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/typeahead.jquery.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/typeahead.js/dist/bloodhound.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Tambah Rkbm</h3>
    </div>
</div>
<div class="" style="min-height: calc(100vh - 180px);">
    <div class="tab-content">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <form action="<?=$action; ?>" method="post">
                    <div class="card-body">
                        <div class="row mt-3">
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">No Rkbm <?php echo form_error('no_rkbm'); ?></label>
                            <input type="text" class="form-control" name="no_rkbm" id="no_rkbm" placeholder="No Rkbm" value="<?php echo $no_rkbm; ?>" />
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">No Invoice <?php echo form_error('no_invoice'); ?></label>
                    <input type="text" class="form-control" name="no_invoice" id="no_invoice" placeholder="No Invoice" value="<?php echo $no_invoice; ?>" />
            </div>
        </div> -->

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
                    <option disabled <?php if (!$agen_kapal) {
    echo 'selected="selected"';
}
?>>Pilih...
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
                    <option disabled <?php if (!$jenis_terminal) {
    echo 'selected="selected"';
}
?>>Pilih..
                    </option>
                    <?php
$agen_kapals = $this->Jenis_terminal_model->get_all();
foreach ($agen_kapals as $palu) {
    $selected = $agen_kapal == $palu->id ? ' selected="selected"' : '';
    echo "<option value='" . $palu->id . "' " . $selected . ">" . strtoupper($palu->nama) . "</option>";
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
                    <option disabled <?php if (!$barang) {
    echo 'selected="selected"';
}
?>>Pilih..
                    </option>
                    <?php
$agen_kapals = $this->Barang_model->get_all();
foreach ($agen_kapals as $palu) {
    $selected = $barang == $palu->id ? ' selected="selected"' : '';
    echo "<option value='" . $palu->id . "' " . $selected . ">" . strtoupper($palu->nama) . "</option>";
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
                    <option disabled <?php if (!$asal_brg) {
    echo 'selected="selected"';
}
?>>Choose...
                    </option>
                    <?php
$agen_kapals = $this->Asal_pemilik_model->get_asal();
foreach ($agen_kapals as $palu) {
    $selected = $asal_brg == $palu->id ? ' selected="selected"' : '';
    echo "<option value='" . $palu->id . "' " . $selected . ">" . $palu->nama . "</option>";
}
?>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label for="perusahaan">Perusahaan PBM</label>
                <select class="custom-select mr-sm-2 wide" name="perusahaan" id="perusahaan" placeholder="Agen Kapal">
                    <option disabled <?php if (!$perusahaan) {
    echo 'selected="selected"';
}
?>>Choose...
                    </option>
                    <?php
$agen_kapals = $this->Perusahaan_model->get_all();
foreach ($agen_kapals as $palu) {
    $selected = $perusahaan == $palu->id ? ' selected="selected"' : '';
    echo "<option value='" . $palu->id . "' " . $selected . ">" . $palu->nama . "</option>";
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
</div>
</div>
</div>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<script>
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
        var xer = <?php echo $red; ?> ;
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
// $ergvr = json_encode($jehbt);?>
        // var dtp = <?php //echo //$ergvr;?>;
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