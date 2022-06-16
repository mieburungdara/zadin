<html lang="en">

    <head>
        <title>Rekapitulasi bongkar Muat TUKS</title>
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
        <?php
$this->db->where('id', $tempat_muat);
$get_tempat_muat_id = $this->db->get('terminal')->row();
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="text-align: center"><strong>REKAPITULASI BONGKAR MUAT TUKS <?=$get_tempat_muat_id->nama; ?></strong></h5>
                    <br>
                    <table style="font-size: 11px">
                        <tbody>
                            <tr>
                                <th>Tempat Muat</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><strong><?=$get_tempat_muat_id->nama; ?></strong></td>
                            </tr>
                            <tr>
                                <th>Alamat Perusahaan</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_tempat_muat_id->lokasi; ?></td>
                            </tr>
                            <tr>
                                <th>Pelabuhan Bongkar Muat</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_tempat_muat_id->pelabuhan; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor SIUP PBM</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_tempat_muat_id->sk_tuks; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Pokok Wajib Pajak</th>
                                <td style="padding-left: 10px"> : </td>
                                <td style="padding-left: 10px"><?=$get_tempat_muat_id->npwp; ?></td>
                            </tr>
                            <tr>
                                <th>Laporan Bulan</th>
                                <td style="padding-left: 10px"> : </td>
                                <?php
$bulan = date('F', strtotime("2000-$bulan-01"));

?>
                                <td style="padding-left: 10px"><?=$bulan; ?> <?=$tahun; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="datatables" class="table table-bordered" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="50%">PBM</th>
                                <th width="10%" class="text-center">Jumlah Kapal</th>
                                <th width="10%" class="text-right">Jumlah B/M</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$no           = 1;
$jumlah_total = 0;
foreach ($datalist as $data) {
    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    $this->db->where('id', $data['operasional']);
    $get_operasional_id = $this->db->get('operasional')->row();
    $this->db->where('id', $get_operasional_id->perusahaan);
    $get_perusahaan_id = $this->db->get('perusahaan')->row();
    echo '<td>' . $get_perusahaan_id->nama . '</td>';
    echo '<td align="center">' . $data['inc'] . '</td>';
    echo '<td align="right">' . number_format($data['jumlah_asli'], 0, ',', '.') . '</td>';
    echo '</tr>';
    $jumlah_total = $jumlah_total + $data['jumlah_asli'];
}
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?=number_format($jumlah_total, 0, ',', '.'); ?></strong></td>
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