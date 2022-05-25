
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Barang_pemilik</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("barang_pemilik/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("barang_pemilik/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("barang_pemilik"); ?>" class="btn btn-default">Reset</a>
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
		<th>Data Status</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($barang_pemilik_data as $barang_pemilik)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'nama', $barang_pemilik->nama)->nama : $barang_pemilik->nama; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "alamat") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'alamat', $barang_pemilik->alamat)->nama : $barang_pemilik->alamat; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "sk_brg") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'sk_brg', $barang_pemilik->sk_brg)->nama : $barang_pemilik->sk_brg; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'npwp', $barang_pemilik->npwp)->nama : $barang_pemilik->npwp; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'jenis', $barang_pemilik->jenis)->nama : $barang_pemilik->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "pph") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'pph', $barang_pemilik->pph)->nama : $barang_pemilik->pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "total_pph") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'total_pph', $barang_pemilik->total_pph)->nama : $barang_pemilik->total_pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "unix") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'unix', $barang_pemilik->unix)->nama : $barang_pemilik->unix; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "data_status") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'data_status', $barang_pemilik->data_status)->nama : $barang_pemilik->data_status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'created_at', $barang_pemilik->created_at)->nama : $barang_pemilik->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_pemilik", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_pemilik', 'updated_at', $barang_pemilik->updated_at)->nama : $barang_pemilik->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('barang_pemilik/read/'.$barang_pemilik->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('barang_pemilik/update/'.$barang_pemilik->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('barang_pemilik/delete/'.$barang_pemilik->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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