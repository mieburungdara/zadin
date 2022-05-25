<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info Kapal</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url("kapal/create"), "Tambah Data Kapal", "class='btn btn-info'"); ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata("message") != "" ? $this->session->userdata("message") : ""; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        <form action="<?php echo site_url("kapal/index"); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
if ($q != "") {
    ?>
                                    <a href="<?php echo site_url("kapal"); ?>" class="btn btn-default">Reset</a>
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
                                <th>Agen Kapal</th>
                                <th>Bendera</th>
                                <th>Ukuran</th>
                                <th>Status</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody class="border border-info"><?php
$i = $start + 1;
foreach ($kapal_data as $kapal) {
    ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "kapal", "nama") ? $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'nama', $kapal->nama)->nama : $kapal->nama; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "kapal", "agen_kapal") ? $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'agen_kapal', $kapal->agen_kapal)->nama : $kapal->agen_kapal; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "kapal", "bendera") ? $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'bendera', $kapal->bendera)->nama : $kapal->bendera; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "kapal", "ukuran") ? $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'ukuran', $kapal->ukuran)->nama : $kapal->ukuran; ?></td>
                                <td><?php echo $this->Reza_model->show_ref($this->db->database, "kapal", "status") ? $this->Reza_model->get_ref_val($this->db->database, 'kapal', 'status', $kapal->status)->nama : $kapal->status; ?></td>
                                <td style="text-align:center" width="200px">
                                    <?php

    echo anchor(site_url('kapal/read/' . $kapal->id), 'Lihat', 'class="btn btn-xs waves-effect waves-light btn-outline-dark"');
    echo ' | ';
    echo anchor(site_url('kapal/update/' . $kapal->id), 'Ubah', 'class="btn btn-xs waves-effect waves-light btn-outline-warning"');
    echo ' | ';
    echo anchor(site_url('kapal/delete/' . $kapal->id), 'Hapus', 'class="btn btn-xs waves-effect waves-light btn-outline-danger" onclick="javasciprt: return confirm(\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\')"');
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