<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Barang_asal Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Sk Brg</td><td><?php echo $sk_brg; ?></td></tr>
	    <tr><td>Npwp</td><td><?php echo $npwp; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Pph</td><td><?php echo $pph; ?></td></tr>
	    <tr><td>Total Pph</td><td><?php echo $total_pph; ?></td></tr>
	    <tr><td>Unix</td><td><?php echo $unix; ?></td></tr>
	    <tr><td>Data Status</td><td><?php echo $data_status; ?></td></tr>
	    <tr><td>Tarif Baru</td><td><?php echo $tarif_baru; ?></td></tr>
	    <tr><td>Tarif Perpanjang</td><td><?php echo $tarif_perpanjang; ?></td></tr>
	    <tr><td>Tarif Revisi</td><td><?php echo $tarif_revisi; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang_asal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>