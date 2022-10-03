<?php defined('BASEPATH') or exit('No direct script access allowed');

$post_bulan = '09';
// $post_bulan = urldecode($this->input->post('post_bulan', true)) ?: date('m');
$post_tahun = urldecode($this->input->post('post_tahun', true)) ?: date('Y');
?>

<div class="row">
    <!-- end col -->

    <div class="px-4 mt-3 col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-3">BUKU BESAR Transaksi</h4>

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
                <div class="row">
                    <!-- <div class="col-12"> -->
                    <div class="col-2">
                        <label class="">Bulan</label>
                        <div class="">
                            <select class="form-control form-control-line">
                                <?php
// date_default_timezone_set('Asia/Makassar');
// setlocale(LC_ALL, "id_ID");
// print '<option value="" disabled selected>Pilih Bulan</option>';

$bolan = trim(date('m', time()));
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
<option value="13">Januari Februari Maret</option>
<option value="14">April Mei Juni</option>
<option value="15">Juli Agustus September</option>
<option value="16">Oktober November Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="">Tahun</label>
                        <div class="">
                            <select class="form-control form-control-line">
                                <?php
// $this->db->where('tanggal')
$taon = trim(date('Y', time()));
// print '<option value="" disabled selected>Pilih Tahun</option>';
$this->db->group_by("Year('tanggal')");
// $this->db->limit('',20);
$tahun = $this->db->get('transaksi', 20)->result();
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
                    <!-- </div> -->
                </div>

                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item pb-3 pr-3">
                        <a href="#semua" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded- active">

                            <span class="badge badge-light">Semua</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#invoice" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded-">

                            <span class=" badge badge-light">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#biaya-operasional" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded-">

                            <span class="badge badge-light">Biaya Operasional</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#kas" data-toggle="tab" aria-expanded="true" class="nav-link py-auto px-auto rounded-">
                            <span class="badge badge-light">Kas</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#bank" data-toggle="tab" aria-expanded="true" class="nav-link py-auto px-auto rounded-">
                            <span class="badge badge-light">Bank</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#biaya-atk" data-toggle="tab" aria-expanded="true" class="nav-link py-auto px-auto rounded-">
                            <span class="badge badge-light">Biaya ATK</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#gaji-karyawan" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded-">

                            <span class="badge badge-light">Gaji Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#saldo-kas" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded-">

                            <span class="badge badge-light">Saldo Kas</span>
                        </a>
                    </li>
                    <li class="nav-item pb-3 pr-3">
                        <a href="#saldo-bank" data-toggle="tab" aria-expanded="false" class="nav-link py-auto px-auto rounded-">

                            <span class="badge badge-light">Saldo Bank</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="semua">


                        <h3 class="pt-3 pb-2 text-center">Laporan <?=indonesian_date('', 'F Y'); ?></h3>

                        <div class="row">
                        <div class="table-umum col-6">

                        <h4 class="pt-3 pb-2 text-center">BUKU KAS</h4>
                            <table class="table mb-0 table-bordered" id="table-umum">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                        <th scope="col" class="text-center" style="width: 4%;">No Kas</th>
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
$this->db->order_by('tanggal', 'asc');
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
$this->db->where('buku', 1);
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    $tagal[] = indonesian_date($trse->tanggal, 'd');
}
// $tagal = array_unique($tagal);
$tagal = array_count_values($tagal);
// var_dump($tagal);
// foreach ($tagal as $tugal => $tugil) {
// echo '<br>' . $tugal . '  - ' . $tugil;
// }
// echo '<br>';
// $this->db->where('tanggal', '2022');
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
$this->db->where('buku', 1);
$this->db->order_by("tanggal");
// $this->db->group_by($tagal);
$transaksi_semua = $this->db->get('transaksi')->result();

$kas_saldo_all = 0;
$kas_saldo_d   = 0;
$kas_saldo_k   = 0;
foreach ($transaksi_semua as $trse) {
    echo '<tr>';
    $berapa    = indonesian_date($trse->tanggal, 'd');
    $berapanew = $berapa;
    if (!isset($berapaold)) {$berapaold = 0;}
    // echo $berapaold . ' - ';
    if ($berapanew != $berapaold) {
        echo '<td rowspan="' . $tagal[indonesian_date($trse->tanggal, 'd')] . '">' . indonesian_date($trse->tanggal, 'd') . '</td>';
        $berapaold = indonesian_date($trse->tanggal, 'd');
    } else {
        // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
    }
    echo '<td class="text-center">' . $trse->no_kas ?: "0" . '</td>';
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
    <td colspan="4" class="text-center font-weight-bold">Jumlah</td>
    <td class="text-right font-weight-bold"><?=number_format($kas_saldo_d, 0, ',', '.'); ?></td>
    <td class="text-right font-weight-bold"><?=number_format($kas_saldo_k, 0, ',', '.'); ?></td>
    <td class="text-right font-weight-bold"><?=number_format($kas_saldo_all, 0, ',', '.'); ?></td>
  </tr>
</tfoot>
                                </tbody>
                            </table>
                        </div>


                        <div class="table-umum col-6">
                        <h4 class="pt-3 pb-2 text-center">BUKU BANK</h4>
                            <table class="table mb-0 table-bordered" id="table-umum">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 0%;">Tgl</th>
                                        <th scope="col" class="text-center" style="width: 4%;">No Kas</th>
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
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
$this->db->order_by('tanggal', 'asc');
$this->db->where('buku', 2);
$transaksi_semua = $this->db->get('transaksi')->result();
foreach ($transaksi_semua as $trse) {
    $tagal[] = indonesian_date($trse->tanggal, 'd');
}
// $tagal = array_unique($tagal);
$tagal = array_count_values($tagal);
// var_dump($tagal);
// foreach ($tagal as $tugal => $tugil) {
// echo '<br>' . $tugal . '  - ' . $tugil;
// }
// echo '<br>';
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}
if ($post_bulan) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}
$this->db->where('buku', 2);
$this->db->order_by("tanggal");
// $this->db->group_by($tagal);
$transaksi_semua = $this->db->get('transaksi')->result();

$bank_saldo_all = 0;
$bank_saldo_d   = 0;
$bank_saldo_k   = 0;
foreach ($transaksi_semua as $trse) {
    echo '<tr>';
    $berapa    = indonesian_date($trse->tanggal, 'd');
    $berapanew = $berapa;
    if (!isset($berapaold)) {$berapaold = 0;}
    // echo $berapaold . ' - ';
    if ($berapanew != $berapaold) {
        echo '<td rowspan="' . $tagal[indonesian_date($trse->tanggal, 'd')] . '">' . indonesian_date($trse->tanggal, 'd') . '</td>';
        $berapaold = indonesian_date($trse->tanggal, 'd');
    } else {
        // echo '<td>' . indonesian_date($trse->tanggal, 'd') . '</td>';
    }
    echo '<td class="text-center">' . $trse->no_kas ?: "0" . '</td>';
    echo '<td class="text-left">' . $trse->keterangan . '</td>';
    echo '<td class="text-center">' . $trse->akun_kode . '</td>';
    if ($trse->dk == 1) {
        $bank_saldo_d = $trse->terbayar + $bank_saldo_d;
        echo '<td class="text-right">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
        echo '<td class="text-right">0</td>';
        $bank_saldo_all = $trse->terbayar + $bank_saldo_all;
    } else {
        $bank_saldo_k = $trse->terbayar + $bank_saldo_k;
        echo '<td class="text-right">0</td>';
        echo '<td class="text-right">' . number_format($trse->terbayar, 0, ',', '.') . '</td>';
        $bank_saldo_all = $bank_saldo_all - $trse->terbayar;
    }
    echo '<td class="text-right">' . number_format($bank_saldo_all, 0, ',', '.') . '</td>';
    // var_dump($trse);
    echo '</tr>';
}
?>
<tfoot>
  <tr>
    <td colspan="4" class="text-center font-weight-bold">Jumlah</td>
    <td class="text-right font-weight-bold"><?=number_format($bank_saldo_d, 0, ',', '.'); ?></td>
    <td class="text-right font-weight-bold"><?=number_format($bank_saldo_k, 0, ',', '.'); ?></td>
    <td class="text-right font-weight-bold"><?=number_format($bank_saldo_all, 0, ',', '.'); ?></td>
  </tr>
</tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane" id="invoice">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="biaya-operasional">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="kas">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="bank">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="saldo-kas">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="saldo-bank">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="biaya-atk">
                        <p>Donec enim.</p>
                    </div>
                    <div class="tab-pane" id="gaji-karyawan">
                        <p>Donec enim.</p>
                    </div>
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
$this->db->where('akun_kode', 23);
$this->db->where('tanggal', $tanggal_bulan_lalu);
$adakah_bulan_lalu_kas = $this->db->get('transaksi')->row();
$saldo_akhir_bulan_lalu_kas = 0;
if(!$adakah_bulan_lalu_kas){
$this->db->where('akun_kode', 21);
$saldo_akhir_bulan_lalu_kas = $this->db->get('transaksi')->row()->nominal;
$data = array(
    'tanggal' => $tanggal_bulan_lalu,
    'akun_kode' => 23,
    'buku' => 1,
    'keterangan' => 'saldo buat akhir bulan '. indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
    'dk' => 1,
    'nominal' => $saldo_akhir_bulan_lalu_kas,
);
// $this->db->insert('transaksi', $data);
    // echo 'saldo bulan lalu gk ada';
}else{
    // echo 'saldo bulan lalu ada';
$saldo_akhir_bulan_lalu_kas = $adakah_bulan_lalu_kas->nominal;

$tanggal_bulan_awal = date('Y-m-01');
$this->db->where('akun_kode', 25);
$this->db->where('tanggal', $tanggal_bulan_awal);
$adakah_bulan_awal_kas = $this->db->get('transaksi')->row();
if(!$adakah_bulan_lalu_kas){
    $data = array(
        'tanggal' => $tanggal_bulan_lalu,
        'akun_kode' => 25,
        'buku' => 1,
        'keterangan' => 'saldo akhir bulan '. indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
        'dk' => 1,
        'nominal' => $saldo_akhir_bulan_lalu_kas,
    );
    // $this->db->insert('transaksi', $data);
}else{
    // $this->db->set('field', 'field+1');
    // $this->db->where('id', 2);
    // $this->db->update('mytable');
    // $this->db->insert('transaksi', $data);
}
// var_dump($adakah_bulan_awal_kas);
};
// echo $saldo_akhir_bulan_lalu_kas;





// saldo BANK
$tanggal_bulan_lalu = date('Y-m-t', strtotime('last month'));
$this->db->where('akun_kode', 24);
$this->db->where('tanggal', $tanggal_bulan_lalu);
$adakah_bulan_lalu_bank = $this->db->get('transaksi')->row();
$saldo_akhir_bulan_lalu_bank = 0;
if(!$adakah_bulan_lalu_bank){
$this->db->where('akun_kode', 22);
$saldo_akhir_bulan_lalu_bank = $this->db->get('transaksi')->row()->nominal;
$data = array(
    'tanggal' => $tanggal_bulan_lalu,
    'akun_kode' => 25,
    'buku' => 2,
    'keterangan' => 'saldo buat akhir bulan '. indonesian_date(date('F Y', strtotime('last month')), 'F Y'),
    'dk' => 1,
    'nominal' => $saldo_akhir_bulan_lalu_bank,
);
// $this->db->insert('transaksi', $data);
    // echo 'saldo bulan lalu gk ada';
}else{
    // echo 'saldo bulan lalu ada';
$saldo_akhir_bulan_lalu_bank = $adakah_bulan_lalu_bank->nominal;


};
// echo $saldo_akhir_bulan_lalu_bank;



$saldo_akhir_kas  = $kas_saldo_all;
$saldo_akhir_bank = $bank_saldo_all;
if ($post_bulan) {
    $this->db->where('MONTH(tanggal)', $post_bulan);
}else{
    $this->db->where('MONTH(tanggal)', date('m'));
}
if ($post_tahun) {
    $this->db->where('YEAR(tanggal)', $post_tahun);
}else{
    $this->db->where('YEAR(tanggal)', date('Y'));
}
$hxh = $this->db->get('transaksi')->row();
if ($hxh) {
    // var_dump($hxh);
    // echo 'ada';
} else {
    // echo 'tidak ada';
}
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