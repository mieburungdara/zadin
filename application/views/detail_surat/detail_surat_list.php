
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Detail_surat</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("detail_surat/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("detail_surat/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("detail_surat"); ?>" class="btn btn-default">Reset</a>
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
		<th>No</th>
		<th>Perusahaan</th>
		<th>Jenis</th>
		<th>Bulan</th>
		<th>Tahun</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($detail_surat_data as $detail_surat)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "no") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'no', $detail_surat->no)->nama : $detail_surat->no; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "perusahaan") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'perusahaan', $detail_surat->perusahaan)->nama : $detail_surat->perusahaan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'jenis', $detail_surat->jenis)->nama : $detail_surat->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "bulan") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'bulan', $detail_surat->bulan)->nama : $detail_surat->bulan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "tahun") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'tahun', $detail_surat->tahun)->nama : $detail_surat->tahun; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'created_at', $detail_surat->created_at)->nama : $detail_surat->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "detail_surat", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'detail_surat', 'updated_at', $detail_surat->updated_at)->nama : $detail_surat->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('detail_surat/read/'.$detail_surat->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('detail_surat/update/'.$detail_surat->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('detail_surat/delete/'.$detail_surat->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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