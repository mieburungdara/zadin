<html lang="en">

    <head>
        <title>Laporan Rekap Invoice</title>
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
                    <h5 style="text-align: center"><strong>Laporan Rekap Invoice <?=$judul; ?></strong></h5>
                    <!-- <br> -->

                    <table id="datatables" class="table table-bordered" width="100%" style="font-size: 11px; margin-top: 20px">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">PBM</th>
                                <th class="text-center">Shipper</th>
                                <th class="text-right">Bruto</th>
                                <th class="text-right">PPH</th>
                                <th class="text-right">Netto</th>
                                <?php
// echo '<th class="text-right">Biaya</th>';
; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$no    = 1;
$bruto = 0;
$pph = 0;
$neto = 0;
if ($datalist) {
    foreach ($datalist as $data) {
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        echo '<tr>';
        echo '<td class="text-center">' . $no++ . '</td>';
        echo '<td class="text-center">' . $data['tanggal'] . '</td>';
        echo '<td class="text-center">' . $data['status'] . '</td>';
        echo '<td class="text-left">' . $data['invoice'] . '</td>';
        echo '<td class="text-left">' . $data['pbm'] . '</td>';
        echo '<td class="text-left">' . $data['shipper'] . '</td>';
        echo '<td align="right">' . number_format($data['bruto'], 0, ',', '.') . '</td>';
        echo '<td align="right">' . number_format($data['pph'], 0, ',', '.') . '</td>';
        echo '<td align="right">' . number_format($data['neto'], 0, ',', '.') . '</td>';
        $bruto = $bruto + $data['bruto'];
        $pph = $pph + $data['pph'];
        $neto = $neto + $data['neto'];
        echo '</tr>';
    }
}
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" align="center"><strong>Total</strong></td>
                                <?php
echo '<td align="right"><strong>' . number_format($bruto, 0, ',', '.') . '</th>';
echo '<td align="right"><strong>' . number_format($pph, 0, ',', '.') . '</th>';
echo '<td align="right"><strong>' . number_format($neto, 0, ',', '.') . '</th>';
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