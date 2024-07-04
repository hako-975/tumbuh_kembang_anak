<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Sistem Informasi Tumbuh Kembang Anak</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary">

    <?php 
        require_once 'connection.php';

        if (isset($_SESSION['id_user'])) {
            echo "
                <script>
                    window.location='index.php'
                </script>
            ";
            exit;
        }

        if (isset($_POST['btnLogin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query_login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
            
            if ($data_user = mysqli_fetch_assoc($query_login)) {
                if (password_verify($password, $data_user['password'])) {
                    $_SESSION['id_user'] = $data_user['id_user'];
                    header("Location: index.php");
                    exit;
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Login!',
                                text: 'Username atau Password salah!',
                                confirmButtonText: 'Kembali'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            });
                        </script>
                    ";
                    exit;
                }
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Login!',
                            text: 'Username atau Password salah!',
                            confirmButtonText: 'Kembali'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.history.back();
                            }
                        });
                    </script>
                ";
                exit;
            }
        }
    ?>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="text-center">
                    <img src="assets/img/logo.png" class="mx-auto w-25" alt="Logo">
                </div>
                <h2 class="text-center">Sistem Informasi Tumbuh Kembang Anak</h2>
            </div>
            <div class="card-body login-card-body">
                <h4 class="text-dark text-center">User Login</h4>
                <form method="post">
                    <div class="input-group mb-1">
                        <div class="form-floating"> 
                            <input id="username" name="username" autocomplete="off" type="text" class="form-control" value="" placeholder="" required> 
                            <label for="username">Username</label> 
                        </div>
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating"> <input id="password" name="password" type="password" class="form-control" placeholder="" required> <label for="password">Password</label> </div>
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div> <!--begin::Row-->
                    <div class="row mt-3">
                        <div class="col-6 d-inline-flex align-items-center">
                            <a href="forgot-password.html">Lupa Password</a>
                        </div> <!-- /.col -->
                        <div class="col-6 text-end">
                            <button type="submit" name="btnLogin" class="btn btn-primary">Login <span class="bi bi-box-arrow-in-right"></span></button>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>