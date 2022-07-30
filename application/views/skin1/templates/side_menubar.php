<aside class="left-sidebar">

    <style>
    .sidebar-nav ul .sidebar-item .first-level .sidebar-item .sidebar-link i {
        display: block;
        font-size: 14px;
    }
    </style>

    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item mr-1"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false"><i class="fa-duotone fa-file-chart-column mr-2"></i><span class="hide-menu"> Dashboard</span></a>
                </li>
                <li class="sidebar-item mr-1"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-scroll-old mr-2"></i><span class="hide-menu">Laporan</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"> <a href="<?php echo base_url('laporan/perusahaan'); ?>" class="sidebar-link"><i class="fa-duotone fa-buildings mr-2"></i><span class="hide-menu"> Perusahaan</span></a></li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('laporan/terminal'); ?>" class="sidebar-link"><i class="fa-duotone fa-garage mr-2"></i><span class="hide-menu"> Terminal</span></a></li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('laporan/operasional'); ?>" class="sidebar-link"><i class="fa-duotone fa-garage mr-2"></i><span class="hide-menu"> Operasional</span></a></li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('laporan/invoice'); ?>" class="sidebar-link"><i class="fa-duotone fa-garage mr-2"></i><span class="hide-menu"> Invoice</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item mr-1"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('operasional'); ?>" aria-expanded="false"><i class="fa-duotone fa-scroll-old mr-2"></i><span class="hide-menu"> Operasional</span></a>
                </li>
                <li class="sidebar-item mr-1"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('transaksi'); ?>" aria-expanded="false"><i class="fa-duotone fa-scroll-old mr-2"></i><span class="hide-menu"> Transaksi</span></a>
                </li>

                <!-- <li class="sidebar-item mr-1"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-scroll-old mr-2"></i><span class="hide-menu">Transaksi</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"> <a href="<?php echo base_url('transaksi/invoice'); ?>" class="sidebar-link"><i class="fa-duotone fa-buildings mr-2"></i><span class="hide-menu"> Invoice</span></a></li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('transaksi/inventori'); ?>" class="sidebar-link"><i class="fa-duotone fa-garage mr-2"></i><span class="hide-menu"> Inventori</span></a></li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('transaksi/akun'); ?>" class="sidebar-link"><i class="fa-duotone fa-garage mr-2"></i><span class="hide-menu"> Akun</span></a></li>
                    </ul>
                </li> -->


                <!-- <li class="nav-small-cap"><i class="fa-duotone fa-gears mr-2"></i> <span class="hide-menu"></span></li> -->
                <li class="sidebar-item mr-1"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-gears mr-2"></i><span class="hide-menu">Masters</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-box-archive mr-2"></i> <span class="hide-menu">Akun</span></a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item"><a href="<?php echo base_url('akun/kelompok'); ?>" class="sidebar-link"><i class="fa-duotone fa-list-check mr-2"></i><span class="hide-menu">
                                            Kelompok</span></a>
                                </li>
                                <li class="sidebar-item"><a href="<?php echo base_url('akun/kode'); ?>" class="sidebar-link"><i class="fa-duotone fa-list-check mr-2"></i><span class="hide-menu">
                                            Kode</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a href="<?php echo base_url('perusahaan'); ?>" class="sidebar-link"><i class="fa-duotone fa-buildings mr-2"></i><span class="hide-menu"> Perusahaan</span></a></li>
                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-ship mr-2"></i> <span class="hide-menu">Kapal</span></a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item"><a href="<?php echo base_url('kapal'); ?>" class="sidebar-link"><i class="fa-duotone fa-list-ol mr-2"></i><span class="hide-menu">Daftar</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo base_url('agen_kapal'); ?>" class="sidebar-link"><i class="fa-duotone fa-anchor mr-2"></i><span class="hide-menu">Agen</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-garage mr-2"></i> <span class="hide-menu">Terminal</span></a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item"><a href="<?php echo base_url('terminal'); ?>" class="sidebar-link"><i class="fa-duotone fa-truck-ramp-box mr-2"></i><span class="hide-menu">
                                            Tempat muat</span></a>
                                </li>
                                <li class="sidebar-item"><a href="<?php echo base_url('jenis_terminal'); ?>" class="sidebar-link"><i class="fa-duotone fa-list-check mr-2"></i><span class="hide-menu">
                                            Jenis</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="fa-duotone fa-box-archive mr-2"></i> <span class="hide-menu">Barang</span></a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item"><a href="<?php echo base_url('barang_jenis'); ?>" class="sidebar-link"><i class="fa-duotone fa-list-check mr-2"></i><span class="hide-menu">
                                            Jenis</span></a>
                                </li>
                                <li class="sidebar-item"><a href="<?php echo base_url('barang_asal'); ?>" class="sidebar-link"><i class="fa-duotone fa-truck-plow mr-2"></i><span class="hide-menu">
                                            Asal</span></a>
                                </li>
                                <li class="sidebar-item"><a href="<?php echo base_url('barang_pemilik'); ?>" class="sidebar-link"><i class="fa-duotone fa-chalkboard-user mr-2"></i><span class="hide-menu">
                                            Pemilik</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<div class="page-wrapper">