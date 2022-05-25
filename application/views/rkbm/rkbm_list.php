
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Rkbm</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("rkbm/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("rkbm/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("rkbm"); ?>" class="btn btn-default">Reset</a>
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
		<th>No Surat Rkbm</th>
		<th>Exp Id</th>
		<th>No Rkbm</th>
		<th>No Invoice</th>
		<th>Nama Kapal</th>
		<th>Bendera</th>
		<th>Ukuran</th>
		<th>Agen</th>
		<th>Bongkar</th>
		<th>Jumlah</th>
		<th>Jumlah Real</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Buruh</th>
		<th>Asal Brg</th>
		<th>Pemilik Brg</th>
		<th>Tujuan</th>
		<th>Jenis</th>
		<th>Loading</th>
		<th>Loading Detail</th>
		<th>Operasional</th>
		<th>Biaya Operasional</th>
		<th>Keterangan</th>
		<th>Status</th>
		<th>Tanggal</th>
		<th>Tanggal Invoice</th>
		<th>Tanggal Exp Invoice</th>
		<th>Tanggal Final</th>
		<th>Perusahaan</th>
		<th>Admin By</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($rkbm_data as $rkbm)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "no_surat_rkbm") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'no_surat_rkbm', $rkbm->no_surat_rkbm)->nama : $rkbm->no_surat_rkbm; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "exp_id") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'exp_id', $rkbm->exp_id)->nama : $rkbm->exp_id; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "no_rkbm") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'no_rkbm', $rkbm->no_rkbm)->nama : $rkbm->no_rkbm; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "no_invoice") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'no_invoice', $rkbm->no_invoice)->nama : $rkbm->no_invoice; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "nama_kapal") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'nama_kapal', $rkbm->nama_kapal)->nama : $rkbm->nama_kapal; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "bendera") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'bendera', $rkbm->bendera)->nama : $rkbm->bendera; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "ukuran") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'ukuran', $rkbm->ukuran)->nama : $rkbm->ukuran; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "agen") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'agen', $rkbm->agen)->nama : $rkbm->agen; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "bongkar") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'bongkar', $rkbm->bongkar)->nama : $rkbm->bongkar; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "jumlah") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'jumlah', $rkbm->jumlah)->nama : $rkbm->jumlah; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "jumlah_real") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'jumlah_real', $rkbm->jumlah_real)->nama : $rkbm->jumlah_real; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "mulai") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'mulai', $rkbm->mulai)->nama : $rkbm->mulai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "selesai") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'selesai', $rkbm->selesai)->nama : $rkbm->selesai; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "buruh") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'buruh', $rkbm->buruh)->nama : $rkbm->buruh; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "asal_brg") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'asal_brg', $rkbm->asal_brg)->nama : $rkbm->asal_brg; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "pemilik_brg") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'pemilik_brg', $rkbm->pemilik_brg)->nama : $rkbm->pemilik_brg; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "tujuan") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'tujuan', $rkbm->tujuan)->nama : $rkbm->tujuan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'jenis', $rkbm->jenis)->nama : $rkbm->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "loading") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'loading', $rkbm->loading)->nama : $rkbm->loading; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "loading_detail") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'loading_detail', $rkbm->loading_detail)->nama : $rkbm->loading_detail; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "operasional") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'operasional', $rkbm->operasional)->nama : $rkbm->operasional; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "biaya_operasional") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'biaya_operasional', $rkbm->biaya_operasional)->nama : $rkbm->biaya_operasional; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "keterangan") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'keterangan', $rkbm->keterangan)->nama : $rkbm->keterangan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'status', $rkbm->status)->nama : $rkbm->status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "tanggal") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'tanggal', $rkbm->tanggal)->nama : $rkbm->tanggal; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "tanggal_invoice") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'tanggal_invoice', $rkbm->tanggal_invoice)->nama : $rkbm->tanggal_invoice; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "tanggal_exp_invoice") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'tanggal_exp_invoice', $rkbm->tanggal_exp_invoice)->nama : $rkbm->tanggal_exp_invoice; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "tanggal_final") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'tanggal_final', $rkbm->tanggal_final)->nama : $rkbm->tanggal_final; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "perusahaan") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'perusahaan', $rkbm->perusahaan)->nama : $rkbm->perusahaan; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "admin_by") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'admin_by', $rkbm->admin_by)->nama : $rkbm->admin_by; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'created_at', $rkbm->created_at)->nama : $rkbm->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "rkbm", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'rkbm', 'updated_at', $rkbm->updated_at)->nama : $rkbm->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('rkbm/read/'.$rkbm->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('rkbm/update/'.$rkbm->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('rkbm/delete/'.$rkbm->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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