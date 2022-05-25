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
        <h2 style="margin-top:0px">Rkbm Read</h2>
        <table class="table">
	    <tr><td>No Surat Rkbm</td><td><?php echo $no_surat_rkbm; ?></td></tr>
	    <tr><td>Exp Id</td><td><?php echo $exp_id; ?></td></tr>
	    <tr><td>No Rkbm</td><td><?php echo $no_rkbm; ?></td></tr>
	    <tr><td>No Invoice</td><td><?php echo $no_invoice; ?></td></tr>
	    <tr><td>Nama Kapal</td><td><?php echo $nama_kapal; ?></td></tr>
	    <tr><td>Bendera</td><td><?php echo $bendera; ?></td></tr>
	    <tr><td>Ukuran</td><td><?php echo $ukuran; ?></td></tr>
	    <tr><td>Agen</td><td><?php echo $agen; ?></td></tr>
	    <tr><td>Bongkar</td><td><?php echo $bongkar; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Jumlah Real</td><td><?php echo $jumlah_real; ?></td></tr>
	    <tr><td>Mulai</td><td><?php echo $mulai; ?></td></tr>
	    <tr><td>Selesai</td><td><?php echo $selesai; ?></td></tr>
	    <tr><td>Buruh</td><td><?php echo $buruh; ?></td></tr>
	    <tr><td>Asal Brg</td><td><?php echo $asal_brg; ?></td></tr>
	    <tr><td>Pemilik Brg</td><td><?php echo $pemilik_brg; ?></td></tr>
	    <tr><td>Tujuan</td><td><?php echo $tujuan; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Loading</td><td><?php echo $loading; ?></td></tr>
	    <tr><td>Loading Detail</td><td><?php echo $loading_detail; ?></td></tr>
	    <tr><td>Operasional</td><td><?php echo $operasional; ?></td></tr>
	    <tr><td>Biaya Operasional</td><td><?php echo $biaya_operasional; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Tanggal Invoice</td><td><?php echo $tanggal_invoice; ?></td></tr>
	    <tr><td>Tanggal Exp Invoice</td><td><?php echo $tanggal_exp_invoice; ?></td></tr>
	    <tr><td>Tanggal Final</td><td><?php echo $tanggal_final; ?></td></tr>
	    <tr><td>Perusahaan</td><td><?php echo $perusahaan; ?></td></tr>
	    <tr><td>Admin By</td><td><?php echo $admin_by; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('rkbm') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>