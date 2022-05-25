
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Rkbm_detail</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("rkbm_detail/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("rkbm_detail/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("rkbm_detail"); ?>" class="btn btn-default">Reset</a>
        <?php
                        }
                    ?>
        <button class="btn btn-info" type="submit">Search</button>
    </span>
</div>
</form>
</div>
</div>



    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-info text-white">
                <tr>
		<th>Rkbm Id</th>
		<th>No</th>
		<th>Price</th>
		<th>Price Other</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Status</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($rkbm_detail_data as $rkbm_detail)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "rkbm_id") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'rkbm_id', $rkbm_detail->rkbm_id)->nama : $rkbm_detail->rkbm_id; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "no") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'no', $rkbm_detail->no)->nama : $rkbm_detail->no; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "price") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'price', $rkbm_detail->price)->nama : $rkbm_detail->price; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "price_other") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'price_other', $rkbm_detail->price_other)->nama : $rkbm_detail->price_other; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "mulai") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'mulai', $rkbm_detail->mulai)->nama : $rkbm_detail->mulai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "selesai") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'selesai', $rkbm_detail->selesai)->nama : $rkbm_detail->selesai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'status', $rkbm_detail->status)->nama : $rkbm_detail->status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'created_at', $rkbm_detail->created_at)->nama : $rkbm_detail->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm_detail", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm_detail', 'updated_at', $rkbm_detail->updated_at)->nama : $rkbm_detail->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('rkbm_detail/read/'.$rkbm_detail->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('rkbm_detail/update/'.$rkbm_detail->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('rkbm_detail/delete/'.$rkbm_detail->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
				?>
			</td></tr><?php } ?></tbody>
        </table>
    </div><div class="row">
        <div class="col-md-6">
            <span class="btn btn-info">Jumlah Data <span class="badge badge-light"><?php echo $total_rows ?></span></span>
	
        </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>
    </div>
</div>
</div>
</div>
</div>