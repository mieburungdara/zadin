<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Tambah Operasional</h3>
    </div>
</div>
<div class="" style="min-height: calc(100vh - 180px);">
    <div class="tab-content">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <form action="<?=$action; ?>" method="post">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama <?php echo form_error('nama'); ?></label>
                                    <textarea class="form-control" rows="3" name="nama" id="nama" placeholder="Nama"><?php echo $nama; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan <?php echo form_error('keterangan'); ?></label>
                                    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="asal_barang">Asal Barang</label>
                                    <select class="custom-select mr-sm-2 wide" name="asal_barang" id="asal_barang" placeholder="Asal Barang">
                                        <?php
$asal = $this->db->get('barang_asal')->result();
foreach ($asal as $palu) {
    if ($palu->id == $asal_barang) {
        $selected = 'selected';
    } else {
        $selected = '';
    }
    echo "<option value='$palu->id' $selected>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="asal_barang">Pemilik Barang</label>
                                    <select class="custom-select mr-sm-2 wide" name="pemilik_barang" id="pemilik_barang" placeholder="Pemilik Barang">
                                        <?php
echo "<option value='0'>KOSONG</option>";
$pemilik = $this->db->get('barang_pemilik')->result();
foreach ($pemilik as $palu) {
    if ($palu->id == $pemilik_barang) {
        $selected = 'selected';
    } else {
        $selected = '';
    }

    echo "<option value='" . $palu->id . "' $selected>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="asal_barang">Perusahaan</label>
                                    <select class="custom-select mr-sm-2 wide" name="perusahaan" id="perusahaan" placeholder="Perusahaan">
                                        <?php
$perusahaan_list = $this->db->get('perusahaan')->result();
foreach ($perusahaan_list as $palu) {
    if ($palu->id == $perusahaan) {
        $selected = 'selected';
    } else {
        $selected = '';
    }

    echo "<option value='" . $palu->id . "' $selected>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-4">
                                    <label class="mr-sm-2 text-danger" for="operasional_status">Status Pembayaran</label>
                                    <select class="custom-select mr-sm-2" name="operasional_status" id="operasional_status" placeholder="Operasional Status">
                                        <?php
// var_dump($operasional_status);
$status_op = $this->db->get('operasional_status')->result();
foreach ($status_op as $palu) {
    if ($palu->id == $operasional_status) {
        $selected = 'selected';
    } else {
        $selected = '';
    }

    echo "<option value='" . $palu->id . "' $selected>" . $palu->nama . "</option>";
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><button type="submit" class="btn btn-info waves-effect waves-light">Save</button><a href="<?=site_url('operasional'); ?>" class="btn btn-dark waves-effect waves-light">Cancel</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>