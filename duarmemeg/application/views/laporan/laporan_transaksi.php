<?php defined('BASEPATH') or exit('No direct script access allowed');

?>
<style>
caption {
    caption-side: top;
}
</style>
<?php
// $post_bulan = '09';
// $post_bulan = urldecode($this->input->post('post_bulan', true)) ?: date('m');
// $post_tahun = urldecode($this->input->post('post_tahun', true)) ?: date('Y');

// $nomor_kas = $trse->no_kas;
$this->db->where('kas', 1);
$result = $this->db->get('akun_kode')->result();
foreach ($result as $res) {

    $list_akun_dihitung_nomor_kasnya[] = $res->id;
    // echo '++++++++++++++++++++++';

    # code...
}
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
// $this->db->order_by('MONTH(tanggal) asc, YEAR(tanggal) asc');
$this->db->where_in('akun_kode', $list_akun_dihitung_nomor_kasnya);
$this->db->order_by('tanggal', 'asc');
$fed    = $this->db->get('transaksi')->result();
$nobank = 1;
$nokas  = 1;
foreach ($fed as $fid) {
    // pre($fid);
    if ($fid->buku == 1) {
        $this->db->set('no_kas', $nokas++);
    }
    if ($fid->buku == 2) {
        $this->db->set('no_kas', $nobank++);
    }
    $this->db->where('id', $fid->id);
    $this->db->update('transaksi');
    // if($fid->buku == $)
    # code...
}

?>


<div class="row">
    <!-- end col -->

    <div class="px-4 mt-3 col-12">
        <div class="card pb-5 px-3 ">
            <div class="card-body">

                <h4 class="card-title mb-3 noprint">BUKU BESAR Transaksi</h4>

                <p>
                    <?php

$this->db->order_by('tanggal', 'asc');
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    $gtl[] = indonesian_date($trse->tanggal, 'Y');
}
$gtl = array_unique($gtl);
// $tagal = array_count_values($tagal);
// var_dump($gtl);
// foreach ($tagal as $tugal => $tugil) {
// echo '<br>' . $tugal . '  - ' . $tugil;
// }
// echo '<br>'; ?>
                </p>
                <form action="<?=base_url(); ?>laporan/transaksi" method="post">
                    <div class="row mb-3  noprint">
                        <!-- <div class="col-12"> -->
                        <div class="col-2">
                            <label class="">Bulan</label>
                            <div class="">
                                <select name="post_bulan" class="form-control form-control-line">
                                    <?php
// date_default_timezone_set('Asia/Makassar');
// setlocale(LC_ALL, "id_ID");
// print '<option value="" disabled selected>Pilih Bulan</option>';
// echo $post_bulan;
$bolan = $post_bulan ?: trim(date('m', time()));
for ($i = 1; $i <= 12; $i++) {
    if ($bolan == $i) {
        $selected = 'selected';
    } else {
        $selected = '';
    }
    print '<option ' . $selected . ' value="' . $i . '">' . indonesian_date("1-$i-10", "F") . '</option>';
    // print '<option value="' . $i . '">' . date( 'F', strtotime( "$i/12/10" ) ) . '</option>';
}
?>
                                    <option <?=$bolan == 13 ? 'selected' : ''; ?> value="13">Januari Februari Maret</option>
                                    <option <?=$bolan == 14 ? 'selected' : ''; ?> value="14">April Mei Juni</option>
                                    <option <?=$bolan == 15 ? 'selected' : ''; ?> value="15">Juli Agustus September</option>
                                    <option <?=$bolan == 16 ? 'selected' : ''; ?> value="16">Oktober November Desember</option>
                                    <option <?=$bolan == 17 ? 'selected' : ''; ?> value="17">Semua</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <label class="">Tahun</label>
                            <div class="">
                                <select name="post_tahun" class="form-control form-control-line">
                                    <?php
// $this->db->where('tanggal')
$taon = $post_tahun ?: trim(date('Y', time()));
// print '<option value="" disabled selected>Pilih Tahun</option>';
$this->db->group_by("YEAR(tanggal)");
// $this->db->limit('',20);
$tahun = $this->db->get('transaksi')->result();
// pre($tahun);
foreach ($tahun as $tah) {
    if ($taon == date('Y', strtotime("$tah->tanggal"))) {
        $selected = 'selected';
    } else {
        $selected = '';
    }
    // echo '<option value="' . $tah->tanggal . '">' . $tah->tanggal . '</option>';
    print '<option ' . $selected . ' value="' . date('Y', strtotime("$tah->tanggal")) . '">' . date('Y', strtotime("$tah->tanggal")) . '</option>';
}
; // var_dump($bulan); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" name="filter" value="1" class="btn mt-4 btn-sm btn-success waves-effect waves-light mr-2">Filter</button>
                            <button type="submit" name="cetak" value="1" class="btn mt-4 btn-sm btn-success waves-effect waves-light mr-2">Cetak</button>
                        </div>
                    </div>
                </form>
                <!-- </div> -->
            </div>



            <h3 class="pt-3 pb-2 text-center">Laporan
                <!-- <?=$bolan == 13 ? 'Kuartal 1 (Q1) Januari Februari Maret ' . $post_tahun : ''; ?> -->
                <?=$bolan == 13 ? 'Kuartal 1 (Q1) ' . $post_tahun : ''; ?>
                <!-- <?=$bolan == 14 ? 'Kuartal 2 (Q2) April Mei Juni ' . $post_tahun : ''; ?> -->
                <?=$bolan == 14 ? 'Kuartal 2 (Q2) ' . $post_tahun : ''; ?>
                <!-- <?=$bolan == 15 ? 'Kuartal 3 (Q3) Juli Agustus September ' . $post_tahun : ''; ?> -->
                <?=$bolan == 15 ? 'Kuartal 3 (Q3) ' . $post_tahun : ''; ?>
                <!-- <?=$bolan == 16 ? 'Kuartal 4 (Q4) Oktober November Desember ' . $post_tahun : ''; ?> -->
                <?=$bolan == 16 ? 'Kuartal 4 (Q4) ' . $post_tahun : ''; ?>
                <?=$bolan == 17 ? 'Tahun ' . $post_tahun : ''; ?>
            </h3>

            <div class="row" id="yak">
                <div class="table-umum col-6">

                    <h4 class="pt-3 pb-2 text-center">BUKU KAS</h4>
                    <table class="table table-sm mb-0 table-bordered" id="table-umum">
                        <thead>
                            <tr>
                                <?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<th scope="col" class="text-center" style="width: 0%;">Bulan</th>' : ''; ?>
                                <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                <!-- <th scope="col" class="text-center" style="width: 4%;">No Kas</th> -->
                                <th scope="col" class="text-center" style="width: 50%;">Keterangan</th>
                                <th scope="col" class="text-center" style="width: 0%;">Reff</th>
                                <th scope="col" class="text-center" style="width: 10%;">Debit</th>
                                <th scope="col" class="text-center" style="width: 10%;">Credit</th>
                                <th scope="col" class="text-right" style="width: 10%;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
unset($tagal);
unset($nagal);
$this->db->order_by('tanggal', 'asc');
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan <= 12) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
if ($post_bulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($post_bulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($post_bulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($post_bulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($post_bulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}

$this->db->where('buku', 1);
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    $tagal[] = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
    $nagal[] = trim(indonesian_date($trse->tanggal, 'F'));
}
if (!empty($tagal)) {

// $tagal = array_unique($tagal);
    $tagal = array_count_values($tagal);
    $nagal = array_count_values($nagal);
    // pre($tagal);
    // foreach ($tagal as $tugal => $tugil) {
    // echo '<br>' . $tugal . '  - ' . $tugil;
    // }
    // echo '<br>';
    // $this->db->where('tanggal', '2022');
    if ($post_tahun) {
        $this->db->where('YEAR(tanggal)', $post_tahun);
    }
    if ($post_bulan <= 12) {
        $this->db->where('MONTH(tanggal)', $post_bulan);
    }
    if ($post_bulan == 13) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 3);
    }
    if ($post_bulan == 14) {
        $this->db->where('MONTH(tanggal) >=', 4);
        $this->db->where('MONTH(tanggal) <=', 6);
    }
    if ($post_bulan == 15) {
        $this->db->where('MONTH(tanggal) >=', 7);
        $this->db->where('MONTH(tanggal) <=', 9);
    }
    if ($post_bulan == 16) {
        $this->db->where('MONTH(tanggal) >=', 10);
        $this->db->where('MONTH(tanggal) <=', 12);
    }
    if ($post_bulan == 17) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 12);
    }

    $this->db->where('buku', 1);
    $this->db->order_by("tanggal", 'asc');
// $this->db->group_by($tagal);
    $transaksi_semua = $this->db->get('transaksi')->result();

    $kas_saldo_all = 0;
    $kas_saldo_d   = 0;
    $kas_saldo_k   = 0;
    unset($mulanold);
    foreach ($transaksi_semua as $trse) {
        echo '<tr>';

        if ($post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17) {
            $mulan    = trim(indonesian_date($trse->tanggal, 'F'));
            $mulannew = $mulan;
            if (!isset($mulanold)) {$mulanold = '';}
            if ($mulannew != $mulanold) {
                echo '<td style="vertical-align : middle;text-align:center;" rowspan="' . $nagal[trim(indonesian_date($trse->tanggal, 'F'))] . '">' . trim(indonesian_date($trse->tanggal, 'F')) . '</td>';
                $mulanold = trim(indonesian_date($trse->tanggal, 'F'));
            } else {
                // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
            }
        }

        $berapa    = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
        $berapanew = $berapa;
        if (!isset($berapaold)) {$berapaold = '0';}
        // echo $berapaold . ' - ';
        if ($berapanew != $berapaold) {
            echo '<td style="vertical-align : middle;text-align:center;" rowspan="' . $tagal[trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd')] . '">' . indonesian_date($trse->tanggal, 'd') . '</td>';
            $berapaold = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
        } else {
            // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
        }
        // echo $berapanew . ' - ' . $berapaold . '<br>';

        // echo '<td class="text-center">' . $trse->no_kas ?: "0" . '</td>';
        echo '<td class="text-left">' . $trse->keterangan . '</td>';
        echo '<td class="text-center">' . $trse->akun_kode . '</td>';
        if ($trse->dk == 1) {
            $kas_saldo_d = $trse->terbayar + $kas_saldo_d;
            echo '<td class="text-right">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
            echo '<td class="text-right">0</td>';
            $kas_saldo_all = $trse->terbayar + $kas_saldo_all;
        } else {
            $kas_saldo_k = $trse->terbayar + $kas_saldo_k;
            echo '<td class="text-right">0</td>';
            echo '<td class="text-right">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
            $kas_saldo_all = $kas_saldo_all - $trse->terbayar;
        }
        echo '<td class="text-right">' . number_format($kas_saldo_all, 0, ',', '.') . '</td>';
        // var_dump($trse);
        echo '</tr>';
    }
    ?>
                        <tfoot>
                            <tr>
                                <td colspan="<?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '4' : '3'; ?>" class="text-center font-weight-bold">Jumlah</td>
                                <td class="text-right font-weight-bold"><?=number_format($kas_saldo_d, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($kas_saldo_k, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($kas_saldo_all, 0, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                        <?php
} else {
    echo '<tr>';
    echo $post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<td class="text-center"></td>' : '';

    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center">KOSONG</td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    // echo '<td class="text-center"> </td>';
    echo '</tr>';
}
?>
                        </tbody>

                    </table>
                </div>


                <div class="table-umum col-6" id="bang">
                    <h4 class="pt-3 pb-2 text-center">BUKU BANK</h4>
                    <table class="table table-sm mb-0 table-bordered" id="table-umum">
                        <thead>
                            <tr>
                                <?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<th scope="col" class="text-center" style="width: 0%;">Bulan</th>' : ''; ?>
                                <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                <!-- <th scope="col" class="text-center" style="width: 4%;">No Kas</th> -->
                                <th scope="col" class="text-center" style="width: 50%;">Keterangan</th>
                                <th scope="col" class="text-center" style="width: 0%;">Reff</th>
                                <th scope="col" class="text-center" style="width: 10%;">Debit</th>
                                <th scope="col" class="text-center" style="width: 10%;">Credit</th>
                                <th scope="col" class="text-right" style="width: 10%;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
unset($tagal);
unset($nagal);
unset($transaksi_semua);
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan <= 12) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
if ($post_bulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($post_bulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($post_bulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($post_bulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($post_bulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}
$this->db->order_by('tanggal', 'asc');
$this->db->where('buku', 2);
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    // pre($trse);
    $tagal[] = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
    $nagal[] = trim(indonesian_date($trse->tanggal, 'F'));
}
if (!empty($tagal)) {
// $tagal = array_unique($tagal);
    $tagal = array_count_values($tagal);
    $nagal = array_count_values($nagal);
    // pre($tagal);
    // var_dump($tagal);
    // foreach ($tagal as $tugal => $tugil) {
    // echo '<br>' . $tugal . '  - ' . $tugil;
    // }
    // echo '<br>';
    if ($post_tahun) {
        $this->db->where('YEAR(tanggal)', $post_tahun);
    }
    if ($post_bulan <= 12 && $post_bulan != 17) {
        $this->db->where('MONTH(tanggal)', $post_bulan);
    }
    if ($post_bulan == 13) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 3);
    }
    if ($post_bulan == 14) {
        $this->db->where('MONTH(tanggal) >=', 4);
        $this->db->where('MONTH(tanggal) <=', 6);
    }
    if ($post_bulan == 15) {
        $this->db->where('MONTH(tanggal) >=', 7);
        $this->db->where('MONTH(tanggal) <=', 9);
    }
    if ($post_bulan == 16) {
        $this->db->where('MONTH(tanggal) >=', 10);
        $this->db->where('MONTH(tanggal) <=', 12);
    }
    if ($post_bulan == 17) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 12);
    }

    $this->db->where('buku', 2);
    $this->db->order_by("tanggal", 'asc');
// $this->db->group_by($tagal);
    $transaksi_semua = $this->db->get('transaksi')->result();

    $bank_saldo_all = 0;
    $bank_saldo_d   = 0;
    $bank_saldo_k   = 0;
    unset($mulanold);
    unset($berapaold);

    foreach ($transaksi_semua as $trse) {
        echo '<tr>';

        if ($post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17) {
            $mulan    = trim(indonesian_date($trse->tanggal, 'F'));
            $mulannew = $mulan;
            if (!isset($mulanold)) {$mulanold = '';}
            if ($mulannew != $mulanold) {
                $mulanold = trim(indonesian_date($trse->tanggal, 'F'));
                echo '<td nama="bulannya" rowspan="' . $nagal[trim(indonesian_date($trse->tanggal, 'F'))] . '">' . trim(indonesian_date($trse->tanggal, 'F')) . '</td>';
            } else {
                // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
            }
        }
        $berapa    = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
        $berapanew = $berapa;
        if (!isset($berapaold)) {$berapaold = 0;}
        if ($berapanew != $berapaold) {
            $berapaold = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
            echo '<td nama="tanggalnya" rowspan="' . $tagal[trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd')] . '">' . indonesian_date($trse->tanggal, 'd') . '</td>';
        } else {
        }

        // echo '<td class="text-center">' . $trse->no_kas ?: "0" . '</td>';
        if ($trse->akun_kode == 101) {
            $this->db->where('id_transaksi', $trse->id);
            $ren = $this->db->get('operasional')->result();
            // dd($trse->id);
            $bren = count($ren) - 1;
            $tex  = '';
            $this->db->where('id', $ren[0]->barang_asal);
            $per = $this->db->get('barang_asal')->row();
            // pre($per);
            // print_r($this->db->last_query());
            $tex = '<h6>Laporan Pembayaran ' . $per->inisial . ' </h6>';
            // var_dump($bren);
            foreach ($ren as $r) {
                $tex .= '
            <div class="form-group row align-items-center mb-0">
                                        <label for="inputEmail3" class="col-2 text-right control-label col-form-label">Inv. ' . $r->id . ' </label>
                                        <div class="col-md-9 border-left">
                                        <div class="row text-center justify-content-center">
                                    <div class="col-6 col-md-4 mt-1">
                                        <h5 class="mb-0 font-weight-light">' . number_format($r->st, 0, ',', '.') . '</h5><small>Bruto</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-1">
                                        <h5 class="mb-0 font-weight-light">' . number_format($r->pt, 0, ',', '.') . '</h5><small>PPh23</small>
                                    </div>
                                    <div class="col-6 col-md-4 mt-1">
                                        <h5 class="mb-0 font-weight-light">' . number_format($r->tt, 0, ',', '.') . '</h5><small>Netto</small>
                                    </div>
                                </div>
                                            </div>
                                    </div>
                                    ';
                if ($bren-- != 0) {
                    $tex .= '<hr class="m-0">';
                }
            }
            echo '<td class="text-left">' . $tex . '</td>';

        } else {
            echo '<td class="text-left">' . $trse->keterangan . '</td>';
        }
        echo '<td class="text-center"  style="vertical-align:middle;">' . $trse->akun_kode . '</td>';
        if ($trse->dk == 1) {
            $bank_saldo_d = $trse->terbayar + $bank_saldo_d;
            echo '<td class="text-right" style="color: limegreen;vertical-align:middle;;">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
            echo '<td class="text-right" style="color: red;vertical-align:middle;;">0</td>';
            $bank_saldo_all = $trse->terbayar + $bank_saldo_all;
        } else {
            $bank_saldo_k = $trse->terbayar + $bank_saldo_k;
            echo '<td class="text-right" style="color: limegreen;vertical-align:middle;">0</td>';
            echo '<td class="text-right" style="color: red;vertical-align:middle;;">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
            $bank_saldo_all = $bank_saldo_all - $trse->terbayar;
        }
        echo '<td class="text-right" style="vertical-align:middle;">' . number_format($bank_saldo_all, 0, ',', '.') . '</td>';
        // var_dump($trse);
        echo '</tr>';
    }
    ?>
                        <tfoot>
                            <tr>
                                <td colspan="<?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '4' : '3'; ?>" class="text-center font-weight-bold">Jumlah</td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_d, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_k, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_all, 0, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                        <?php

} else {
    echo '<tr>';
    echo $post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<td class="text-center"></td>' : '';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center">KOSONG</td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    echo '<td class="text-center"> </td>';
    // echo '<td class="text-center"> </td>';
    echo '</tr>';
} ?>
                        </tbody>
                    </table>
                </div>













                <?php
unset($tagal);
unset($nagal);
unset($transaksi_semua);
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan <= 12) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
if ($post_bulan == 13) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 3);
}
if ($post_bulan == 14) {
    $this->db->where('MONTH(tanggal) >=', 4);
    $this->db->where('MONTH(tanggal) <=', 6);
}
if ($post_bulan == 15) {
    $this->db->where('MONTH(tanggal) >=', 7);
    $this->db->where('MONTH(tanggal) <=', 9);
}
if ($post_bulan == 16) {
    $this->db->where('MONTH(tanggal) >=', 10);
    $this->db->where('MONTH(tanggal) <=', 12);
}
if ($post_bulan == 17) {
    $this->db->where('MONTH(tanggal) >=', 1);
    $this->db->where('MONTH(tanggal) <=', 12);
}
$this->db->order_by('tanggal', 'asc');
$this->db->where('buku', 2);
$this->db->where('akun_kode', 101);
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    // pre($trse);
    $tagal[] = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
    $nagal[] = trim(indonesian_date($trse->tanggal, 'F'));
}
if (!empty($tagal)) {
    ?>
                <div class="table-umum col-6" id="pph21">
                    <h4 class="pt-3 pb-2 text-center">PPH23</h4>
                    <table class="table table-sm mb-0 table-bordered" id="table-umum">
                        <thead>
                            <tr>
                                <?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<th scope="col" class="text-center" style="width: 0%;">Bulan</th>' : ''; ?>
                                <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                <!-- <th scope="col" class="text-center" style="width: 4%;">No Kas</th> -->
                                <th scope="col" class="text-center" style="width: 50%;">Keterangan</th>
                                <th scope="col" class="text-center" style="width: 0%;">Reff</th>
                                <th scope="col" class="text-center" style="width: 10%;">Debit</th>
                                <th scope="col" class="text-center" style="width: 10%;">Credit</th>
                                <th scope="col" class="text-right" style="width: 10%;">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

// $tagal = array_unique($tagal);
    $tagal = array_count_values($tagal);
    $nagal = array_count_values($nagal);
    // pre($nagal);
    // var_dump($tagal);
    // foreach ($tagal as $tugal => $tugil) {
    // echo '<br>' . $tugal . '  - ' . $tugil;
    // }
    // echo '<br>';
    if ($post_tahun) {
        $this->db->where('YEAR(tanggal)', $post_tahun);
    }
    if ($post_bulan <= 12 && $post_bulan != 17) {
        $this->db->where('MONTH(tanggal)', $post_bulan);
    }
    if ($post_bulan == 13) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 3);
    }
    if ($post_bulan == 14) {
        $this->db->where('MONTH(tanggal) >=', 4);
        $this->db->where('MONTH(tanggal) <=', 6);
    }
    if ($post_bulan == 15) {
        $this->db->where('MONTH(tanggal) >=', 7);
        $this->db->where('MONTH(tanggal) <=', 9);
    }
    if ($post_bulan == 16) {
        $this->db->where('MONTH(tanggal) >=', 10);
        $this->db->where('MONTH(tanggal) <=', 12);
    }
    if ($post_bulan == 17) {
        $this->db->where('MONTH(tanggal) >=', 1);
        $this->db->where('MONTH(tanggal) <=', 12);
    }

    $this->db->where('buku', 2);
    $this->db->order_by("tanggal", 'asc');
// $this->db->group_by($tagal);
    $transaksi_semua = $this->db->get('transaksi')->result();

    $bank_saldo_all = 0;
    $bank_saldo_d   = 0;
    $bank_saldo_k   = 0;
    unset($mulanold);
    unset($berapaold);

    foreach ($transaksi_semua as $trse) {
        if ($trse->akun_kode == 101) {
            echo '<tr>';

            if ($post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17) {
                $mulan = trim(indonesian_date($trse->tanggal, 'F'));
                // pre($nagal);
                $mulannew = $mulan;
                if (!isset($mulanold)) {$mulanold = '';}
                if ($mulannew != $mulanold) {
                    $mulanold = trim(indonesian_date($trse->tanggal, 'F'));
                    echo '<td nama="bulannya" rowspan="' . $nagal[trim(indonesian_date($trse->tanggal, 'F'))] . '">' . trim(indonesian_date($trse->tanggal, 'F')) . '</td>';
                } else {
                    // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
                }
            }
            $berapa    = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
            $berapanew = $berapa;
            if (!isset($berapaold)) {$berapaold = 0;}
            if ($berapanew != $berapaold) {
                $berapaold = trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd');
                echo '<td nama="tanggalnya" rowspan="' . $tagal[trim(indonesian_date($trse->tanggal, 'm')) . indonesian_date($trse->tanggal, 'd')] . '">' . indonesian_date($trse->tanggal, 'd') . '</td>';
            } else {
            }

            // echo '<td class="text-center">' . $trse->no_kas ?: "0" . '</td>';
            $this->db->where('id_transaksi', $trse->id);
            $ren = $this->db->get('operasional')->result();
            // pre($ren);
            $bren = count($ren) - 1;
            $tex  = '';
            $this->db->where('id', $ren[0]->barang_asal);
            $per = $this->db->get('barang_asal')->row();
            // pre($per);
            // print_r($this->db->last_query());
            // $tex = '';
            $tex = '<h6>Pembayaran ' . $per->inisial . ' </h6>';
            // var_dump($bren);
            foreach ($ren as $r) {
                $tex .= '
            <div class="form-group row align-items-center mb-0">
                                        <label for="inputEmail3" class="col-2 text-right control-label col-form-label">Inv. ' . $r->id . ' </label>
                                        <div class="col-md-9 border-left">
                                        <div class="row text-center justify-content-center">
                                    <div class="col-6 col-md-4 mt-1">
                                        <h5 class="mb-0 font-weight-light">' . number_format($r->pt, 0, ',', '.') . '</h5>
                                    </div>
                                </div>
                                            </div>
                                    </div>
                                    ';
                if ($bren-- != 0) {
                    $tex .= '<hr class="m-0">';
                }
            }
            echo '<td class="text-left">' . $tex . '</td>';
            echo '<td class="text-center"  style="vertical-align:middle;"></td>';
            // echo '<td class="text-center"  style="vertical-align:middle;">' . $trse->akun_kode . '</td>';
            $bank_saldo_k = $r->pt + $bank_saldo_k;
            echo '<td class="text-right" style="color: limegreen;vertical-align:middle;">0</td>';
            echo '<td class="text-right" style="color: red;vertical-align:middle;;">' . number_format($r->pt, 0, ',', '.') . '</td>';
            $bank_saldo_all = $bank_saldo_all - $r->pt;

            echo '<td class="text-right" style="vertical-align:middle;">' . number_format($bank_saldo_all, 0, ',', '.') . '</td>';
            // var_dump($trse);
            echo '</tr>';

        }
    }
    ?>
                        <tfoot>
                            <tr>
                                <td colspan="<?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '5' : '4'; ?>" class="text-center font-weight-bold">Jumlah</td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_d, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_k, 0, ',', '.'); ?></td>
                                <td class="text-right font-weight-bold"><?=number_format($bank_saldo_all, 0, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
                <?php

} 
// else {
//     echo '<tr>';
//     echo $post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<td class="text-center"></td>' : '';
//     echo '<td class="text-center"> </td>';
//     echo '<td class="text-center"> </td>';
//     echo '<td class="text-center">KOSONG</td>';
//     echo '<td class="text-center"> </td>';
//     echo '<td class="text-center"> </td>';
//     echo '<td class="text-center"> </td>';
//     echo '<td class="text-center"> </td>';
//     echo '</tr>';
// } 
?>






                <?php
$this->db->where('hitung', 1);
$result1 = $this->db->get('akun_kode')->result();
if ($result1) {
    foreach ($result1 as $row1) {
        unset($tagal);
        unset($nagal);
        unset($magal);
        if ($post_tahun) {
            $this->db->where('YEAR(tanggal)', $post_tahun);
        }
        if ($post_bulan <= 12) {
            // if ($post_bulan <= 12 && $post_bulan != 17) {
            $this->db->where('MONTH(tanggal)', $post_bulan);
        }
        if ($post_bulan == 13) {
            $this->db->where('MONTH(tanggal) >=', 1);
            $this->db->where('MONTH(tanggal) <=', 3);
        }
        if ($post_bulan == 14) {
            $this->db->where('MONTH(tanggal) >=', 4);
            $this->db->where('MONTH(tanggal) <=', 6);
        }
        if ($post_bulan == 15) {
            $this->db->where('MONTH(tanggal) >=', 7);
            $this->db->where('MONTH(tanggal) <=', 9);
        }
        if ($post_bulan == 16) {
            $this->db->where('MONTH(tanggal) >=', 10);
            $this->db->where('MONTH(tanggal) <=', 12);
        }
        if ($post_bulan == 17) {
            $this->db->where('MONTH(tanggal) >=', 1);
            $this->db->where('MONTH(tanggal) <=', 12);
        }

        $this->db->order_by('tanggal', 'asc');
        $this->db->where('akun_kode', $row1->id);
        $result = $this->db->get('transaksi')->result();
        foreach ($result as $res) {
            $tagal[] = trim(indonesian_date($res->tanggal, 'm')) . indonesian_date($res->tanggal, 'd');
            $nagal[] = trim(indonesian_date($res->tanggal, 'F'));
            // $magal[] = trim(indonesian_date($res->tanggal, 'm'));
        }
        if (!empty($tagal)) {

            
        echo '<div class="col-6">';
        echo '<h4 class="pt-3 pb-2 text-center"><code>[' . $row1->id . ']</code> ' . $row1->nama . '</h4>';
        // print_r($row1);
        echo '<table class="table table-sm mb-0 table-bordered">';
//   echo '<caption>Example Caption</caption>';
        echo '<thead>';
        echo '                 <tr>';
        ?>
                <?=$post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<th scope="col" class="text-center" style="width: 0%;">Bulan</th>' : ''; ?>
                <?php
echo '
                                            <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                            <th scope="col" class="text-center" style="width: 50%;">Keterangan</th>
                                            <th scope="col" class="text-center" style="width: 10%;">Debit</th>
                                            <th scope="col" class="text-center" style="width: 10%;">Kredit</th>
                                            <th scope="col" class="text-right" style="width: 10%;">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                                    
            $tagal = array_count_values($tagal);
            $nagal = array_count_values($nagal);
            // $magal = array_count_values($magal);
            // pre($nagal);

            if ($post_bulan <= 12) {
                // if ($post_bulan <= 12 && $post_bulan != 17) {
                $this->db->where('MONTH(tanggal)', $post_bulan);
            }
            if ($post_bulan == 13) {
                $this->db->where('MONTH(tanggal) >=', 1);
                $this->db->where('MONTH(tanggal) <=', 3);
            }
            if ($post_bulan == 14) {
                $this->db->where('MONTH(tanggal) >=', 4);
                $this->db->where('MONTH(tanggal) <=', 6);
            }
            if ($post_bulan == 15) {
                $this->db->where('MONTH(tanggal) >=', 7);
                $this->db->where('MONTH(tanggal) <=', 9);
            }
            if ($post_bulan == 16) {
                $this->db->where('MONTH(tanggal) >=', 10);
                $this->db->where('MONTH(tanggal) <=', 12);
            }
            if ($post_bulan == 17) {
                $this->db->where('MONTH(tanggal) >=', 1);
                $this->db->where('MONTH(tanggal) <=', 12);
            }

            $this->db->where('YEAR(tanggal)', $post_tahun);
            $this->db->where('akun_kode', $row1->id);
            $this->db->order_by('tanggal', 'asc');
            $result2 = $this->db->get('transaksi')->result();
            unset($berapaold);
            unset($mulanold);
            $bank_saldo_all = 0;
            $bank_saldo_d   = 0;
            $bank_saldo_k   = 0;

            // pre($result2);
            foreach ($result2 as $row2) {
                echo '<tr>';
                // var_dump($post_bulan);
                if (in_array($post_bulan, range(13, 16), true)) {
                    // var_dump("You can be sure that $min <= $value <= $max");
                    // echo '<td class="text-right">YES</td>';
                }

                if ($post_bulan >= 13 && $post_bulan <= 17) {
                    // if ($post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17) {
                    $mulan = trim(indonesian_date($row2->tanggal, 'F'));
                    // pre($row2->tanggal);
                    $mulannew = $mulan;
                    if (!isset($mulanold)) {$mulanold = '';}
                    if ($mulannew != $mulanold) {
                        // pre($nagal);
                        echo '<td style="vertical-align : middle;text-align:center;" rowspan="' .
                        $nagal[trim(indonesian_date($row2->tanggal, 'F'))]
                        . '">' . trim(indonesian_date($row2->tanggal, 'F')) .
                            '</td>';
                        $mulanold = trim(indonesian_date($row2->tanggal, 'F'));
                    } else {
                        // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
                    }
                }

                // pre($row2);
                // pre($tagal);
                $berapa    = indonesian_date($row2->tanggal, 'd');
                $berapanew = $berapa;
                if (!isset($berapaold)) {$berapaold = '';}
                if ($berapanew != $berapaold) {
                    $berapaold = indonesian_date($row2->tanggal, 'd');
                    echo '<td style="vertical-align : middle;text-align:center;" rowspan="' . $tagal[trim(indonesian_date($row2->tanggal, 'm')) . indonesian_date($row2->tanggal, 'd')] . '">' . indonesian_date($row2->tanggal, 'd') . '</td>';
                } else {
                    // echo '<td>' . indonesian_date($row2->tanggal, 'd') . '</td>';
                }

                echo '<td>' . $row2->keterangan . '</td>';
                if ($row2->dk == 1) {
                    $bank_saldo_d = $row2->terbayar + $bank_saldo_d;
                    echo '<td class="text-right">' . number_format($row2->terbayar, 0, ',', '.') . '</td>';
                    echo '<td class="text-right"></td>';
                    $bank_saldo_all = $row2->terbayar + $bank_saldo_all;
                } else {
                    $bank_saldo_k = $row2->terbayar + $bank_saldo_k;
                    echo '<td class="text-right"></td>';
                    echo '<td class="text-right">' . number_format($row2->terbayar, 0, ',', '.') . '</td>';
                    $bank_saldo_all = $bank_saldo_all + $row2->terbayar;
                }
                echo '<td class="text-right">' . number_format($bank_saldo_all, 0, ',', '.') . '</td>';

                echo '</tr>';
            }
        echo '</tbody></table>';
        echo '</div>';
        } else {
            // echo '<tr>';
            // echo $post_bulan >= 13 && $post_bulan <= 16 || $post_bulan == 17 ? '<td class="text-center"></td>' : '';
            // echo '<td class="text-center"></td>';
            // echo '<td class="text-center">KOSONG </td>';
            // echo '<td class="text-center"> </td>';
            // echo '<td class="text-center"> </td>';
            // echo '<td class="text-center"> </td>';
            // echo '</tr>';
        }
    }

}

?>
            </div>

        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div> <!-- end col -->
</div>



<?php

// $dayOfMonth = date('d');
// $bulan_lalu = date("Y-m",strtotime(sprintf('-1 months', $dayOfMonth)));
// $hari_bulan_tahun_lalu = date("Y-m-t",strtotime(sprintf('-1 months', $dayOfMonth)));

// $tanggal_bulan_awal = date('Y-m-01');
// saldo KAS
$tanggal_bulan_lalu = date('Y-m-t', strtotime('last month'));
$this->db->where('akun_kode', 1);
$this->db->where('tanggal', $tanggal_bulan_lalu);
$adakah_bulan_lalu_kas      = $this->db->get('transaksi')->row();
$saldo_akhir_bulan_lalu_kas = 0;
if (!$adakah_bulan_lalu_kas) {
    $this->db->where('akun_kode', 1);
    $saldo_akhir_bulan_lalu_kas = $this->db->get('transaksi')->row();
if ($saldo_akhir_bulan_lalu_kas) {
    // debugx($saldo_akhir_bulan_lalu_kas);
    $saldo_akhir_bulan_lalu_kas = $saldo_akhir_bulan_lalu_kas->nominal;
    $data = array(
        'tanggal'    => $tanggal_bulan_lalu,
        'akun_kode'  => 1,
        'buku'       => 1,
        'keterangan' => 'saldo buat akhir bulan ' . indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
        'dk'         => 1,
        'nominal'    => $saldo_akhir_bulan_lalu_kas,
    );
}
// $this->db->insert('transaksi', $data);
    // echo 'saldo bulan lalu gk ada';
} else {
    // echo 'saldo bulan lalu ada';
    $saldo_akhir_bulan_lalu_kas = $adakah_bulan_lalu_kas->nominal;

    $tanggal_bulan_awal = date('Y-m-01');
    $this->db->where('akun_kode', 25);
    $this->db->where('tanggal', $tanggal_bulan_awal);
    $adakah_bulan_awal_kas = $this->db->get('transaksi')->row();
    if (!$adakah_bulan_lalu_kas) {
        $data = array(
            'tanggal'    => $tanggal_bulan_lalu,
            'akun_kode'  => 25,
            'buku'       => 1,
            'keterangan' => 'saldo akhir bulan ' . indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
            'dk'         => 1,
            'nominal'    => $saldo_akhir_bulan_lalu_kas,
        );
        // $this->db->insert('transaksi', $data);
    } else {
        // $this->db->set('field', 'field+1');
        // $this->db->where('id', 2);
        // $this->db->update('mytable');
        // $this->db->insert('transaksi', $data);
    }
// var_dump($adakah_bulan_awal_kas);
}
;
// echo $saldo_akhir_bulan_lalu_kas;

// saldo BANK
$tanggal_bulan_lalu = date('Y-m-t', strtotime('last month'));
$this->db->where('akun_kode', 2);
$this->db->where('tanggal', $tanggal_bulan_lalu);
$adakah_bulan_lalu_bank      = $this->db->get('transaksi')->row();
$saldo_akhir_bulan_lalu_bank = 0;
if (!$adakah_bulan_lalu_bank) {
    $this->db->where('akun_kode', 2);
    $saldo_akhir_bulan_lalu_bank = $this->db->get('transaksi')->row();
if ($saldo_akhir_bulan_lalu_bank) {
    $saldo_akhir_bulan_lalu_bank = $saldo_akhir_bulan_lalu_bank->nominal;
    $data                        = array(
        'tanggal'    => $tanggal_bulan_lalu,
        'akun_kode'  => 25,
        'buku'       => 2,
        'keterangan' => 'saldo buat akhir bulan ' . indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
        'dk'         => 1,
        'nominal'    => $saldo_akhir_bulan_lalu_bank,
    );
}
// $this->db->insert('transaksi', $data);
    // echo 'saldo bulan lalu gk ada';
} else {
    // echo 'saldo bulan lalu ada';
    $saldo_akhir_bulan_lalu_bank = $adakah_bulan_lalu_bank->nominal;

}
;
// echo $saldo_akhir_bulan_lalu_bank;

// $saldo_akhir_kas  = $kas_saldo_all;
// $saldo_akhir_bank = $bank_saldo_all;
// if ($post_bulan) {
//     $this->db->where('MONTH(tanggal)', $post_bulan);
// } else {
//     $this->db->where('MONTH(tanggal)', date('m'));
// }
// if ($post_tahun) {
//     $this->db->where('YEAR(tanggal)', $post_tahun);
// } else {
//     $this->db->where('YEAR(tanggal)', date('Y'));
// }
// $hxh = $this->db->get('transaksi')->row();
// if ($hxh) {
// var_dump($hxh);
// echo 'ada';
// } else {
// echo 'tidak ada';
// }
echo '<br>';

// $now = mktime(0, 0, 0, 01, 01, 2017);
// echo date("Y-m", $now)."<br>";
// echo date("Y-m", strtotime("-1 months", $now))."\n";

// echo date(strtotime("01-01-2023"), strtotime("-1 months"));
; // $data = array(; //     'email' => $new; // );; // $this->db->where('email', $this->session->userdata('email'));; // $result = $this->db->update('person', $data);; // $error = $this->db->error();; // return $error;

?>
<script>
$(document).ready(function() {
    $('.page-wrapper').css("max-width", "100%");
});




// umum
$(document).ready(function($) {
    //     $('#table-umum').css('width', '100%');
    //     $(function() {
    //         var t = $('#table-umum').DataTable({
    //             "drawCallback": function(settings) {
    //                 $('[data-toggle="tooltip"]').tooltip({
    //                     container: 'body'
    //                 });
    //             },
    //             searching: false,
    //             ordering: false,
    //             processing: true,
    //             responsive: false,
    //             "language": {
    //                 "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
    //                 "search": "Pencarian:",
    //                 "zeroRecords": "Tidak ditemukan - sorry",
    //                 "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
    //                 "infoEmpty": "Tidak ada data ditemukan",
    //                 "infoFiltered": "(Disaring dari _MAX_ data)"
    //             },
    //             "columnDefs": [{
    //                 "className": "dt-center",
    //                 "targets": [0, 1, 2],
    //             }, {
    //                 "className": "dt-left",
    //                 "targets": [4],
    //             }],
    //             serverSide: true,
    //             ajax: {
    //                 'url': "<?=base_url(); ?>transaksi/load_laporan_transaksi",
    //                 'type': 'post',
    //                 'data': function(d) {
    //                     // d.bulan = $('input[name=bulan]').val();
    //                     // d.tahun = $('input[name=tahun]').val();
    //                     // d.perusahaan = $('select[name=perusahaan]').val();
    //                     // d.status = $('select[name=status]').val();
    //                 },
    //             },
    //             "columns": [
    //                 {
    //                     data: "tanggal",
    //                     className: "text-center",
    //                 },
    //                 {
    //                     data: "no_kas",
    //                     className: "text-center",
    //                 },
    //                 {
    //                     data: "keterangan",
    //                     className: "text-left",
    //                 },
    //                 {
    //                     data: "no_akun",
    //                     className: "text-center",
    //                 },
    //                 {
    //                     data: "debit",
    //                     className: "text-right",
    //                 },
    //                 {
    //                     data: "credit",
    //                     className: "text-right",
    //                 },
    //                 {
    //                     data: "saldo",
    //                     className: "text-right",
    //                 },
    //                 // {
    //                 //     data: "transaksi",
    //                 //     className: "text-center",
    //                 // },
    //                 // {
    //                 //     data: "jenis",
    //                 //     className: "text-center",
    //                 // },
    //                 // {
    //                 //     data: "dana",
    //                 //     className: "text-center",
    //                 // },
    //             ]
    //         });

    //         $('#bulan').on('change', function(e) {
    //             t.draw();
    //             e.preventDefault();
    //         });

    //         $('#tahun').on('change', function(e) {
    //             t.draw();
    //             e.preventDefault();
    //         });

    //         // $('#perusahaan').on('change', function(e) {
    //         //     t.draw();
    //         //     e.preventDefault();
    //         // });
    //         // $('#status').on('change', function(e) {
    //         //     t.draw();
    //         //     e.preventDefault();
    //         // });

    //         t.on('xhr', function(e, settings, json) {
    //             //     var month = json.month;
    //             //     var year = json.year;
    //             //     var perusahaan = json.perusahaan;
    //             //     if (perusahaan == 0) {
    //             //         // $("#cetaks2").attr("href", '#')
    //             //         // $("#cetaks").attr("href", '#')

    //             //         alert('kosong');

    //             //     } else {
    //             //         // alert('ok');
    //             //         // $("#cetaks2").attr("href", 'https://zadin.co.id/admin/laporan/cetak/'+month+'/'+year+'/'+perusahaan)
    //             //         // $("#cetaks").attr("href", 'https://zadin.co.id/admin/laporan/cetak/data/'+month+'/'+year+'/'+perusahaan)
    //             //     }
    //         });

    //     });
});
</script>





<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url(); ?>assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>