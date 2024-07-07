<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user ORDER BY tanggal_pengamatan DESC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Pemeriksaan</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-notes-medical"></i> Pemeriksaan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Pemeriksaan
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
                                <a href="tambah_pemeriksaan.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pemeriksaan</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Foto Anak</th>
                                            <th class="text-center align-middle">Nama Anak</th>
                                            <th class="text-center align-middle">Nama Dokter</th>
                                            <th class="text-center align-middle">Berat Badan</th>
                                            <th class="text-center align-middle">Tinggi Badan</th>
                                            <th class="text-center align-middle">Lingkar Kepala</th>
                                            <th class="text-center align-middle">Tanggal Pengamatan</th>
                                            <th class="text-center align-middle">Catatan</th>
                                            <th class="text-center align-middle">Operator</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pemeriksaan as $dp): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="text-center align-middle"><img style="height: 100px" src="assets/img/profiles/<?= $dp['foto_anak']; ?>" alt="<?= $dp['foto_anak']; ?>"></td>
                                                <td class="align-middle"><?= $dp['nama_anak']; ?></td>
                                                <td class="align-middle"><?= $dp['nama_dokter']; ?></td>
                                                <td class="align-middle"><?= $dp['berat_badan']; ?></td>
                                                <td class="align-middle"><?= $dp['tinggi_badan']; ?></td>
                                                <td class="align-middle"><?= $dp['lingkar_kepala']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y', strtotime($dp['tanggal_pengamatan']));; ?></td>
                                                <td class="align-middle"><?= $dp['catatan']; ?></td>
                                                <td class="align-middle"><?= $dp['username']; ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="ubah_pemeriksaan.php?id_pemeriksaan=<?= $dp['id_pemeriksaan']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_pemeriksaan.php?id_pemeriksaan=<?= $dp['id_pemeriksaan']; ?>" data-nama="<?= $dp['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                </td>
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