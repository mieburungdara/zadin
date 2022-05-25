<div class="row page-titles">
	<div class="col-md-5 col-12 align-self-center">
	<h3 class="text-themecolor mb-0">Tambah Operasional</h3>
	</div>
	</div>
	<div class="" style="min-height: calc(100vh - 180px);">
	<div class="tab-content">
	<div class="col-sm-12 col-lg-12">
	<div class="card">
	<form action="<?= $action ?>" method="post">
	<div class="card-body"><div class="row mt-3"><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="nama">Nama <?php echo form_error('nama') ?></label>
            <textarea class="form-control" rows="3" name="nama" id="nama" placeholder="Nama"><?php echo $nama; ?></textarea>
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div></div><div class="col-sm-12 col-md-6">
	    <div class="form-group">
            <label for="int">Operasional Status <?php echo form_error('operasional_status') ?></label>
            <input type="text" class="form-control" name="operasional_status" id="operasional_status" placeholder="Operasional Status" value="<?php echo $operasional_status; ?>" />
        </div></div><div class="card-body"><div class="action-form"> <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>"/><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?= site_url('operasional')?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div></div></div></div></div></form></div></div></div></div>