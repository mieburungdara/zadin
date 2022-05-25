<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
	<h3 class="text-themecolor mb-0">Tambah Rkbm_detail</h3>
	</div>
	</div>
	<div class="" style="min-height: calc(100vh - 180px);">
	<div class="tab-content">
	<div class="col-sm-12 col-lg-12">
	<div class="card">
	<form action="<?= $action ?>" method="post">
	<div class="card-body"><div class="row mt-3"><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">Rkbm Id <?php echo form_error('rkbm_id') ?></label>
            <input type="text" class="form-control" name="rkbm_id" id="rkbm_id" placeholder="Rkbm Id" value="<?php echo $rkbm_id; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">No <?php echo form_error('no') ?></label>
            <input type="text" class="form-control" name="no" id="no" placeholder="No" value="<?php echo $no; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">Price <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">Price Other <?php echo form_error('price_other') ?></label>
            <input type="text" class="form-control" name="price_other" id="price_other" placeholder="Price Other" value="<?php echo $price_other; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="date">Mulai <?php echo form_error('mulai') ?></label>
            <input type="text" class="form-control" name="mulai" id="mulai" placeholder="Mulai" value="<?php echo $mulai; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="date">Selesai <?php echo form_error('selesai') ?></label>
            <input type="text" class="form-control" name="selesai" id="selesai" placeholder="Selesai" value="<?php echo $selesai; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div></div><div class="card-body"><div class="action-form"> <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>"/><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?= site_url('rkbm_detail')?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div></div></div></div></div></form></div></div></div></div>