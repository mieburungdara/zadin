<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
	<h3 class="text-themecolor mb-0">Tambah Perusahaan</h3>
	</div>
	</div>
	<div class="" style="min-height: calc(100vh - 180px);">
	<div class="tab-content">
	<div class="col-sm-12 col-lg-12">
	<div class="card">
	<form action="<?= $action ?>" method="post">
	<div class="card-body"><div class="row mt-3"><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Inisial <?php echo form_error('inisial') ?></label>
            <input type="text" class="form-control" name="inisial" id="inisial" placeholder="Inisial" value="<?php echo $inisial; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Kop <?php echo form_error('kop') ?></label>
            <input type="text" class="form-control" name="kop" id="kop" placeholder="Kop" value="<?php echo $kop; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Pelabuhan <?php echo form_error('pelabuhan') ?></label>
            <input type="text" class="form-control" name="pelabuhan" id="pelabuhan" placeholder="Pelabuhan" value="<?php echo $pelabuhan; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Sk Tuks <?php echo form_error('sk_tuks') ?></label>
            <input type="text" class="form-control" name="sk_tuks" id="sk_tuks" placeholder="Sk Tuks" value="<?php echo $sk_tuks; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="varchar">Npwp <?php echo form_error('npwp') ?></label>
            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="tinyint">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div></div><div class="card-body"><div class="action-form"> <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>"/><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?= site_url('perusahaan')?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div></div></div></div></div></form></div></div></div></div>