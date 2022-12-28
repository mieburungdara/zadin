<div class="col-12 mt-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Laporan Laba Rugi </h4>


            <form action="<?=base_url(); ?>laporan/labarugi" method="post">
                <div class="row mb-3  noprint">
                    <?php

$total_semuanya = 0;
$nahun          = $this->input->post('post_tahun');
$nulan          = $this->input->post('post_bulan');
?>


                    <div class="col-2">
                        <label class="">Bulan</label>
                        <div class="">
                            <select name="post_bulan" class="form-control form-control-line">
                                <option <?=$nulan == 1 ? 'selected' : ''; ?> value="1">Januari </option>
                                <option <?=$nulan == 2 ? 'selected' : ''; ?> value="2">Februari </option>
                                <option <?=$nulan == 3 ? 'selected' : ''; ?> value="3">Maret </option>
                                <option <?=$nulan == 4 ? 'selected' : ''; ?> value="4">April </option>
                                <option <?=$nulan == 5 ? 'selected' : ''; ?> value="5">Mei </option>
                                <option <?=$nulan == 6 ? 'selected' : ''; ?> value="6">Juni </option>
                                <option <?=$nulan == 7 ? 'selected' : ''; ?> value="7">Juli </option>
                                <option <?=$nulan == 8 ? 'selected' : ''; ?> value="8">Agustus </option>
                                <option <?=$nulan == 9 ? 'selected' : ''; ?> value="9">September </option>
                                <option <?=$nulan == 10 ? 'selected' : ''; ?> value="10">Oktober </option>
                                <option <?=$nulan == 11 ? 'selected' : ''; ?> value="11">November </option>
                                <option <?=$nulan == 12 ? 'selected' : ''; ?> value="12">Desember </option>
                                <option <?=$nulan == 13 ? 'selected' : ''; ?> value="13">Januari Februari Maret</option>
                                <option <?=$nulan == 14 ? 'selected' : ''; ?> value="14">April Mei Juni</option>
                                <option <?=$nulan == 15 ? 'selected' : ''; ?> value="15">Juli Agustus September</option>
                                <option <?=$nulan == 16 ? 'selected' : ''; ?> value="16">Oktober November Desember</option>
                                <option <?=$nulan == 17 ? 'selected' : ''; ?> value="17">Semua</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="">Tahun</label>
                        <div class="">
                            <select name="post_tahun" class="form-control form-control-line">
                                <option <?=$nahun == 2021 ? 'selected' : ''; ?> value="2021">2021</option>
                                <option <?=$nahun == 2022 ? 'selected' : ''; ?> value="2022">2022</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" name="filter" value="1" class="btn mt-4 btn-sm btn-success waves-effect waves-light mr-2">Filter</button>
                        <button type="submit" name="cetak" value="1" class="btn mt-4 btn-sm btn-success waves-effect waves-light mr-2">Cetak</button>
                    </div>
                </div>
            </form>




            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-uppercase"><b>Pendapatan</b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
$this->db->where('lr', 'pendapatan_usaha');
$gg  = $this->db->get('akun_kode')->result();
$did = [];
foreach ($gg as $ff) {
    $did[] += $ff->id;
}
$this->db->order_by('tanggal', 'asc');
if ($nahun) {
    $this->db->where('YEAR(tanggal)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(tanggal)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}

$this->db->where_in('akun_kode', $did);
$cot = $this->db->get('transaksi')->result();
// pre($cot);
$inpois_terbayar = 0;
foreach ($cot as $cut) {
    $inpois_terbayar += $cut->terbayar;
}

$this->db->where('lr', 'pendapatan_diluar_usaha');
$gg  = $this->db->get('akun_kode')->result();
$did = [];
foreach ($gg as $ff) {
    $did[] += $ff->id;
}
$this->db->order_by('tanggal', 'asc');
if ($nahun) {
    $this->db->where('YEAR(tanggal)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(tanggal)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}

$this->db->where_in('akun_kode', $did);
$cot = $this->db->get('transaksi')->result();
// pre($cot);
$pdu = 0;
foreach ($cot as $cut) {
    $pdu += $cut->terbayar;
}

$this->db->where('lr', 'pendapatan_lainya');
$gg  = $this->db->get('akun_kode')->result();
$did = [];
foreach ($gg as $ff) {
    $did[] += $ff->id;
}
$this->db->order_by('tanggal', 'asc');
if ($nahun) {
    $this->db->where('YEAR(tanggal)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(tanggal)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}
$cot = array();
$this->db->where_in('akun_kode', $did);
$cot = $this->db->get('transaksi') ? $this->db->get('transaksi')->result() : [];
// $cot =
// pre($cot->result());
$pdl = 0;
if ($cot) {
    foreach ($cot->result() as $cut) {
        $pdl += $cut->terbayar;
    }
}

; // echo $inpois_terbayar; ?>
                    <tr>
                        <td>Pendapatan Usaha</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;"><?=number_format($inpois_terbayar, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                    </tr>
                    <?php if ($pdu) {
    ?>
                    <tr>
                        <td>Pendapatan diluar usaha</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;"><?=number_format($pdu, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                    </tr>
                    <?php
}
?>
                    <?php if ($pdl) {
    ?>
                    <tr>
                        <td>Pendapatan lain-lain / Bunga bank</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;"><?=number_format($pdl, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                    </tr>
                    <?php
}
?>
                    <tr>
                        <td></td>
                        <td>
                            <div style="border-top: 2px solid black;"></div>
                        </td>
                        <td></td>
                    </tr>
                    <?php
$total_pendapatan = $inpois_terbayar;
// $total_semuanya += $total_pendapatan; ?>
                    <tr>
                        <td class="text-center"><b>Total Pendapatan</b></td>
                        <td></td>
                        <td>
                            <b>
                                <div style="float:left;text-align:left;">Rp.</div>
                                <div style="float:right;text-align:right;"><?=number_format($total_pendapatan = $total_pendapatan + $pdu + $pdl, 0, ',', '.'); ?></div>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="text-uppercase"><b>Biaya Operasional</b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php

$total_bo = 0;
$this->db->order_by('created_at', 'asc');
if ($nahun) {
    $this->db->where('YEAR(created_at)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(created_at)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(created_at) >=', 1);
    $this->db->where('MONTH(created_at) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(created_at) >=', 4);
    $this->db->where('MONTH(created_at) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(created_at) >=', 7);
    $this->db->where('MONTH(created_at) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(created_at) >=', 10);
    $this->db->where('MONTH(created_at) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(created_at) >=', 1);
    $this->db->where('MONTH(created_at) <=', 12);
}
$this->db->where('id_transaksi != ""');
$cit = $this->db->get('biaya_operasional')->result();
// pre($cit);
$biaya_operasinal_array = array();
foreach ($cit as $k => $v) {
    if (isset($biaya_operasinal_array[$v->jenis_biaya])) {
        $biaya_operasinal_array[$v->jenis_biaya] += $v->biaya;
    } else {
        $biaya_operasinal_array[$v->jenis_biaya] = $v->biaya;
    }
}
// pre($arv);
// pre($biaya_operasinal_array);

foreach ($biaya_operasinal_array as $k => $v) {
    // pre($k);
    // pre($v);
    $this->db->where('id', $k);
    $g = $this->db->get('jenis_biaya')->row();
    // pre($g->nama);
    // echo $g->nama;
    $total_bo += $v;
    echo '

                    <tr>
                        <td>' . $g->nama . '</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">' . number_format($v, 0, ',', '.') . '</div>
                        </td>
                        <td></td>
                    </tr>
                    ';
}
?>
                    <?php

$total_bol = 0;
$this->db->order_by('tanggal', 'asc');
if ($nahun) {
    $this->db->where('YEAR(tanggal)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(tanggal)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}
$this->db->where('akun_kode', 18);
$cit = $this->db->get('transaksi')->result();
// $this->db->query("SELECT * FROM `transaksi` WHERE `tanggal` BETWEEN '2022-02-01' AND '2022-02-28' AND `akun_kode` = 17");
// dd($this->db->last_query());
// dd($cit);
// $biaya_operasinal_array = array();
$total_terbayar = 0;
foreach ($cit as $k => $v) {
    $total_terbayar = $total_terbayar + $v->terbayar;
    // dd($v->terbayar);
}
// dd( $total_terbayar);
// // pre($arv);
// // pre($biaya_operasinal_array);

// foreach ($biaya_operasinal_array as $k => $v) {
//     // pre($k);
//     // pre($v);
//     $this->db->where('id', $k);
//     $g = $this->db->get('jenis_biaya')->row();
//     // pre($g->nama);
//     // echo $g->nama;
    $total_bo += $total_terbayar;
// }
    echo '

                    <tr>
                        <td>Biaya Operasional Lainnya</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">' . number_format($total_terbayar, 0, ',', '.') . '</div>
                        </td>
                        <td></td>
                    </tr>
                    ';
?>
                    <!-- <tr>
                        <td>Pembayaran Uang Titipan Konsultan</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">20000</div>
                        </td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-center"><b>Total Biaya Operasional</b></td>
                        <td>
                        </td>
                        <td><u><b>
                                    <div style="float:left;text-align:left;">Rp.</div>
                                    <div style="float:right;text-align:right;"><?=number_format($total_bo, 0, ',', '.'); ?></div>
                                </b></u></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="border-top: 2px solid black;"><b>
                                <div style="float:left;text-align:left;">Rp.</div>
                                <div style="float:right;text-align:right;"><?=number_format($total_hasil = $total_pendapatan - $total_bo, 0, ',', '.'); ?></div>
                            </b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- <tr>
                        <td class="text-uppercase"><b>Biaya gaji direksi dan karyawan</b></td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">20000</div>
                        </td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-uppercase"><b>Biaya Kantor / bank</b></td>
                        <td></td>
                        <td></td>
                    </tr>


                    <?php

$this->db->where('lr', 'biaya_kantor');
$cot = $this->db->get('akun_kode')->result();
$dud = [];
foreach ($cot as $pl) {
    $dud[] += $pl->id;
}
// pre($dud);

$this->db->order_by('tanggal', 'asc');
if ($nahun) {
    $this->db->where('YEAR(tanggal)', $nahun);
}
if ($nulan <= 12) {
    $this->db->where('MONTH(tanggal)', $nulan);
}
if ($nulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($nulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($nulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($nulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($nulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}

$this->db->where_in('akun_kode', $dud);
$cot  = $this->db->get('transaksi')->result();
$beka = 0;
$bpo  = [];
foreach ($cot as $cut) {
    // pre($cut);

    if (isset($bpo[$cut->akun_kode])) {
        $bpo[$cut->akun_kode] += $cut->terbayar;
    } else {
        $bpo[$cut->akun_kode] = $cut->terbayar;
    }

    $beka += $cut->terbayar;
}
// pre($bpo);
foreach ($bpo as $key => $value) {
    $this->db->where('id', $key);
    $ddd = $this->db->get('akun_kode')->row();
    echo '

                    <tr>
                        <td>' . $ddd->nama . '</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">' . number_format($value, 0, ',', '.') . '</div>
                        </td>
                        <td></td>
                    </tr>';

}
?>
                    <tr>
                        <td class="text-center"><b>Total Biaya Kantor / Bank</b></td>
                        <td></td>
                        <td style="border-bottom: 2px solid black;"><u><b>
                                    <div style="float:left;text-align:left;">Rp.</div>
                                    <div style="float:right;text-align:right;"><?=number_format($beka, 0, ',', '.'); ?></div>
                                </b></u></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-uppercase"><b style="border-bottom: 2px solid black;">Laba Rugi Sebelum pajak</b></td>
                        <td></td>
                        <td style="border-bottom: 2px solid black;"><u><b>
                                    <div style="float:left;text-align:left;">Rp.</div>
                                    <div style="float:right;text-align:right;"><?=number_format($total_hasil - $beka, 0, ',', '.'); ?></div>
                                </b></u></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>
</div>