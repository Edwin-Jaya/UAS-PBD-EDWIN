<?php
    session_start();
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edwin Jaya & Co.</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/login.png" width="40%">
                                        <h1 class="h4 text-gray-900 mb-2 mt-4">LOGIN</h1>
                                        <p>Silahkan Masukan ID Karyawan dan Password</p>
                                    </div>
                                    <form class="user" method="post" action="proseslogin.php">
                                        <div class="form-group">
                                            <input name="kode_pegawai" required type="text" class="form-control form-control-user"
                                                placeholder="ID Karyawan" value="10121121">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" required type="password" class="form-control form-control-user"
                                                 placeholder="Password" value="admin123">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block" name="login">
                                            <i class="fa fa-spinner"></i> Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == '1') {
                echo '<script>alert("Registrasi berhasil silahkan login")</script>';
            }
        } 

        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == 'gagal') {
                echo '<script>alert("Username atau Password salah")</script>';
            }
        }    
    ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
