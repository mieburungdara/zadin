<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Perusahaan</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url("perusahaan/create"), "Tambah Data", "class='btn btn-info'"); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata("message") != "" ? $this->session->userdata("message") : ""; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        <form action="<?php echo site_url("perusahaan/index"); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
if ($q != "") {
    ?>
                                    <a href="<?php echo site_url("perusahaan"); ?>" class="btn btn-default">Reset</a>
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
                                <th>Inisial</th>
                                <th>Kop</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Pelabuhan</th>
                                <th>Sk Tuks</th>
                                <th>Npwp</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody class="border border-info"><?php
foreach ($perusahaan_data as $perusahaan) {
    ?>
                            <tr>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "inisial") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'inisial', $perusahaan->inisial)->nama : $perusahaan->inisial; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "kop") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'kop', $perusahaan->kop)->nama : $perusahaan->kop; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'nama', $perusahaan->nama)->nama : $perusahaan->nama; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "alamat") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'alamat', $perusahaan->alamat)->nama : $perusahaan->alamat; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "pelabuhan") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'pelabuhan', $perusahaan->pelabuhan)->nama : $perusahaan->pelabuhan; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "sk_tuks") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'sk_tuks', $perusahaan->sk_tuks)->nama : $perusahaan->sk_tuks; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "npwp") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'npwp', $perusahaan->npwp)->nama : $perusahaan->npwp; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'status', $perusahaan->status)->nama : $perusahaan->status; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "created_at") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'created_at', $perusahaan->created_at)->nama : $perusahaan->created_at; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "perusahaan", "updated_at") ? $this->Reza_model->get_ref_val($this->db->database, 'perusahaan', 'updated_at', $perusahaan->updated_at)->nama : $perusahaan->updated_at; ?></td>
                                <td style="text-align:center" width="200px">
                                    <?php

    echo anchor(site_url('perusahaan/update/' . $perusahaan->id), 'Ubah', 'class="btn btn-xs waves-effect waves-light btn-outline-warning"');
    echo ' | ';
    echo anchor(site_url('perusahaan/delete/' . $perusahaan->id), 'Hapus', 'class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"');
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