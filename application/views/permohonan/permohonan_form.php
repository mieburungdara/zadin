<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>

<div class="mt-3" style="min-height: calc(100vh - 180px);">
    <div class="tab-content">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <form action="<?=$action; ?>" method="post">
                    <div class="card-body">
                        <div class="row mt-3">
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Parent <?php echo form_error('parent'); ?></label>
                                    <input type="text" class="form-control" name="parent" id="parent" placeholder="Parent" value="<?php echo $parent; ?>" />
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Operasional <?php echo form_error('operasional'); ?></label>
                                    <input type="text" class="form-control" name="operasional" id="operasional" placeholder="Operasional" value="<?php echo $operasional; ?>" />
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">No Rkbm <?php echo form_error('no_rkbm'); ?></label>
                                    <input type="text" class="form-control" name="no_rkbm" id="no_rkbm" placeholder="No Rkbm" value="<?php echo $no_rkbm; ?>" />
                                </div>
                            </div> -->

                            <div class="col-sm-12 col-md-6">
                                <label for="tanggal_muat">Rencana Mulai Muat/Bongkar <?php echo form_error('mulai'); ?></label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div>
                                    <input type="text" id="tanggal_muat" name="mulai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo $mulai; ?>">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="tanggal_selesai">Tanggal Selesai <?php echo form_error('selesai'); ?></label>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div>
                                    <input type="text" id="tanggal_selesai" name="selesai" class="form-control mydatepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo $selesai; ?>">
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
                                    <label for="int">Tempat Muat <?php echo form_error('tempat_muat'); ?></label>
                                    <input type="text" class="form-control" name="tempat_muat" id="tempat_muat" placeholder="Tempat Muat" value="<?php echo $tempat_muat; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Barang <?php echo form_error('barang'); ?></label>
                                    <input type="text" class="form-control" name="barang" id="barang" placeholder="Barang" value="<?php echo $barang; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="tempat_bongkar">Tempat Bongkar <?php echo form_error('tempat_bongkar'); ?></label>
                                    <textarea class="form-control" rows="3" name="tempat_bongkar" id="tempat_bongkar" placeholder="Tempat Bongkar"><?php echo $tempat_bongkar; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Jumlah Muatan <?php echo form_error('jumlah_muatan'); ?></label>
                                    <input type="text" class="form-control" name="jumlah_muatan" id="jumlah_muatan" placeholder="Jumlah Muatan" value="<?php echo $jumlah_muatan; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Jumlah Asli <?php echo form_error('jumlah_asli'); ?></label>
                                    <input type="text" class="form-control" name="jumlah_asli" id="jumlah_asli" placeholder="Jumlah Asli" value="<?php echo $jumlah_asli; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Jumlah Bongkar <?php echo form_error('jumlah_bongkar'); ?></label>
                                    <input type="text" class="form-control" name="jumlah_bongkar" id="jumlah_bongkar" placeholder="Jumlah Bongkar" value="<?php echo $jumlah_bongkar; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Asal Barang <?php echo form_error('asal_barang'); ?></label>
                                    <input type="text" class="form-control" name="asal_barang" id="asal_barang" placeholder="Asal Barang" value="<?php echo $asal_barang; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Perusahaan <?php echo form_error('perusahaan'); ?></label>
                                    <input type="text" class="form-control" name="perusahaan" id="perusahaan" placeholder="Perusahaan" value="<?php echo $perusahaan; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Status <?php echo form_error('status'); ?></label>
                                    <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Permohonan Jenis <?php echo form_error('permohonan_jenis'); ?></label>
                                    <input type="text" class="form-control" name="permohonan_jenis" id="permohonan_jenis" placeholder="Permohonan Jenis" value="<?php echo $permohonan_jenis; ?>" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?=site_url('permohonan'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
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
jQuery('.mydatepicker').datepicker({
    maxViewMode: 2,
    todayBtn: "linked",
    clearBtn: true,
    language: "id",
    autoclose: true,
    todayHighlight: true
});
</script>