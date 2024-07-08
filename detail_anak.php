<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_anak = $_GET['id_anak'];

    $data_anak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anak WHERE id_anak = '$id_anak'"));
    
    $pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user WHERE pemeriksaan.id_anak = '$id_anak' ORDER BY tanggal_pengamatan DESC");

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Detail Anak - <?= $data_anak['nama']; ?></title>
    <?php include_once 'include/head.php'; ?>
    <style>
        .profile-card {
            max-width: 400px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .profile-card img {
            width: 200px;
            height: auto;
            border-radius: 10px;
        }
        .profile-card h3 {
            margin-top: 15px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .profile-card p {
            color: #666;
            margin-bottom: 10px;
        }
        .profile-card .btn-group {
            width: 100%;
        }
        .profile-card .btn-group .btn {
            width: 50%;
        }
    </style>
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
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-baby"></i> Detail Anak - <?= $data_anak['nama']; ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="anak.php">Anak</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Detail Anak
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="profile-card mb-3">
                        <div class="text-center">
                            <img src="assets/img/profiles/<?= $data_anak['foto']; ?>" alt="<?= $data_anak['foto']; ?>">
                        </div>
                        <h3 class="text-center"><?= $data_anak['nama']; ?></h3>
                        <p><strong>Tanggal Lahir: </strong><?= date('d-m-Y', strtotime($data_anak['tanggal_lahir']));; ?></p>
                        <p><strong>Jenis Kelamin: </strong><?= ucwords($data_anak['jenis_kelamin']); ?></p>
                        <p><strong>Nama Ibu Kandung: </strong><?= $data_anak['nama_ibu_kandung']; ?></p>
                        <p><strong>No. Telepon Orang Tua: </strong><?= $data_anak['no_telepon_orang_tua']; ?></p>
                        <p><strong>Alamat Orang Tua: </strong><?= $data_anak['alamat_orang_tua']; ?></p>
                        <p><strong>Dibuat Pada: </strong><?= date('d-m-Y, H:i:s', strtotime($data_anak['dibuat_pada']));; ?></p>
                        <div class="btn-group" role="group">
                            <a href="ubah_anak.php?id_anak=<?= $data_anak['id_anak']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                            <a href="hapus_anak.php?id_anak=<?= $data_anak['id_anak']; ?>" data-nama="<?= $data_anak['nama']; ?>" class="btn btn-danger btn-delete"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-2">
                                <a href="tambah_pemeriksaan.php?id_anak=<?= $id_anak; ?>" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pemeriksaan</a>
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