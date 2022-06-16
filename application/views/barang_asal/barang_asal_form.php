<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Tambah Asal Barang</h3>
    </div>
</div>
<div class="" style="min-height: calc(100vh - 180px);">
    <div class="tab-content">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <form action="<?=$action; ?>" method="post">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama <?php echo form_error('nama'); ?></label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="inisial">Inisial <?php echo form_error('inisial'); ?></label>
                                    <input type="text" class="form-control" name="inisial" id="inisial" placeholder="inisial" value="<?php echo $inisial; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat <?php echo form_error('alamat'); ?></label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi <?php echo form_error('lokasi'); ?></label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="sk_brg">SK Barang <?php echo form_error('sk_brg'); ?></label>
                                    <input type="text" class="form-control" name="sk_brg" id="sk_brg" placeholder="Sk Brg" value="<?php echo $sk_brg; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="npwp">NPWP <?php echo form_error('npwp'); ?></label>
                                    <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pph">Pakai Pph? <?php echo form_error('pph'); ?></label>
                                    <?php
if ($pph) {
    $selected = 'selected="selected"';
} else {
    $selected = '';
}
?>
                                    <select class="custom-select mr-sm-2" id="pph" name="pph">
                                        <option value="0" <?php echo $selected; ?>>Tidak</option>
                                        <option value="1" <?php echo $selected; ?>>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="total_pph">Jumlah Pph <?php echo form_error('total_pph'); ?></label>
                                    <input type="number" style="text-align: right;" class="form-control" name="total_pph" id="total_pph" placeholder="Total Pph" value="<?php echo $total_pph; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="tarif_baru">Tarif Baru <?php echo form_error('tarif_baru'); ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="tarif_baru" id="tarif_baru" placeholder="Tarif Baru" value="<?php echo $tarif_baru; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="tarif_perpanjangtn">Tarif Perpanjang <?php echo form_error('tarif_perpanjang'); ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="tarif_perpanjang" id="tarif_perpanjang" placeholder="Tarif Perpanjang" value="<?php echo $tarif_perpanjang; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="tarif_revisi">Tarif Revisi <?php echo form_error('tarif_revisi'); ?></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="tarif_revisi" id="tarif_revisi" placeholder="Tarif Revisi" value="<?php echo $tarif_revisi; ?>" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light mr-3">Save</button><a href="<?=site_url('barang_asal'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$("input[name='total_pph']").TouchSpin({
    min: 0,
    max: 100,
    decimals: 1,
    boostat: 1,
    maxboostedstep: 10,
    postfix: '%'
});
</script>