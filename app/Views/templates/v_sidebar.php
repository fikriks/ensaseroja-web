<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:rgb(0, 136, 255)">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-5" href="<?= base_url("home") ?>">
        <div class="sidebar-logo mt-5">
            <img class="img-fluid d-block" src="<?= site_url('asset/img/logo_ensa_seroja.png') ?>" alt="Logo Ensa Seroja" width="100">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link font-weight-bold" href="<?= base_url('home') ?>">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #EFAA41;"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Menu</div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('produk') ?>">
            <i class="fas fa-box" style="color: #EFAA41;"></i>
            <span>Data Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('batch') ?>">
            <i class="fas fa-barcode" style="color: #EFAA41;"></i>
            <span>Data Kode Produksi</span>
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