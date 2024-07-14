<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $anak = mysqli_query($conn, "SELECT * FROM anak ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Anak</title>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-baby"></i> Anak</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Anak
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
                                <a href="tambah_anak.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Anak</a>
                                <table class="table table-bordered" id="table_id">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center align-middle">No.</th>
                                            <th class="text-center align-middle">Foto</th>
                                            <th class="text-center align-middle">Nama</th>
                                            <th class="text-center align-middle">Tanggal Lahir</th>
                                            <th class="text-center align-middle">Jenis Kelamin</th>
                                            <th class="text-center align-middle">Nama Ibu Kandung</th>
                                            <th class="text-center align-middle">No. Telepon Orang Tua</th>
                                            <th class="text-center align-middle">Alamat Orang Tua</th>
                                            <th class="text-center align-middle">Dibuat Pada</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($anak as $da): ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $i++; ?>.</td>
                                                <td class="text-center align-middle"><img style="width: 7.5rem" src="assets/img/profiles/<?= $da['foto']; ?>" alt="<?= $da['foto']; ?>"></td>
                                                <td class="align-middle"><?= $da['nama']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y', strtotime($da['tanggal_lahir']));; ?></td>
                                                <td class="align-middle"><?= $da['jenis_kelamin']; ?></td>
                                                <td class="align-middle"><?= $da['nama_ibu_kandung']; ?></td>
                                                <td class="align-middle"><?= $da['no_telepon_orang_tua']; ?></td>
                                                <td class="align-middle"><?= $da['alamat_orang_tua']; ?></td>
                                                <td class="align-middle"><?= date('d-m-Y, H:i:s', strtotime($da['dibuat_pada']));; ?></td>
                                                <td class="text-center align-middle">
                                                    <a href="detail_anak.php?id_anak=<?= $da['id_anak']; ?>" class="m-1 btn btn-primary"><i class="fas fa-fw fa-bars"></i> Detail</a>
                                                    <a href="ubah_anak.php?id_anak=<?= $da['id_anak']; ?>" class="m-1 btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="hapus_anak.php?id_anak=<?= $da['id_anak']; ?>" data-nama="<?= $da['nama']; ?>" class="m-1 btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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