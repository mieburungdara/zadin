<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Transaksi</h4>
                <ul class="nav nav-tabs mb-3 row">
                    <li class="nav-item">
                        <a href="#tab-umum" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Umum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-invoice" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-operasional" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block">Operasional</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-pspk" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                            <span class="d-none d-lg-block text-bold">Pinjaman Sementara / Pembukuan Kembali</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="tab-umum">
                        <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-umum-modal-lg" data-jenis="umum"><i class="fa-duotone fa-plus"></i> Umum</button>
                        <div class="modal fade" id="bs-umum-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Transaksi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                        <code class="text-center"><p id="show_message" style="display: none">Transaksi ditambakan..</p></code>
                                        <code class="text-center"><p id="error" style="display: none"></p></code>
                                        <form action="javascript:void(0)" method="post" id="form-inventori">
                                            <div class="card-body">
                                                <div class="form-group row align-items-center mb-0" id='field_invoice'>
                                                    <label for="input_akun" class="col-md-3 text-right control-label col-form-label">Nomor Akun</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <select class="selectpicker" name="input_akun" id="input_akun" data-show-subtext="true" required>
                                                            <?php
// $this->db->where('kas_group', null);
// $fr = $this->db->get('akun_kelompok')->result();
// foreach ($fr as $row) {
//     echo '<optgroup label="(' . $row->id . ') ' . $row->nama . '">';
    // $this->db->where('kelompok', $row->id);
    $this->db->where('umum', 1);
    $fe = $this->db->get('akun_kode')->result();
    foreach ($fe as $de) {
        echo '<option data-subtext="' . $de->nama . '" value="' . $de->id . '">' . $de->id . '</option>';
    }
//     echo '</optgroup>';
// }
?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="input_tanggal" class="col-md-3 text-right control-label col-form-label">Tanggal</label>
                                                    <div class="col-md-4 border-left pb-2 pt-2">
                                                        <input type="text" autocomplete="off" required class="form-control" id="input_tp2" name="input_tanggal" placeholder="hari-bulan-tahun">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="nominal" class="col-md-3 text-right control-label col-form-label">Nominal</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input type="text" class="form-control masinput" name="nominal" required id="nominal" placeholder="Nominal" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label">Jenis</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input name="jenis_transaksi" value="1" type="radio" id="customControlValidation11" class="radio-col-red material-inputs">
                                                        <label for="customControlValidation11" class="mb-0 mt-2">Pendapatan</label>
                                                        <input name="jenis_transaksi" value="2" type="radio" id="customControlValidation22" class="radio-col-red material-inputs">
                                                        <label for="customControlValidation22" class="mb-0 mt-2">Pengeluaran</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label">Dana</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input name="dana" value="1" type="radio" id="customControlValidation33" class="radio-col-red material-inputs">
                                                        <label for="customControlValidation33" class="mb-0 mt-2">Kas</label>
                                                        <input name="dana" value="2" type="radio" id="customControlValidation44" class="radio-col-red material-inputs">
                                                        <label for="customControlValidation44" class="mb-0 mt-2">Bank</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="keterangan" class="col-md-3 text-right control-label col-form-label">Keterangan</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <textarea class="form-control" required id="keterangan" name="keterangan" required rows="3" placeholder="keterangan.."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="action-form">
                                                    <div class="form-group mb-0 text-right">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>

                    <div class="tab-pane" id="tab-invoice">
                        <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-inv-modal-lg" data-jenis="invoice"><i class="fa-duotone fa-plus"></i> Invoice</button>
                        <div class="modal fade" id="bs-inv-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Transaks1</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                        <code class="text-center"><p id="show_message" style="display: none">Transaksi ditambakan..</p></code>
                                        <code class="text-center"><p id="error" style="display: none"></p></code>
                                        <form action="javascript:void(0)" method="post" id="form-invoice">
                                            <div class="card-body">
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="input_inv" class="col-md-3 text-right control-label col-form-label">Nomor Invoice</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <select class="selectpicker" name="input_inv[]" id="input_inv" onchange="invoiceChange(this, event)" required multiple data-live-search="true">
                                                            <?php
// $this->db->where('id_transaksi', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $row) {
    echo '<option data-subtext="' . $row->nama . '" value="' . $row->id . '">' . $row->id . '</option>';
}
?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="input_tanggal" class="col-md-3 text-right control-label col-form-label">Tanggal</label>
                                                    <div class="col-md-4 border-left pb-2 pt-2">
                                                        <input type="text" autocomplete="off" required class="form-control" id="input_tp2" name="input_tanggal" placeholder="hari-bulan-tahun">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="tagihan" class="col-md-3 text-right control-label col-form-label">Tagihan</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input type="text" class="form-control masinput" name="tagihan" required id="tagihan" disabled placeholder="Tagihan Invoice" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="terbayar" class="col-md-3 text-right control-label col-form-label">Terbayar</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input type="text" class="form-control masinput" name="terbayar" required id="terbayar" placeholder="Invoice terbayar" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label">Jenis Transaksi</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input name="jenis_transaksi" value="1" type="radio" id="r2" class="radio-col-red material-inputs">
                                                        <label for="r2" class="mb-0 mt-2">Pendapatan</label>
                                                        <input name="jenis_transaksi" value="2" type="radio" required id="r1" class="radio-col-red material-inputs">
                                                        <label for="r1" class="mb-0 mt-2">Pengeluaran</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label"></label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <input name="dana" value="1" type="radio" id="r3" required class="radio-col-red material-inputs">
                                                        <label for="r3" class="mb-0 mt-2">Kas</label>
                                                        <input name="dana" value="2" type="radio" id="r4" class="radio-col-red material-inputs">
                                                        <label for="r4" class="mb-0 mt-2">Bank</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center mb-0">
                                                    <label for="keterangan" class="col-md-3 text-right control-label col-form-label">Keterangan</label>
                                                    <div class="col-md-9 border-left pb-2 pt-2">
                                                        <textarea class="form-control" required id="keterangan" name="keterangan" required rows="3" placeholder="keterangan.."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="action-form">
                                                    <div class="form-group mb-0 text-right">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-operasional">
                        <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-operasional-modal-lg" data-jenis="operasional"><i class="fa-duotone fa-plus"></i> Operasional</button>

                    </div>

                    <div class="tab-pane" id="tab-pspk">
                        <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-pspk-modal-lg" data-jenis="ps"><i class="fa-duotone fa-plus"></i> Pinjaman Sementara</button>
                        <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-pspk-modal-lg" data-jenis="pk"><i class="fa-duotone fa-plus"></i> Pembukuan Kembali</button>

                    </div>
                </div>




                <div class="text-left mb-3">
                    <button type="button" class="btn btn-info waves-effect waves-light btn-sm mb-2 text-right" data-toggle="modal" data-target="#bs-all-modal-lg">Transaksi Akun</button>
                </div>
                <div class="">
                    <table class="table mb-0 table-bordered" id="table-invoice">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">No</th>
                                <th scope="col" class="text-center" style="width: 8%;">Tanggal</th>
                                <th scope="col" class="text-center" style="width: 0%;">Reff</th>
                                <th scope="col" class="text-center" style="width: 0%;">Transaksi</th>
                                <th scope="col" class="text-left"style="width: 30%;">Keterangan</th>
                                <th scope="col" class="text-center"style="width: 0%;">Jenis</th>
                                <th scope="col" class="text-center"style="width: 0%;">Dana</th>
                                <th scope="col" class="text-right"style="width: 0%;">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width:7%;">Tgl</th>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-left">Keterangan</th>
                                    <th scope="col" class="text-right">Debit</th>
                                    <th scope="col" class="text-right">Kredit</th>
                                    <th scope="col" class="text-right">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

        <?php // XXX MODAL EXAMPLE  ; ?>
        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Verifikasi Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <code class="text-center"><p id="show_message" style="display: none">Invoice ebrhasil ditambakan..</p></code>
                        <code class="text-center">
                            <p id="error" style="display: none"></p>
                        </code>
                        <form action="javascript:void(0)" method="post" id="ajax-form">

                            <div class="card-body">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="input_inv" class="col-md-3 text-right control-label col-form-label">Nomor Invoice</label>
                                    <div class="col-md-9 border-left pb-2 pt-2">
                                        <select class="selectpicker" name="input_inv[]" id="input_inv" required multiple data-live-search="true">
                                            <?php
$this->db->where('id_transaksi', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $row) {
    echo '<option data-subtext="' . $row->nama . '" value="' . $row->id . '">' . $row->id . '</option>';
}
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="input_tp" class="col-md-3 text-right control-label col-form-label">Tanggal Pembayaran</label>
                                    <div class="col-md-4 border-left pb-2 pt-2">
                                        <input type="text" required class="form-control" id="input_tp" name="input_tanggal" placeholder="hari-bulan-tahun">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="input_keterangan" class="col-md-3 text-right control-label col-form-label">Keterangan</label>
                                    <div class="col-md-9 border-left pb-2 pt-2">
                                        <textarea class="form-control" required id="input_keterangan" name="input_keterangan" rows="3" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center mb-0">
                                    <label for="inputEmail3" class="col-md-3 text-right control-label col-form-label">Existing Customer</label>
                                    <div class="col-md-9 border-left pb-2 pt-2">
                                        <input name="input_pembayaran" value="kas" type="radio" id="customControlValidation2" class="radio-col-red material-inputs">
                                        <label for="customControlValidation2" class="mb-0 mt-2">Kas</label>
                                        <input name="input_pembayaran" value="bank" type="radio" id="customControlValidation3" class="radio-col-red material-inputs">
                                        <label for="customControlValidation3" class="mb-0 mt-2">Bank</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="action-form">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <?php // XXX MODAL ALL  ; ?>
    <div class="modal fade" id="bs-all-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <code class="text-center"><p id="show_message" style="display: none">Transaksi ditambakan..</p></code>
                    <code class="text-center"><p id="error" style="display: none"></p></code>
                    <form action="javascript:void(0)" method="post" id="form-inventori">
                        <div class="card-body">
                            <div class="form-group row align-items-center mb-0" id='field_umum'>
                                <label for="input_inv" class="col-md-3 text-right control-label col-form-label">Nomor Invoice</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <select class="selectpicker" name="input_inv[]" id="input_inv" required multiple data-live-search="true">
                                        <?php
$this->db->where('id_transaksi', null);
$fr = $this->db->get('operasional')->result();
foreach ($fr as $row) {
    echo '<option data-subtext="' . $row->nama . '" value="' . $row->id . '">' . $row->id . '</option>';
}
?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-0" id='field_operasional'>
                                <label for="input_op" class="col-md-3 text-right control-label col-form-label">Nomor Operasional</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <select class="selectpicker" name="input_op[]" id="input_op" required multiple>
                                        <?php
$fr = $this->db->query('select * from biaya_operasional where wait = 1 group by no_operasional')->result();
foreach ($fr as $row) {
    $this->db->where('id', $row->no_operasional);
    $dul = $this->db->get('operasional')->row();
    echo '<optgroup label="(' . $dul->id . ') ' . $dul->nama . '">';
    $this->db->where('wait', 1);
    $this->db->where('no_operasional', $dul->id);
    $nik = $this->db->get('biaya_operasional')->result();
    foreach ($nik as $nuk) {
        $this->db->where('id', $nuk->no_permohonan);
        $fu = $this->db->get('permohonan')->row();
        $this->db->where('id', $nuk->jenis_biaya);
        $ger = $this->db->get('jenis_biaya')->row();
        echo '<option data-subtext="<b>' . $ger->nama . '</b>[<code>' . number_format($nuk->biaya, 0, ',', '.') . '</code>] - ' . $fu->no_rkbm . '" value="' . $nuk->id . '">' . $ger->id . '</option>';
    }
    echo '</optgroup>';
}
?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-0" id='field_invoice'>
                                <label for="input_akun" class="col-md-3 text-right control-label col-form-label">Nomor Akun</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <select class="selectpicker" name="input_akun" id="input_akun" data-show-subtext="true" required>
                                        <?php
// $this->db->where('kas_group', null);
$fr = $this->db->get('akun_kelompok')->result();
foreach ($fr as $row) {
    echo '<optgroup label="(' . $row->id . ') ' . $row->nama . '">';
    $this->db->where('kelompok', $row->id);
    $fe = $this->db->get('akun_kode')->result();
    foreach ($fe as $de) {
        echo '<option data-subtext="' . $de->nama . '" value="' . $de->id . '">' . $de->kode . '</option>';
    }
    echo '</optgroup>';
}
?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-0">
                                <label for="input_tanggal" class="col-md-3 text-right control-label col-form-label">Tanggal</label>
                                <div class="col-md-4 border-left pb-2 pt-2">
                                    <input type="text" autocomplete="off" required class="form-control" id="input_tp2" name="input_tanggal" placeholder="hari-bulan-tahun">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-0">
                                <label for="nominal" class="col-md-3 text-right control-label col-form-label">Nominal</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <input type="text" class="form-control masinput" name="nominal" required id="nominal" placeholder="Nominal" value="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-0">
                                <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label">Jenis</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <input name="jenis_transaksi" value="in" type="radio" id="customControlValidation33" class="radio-col-red material-inputs">
                                    <label for="customControlValidation33" class="mb-0 mt-2">Pendapatan</label>
                                    <input name="jenis_transaksi" value="out" type="radio" id="customControlValidation22" class="radio-col-red material-inputs">
                                    <label for="customControlValidation22" class="mb-0 mt-2">Pengeluaran</label>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-0">
                                <label for="inputEmail4" class="col-md-3 text-right control-label col-form-label">Dana</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <input name="dana" value="kas" type="radio" id="customControlValidation22" class="radio-col-red material-inputs">
                                    <label for="customControlValidation22" class="mb-0 mt-2">Kas</label>
                                    <input name="dana" value="bank" type="radio" id="customControlValidation33" class="radio-col-red material-inputs">
                                    <label for="customControlValidation33" class="mb-0 mt-2">Bank</label>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-0">
                                <label for="keterangan" class="col-md-3 text-right control-label col-form-label">Keterangan</label>
                                <div class="col-md-9 border-left pb-2 pt-2">
                                    <textarea class="form-control" required id="keterangan" name="keterangan" required rows="3" placeholder="keterangan.."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dark waves-effect waves-light">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
</div>


<script>
// $(selector).filter('.class1.class2');

function invoiceChange(ele, event) {
    var val = $(ele).selectpicker('val');
    console.log(val);
    $.post("<?=base_url(); ?>transaksi/get_invoice", {
        name: val
    }, function(data, status) {
        console.log("Data: " + data + "\nStatus: " + status);
        $('#tagihan').val(data
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
        $('#terbayar').val(data
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
    });
}


jQuery('#input_tp').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy',
    todayHighlight: true
});
jQuery('#input_tp2').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy',
    todayHighlight: true
});

$('input.masinput').keyup(function(event) {
    if (event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
});

$(document).ready(function() {
    $('.page-wrapper').css("max-width", "100%");
});
</script>

<script>
$('select').selectpicker();

function sendFunc() {
    var value = $('select').selectpicker().val();
    // console.log(value);
    // $('.selectpicker').selectpicker('val', value);
}
</script>

<script>
//XXX FORM INVOICE
$(document).ready(function($) {
    // hide messages
    $("#error").hide();
    $("#show_message").hide();
    // on submit...
    $('#form-invoice').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var kode = $("input#input_kode").val();
        if (kode == "") {
            $("#error").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_kode").focus();
            return false;
        }
        var kelompok = $("select#input_inv").val();
        if (kelompok == "") {
            $("#error").fadeIn().text("Invoice tidak boleh kosong..");
            $("select#input_inv").focus();
            return false;
        }
        var name = $("input#input_name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nama tidak boleh kosong..");
            $("input#input_name").focus();
            return false;
        }

        // ajax
        $.ajax({
            type: "POST",
            url: "<?=base_url(); ?>transaksi/form_invoice",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});
//XXX FORM GENERAL
$(document).ready(function($) {
    // hide messages
    $("#error").hide();
    $("#show_message").hide();
    // on submit...
    $('#form-inventori').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var kode = $("input#input_kode").val();
        if (kode == "") {
            $("#error").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_kode").focus();
            return false;
        }
        var kelompok = $("select#input_kelompok").val();
        if (kelompok == "") {
            $("#error").fadeIn().text("Kelompok tidak boleh kosong..");
            $("select#input_kelompok").focus();
            return false;
        }
        var name = $("input#input_name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nama tidak boleh kosong..");
            $("input#input_name").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "http://localhost/zadin/transaksi/akun",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});

$(document).ready(function($) {
    // hide messages
    $("#error").hide();
    $("#show_message").hide();
    // on submit...
    $('#ajax-form').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var kode = $("input#input_kode").val();
        if (kode == "") {
            $("#error").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_kode").focus();
            return false;
        }
        var kelompok = $("select#input_kelompok").val();
        if (kelompok == "") {
            $("#error").fadeIn().text("Kelompok tidak boleh kosong..");
            $("select#input_kelompok").focus();
            return false;
        }
        var name = $("input#input_name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nama tidak boleh kosong..");
            $("input#input_name").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "http://localhost/zadin/transaksi/invoice",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});

$(document).ready(function($) {
    // hide messages
    // $("#error").hide();
    // $("#show_message").hide();
    // on submit...
    $('#form-transaksi-akun').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var input_tp2_akun = $("input#input_tp2_akun").val();
        if (input_tp2_akun == "") {
            $("#error_transaksi_akun").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_tp2_akun").focus();
            return false;
        }
        var input_keterangan_transaksi_akun = $("input#input_keterangan_transaksi_akun").val();
        if (input_keterangan_transaksi_akun == "") {
            $("#error_transaksi_akun").fadeIn().text("Kode tidak boleh kosong..");
            $("input#input_keterangan_transaksi_akun").focus();
            return false;
        }
        var input_transaksi_akun = $("select#input_transaksi_akun").val();
        if (input_transaksi_akun == "") {
            $("#error_transaksi_akun").fadeIn().text("Kelompok tidak boleh kosong..");
            $("select#input_transaksi_akun").focus();
            return false;
        }
        // var name = $("input#input_name").val();
        // if (name == "") {
        //     $("#error_transaksi_akun").fadeIn().text("Nama tidak boleh kosong..");
        //     $("input#input_name").focus();
        //     return false;
        // }
        // ajax
        $.ajax({
            type: "POST",
            url: "http://localhost/zadin/transaksi/akun_input",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});

$(document).ready(function($) {
    // hide messages
    // $("#error").hide();
    // $("#show_message").hide();
    // on submit...
    $('#form-inventori').submit(function(e) {
        e.preventDefault();
        $("#error").hide();
        var jb = $("input#jb").val();
        if (jb == "") {
            $("input#jb").focus();
            return false;
        }
        var hs = $("input#hs").val();
        if (hs == "") {
            $("input#hs").focus();
            return false;
        }
        var input_tanggal = $("input#input_tanggal").val();
        if (input_tanggal == "") {
            $("input#input_tanggal").focus();
            return false;
        }
        var input_keterangan = $("input#input_keterangan").val();
        if (input_keterangan == "") {
            $("input#input_keterangan").focus();
            return false;
        }
        var input_akun = $("select#input_akun").val();
        if (input_transaksi_akun == "") {
            $("select#input_transaksi_akun").focus();
            return false;
        }
        $.ajax({
            type: "POST",
            url: "http://localhost/zadin/transaksi/inventori_input",
            data: $(this).serialize(), // get all form field value in serialize form
            // success: function() {
            // 	$("#show_message").fadeIn();
            // 	//$("#ajax-form").fadeOut();
            // }
            success: function(data) {
                var xhr = jQuery.parseJSON(data);
                console.log(xhr.status);
                if (xhr.status == 'ok') {
                    $("#show_message").fadeIn();
                    $("#show_message").text('Berhasil Menambahkan Akun group');
                    location.reload();
                } else {
                    $("#show_message").fadeIn();
                    $("#show_message").text(xhr.data.message);
                    // console.log("ERROR : ", e);
                }
                // console.log(data.status);
                // $("#btnSubmit").prop("disabled", false);

            },
            error: function(e) {

                // $("#btnSubmit").prop("disabled", false);

            }
        });
    });
    return false;
});




$(document).ready(function($) {
    $(function() {
        var t = $('#table-invoice').DataTable({
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip({
                    container: 'body'
                });
            },
            searching: false,
            ordering: false,
            processing: true,
            responsive: false,
            "language": {
                "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
                "search": "Pencarian:",
                "zeroRecords": "Tidak ditemukan - sorry",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data ditemukan",
                "infoFiltered": "(Disaring dari _MAX_ data)"
            },
            "columnDefs": [{
                "className": "dt-center",
                "targets": [0, 1, 2],
            }, {
                "className": "dt-left",
                "targets": [4],
            }],
            serverSide: true,
            ajax: {
                'url': "<?=base_url(); ?>transaksi/load_transaksi",
                'type': 'post',
                'data': function(d) {
                    // d.bulan = $('input[name=bulan]').val();
                    // d.tahun = $('input[name=tahun]').val();
                    // d.perusahaan = $('select[name=perusahaan]').val();
                    // d.status = $('select[name=status]').val();
                },
            },
            "columns": [{
                    data: "no",
                },
                {
                    data: "tanggal",
                },
                {
                    data: "no_akun",
                },
                {
                    data: "transaksi",
                    className: "text-center",
                },
                {
                    data: "keterangan",
                },
                {
                    data: "jenis",
                    className: "text-center",
                },
                {
                    data: "dana",
                    className: "text-center",
                },
                {
                    data: "nominal",
                    className: "text-right",
                },
            ]
        });

        $('#bulan').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });

        $('#tahun').on('change', function(e) {
            t.draw();
            e.preventDefault();
        });

        // $('#perusahaan').on('change', function(e) {
        //     t.draw();
        //     e.preventDefault();
        // });
        // $('#status').on('change', function(e) {
        //     t.draw();
        //     e.preventDefault();
        // });

        t.on('xhr', function(e, settings, json) {
            //     var month = json.month;
            //     var year = json.year;
            //     var perusahaan = json.perusahaan;
            //     if (perusahaan == 0) {
            //         // $("#cetaks2").attr("href", '#')
            //         // $("#cetaks").attr("href", '#')

            //         alert('kosong');

            //     } else {
            //         // alert('ok');
            //         // $("#cetaks2").attr("href", 'https://zadin.co.id/admin/laporan/cetak/'+month+'/'+year+'/'+perusahaan)
            //         // $("#cetaks").attr("href", 'https://zadin.co.id/admin/laporan/cetak/data/'+month+'/'+year+'/'+perusahaan)
            //     }
        });

    });
});
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="<?=base_url(); ?>assets/libs/jquery-kk-message/message.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>