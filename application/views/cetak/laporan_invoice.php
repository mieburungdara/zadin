<html lang="en">

    <head>
        <title>Laporan Invoice</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
        .fonts {
            font-family: "Times New Roman", Times, serif;
        }

        .noBorder {
            border: none !important;
            border-collapse: separate;
            border-spacing: 0px 15px;
        }

        @media print and (width: 21cm) and (height: 29.7cm) {
            @page {
                margin: 0.5cm;
            }
        }

        @page {
            size: A4 portrait;
            margin: 5%;
        }

        @media print {
            tfoot {
                display: table-row-group;
                bottom: 0;
                height: 50px;
                width: 100%;
                /* position: sticky; */

            }

            #datatables>th>td {
                border: solid black !important;
                border-width: 1px 1px 1px 1px !important;
            }
        }
        </style>
        <style>
        .bootstrapiso .tooltip {
            font-size: 14px;
        }

        .bootstrapiso .tooltip-inner {
            max-width: 200px;
        }
        </style>
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="true">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swa">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="text-align: center"><strong>Laporan Biaya <?=$judul; ?> </strong></h5>
                    <!-- <br> -->

                    <table id="datatables" class="table table-bordered" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Admin</th>
                                <th class="text-center">No.RKBM</th>
                                <th class="text-center">Terminal</th>
                                <th class="text-center">Kapal</th>
                                <?php
if (empty($jenis)) {
    // if ($jenis == 1) {
    echo '<th class="text-center">Operasional</th>';
    // }
    // if ($jenis == 2) {
    echo '<th class="text-center">Honor</th>';
    // }
    // if ($jenis == 3) {
    echo '<th class="text-center">Konsumsi</th>';
    // }
    // if ($jenis == 4) {
    echo '<th class="text-center">Kapal</th>';
    // }
    // if ($jenis == 5) {
    echo '<th class="text-center">Dozer</th>';
    // }
    // if ($jenis == 6) {
    echo '<th class="text-center">Antar</th>';
    // }
    // if ($jenis == 7) {
    echo '<th class="text-center">Jemput</th>';
    // }
} else {
    echo '<th class="text-center">Biaya</th>';
}
?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$no                            = 1;
$jumlah_biaya_operasional      = 0;
$jumlah_biaya_honor            = 0;
$jumlah_biaya_konsumsi         = 0;
$jumlah_biaya_kapal            = 0;
$jumlah_biaya_dozer            = 0;
$jumlah_biaya_speedboat_antar  = 0;
$jumlah_biaya_speedboat_jemput = 0;
if ($datalist) {
    foreach ($datalist as $data) {
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        echo '<tr>';
        echo '<td class="text-center">' . $no++ . '</td>';
        echo '<td class="text-center">' . $data['status'] . '</td>';
        echo '<td class="text-center">' . $data['tanggal'] . '</td>';
        echo '<td class="text-center">' . $data['admin'] . '</td>';
        echo '<td class="text-left">' . $data['no_rkbm'] . '</td>';
        echo '<td>' . $data['terminal'] . '</td>';
        echo '<td>' . $data['kapal'] . '</td>';
        // echo '<td>' . $data['biaya'] . '</td>';
        if (!empty($jenis)) {
            if ($jenis == 1) {
                echo '<td align="right">' . number_format($data['biaya_operasional'], 0, ',', '.') . '</td>';
                $jumlah_biaya_operasional = $jumlah_biaya_operasional + $data['biaya_operasional'];
            }
            if ($jenis == 2) {
                echo '<td align="right">' . number_format($data['biaya_honor'], 0, ',', '.') . '</td>';
                $jumlah_biaya_honor = $jumlah_biaya_honor + $data['biaya_honor'];
            }
            if ($jenis == 3) {
                echo '<td align="right">' . number_format($data['biaya_konsumsi'], 0, ',', '.') . '</td>';
                $jumlah_biaya_konsumsi = $jumlah_biaya_konsumsi + $data['biaya_konsumsi'];
            }
            if ($jenis == 4) {
                echo '<td align="right">' . number_format($data['biaya_kapal'], 0, ',', '.') . '</td>';
                $jumlah_biaya_kapal = $jumlah_biaya_kapal + $data['biaya_kapal'];
            }
            if ($jenis == 5) {
                echo '<td align="right">' . number_format($data['biaya_dozer'], 0, ',', '.') . '</td>';
                $jumlah_biaya_dozer = $jumlah_biaya_dozer + $data['biaya_dozer'];
            }
            if ($jenis == 6) {
                echo '<td align="right">' . number_format($data['biaya_speedboat_antar'], 0, ',', '.') . '</td>';
                $jumlah_biaya_speedboat_antar = $jumlah_biaya_speedboat_antar + $data['biaya_speedboat_antar'];
            }
            if ($jenis == 7) {
                echo '<td align="right">' . number_format($data['biaya_speedboat_jemput'], 0, ',', '.') . '</td>';
                $jumlah_biaya_speedboat_jemput = $jumlah_biaya_speedboat_jemput + $data['biaya_speedboat_jemput'];
            }
        } else {
            echo '<td align="right">' . number_format($data['biaya_operasional'], 0, ',', '.') . '</td>';
            $jumlah_biaya_operasional = $jumlah_biaya_operasional + $data['biaya_operasional'];
            echo '<td align="right">' . number_format($data['biaya_honor'], 0, ',', '.') . '</td>';
            $jumlah_biaya_honor = $jumlah_biaya_honor + $data['biaya_honor'];
            echo '<td align="right">' . number_format($data['biaya_konsumsi'], 0, ',', '.') . '</td>';
            $jumlah_biaya_konsumsi = $jumlah_biaya_konsumsi + $data['biaya_konsumsi'];
            echo '<td align="right">' . number_format($data['biaya_kapal'], 0, ',', '.') . '</td>';
            $jumlah_biaya_kapal = $jumlah_biaya_kapal + $data['biaya_kapal'];
            echo '<td align="right">' . number_format($data['biaya_dozer'], 0, ',', '.') . '</td>';
            $jumlah_biaya_dozer = $jumlah_biaya_dozer + $data['biaya_dozer'];
            echo '<td align="right">' . number_format($data['biaya_speedboat_antar'], 0, ',', '.') . '</td>';
            $jumlah_biaya_speedboat_antar = $jumlah_biaya_speedboat_antar + $data['biaya_speedboat_antar'];
            echo '<td align="right">' . number_format($data['biaya_speedboat_jemput'], 0, ',', '.') . '</td>';
            $jumlah_biaya_speedboat_jemput = $jumlah_biaya_speedboat_jemput + $data['biaya_speedboat_jemput'];
        }

        // $this->db->where('id', $data['operasional']);
        // $get_operasional_id = $this->db->get('operasional')->row();
        // $this->db->where('id', $get_operasional_id->perusahaan);
        // $get_perusahaan_id = $this->db->get('perusahaan')->row();
        // echo '<td>' . $get_perusahaan_id->nama . '</td>';
        // echo '<td align="center">' . $data['inc'] . '</td>';
        echo '</tr>';
    }
}
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" align="center"><strong>Total</strong></td>
                                <?php
if (!empty($jenis)) {
    echo '<td align="right"><strong>';
    if ($jenis == 1) {
        echo number_format($jumlah_biaya_operasional, 0, ',', '.');
    }
    if ($jenis == 2) {
        echo number_format($jumlah_biaya_honor, 0, ',', '.');
    }
    if ($jenis == 3) {
        echo number_format($jumlah_biaya_konsumsi, 0, ',', '.');
    }
    if ($jenis == 4) {
        echo number_format($jumlah_biaya_kapal, 0, ',', '.');
    }
    if ($jenis == 5) {
        echo number_format($jumlah_biaya_dozer, 0, ',', '.');
    }
    if ($jenis == 6) {
        echo number_format($jumlah_biaya_speedboat_antar, 0, ',', '.');
    }
    if ($jenis == 7) {
        echo number_format($jumlah_biaya_speedboat_jemput, 0, ',', '.');
    }
    echo '</strong></td>';
} else {
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_operasional, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_honor, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_konsumsi, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_kapal, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_dozer, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_speedboat_antar, 0, ',', '.') . '</th>';
    echo '<td align="right"><strong>' . number_format($jumlah_biaya_speedboat_jemput, 0, ',', '.') . '</th>';
}
?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <script>
        // window.print();
        </script>


        <div id="mttContainer" class="bootstrapiso" style="left: 0px; top: 0px; position: fixed; z-index: 100000200; width: 500px; margin-left: -250px; background-color: rgba(0, 0, 0, 0); pointer-events: none; transform: translate(285px, 121px);" data-original-title="" title=""></div>
    </body>

</html>