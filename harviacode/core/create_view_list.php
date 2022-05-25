<?php

$string = '
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Info ' . ucfirst($table_name) . '</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
<div class="col-12">
<div class="card">
<div class="card-body">
    <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url("' . $c_url . '/create"), "Tambah Data", "class=\'btn btn-info\'"); ?>
</div>
<div class="col-md-4 text-center">
<div style="margin-top: 8px" id="message">
<?php echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>
</div>
</div>
<div class="col-md-1 text-right">
</div>
<div class="col-md-3 text-right">
<form action="<?php echo site_url("' . $c_url . '/index"); ?>" class="form-inline" method="get">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
    <span class="input-group-btn">
        <?php
                        if ($q <> "")
                        {
                            ?>
        <a href="<?php echo site_url("' . $c_url . '"); ?>" class="btn btn-default">Reset</a>
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
                <tr>';
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Operasi</th>";
$string .= '
                </tr>
            </thead>
            <tbody class="border border-info">';
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";
foreach ($non_pk as $row) {
    // $string .= "\n\t\t\t<td><?php echo $" . $c_url . "->" . $row['column_name'] . " ?\></td>";
    $string .= "\n\t\t\t<td><?php echo " . '$this->Reza_model->show_ref($this->db->database, "' . $c_url . '", "' . $row["column_name"] . '")' . " ? " . '$this->Reza_model->get_ref_val($this->db->database, ' . "'" . $c_url . "', '" . $row['column_name'] . "', $" . $c_url . "->" . $row['column_name'] . ")->nama : $" . $c_url . "->" . $row['column_name'] . "; ?></td>";
}

$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
    . "\n\t\t\t\t<?php "
    . "\n\t\t\t\techo anchor(site_url('" . $c_url . "/read/'.$" . $c_url . "->" . $pk . "),'Lihat','class=\"btn btn-xs waves-effect waves-light btn-outline-dark\"'); "
    . "\n\t\t\t\techo ' | '; "
    . "\n\t\t\t\techo anchor(site_url('" . $c_url . "/update/'.$" . $c_url . "->" . $pk . "),'Ubah','class=\"btn btn-xs waves-effect waves-light btn-outline-warning\"'); "
    . "\n\t\t\t\techo ' | '; "
    . "\n\t\t\t\techo anchor(site_url('" . $c_url . "/delete/'.$" . $c_url . "->" . $pk . "),'Hapus','class=\"btn btn-xs waves-effect waves-light btn-outline-danger\" onclick=\"javasciprt: return confirm(\\'Apa kamu yakin? Data yg terhapus tidak dapat dikembalikan!!\\')\"'); "
    . "\n\t\t\t\t?>"
    . "\n\t\t\t</td>";
$string .= '</tr><?php } ?></tbody>
        </table>
    </div>';
$string .= "<div class=\"row\">
        <div class=\"col-md-6\">
            <span class=\"btn btn-info\">Jumlah Data <span class=\"badge badge-light\"><?php echo \$total_rows ?></span></span>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('" . $c_url . "/excel'), 'Excel', 'class=\"btn btn-info\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('" . $c_url . "/word'), 'Word', 'class=\"btn btn-info\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('" . $c_url . "/pdf'), 'PDF', 'class=\"btn btn-info\"'); ?>";
}
$string .= "\n\t
        </div>
        <div class=\"col-md-6 text-right\">
            <?php echo \$pagination ?>
        </div>
    </div>";
$string .= '
</div>
</div>
</div>
</div>';

$hasil_view_list = createFile($string, $target . "views/" . $c_url . "/" . $v_list_file);
