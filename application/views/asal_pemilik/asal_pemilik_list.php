
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Asal_pemilik</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("asal_pemilik/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("asal_pemilik/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("asal_pemilik"); ?>" class="btn btn-default">Reset</a>
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
		<th>Sk Brg</th>
		<th>Npwp</th>
		<th>Jenis</th>
		<th>Pph</th>
		<th>Total Pph</th>
		<th>Unix</th>
		<th>Status</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($asal_pemilik_data as $asal_pemilik)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'nama', $asal_pemilik->nama)->nama : $asal_pemilik->nama; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "alamat") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'alamat', $asal_pemilik->alamat)->nama : $asal_pemilik->alamat; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "sk_brg") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'sk_brg', $asal_pemilik->sk_brg)->nama : $asal_pemilik->sk_brg; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'npwp', $asal_pemilik->npwp)->nama : $asal_pemilik->npwp; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'jenis', $asal_pemilik->jenis)->nama : $asal_pemilik->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "pph") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'pph', $asal_pemilik->pph)->nama : $asal_pemilik->pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "total_pph") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'total_pph', $asal_pemilik->total_pph)->nama : $asal_pemilik->total_pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "unix") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'unix', $asal_pemilik->unix)->nama : $asal_pemilik->unix; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'status', $asal_pemilik->status)->nama : $asal_pemilik->status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'created_at', $asal_pemilik->created_at)->nama : $asal_pemilik->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "asal_pemilik", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'asal_pemilik', 'updated_at', $asal_pemilik->updated_at)->nama : $asal_pemilik->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('asal_pemilik/read/'.$asal_pemilik->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('asal_pemilik/update/'.$asal_pemilik->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('asal_pemilik/delete/'.$asal_pemilik->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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