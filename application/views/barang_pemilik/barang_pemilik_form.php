<div class="row mb-3  page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Tambah Pemilik Barang</h3>
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
                                    <label for="varchar">Alamat <?php echo form_error('alamat'); ?></label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="varchar">Sk Brg <?php echo form_error('sk_brg'); ?></label>
                                    <input type="text" class="form-control" name="sk_brg" id="sk_brg" placeholder="Sk Brg" value="<?php echo $sk_brg; ?>" />
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
                                    <label for="int">Pph <?php echo form_error('pph'); ?></label>
                                    <input type="text" class="form-control" name="pph" id="pph" placeholder="Pph" value="<?php echo $pph; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="int">Total Pph <?php echo form_error('total_pph'); ?></label>
                                    <input type="text" class="form-control" name="total_pph" id="total_pph" placeholder="Total Pph" value="<?php echo $total_pph; ?>" />
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="smallint">Unix <?php echo form_error('unix'); ?></label>
                                    <input type="text" class="form-control" name="unix" id="unix" placeholder="Unix" value="<?php echo $unix; ?>" />
                                </div>
                            </div> -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="data_status">Status <?php echo form_error('data_status'); ?></label>
                                    <select class="custom-select mr-sm-2" name="data_status" id="data_status" placeholder="Data Status">
                                        <option disabled selected="">Pilih...</option>
                                        <option value="1" <?=$data_status == 1 ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="2" <?=$data_status == 2 ? 'selected' : ''; ?>>Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?=site_url('barang_pemilik'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>