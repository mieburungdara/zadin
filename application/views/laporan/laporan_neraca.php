});
$("[name=cetak]").click(function() {
if (tanggal_awal && tanggal_akhir) {
// console.log(tanggal_awal, tanggal_akhir);
// $.get("<?= base_url('laporan/get_filter')?>", function(data, status) {
// alert("Data: " + data + "\nStatus: " + status);
// });
} else {
alert("Tanggal Tidak Boleh Kosong..")
}
});
</script>
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
            <td class="text-uppercase"><b style="border-bottom: 2px solid black;"> AKTIVA </b></b></td>
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

    $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d') >='$post_awal'");
    $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d') <='$post_akhir'");
// if ($nahun) {
//     $this->db->where('YEAR(tanggal)', $nahun);
// }
// if ($nulan <= 12) {
//     $this->db->where('MONTH(tanggal)', $nulan);
// }
// if ($nulan == 13) {
//     $this->db->where('MONTH(tanggal) >=', 1);
//     $this->db->where('MONTH(tanggal) <=', 3);
// }
// if ($nulan == 14) {
//     $this->db->where('MONTH(tanggal) >=', 4);
//     $this->db->where('MONTH(tanggal) <=', 6);
// }
// if ($nulan == 15) {
//     $this->db->where('MONTH(tanggal) >=', 7);
//     $this->db->where('MONTH(tanggal) <=', 9);
// }
// if ($nulan == 16) {
//     $this->db->where('MONTH(tanggal) >=', 10);
//     $this->db->where('MONTH(tanggal) <=', 12);
// }
// if ($nulan == 17) {
//     $this->db->where('MONTH(tanggal) >=', 1);
//     $this->db->where('MONTH(tanggal) <=', 12);
// }
$this->db->where_in('akun_kode', $did);
$cot = $this->db->get('transaksi')->result();
dd($cot);
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
        <tr>
            <td>Pendapatan diluar usaha</td>
            <td>
                <div style="float:left;text-align:left;">Rp.</div>
                <div style="float:right;text-align:right;"><?=number_format($pdu, 0, ',', '.'); ?></div>
            </td>
            <td></td>
        </tr>
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