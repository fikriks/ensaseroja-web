<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $judul; ?></title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="ENSASEROJA" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Custom fonts & Bootstrap -->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #60B5FF;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background: #EFAA41;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background:rgb(255, 153, 0);
            color: white;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 login-container text-center">
                <img src="<?= base_url('asset/img/logo_ensa_seroja.png') ?>" alt="Logo Ensa Seroja" width="200">
                <h4 class="mb-4"><b>Login Ensa Seroja</b></h4>
                <?php if(session()->get("warning")){ ?>
                    <div class="alert alert-warning">Username atau Password salah!</div>
                <?php } else if(session()->get("err")){ ?>
                    <div class="alert alert-danger">Harap isi data yang ada!</div>
                <?php } ?>
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-group text-left">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan Username" name="username" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url("asset/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("asset/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
</body>
</html>
