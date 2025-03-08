<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $judul; ?></title>

    <!-- Custom fonts & Bootstrap -->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4e73df, #1cc88a);
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background: #1cc88a;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background: #13855c;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 login-container text-center">
                <h4 class="mb-4"><b>Login Ensa Seroja</b></h4>
                <?php if(session()->get("warning")){ ?>
                    <div class="alert alert-warning">Username atau Password salah!</div>
                <?php } else if(session()->get("err")){ ?>
                    <div class="alert alert-danger">Harap isi data yang ada!</div>
                <?php } ?>
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-group text-left">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan Username" name="username">
                    </div>
                    <div class="form-group text-left">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password">
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
