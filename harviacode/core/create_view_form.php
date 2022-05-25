<?php

$string = '';

$string .= '<div class="row page-titles">';
$string .= "\n\t" . '<div class="col-md-5 col-12 align-self-center">';
$string .= "\n\t" . '<h3 class="text-themecolor mb-0">Tambah ' . ucfirst($table_name) . '</h3>';
$string .= "\n\t" . '</div>';
$string .= "\n\t" . '</div>';

$string .= "\n\t" . '<div class="" style="min-height: calc(100vh - 180px);">';
$string .= "\n\t" . '<div class="tab-content">';
$string .= "\n\t" . '<div class="col-sm-12 col-lg-12">';
$string .= "\n\t" . '<div class="card">';
$string .= "\n\t" . '<form action="<?= $action ?>" method="post">';
$string .= "\n\t" . '<div class="card-body"><div class="row mt-3">';

foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text') {
        $string .= '<div class="col-sm-12 col-md-6">';
        $string .= "\n\t    <div class=\"form-group\">
            <label for=\"" . $row["column_name"] . "\">" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\"><?php echo $" . $row["column_name"] . "; ?></textarea>
        </div>";
        $string .= '</div>';
    } else {
        $string .= '<div class="col-sm-12 col-md-6">';
        $string .= "\n\t    <div class=\"form-group\">
            <label for=\"" . $row["data_type"] . "\">" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"" . label($row["column_name"]) . "\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
        </div>";
        $string .= '</div>';
    }
}

$string .= '<div class="card-body"><div class="action-form">';
$string .= ' <div class="form-group mb-0 text-right">';
$string .= '<input type="hidden" name="' . $pk . '" value="<?php echo $' . $pk . '; ?>"/>';
$string .= '<button type="submit" class="btn btn-info waves-effect waves-light">Save</button>';
$string .= '<a href="<?= site_url(\'' . $c_url . '\')?>" class="btn btn-dark waves-effect waves-light">Cancel</a>';
$string .= '</div>';
$string .= '</div></div>';
$string .= '</div></div>';
$string .= '</form>';
$string .= '</div>';
$string .= '</div>';
$string .= '</div>';
$string .= '</div>';

$hasil_view_form = createFile($string, $target . "views/" . $c_url . "/" . $v_form_file);
