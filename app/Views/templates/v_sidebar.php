<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:rgb(5, 50, 109)">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("home") ?>">
        <div class="sidebar-logo">
            <img class="img-fluid" src="<?= site_url('asset/img/logo_ensa1.png') ?>" alt="Logo Ensa Seroja">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link font-weight-bold" href="<?= base_url('home')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Menu</div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('produk')?>">
            <i class="fas fa-box"></i>
            <span>Data Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('batch')?>">
            <i class="fas fa-barcode"></i>
            <span>Data Kode Produksi</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('info')?>">
            <i class="fas fa-info-circle"></i>
            <span>Profil Perusahaan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar --> 
