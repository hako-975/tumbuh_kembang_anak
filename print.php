<?php 
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$dari_tanggal = $_GET['dari_tanggal'];
$sampai_tanggal = $_GET['sampai_tanggal'];

$pemeriksaan = mysqli_query($conn, "SELECT *, anak.nama as nama_anak, pemeriksaan.foto as foto_anak, dokter.nama as nama_dokter FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id_dokter LEFT JOIN user ON pemeriksaan.id_user = user.id_user WHERE pemeriksaan.tanggal_pengamatan BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY pemeriksaan.tanggal_pengamatan DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .print-container {
            width: 100%;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="print-container">
        <h2 class="text-center">Laporan Pemeriksaan Anak</h2>
        <p class="text-right">Dari Tanggal: <?= date('d-m-Y', strtotime($dari_tanggal)); ?> Sampai Tanggal: <?= date('d-m-Y', strtotime($sampai_tanggal)); ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Anak</th>
                    <th>Nama Dokter</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Lingkar Kepala</th>
                    <th>Tanggal Pengamatan</th>
                    <th>Catatan</th>
                    <th>Operator</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pemeriksaan as $dp): ?>
                    <tr>
                        <td><?= $i++; ?>.</td>
                        <td><?= $dp['nama_anak']; ?></td>
                        <td><?= $dp['nama_dokter']; ?></td>
                        <td><?= $dp['berat_badan']; ?></td>
                        <td><?= $dp['tinggi_badan']; ?></td>
                        <td><?= $dp['lingkar_kepala']; ?></td>
                        <td><?= date('d-m-Y', strtotime($dp['tanggal_pengamatan'])); ?></td>
                        <td><?= $dp['catatan']; ?></td>
                        <td><?= $dp['username']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>
