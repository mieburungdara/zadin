<div class="col-12 mt-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Laporan Neraca </h4>


            <form action="<?=base_url(); ?>laporan/neraca" method="post">
                <div class="row mb-3  noprint">
                    <?php

$total_semuanya = 0;
$nahun          = $this->input->post('post_tahun');
$nulan          = $this->input->post('post_bulan');
?>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="">Tanggal</label>
                            <input type="text" required class="form-control" name="tanggal_nya" value="<?= $tuanggal ?? '' ?>" autocomplete="off" id="tanggal_range" aria-describedby="tanggal" placeholder="Tanggal">
                        </div>
                        <script>
                        var tanggal_awal = '<?= $post_awal ?? '' ?>';
                        var tanggal_akhir = '<?= $post_akhir ?? '' ?>';
                        $("#tanggal_range").daterangepicker({
                            daterangepickerFormat: 'DD MMMM YYYY',
                            minDate: moment().subtract(2, 'years')
                        }, function(startDate, endDate, period) {
                            // console.log(period);
                            tanggal_awal = startDate.format('YYYY-MM-DD');
                            tanggal_akhir = endDate.format('YYYY-MM-DD');
                            $(this).val(startDate.format('D MMMM YYYY') + ' – ' + endDate.format('D MMMM YYYY'));
                        });
                        console.log(tanggal_awal);
                        console.log(tanggal_akhir);
                        // $('#tanggal_range').daterangepicker({
                        //     forceUpdate: true,
                        // });
                        // $('#tanggal_range').datePicker({
                        //     format: 'YY-MM-DD HH:mm:ss'
                        // });
                        // $('#tanggal_range').dateRangePicker({
                        //     separator: ' hingga '
                        // });
                        </script>

                    </div>
                    <div class="col-2">
                        <button type="submit" name="filter" value="1" class="btn mt-4 btn-md btn-success waves-effect waves-light mr-2">Filter</button>
                        <button type="submit" name="cetak" value="1" class="btn mt-4 btn-md btn-success waves-effect waves-light mr-2">Cetak</button>
                        <script>
                        $("[name=filter]").click(function() {
                            if (tanggal_awal && tanggal_akhir) {
                                // console.log(tanggal_awal, tanggal_akhir);
                            } else {
                                alert("Tanggal Tidak Boleh Kosong..")
                            }
                        });
                        $("[name=cetak]").click(function() {
                            if (tanggal_awal && tanggal_akhir) {
                                // console.log(tanggal_awal, tanggal_akhir);
                                // $.get("<?= base_url('laporan/get_filter')?>", function(data, status) {
                                //     alert("Data: " + data + "\nStatus: " + status);
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
                        <th style="width:1%"></th>
                        <th style="width:1%"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $numur = 0;
                $abjat = 'a';
                ?>
                <tbody>
                    <tr>
                        <td class="text-uppercase"><b style="border-bottom: 2px solid black;"> AKTIVA </b></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= ++$numur?>.</td>
                        <td>Saldo Kas per <?= $tuanggal?></td>
                        <!-- <td>1. Saldo Kas per <?= explode(' – ', $tuanggal)[0]?></td> -->
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <?php
                            $nr = array();
                            $this->db->where_in('lr',array('biaya_pegawai', 'biaya_operasional','biaya_kantor','pendapatan_usaha','saldo_akhir_bulan','gaji_direksi'));
                            $this->db->from('akun_kode');
                            $get_kode = $this->db->get()->result();
                            foreach($get_kode as $row){
$nr[] = $row->id;
                            }
                            // dd($nr);
$this->db->order_by('tanggal', 'asc');
$this->db->where_in('akun_kode',$nr);
$this->db->where("tanggal BETWEEN '$post_awal' AND '$post_akhir'");
$this->db->where("buku", "1");
$this->db->from('transaksi');
$get_db = $this->db->get()->result();
// echo $this->db->last_query();
// dd($get_db);
$total_kas = 0;
foreach($get_db as $row){
// dd($row->tanggal);
    if($row->dk == 1){
$total_kas = $total_kas+$row->terbayar;
// echo($total_kas . ' '. $row->keterangan);
    }else{
$total_kas = $total_kas-$row->terbayar;
// echo($total_kas . ' '. $row->keterangan);
    }
    // echo '<br>';
    // echo '<br>';
}
// echo $total_kas;
?>
                            <div style="float:right;text-align:right;"><?=number_format($total_kas, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= ++$numur?>.</td>
                        <td>Saldo Bank per <?= $tuanggal?></td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <?php
                            $nr = array();
                            $this->db->where_in('lr',array('saldo_akhir_bulan', 'pindah_buku','pendapatan_usaha','pajak','biaya_operasional','beban','bunga'));
                            $this->db->from('akun_kode');
                            $get_kode = $this->db->get()->result();
                            foreach($get_kode as $row){
$nr[] = $row->id;
                            }
                            // dd($nr);
$this->db->order_by('tanggal', 'asc');
$this->db->where_in('akun_kode',$nr);
$this->db->where("tanggal BETWEEN '$post_awal' AND '$post_akhir'");
$this->db->where("buku", "2");
$this->db->from('transaksi');
$get_db = $this->db->get()->result();
// echo $this->db->last_query();
// dd($get_db);
$total_bank = 0;
foreach($get_db as $row){
// dd($row->tanggal);
    if($row->dk == 1){
$total_bank = $total_bank+$row->terbayar;
// echo($total_bank . ' '. $row->keterangan);
    }else{
$total_bank = $total_bank-$row->terbayar;
// echo($total_bank . ' '. $row->keterangan);
    }
    // echo '<br>';
    // echo '<br>';
}
echo $total_bank;
?>
                            <div style="float:right;text-align:right;"><?=number_format($total_bank, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= ++$numur?>.</td>
                        <td>Piutang</td>
                        <td>
                            <div style="float:left;text-align:left;"></div>
                            <div style="float:right;text-align:right;"></div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><?= $abjat++?>. Pembayaran PPH23</td>
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <?php
                            $tr = array();
$this->db->order_by('tanggal', 'asc');
$this->db->where('akun_kode',101);
$this->db->where("tanggal BETWEEN '$post_awal' AND '$post_akhir'");
// $this->db->where("buku", "2");
$this->db->from('transaksi');
$get_tr = $this->db->get()->result();
                            foreach($get_tr as $row){
$tr[] = $row->id;
                            }
// dd($tr);
$this->db->where_in('id_transaksi', $tr);
$this->db->from('operasional');
$get_op = $this->db->get()->result();
// dd($get_op);
$jumlahpph23 = 0;
foreach($get_op as $row){
$jumlahpph23 = $jumlahpph23 + $row->pt;
}

                            $tr
                            ?>
                            <div style="float:right;text-align:right;"><?=number_format($jumlahpph23, 0, ',', '.'); ?></div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="border-top: 2px solid black; border-bottom: 5px double black;"><b>
                                <div style="float:left;text-align:left;">Rp.</div>
                                <div style="float:right;text-align:right;"><?=number_format($jumlahpph23 + $total_kas + $total_bank, 0, ',', '.'); ?></div>
                            </b>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-uppercase"><b style="border-bottom: 2px solid black;"> Pasiva </b></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php $numur = 0; ?>
                    <tr>
                        <td></td>
                        <td><?= ++$numur?>.</td>
                        <td>Laba ditahan dari <?= $tuanggal?></td>
                        <!-- <td>Laba ditahan tahun <?= date("Y",strtotime(explode(' – ', $tuanggal)[0]))?></td> -->
                        <!-- <td>Laba ditahan tahun <?= date("Y",strtotime(explode(' – ', $tuanggal)[0]))?></td> -->
                        <td>
                            <div style="float:left;text-align:left;">Rp.</div>
                            <div style="float:right;text-align:right;">0</div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>
</div>


<!-- $this->db->where("tanggal BETWEEN '$post_awal' AND '$post_akhir'");s -->