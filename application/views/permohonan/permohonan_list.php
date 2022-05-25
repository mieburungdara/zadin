
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Permohonan</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("permohonan/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("permohonan/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("permohonan"); ?>" class="btn btn-default">Reset</a>
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
		<th>Parent</th>
		<th>Operasional</th>
		<th>No Rkbm</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Kapal</th>
		<th>Tempat Muat</th>
		<th>Barang</th>
		<th>Tempat Bongkar</th>
		<th>Jumlah Muatan</th>
		<th>Jumlah Asli</th>
		<th>Jumlah Bongkar</th>
		<th>Asal Barang</th>
		<th>Perusahaan</th>
		<th>Status</th>
		<th>Permohonan Jenis</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($permohonan_data as $permohonan)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "parent") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'parent', $permohonan->parent)->nama : $permohonan->parent; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "operasional") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'operasional', $permohonan->operasional)->nama : $permohonan->operasional; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "no_rkbm") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'no_rkbm', $permohonan->no_rkbm)->nama : $permohonan->no_rkbm; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "mulai") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'mulai', $permohonan->mulai)->nama : $permohonan->mulai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "selesai") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'selesai', $permohonan->selesai)->nama : $permohonan->selesai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "kapal") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'kapal', $permohonan->kapal)->nama : $permohonan->kapal; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "tempat_muat") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_muat', $permohonan->tempat_muat)->nama : $permohonan->tempat_muat; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "barang") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'barang', $permohonan->barang)->nama : $permohonan->barang; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "tempat_bongkar") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'tempat_bongkar', $permohonan->tempat_bongkar)->nama : $permohonan->tempat_bongkar; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "jumlah_muatan") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'jumlah_muatan', $permohonan->jumlah_muatan)->nama : $permohonan->jumlah_muatan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "jumlah_asli") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'jumlah_asli', $permohonan->jumlah_asli)->nama : $permohonan->jumlah_asli; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "jumlah_bongkar") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'jumlah_bongkar', $permohonan->jumlah_bongkar)->nama : $permohonan->jumlah_bongkar; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "asal_barang") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'asal_barang', $permohonan->asal_barang)->nama : $permohonan->asal_barang; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "perusahaan") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'perusahaan', $permohonan->perusahaan)->nama : $permohonan->perusahaan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'status', $permohonan->status)->nama : $permohonan->status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "permohonan", "permohonan_jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'permohonan', 'permohonan_jenis', $permohonan->permohonan_jenis)->nama : $permohonan->permohonan_jenis; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('permohonan/read/'.$permohonan->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('permohonan/update/'.$permohonan->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('permohonan/delete/'.$permohonan->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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