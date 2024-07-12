<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Dashboard - Sistem Informasi Tumbuh Kembang Anak</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-tachometer-alt"></i> Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Gizi Buruk</span> 
                                    <span class="info-box-number">
                                        0
                                    </span> </div>
                            </div> <!-- /.info-box -->
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Gizi Kurang</span> 
                                    <span class="info-box-number">0</span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Gizi Baik</span>
                                    <span class="info-box-number">0</span>
                                </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Berisiko Gizi Lebih</span> <span class="info-box-number">0</span> </div> <!-- /.info-box-content -->
                            </div> <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Gizi Lebih</span> 
                                    <span class="info-box-number">
                                        0
                                    </span> </div>
                            </div> <!-- /.info-box -->
                        </div> <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="fas fa-fw fa-apple-alt"></i> </span>
                                <div class="info-box-content"> <span class="info-box-text">Obesitas</span> 
                                    <span class="info-box-number">0</span>
                                </div>
                            </div>
                        </div> 
                    </div> <!-- /.row --> <!--begin::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>