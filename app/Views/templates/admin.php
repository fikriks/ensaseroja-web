<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->renderSection('title') ?> - Ensa Seroja</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="ENSASEROJA" />
    <link rel="manifest" href="/site.webmanifest" />
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #EFAA41;
            border: 1px solid rgb(255, 225, 182);
        }

        .btn-primary:hover {
            background-color: rgb(255, 153, 0);
            border: 1px solid rgb(255, 225, 182);
        }

        .btn-primary:focus {
            background-color: rgb(255, 153, 0);
            border: 1px solid rgb(255, 225, 182);
        }
    </style>

    <?= $this->renderSection('css') ?>
</head>

<body id="page-top">
    <div id="wrapper">
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
                    <span>Data Produksi</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt" style="color: #EFAA41;"></i>
                    <span>Keluar</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin Ensa Seroja</span>
                            <img class="img-profile rounded w-100"
                                src="asset/img/logo_ensa_seroja.png">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <!-- <div id="content" style="flex: 1 0"> -->

            <!-- Topbar -->

            <!-- End of Topbar -->

            <?= $this->renderSection('content') ?>

            <!-- Footer -->
        </div>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

    <footer class="sticky-footer bg-white align-self-end w-100">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Melani Agustia Sari 2024</span>
            </div>
        </div>
    </footer>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin ingin keluar?.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asset/jquery-3.4.1.min.js"></script>
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/js/sb-admin-2.min.js"></script>

    <script src="asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!--my Script-->
    <script src="asset/js/script.js"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>