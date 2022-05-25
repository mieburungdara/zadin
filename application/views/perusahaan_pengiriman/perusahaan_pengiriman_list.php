
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Perusahaan_pengiriman</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("perusahaan_pengiriman/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("perusahaan_pengiriman/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("perusahaan_pengiriman"); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Alamat</th>
		<th>Sk</th>
		<th>Npwp</th>
		<th>Pph</th>
		<th>Total Pph</th>
		<th>Unix</th>
		<th>Status</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($perusahaan_pengiriman_data as $perusahaan_pengiriman)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'nama', $perusahaan_pengiriman->nama)->nama : $perusahaan_pengiriman->nama; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "alamat") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'alamat', $perusahaan_pengiriman->alamat)->nama : $perusahaan_pengiriman->alamat; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "sk") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'sk', $perusahaan_pengiriman->sk)->nama : $perusahaan_pengiriman->sk; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'npwp', $perusahaan_pengiriman->npwp)->nama : $perusahaan_pengiriman->npwp; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "pph") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'pph', $perusahaan_pengiriman->pph)->nama : $perusahaan_pengiriman->pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "total_pph") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'total_pph', $perusahaan_pengiriman->total_pph)->nama : $perusahaan_pengiriman->total_pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "unix") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'unix', $perusahaan_pengiriman->unix)->nama : $perusahaan_pengiriman->unix; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan_pengiriman", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan_pengiriman', 'status', $perusahaan_pengiriman->status)->nama : $perusahaan_pengiriman->status; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('perusahaan_pengiriman/read/'.$perusahaan_pengiriman->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('perusahaan_pengiriman/update/'.$perusahaan_pengiriman->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('perusahaan_pengiriman/delete/'.$perusahaan_pengiriman->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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