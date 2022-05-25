<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Terminal</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url("terminal/create"), "Tambah Data", "class='btn btn-info'"); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata("message") != "" ? $this->session->userdata("message") : ""; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        <form action="<?php echo site_url("terminal/index"); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
if ($q != "") {
    ?>
                                    <a href="<?php echo site_url("terminal"); ?>" class="btn btn-default">Reset</a>
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
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Pelabuhan</th>
                                <th>Sk Tuks</th>
                                <th>Npwp</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Status</th>
                                <!-- <th>Created At</th>
                                <th>Updated At</th> -->
                                <th class="text-center">Operasi</th>
                            </tr>
                        </thead>
                        <tbody class="border border-info"><?php
$i = $start + 1;
foreach ($terminal_data as $terminal) {
    ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "terminal", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'nama', $terminal->nama)->nama : $terminal->nama; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "terminal", "lokasi") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'lokasi', $terminal->lokasi)->nama : $terminal->lokasi; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "terminal", "pelabuhan") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'pelabuhan', $terminal->pelabuhan)->nama : $terminal->pelabuhan; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "terminal", "sk_tuks") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'sk_tuks', $terminal->sk_tuks)->nama : $terminal->sk_tuks; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "terminal", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'npwp', $terminal->npwp)->nama : $terminal->npwp; ?></td>
                                <td class="text-center"><?php $jenis = $this->Reza_model->show_ref($this->db->database, "terminal", "jenis") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'jenis', $terminal->jenis)->nama : $terminal->jenis;
    echo '<span class="badge badge-info">' . strtoupper($jenis) . '</span>'; ?></td>
                                <td class="text-center">
                                    <?php
$status_values = array(
        1 => 'Aktif',
        2 => 'Non-Aktif',
    );
    foreach ($status_values as $value => $display_text) {
        if ($value == $terminal->status) {
            $selected = ($value == $terminal->status) ? 'info' : 'danger';
            echo '<span class="badge badge-' . $selected . '">' . strtoupper($display_text) . '</span>';
        }
    }
    ?>
                                </td>
                                <!-- <td><?php// echo $this->Reza_model->show_ref($this->db->database, "terminal", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'created_at', $terminal->created_at)->nama : $terminal->created_at; ?></td> -->
                                <!-- <td><?php// echo $this->Reza_model->show_ref($this->db->database, "terminal", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'terminal', 'updated_at', $terminal->updated_at)->nama : $terminal->updated_at; ?></td> -->
                                <td style="text-align:center" width="200px">
                                    <?php
echo anchor(site_url('terminal/update/' . $terminal->id), 'Ubah', 'class="btn btn-xs waves-effect waves-light btn-outline-warning"');
    echo ' | ';
    echo anchor(site_url('terminal/delete/' . $terminal->id), 'Hapus', 'class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"');
    ?>
                                </td>
                            </tr><?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span class="btn btn-info">Jumlah Data <span class="badge badge-light"><?php echo $total_rows; ?></span></span>

                    </div>
                    <div class="col-md-6 text-right">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>