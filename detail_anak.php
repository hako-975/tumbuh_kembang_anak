<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_anak = $_GET['id_anak'];

    $data_anak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anak WHERE id_anak = '$id_anak'"));
    
    $pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user WHERE pemeriksaan.id_anak = '$id_anak' ORDER BY tanggal_pengamatan DESC");
    
    $chart_pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user WHERE pemeriksaan.id_anak = '$id_anak' ORDER BY tanggal_pengamatan ASC");

    $data_pemeriksaan = [];
    while ($row = mysqli_fetch_assoc($chart_pemeriksaan)) {
        $row['tanggal_pengamatan'] = date('d-m-Y, H:i', strtotime($row['tanggal_pengamatan']));
        $data_pemeriksaan[] = $row;
    }

    // Convert data to JSON
    $labels = array_column($data_pemeriksaan, 'tanggal_pengamatan');
    $beratBadanData = array_column($data_pemeriksaan, 'berat_badan');
    $tinggiBadanData = array_column($data_pemeriksaan, 'tinggi_badan');
    $lingkarKepalaData = array_column($data_pemeriksaan, 'lingkar_kepala');

    $labels_json = json_encode($labels);
    $beratBadanData_json = json_encode($beratBadanData);
    $tinggiBadanData_json = json_encode($tinggiBadanData);
    $lingkarKepalaData_json = json_encode($lingkarKepalaData);

    // Calculate averages
    $averageBeratBadan = array_sum($beratBadanData) / count($beratBadanData);
    $averageTinggiBadan = array_sum($tinggiBadanData) / count($tinggiBadanData);
    $averageLingkarKepala = array_sum($lingkarKepalaData) / count($lingkarKepalaData);
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Detail Anak - <?= $data_anak['nama']; ?></title>
    <?php include_once 'include/head.php'; ?>
    <style>
        .profile-card {
            width: 100%;
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
                        <div class="col-sm-8">
                            <h3 class="mb-0"><i class="nav-icon fas fa-fw fa-baby"></i> Detail Anak - <?= $data_anak['nama']; ?></h3>
                        </div>
                        <div class="col-sm-4">
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
                    <div class="row">
                        <div class="col-5">
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
                        </div>
                        <div class="col-7">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="fas fa-fw fa-chart-line"></i> Grafik Tumbuh Kembang Anak</h3>
                                    <div class="text-end ms-auto">
                                        <button type="button" id="btnLine" class="btn btn-primary"><i class="fas fa-fw fa-chart-line"></i> Garis</button>
                                        <button type="button" id="btnBar" class="btn btn-primary"><i class="fas fa-fw fa-chart-bar"></i> Batang</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <canvas id="tumbuhChart" width="100%"></canvas>
                                    <hr>
                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Rata-rata:</strong></p>
                                        <p class="mb-1">Berat Badan: <?= number_format($averageBeratBadan, 2); ?> kg</p>
                                        <p class="mb-1">Tinggi Badan: <?= number_format($averageTinggiBadan, 2); ?> cm</p>
                                        <p class="mb-1">Lingkar Kepala: <?= number_format($averageLingkarKepala, 2); ?> cm</p>
                                    </div>
                                </div>
                            </div>
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
    <script>
    $(document).ready(function() {
        // Data for charts, replace this with your actual data
        var labels = <?= $labels_json; ?>;
        var beratBadanData = <?= $beratBadanData_json; ?>;
        var tinggiBadanData = <?= $tinggiBadanData_json; ?>;
        var lingkarKepalaData = <?= $lingkarKepalaData_json; ?>;

        var ctx = document.getElementById('tumbuhChart').getContext('2d');

        var chartType = 'line';

        var chartData = {
            labels: labels,
            datasets: [
                {
                    label: 'Berat Badan (kg)',
                    data: beratBadanData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Tinggi Badan (cm)',
                    data: tinggiBadanData,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Lingkar Kepala (cm)',
                    data: lingkarKepalaData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        };

        var tumbuhChart = new Chart(ctx, {
            type: chartType,
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $('#btnLine').on('click', function() {
            tumbuhChart.destroy();
            tumbuhChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        $('#btnBar').on('click', function() {
            tumbuhChart.destroy();
            tumbuhChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

    });
    </script>
</body><!--end::Body-->

</html>