<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user ORDER BY tanggal_pengamatan DESC");
    
    if (isset($_GET['btnPrint'])) {
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];
        $pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user WHERE pemeriksaan.tanggal_pengamatan BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY pemeriksaan.tanggal_pengamatan DESC");
    }
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Laporan</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-history"></i> Laporan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Laporan
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <form method="get">
                                    <div class="row">
                                        <div class="col-3"> 
                                            <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                                            <input type="date" value="<?= (isset($_GET['dari_tanggal']) ? $_GET['dari_tanggal'] : date('Y-m-01')); ?>" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                                        </div>
                                        <div class="col-3"> 
                                            <label for="sampai_tanggal" class="form-label">Sampai Tanggal</label>
                                            <input type="date" value="<?= (isset($_GET['sampai_tanggal']) ? $_GET['sampai_tanggal'] : date('Y-m-d')); ?>" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                                        </div>
                                        <div class="col-6 d-flex align-items-end"> 
                                            <button type="submit" name="btnPrint" class="me-3 btn btn-primary"><i class="fas fa-fw fa-filter"></i> filter</button>
                                            <?php if (isset($_GET['btnPrint'])): ?>
                                                <a href="laporan.php" class="me-3 btn btn-danger"><i class="fas fa-fw fa-times"></i> Reset</a>
                                                <a href="print.php?dari_tanggal=<?= $dari_tanggal; ?>&sampai_tanggal=<?= $sampai_tanggal; ?>" target="_blank" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Print</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Nama Anak</th>
                                            <th class="text-center align-middle">Nama Dokter</th>
                                            <th class="text-center align-middle">Berat Badan</th>
                                            <th class="text-center align-middle">Tinggi Badan</th>
                                            <th class="text-center align-middle">Lingkar Kepala</th>
                                            <th class="text-center align-middle">Tanggal Pengamatan</th>
                                            <th class="text-center align-middle">Catatan</th>
                                            <th class="text-center align-middle">Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pemeriksaan as $dp): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="align-middle"><?= $dp['nama_anak']; ?></td>
                                                <td class="align-middle"><?= $dp['nama_dokter']; ?></td>
                                                <td class="align-middle"><?= $dp['berat_badan']; ?></td>
                                                <td class="align-middle"><?= $dp['tinggi_badan']; ?></td>
                                                <td class="align-middle"><?= $dp['lingkar_kepala']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y', strtotime($dp['tanggal_pengamatan']));; ?></td>
                                                <td class="align-middle"><?= $dp['catatan']; ?></td>
                                                <td class="align-middle"><?= $dp['username']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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