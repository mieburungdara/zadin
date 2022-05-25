
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Barang_asal</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("barang_asal/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("barang_asal/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("barang_asal"); ?>" class="btn btn-default">Reset</a>
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
		<th>Tarif Baru</th>
		<th>Tarif Perpanjang</th>
		<th>Tarif Revisi</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($barang_asal_data as $barang_asal)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'nama', $barang_asal->nama)->nama : $barang_asal->nama; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "alamat") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'alamat', $barang_asal->alamat)->nama : $barang_asal->alamat; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "sk_brg") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'sk_brg', $barang_asal->sk_brg)->nama : $barang_asal->sk_brg; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'npwp', $barang_asal->npwp)->nama : $barang_asal->npwp; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'jenis', $barang_asal->jenis)->nama : $barang_asal->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "pph") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'pph', $barang_asal->pph)->nama : $barang_asal->pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "total_pph") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'total_pph', $barang_asal->total_pph)->nama : $barang_asal->total_pph; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "unix") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'unix', $barang_asal->unix)->nama : $barang_asal->unix; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "data_status") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'data_status', $barang_asal->data_status)->nama : $barang_asal->data_status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "tarif_baru") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'tarif_baru', $barang_asal->tarif_baru)->nama : $barang_asal->tarif_baru; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "tarif_perpanjang") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'tarif_perpanjang', $barang_asal->tarif_perpanjang)->nama : $barang_asal->tarif_perpanjang; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "tarif_revisi") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'tarif_revisi', $barang_asal->tarif_revisi)->nama : $barang_asal->tarif_revisi; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'created_at', $barang_asal->created_at)->nama : $barang_asal->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "barang_asal", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'barang_asal', 'updated_at', $barang_asal->updated_at)->nama : $barang_asal->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('barang_asal/read/'.$barang_asal->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('barang_asal/update/'.$barang_asal->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('barang_asal/delete/'.$barang_asal->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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