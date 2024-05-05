<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Lintas Media</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a href="<?= base_url('dashboard') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Dashboard</span></a>
                        </li>
                    </ul>
                </li> -->
                <li class=" nav-item"><a href="<?= base_url('dashboard') ?>"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Calender">Dashboard</span></a>

                </li>
                <?php if ($this->session->userdata('role') == 'Pelanggan') { ?>
                    <li class=" nav-item"><a href="<?= base_url('pelanggan/history') ?>"><i class="feather icon-user"></i><span
                                class="menu-title" data-i18n="Calender">History Payment</span></a>
                    <?php } ?>
                <?php if ($this->session->userdata('role') == 'Super Admin' || $this->session->userdata('role') == 'Admin') { ?>
                <li class=" nav-item"><a href="<?= base_url('pelanggan/registrasi') ?>"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender">Registrasi</span></a>
                <?php } ?>
                <?php if ($this->session->userdata('role') != 'Pelanggan') { ?>
                <li class=" nav-item"><a href="<?= base_url('pelanggan/list') ?>"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Calender">List Pelanggan</span></a>
                <?php } ?>
                <!-- <li class=" nav-item"><a href="#"><i class="feather icon-book-open"></i><span class="menu-title" data-i18n="Ecommerce">Pelanggan</span></a>
                    <ul class="menu-content">
                        <?php if ($this->session->userdata('role') == 'Super Admin') {?>    
                        <li><a href="<?= base_url('pelanggan/registrasi') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Registrasi</span></a>
                        </li>
                        <?php } ?>
                        <li><a href="<?= base_url('pelanggan/list') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">List Pelanggan</span></a>
                        </li>
                    </ul>
                </li> -->
                <?php if ($this->session->userdata('role') == 'Super Admin') {?>
                <li class=" nav-item"><a href="#"><i class="feather icon-book-open"></i><span class="menu-title" data-i18n="Ecommerce">Group</span></a>
                    <ul class="menu-content">
                            <li><a href="<?= base_url('pelanggan/alamat') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Group</span></a>
                            <li><a href="<?= base_url('pelanggan/role') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Perizinan</span></a>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Super Admin') {?>
                    <li class=" nav-item"><a href="<?= base_url('pelanggan/pembayaran') ?>"><i class="feather icon-log-in"></i><span class="menu-title" data-i18n="Calender">Buat Pembayaran</span></a>
                    <li class=" nav-item"><a href="<?= base_url('pelanggan/cetak') ?>"><i class="feather icon-log-in"></i><span class="menu-title" data-i18n="Calender">Cetak</span></a>
                <?php } ?>
                <?php if ($this->session->userdata('role') != 'Pelanggan') { ?>
                <li class=" nav-item"><a href="<?= base_url('pelanggan/status') ?>"><i class="feather icon-check-square"></i><span class="menu-title" data-i18n="Calender">Status Pembayaran</span></a>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Super Admin') {?>
                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a href="<?= base_url('user/create') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Buat User</span></a>
                        </li>
                        <li><a href="<?= base_url('user') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View</span></a>
                        </li>
                      
                    </ul>
                </li>
                <?php }  ?>
                <?php if ($this->session->userdata('role') == 'Super Admin') {?>
               
                <li class=" nav-item"><a href="#"><i class="feather icon-clipboard"></i><span class="menu-title" data-i18n="User">Keuangan</span></a>
                    <ul class="menu-content">
                        <li><a href="<?= base_url('keuangan/create') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Pengeluaran</span></a>
                        </li>
                        <li><a href="<?= base_url('keuangan') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View</span></a>
                        </li>
                      
                    </ul>
                </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Super Admin') {?>
                <li class=" nav-item"><a href="<?= base_url('paket') ?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">Paket internet</span></a>
                <li class=" nav-item"><a href="<?= base_url('pelanggan/addon') ?>"><i class="feather icon-calendar"></i><span class="menu-title" data-i18n="Calender">Master Add on</span></a>
                <?php } ?>
                <?php if ($this->session->userdata('role') != 'Pelanggan') { ?>

                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Laporan</span></a>
                    <ul class="menu-content">
                        <li><a href="<?= base_url('laporan/create') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Buat User</span></a>
                        </li>
                        <li><a href="<?= base_url('laporan') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View</span></a>
                        </li>
                      
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>