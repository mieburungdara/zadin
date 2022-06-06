<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Tambah Terminal</h3>
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
                                    <label for="varchar">Nama <?php echo form_error('nama'); ?></label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">Lokasi <?php echo form_error('lokasi'); ?></label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">Pelabuhan <?php echo form_error('pelabuhan'); ?></label>
                                    <input type="text" class="form-control" name="pelabuhan" id="pelabuhan" placeholder="Pelabuhan" value="<?php echo $pelabuhan; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">Sk Tuks <?php echo form_error('sk_tuks'); ?></label>
                                    <input type="text" class="form-control" name="sk_tuks" id="sk_tuks" placeholder="Sk Tuks" value="<?php echo $sk_tuks; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">Npwp <?php echo form_error('npwp'); ?></label>
                                    <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jenis <?php echo form_error('jenis'); ?></label>
                                    <select class="custom-select mr-sm-2" name="jenis" id="jenis" placeholder="Jenis">
                                        <option disabled selected="">Pilih jenis terminal...</option>
                                        <option value="1" <?=$jenis == 1 ? "selected" : ''; ?>>Umum</option>
                                        <option value="2" <?=$jenis == 2 ? "selected" : ''; ?>>TUKS</option>
                                        <option value="3" <?=$jenis == 3 ? "selected" : ''; ?>>TERSUS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?=site_url('terminal'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>