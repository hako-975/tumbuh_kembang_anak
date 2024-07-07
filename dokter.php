<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $dokter = mysqli_query($conn, "SELECT * FROM dokter ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Dokter</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-user-md"></i> Dokter</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dokter
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
                                <a href="tambah_dokter.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Dokter</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Foto</th>
                                            <th class="text-center align-middle">Nama</th>
                                            <th class="text-center align-middle">Spesialis</th>
                                            <th class="text-center align-middle">No. Telepon</th>
                                            <th class="text-center align-middle">Alamat</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($dokter as $dd): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="text-center align-middle"><img style="height: 100px" src="assets/img/profiles/<?= $dd['foto']; ?>" alt="<?= $dd['foto']; ?>"></td>
                                                <td class="align-middle"><?= $dd['nama']; ?></td>
                                                <td class="align-middle"><?= $dd['spesialis']; ?></td>
                                                <td class="align-middle"><?= $dd['no_telepon']; ?></td>
                                                <td class="align-middle"><?= $dd['alamat']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y, H:i:s', strtotime($dd['dibuat_pada']));; ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="ubah_dokter.php?id_dokter=<?= $dd['id_dokter']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_dokter.php?id_dokter=<?= $dd['id_dokter']; ?>" data-nama="<?= $dd['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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