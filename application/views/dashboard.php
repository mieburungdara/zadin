        <link rel="stylesheet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Belum di isi
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$semua_operasional = $this->db->get('operasional')->result();
?>
                                    <h2><?=count($semua_operasional); ?></h2>
                                    <h6 class="text-info">Total Operasional</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where_in('operasional_status', array(1, 2));
$operasional_berjalan = $this->db->get('operasional')->result();
?>
                                    <h2><?=count($operasional_berjalan); ?></h2>
                                    <h6 class="text-info">Operasional Berjalan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('operasional_status', 3);
$operasional_selesai = $this->db->get('operasional')->result();
?>
                                    <h2><?=count($operasional_selesai); ?></h2>
                                    <h6 class="text-info">Operasional Selesai</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$semua_permohonan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan); ?></h2>
                                    <h6 class="text-info">Semua Permohonan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where_in('operasional_status', array(1, 2));
$semua_operasional = $this->db->get('operasional')->result();
foreach ($semua_operasional as $operasional) {
    $permohonan_berjalan_array[] = $operasional->id;
}
var_dump($permohonan_berjalan_array);
if (!empty($permohonan_berjalan_array)) {
    $this->db->where_in('operasional', $permohonan_berjalan_array);
    $semua_permohonan_berjalan = $this->db->get('permohonan')->result();
} else {
    $semua_permohonan_berjalan = 0;
}
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Permohonan Berjalan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('operasional_status', 3);
$semua_operasional = $this->db->get('operasional')->result();
foreach ($semua_operasional as $operasional) {
    $permohonan_selesai_array[] = $operasional->id;
}
$this->db->where_in('operasional', $permohonan_selesai_array);
$semua_permohonan_berjalan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Permohonan Selesai</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('status', 1);
$semua_permohonan_berjalan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Total Permohonan Baru</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('status', 2);
$semua_permohonan_berjalan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Total Permohonan Perpanjang</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('status', 3);
$semua_permohonan_berjalan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Total Permohonan Revisi</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <?php
$this->db->where('status', 4);
$semua_permohonan_berjalan = $this->db->get('permohonan')->result();
?>
                                    <h2><?=count($semua_permohonan_berjalan); ?></h2>
                                    <h6 class="text-info">Total Permohonan Batal</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card border-bottom border-info">
                        <div class="card-body">
                            <label class="label label-success">Total Operasional</label>
                            <div id="bar-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>

        <?php
date_default_timezone_set('Asia/Makassar');
$this->db->where('YEAR(created_at)', date('Y'));
$get_operasional = $this->db->get('operasional')->result();
foreach ($get_operasional as $go) {
//     // echo $go->created_at;
    $dateValue = strtotime($go->created_at);
    //     $tahun_array[] = date("Y", $dateValue);
    $bulan_array[]     = date("m", $dateValue);
    $txt_bulan_array[] = date("F", $dateValue);
}
$bulan_array     = array_unique($bulan_array);
$txt_bulan_array = array_unique($txt_bulan_array);
$jsonnya         = array($bulan_array);
echo json_encode($txt_bulan_array);

?>
        <script>
var data = [{
            y: '2014',
            a: 50,
            b: 90
        },
        {
            y: '2015',
            a: 65,
            b: 75
        }
    ],
    config = {
        data: data,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Total Income', 'Total Outcome'],
        fillOpacity: 0.6,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors: ['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors: ['gray', 'red']
    };
config.element = 'bar-chart';
Morris.Bar(config);
        </script>