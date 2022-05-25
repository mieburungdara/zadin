
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Admin</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("admin/create"), "Tambah Data", "class='btn btn-info'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("admin/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("admin"); ?>" class="btn btn-default">Reset</a>
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
		<th>Username</th>
		<th>Password</th>
		<th>Jenis</th>
		<th>Status</th>
		<th>Plain</th>
		<th>Last Login</th>
		<th>Remember Token</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Operasi</th>
                </tr>
            </thead>
            <tbody class="border border-info"><?php
            foreach ($admin_data as $admin)
            {
                ?>
                <tr>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'nama', $admin->nama)->nama : $admin->nama; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "username") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'username', $admin->username)->nama : $admin->username; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "password") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'password', $admin->password)->nama : $admin->password; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'jenis', $admin->jenis)->nama : $admin->jenis; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'status', $admin->status)->nama : $admin->status; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "plain") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'plain', $admin->plain)->nama : $admin->plain; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "last_login") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'last_login', $admin->last_login)->nama : $admin->last_login; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "remember_token") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'remember_token', $admin->remember_token)->nama : $admin->remember_token; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'created_at', $admin->created_at)->nama : $admin->created_at; ?></td>
			<td><?php echo $this->Reza_model->show_ref($this->db->database, "admin", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'admin', 'updated_at', $admin->updated_at)->nama : $admin->updated_at; ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('admin/read/'.$admin->id),'Lihat','class="btn btn-xs waves-effect waves-light btn-outline-dark"'); 
				echo ' | '; 
				echo anchor(site_url('admin/update/'.$admin->id),'Ubah','class="btn btn-xs waves-effect waves-light btn-outline-warning"'); 
				echo ' | '; 
				echo anchor(site_url('admin/delete/'.$admin->id),'Hapus','class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"'); 
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