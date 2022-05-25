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
        <h2 style="margin-top:0px">Permohonan Read</h2>
        <table class="table">
	    <tr><td>Parent</td><td><?php echo $parent; ?></td></tr>
	    <tr><td>Operasional</td><td><?php echo $operasional; ?></td></tr>
	    <tr><td>No Rkbm</td><td><?php echo $no_rkbm; ?></td></tr>
	    <tr><td>Mulai</td><td><?php echo $mulai; ?></td></tr>
	    <tr><td>Selesai</td><td><?php echo $selesai; ?></td></tr>
	    <tr><td>Kapal</td><td><?php echo $kapal; ?></td></tr>
	    <tr><td>Tempat Muat</td><td><?php echo $tempat_muat; ?></td></tr>
	    <tr><td>Barang</td><td><?php echo $barang; ?></td></tr>
	    <tr><td>Tempat Bongkar</td><td><?php echo $tempat_bongkar; ?></td></tr>
	    <tr><td>Jumlah Muatan</td><td><?php echo $jumlah_muatan; ?></td></tr>
	    <tr><td>Jumlah Asli</td><td><?php echo $jumlah_asli; ?></td></tr>
	    <tr><td>Jumlah Bongkar</td><td><?php echo $jumlah_bongkar; ?></td></tr>
	    <tr><td>Asal Barang</td><td><?php echo $asal_barang; ?></td></tr>
	    <tr><td>Perusahaan</td><td><?php echo $perusahaan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Permohonan Jenis</td><td><?php echo $permohonan_jenis; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('permohonan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>