<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Daftar Asal Barang</h3>
    </div>
</div>

<div style="min-height: calc(100vh - 180px);">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                        <?php echo anchor(site_url("barang_asal/create"), "Tambah Data", "class='btn btn-info'"); ?>
                    </div>

                </div>


                <table id="example" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Inisial</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>SK Barang</th>
                            <th>NPWP</th>
                            <th>PPH</th>
                            <th>Total PPH</th>
                            <th>Baru</th>
                            <th>Perpanjang</th>
                            <th>Revisi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    if (window.location.href == "<?=base_url(); ?>barang_asal" || window.location.href == "<?=base_url(); ?>barang_asal/") {
        // $(this).addClass("is-selected");
        $('.page-wrapper').css("max-width", "1500px");
    }
});


$(function() {
    var t = $('#example').DataTable({
        "drawCallback": function(settings) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        },
        processing: true,
        "language": {
            // "lengthMenu": "Menampilkan _MENU_ hasil per halaman",
            // "search": "Pencarian:",
            // "zeroRecords": "Tidak ditemukan",
            // "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
            // "infoEmpty": "Tidak ada data ditemukan",
            // "infoFiltered": "(Disaring dari _MAX_ data)"
        },
        serverSide: true,
        ajax: {
            'url': "<?=base_url(); ?>barang_asal/load",
            'type': 'post',
            // 'data': function(d) {
            // d.bulan = $('input[name=filter_bulan]').val();
            // d.tahun = $('input[name=filter_tahun]').val();
            // d.jenis_permohonan = $('select[name=filter_permohonan_jenis]').val();
            // d.status = $('select[name=filter_status]').val();
            // d.kapal = $('select[name=filter_kapal]').val();
            // d.tempat_muat = $('select[name=filter_tempat_muat]').val();
            // d.barang = $('select[name=filter_barang]').val();
            // },
        },
        "columns": [{
                data: "inisial",
            },
            {
                data: "nama",
            },
            {
                data: "alamat",
            },
            {
                data: "skb",
            },
            {
                data: "npwp",
            },
            {
                data: "pph",
            },
            {
                data: "total_pph",
            },
            {
                data: "tb",
            },
            {
                data: "tp",
            },
            {
                data: "tr",
            },
            {
                data: "opsi",
            },
        ]
    });

    // $('#filter_bulan').on('change', function(e) {
    //     t.draw();
    //     e.preventDefault();
    // });

    // t.on('xhr', function(e, settings, json) {
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
    // });

});
</script>