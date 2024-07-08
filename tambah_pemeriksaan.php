<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    if (isset($_GET['id_anak'])) {
        $id_anak = $_GET['id_anak'];
        $data_anak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anak WHERE id_anak = '$id_anak'"));
    }

    $anak = mysqli_query($conn, "SELECT * FROM anak ORDER BY nama ASC");
    $dokter = mysqli_query($conn, "SELECT * FROM dokter ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Tambah Pemeriksaan</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahPemeriksaan'])) {
            $id_anak = htmlspecialchars($_POST['id_anak']);
            $id_dokter = htmlspecialchars($_POST['id_dokter']);
            $berat_badan = htmlspecialchars($_POST['berat_badan']);
            $tinggi_badan = htmlspecialchars($_POST['tinggi_badan']);
            $lingkar_kepala = htmlspecialchars($_POST['lingkar_kepala']);
            $tanggal_pengamatan = htmlspecialchars($_POST['tanggal_pengamatan']);
            $catatan = htmlspecialchars($_POST['catatan']);

            $foto = $_FILES['foto']['name'];
            if ($foto != '') {
                $acc_extension = array('png', 'jpg', 'jpeg', 'gif');
                $extension = explode('.', $foto);
                $extension_lower = strtolower(end($extension));
                $size = $_FILES['foto']['size'];
                $file_tmp = $_FILES['foto']['tmp_name'];     

                if ($size > 5253120) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Ukuran file terlalu besar!',
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

                if (!in_array($extension_lower, $acc_extension))
                {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'File yang di upload bukan gambar!',
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

                $foto = uniqid() . '_' . time() . '_' . $foto;
            } else {
                $foto = 'default.jpg';
            }

            $insert_pemeriksaan = mysqli_query($conn, "INSERT INTO pemeriksaan VALUES ('', '$id_anak', '$id_dokter', '$berat_badan', '$tinggi_badan', '$lingkar_kepala', '$tanggal_pengamatan', '$catatan', '$foto', " . $dataUser['id_user'] . ")");
            
            $data_anak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anak WHERE id_anak = '$id_anak'"));
            $nama_anak = $data_anak['nama'];
            if ($insert_pemeriksaan) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pemeriksaan $nama_anak berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                if ($foto != '') {
                    $file_tmp = $_FILES['foto']['tmp_name'];     
                    move_uploaded_file($file_tmp, 'assets/img/profiles/' . $foto);
                }
            
                if (isset($_GET['id_anak'])) {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pemeriksaan " . $nama_anak . " berhasil ditambahkan!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'detail_anak.php?id_anak=".$id_anak."';
                                }
                            });
                        </script>
                    ";
                    exit;
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pemeriksaan " . $nama_anak . " berhasil ditambahkan!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'pemeriksaan.php';
                                }
                            });
                        </script>
                    ";
                    exit;
                }
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pemeriksaan $nama_anak gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Pemeriksaan " . $nama_anak . " gagal ditambahkan!'
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
    <div class="app-wrapper"> <!--begin::Header-->
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/sidebar.php'; ?>
        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Tambah Pemeriksaan</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="pemeriksaan.php">Pemeriksaan</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Pemeriksaan
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div>
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!-- Info boxes -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <form method="post" enctype="multipart/form-data"> 
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="id_anak" class="form-label">Nama Anak & Ibu Kandung</label> 
                                            <select class="form-select" id="id_anak" name="id_anak">
                                                <?php if (isset($_GET['id_anak'])): ?>
                                                    <option value="<?= $id_anak; ?>">Nama Anak: <?= $data_anak['nama']; ?> | Nama Ibu Kandung: <?= $data_anak['nama_ibu_kandung']; ?></option>
                                                    <?php foreach ($anak as $da): ?>
                                                        <?php if ($id_anak != $da['id_anak']): ?>
                                                            <option value="<?= $da['id_anak']; ?>">Nama Anak: <?= $da['nama']; ?> | Nama Ibu Kandung: <?= $da['nama_ibu_kandung']; ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <option value="0">--- Pilih Nama Anak & Ibu Kandung ---</option>
                                                    <?php foreach ($anak as $da): ?>
                                                        <option value="<?= $da['id_anak']; ?>">Nama Anak: <?= $da['nama']; ?> | Nama Ibu Kandung: <?= $da['nama_ibu_kandung']; ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="id_dokter" class="form-label">Nama Dokter & Spesialis</label> 
                                            <select class="form-select" id="id_dokter" name="id_dokter">
                                                <option value="0">--- Pilih Nama Dokter & Spesialis ---</option>
                                                <?php foreach ($dokter as $dd): ?>
                                                    <option value="<?= $dd['id_dokter']; ?>">Nama Dokter: <?= $dd['nama']; ?> | Spesialis: <?= $dd['spesialis']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="berat_badan" class="form-label">Berat Badan Anak (Kg)</label> 
                                            <input type="number" step=".01" class="form-control" id="berat_badan" name="berat_badan" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="tinggi_badan" class="form-label">Tinggi Badan Anak (Cm)</label> 
                                            <input type="number" step=".01" class="form-control" id="tinggi_badan" name="tinggi_badan" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="lingkar_kepala" class="form-label">Lingkar Kepala Anak (Cm)</label> 
                                            <input type="number" step=".01" class="form-control" id="lingkar_kepala" name="lingkar_kepala" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="tanggal_pengamatan" class="form-label">Tanggal Pengamatan</label> 
                                            <input type="datetime-local" value="<?= date('Y-m-d\TH:i', time()); ?>" class="form-control" id="tanggal_pengamatan" name="tanggal_pengamatan" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" placeholder="(Opsional)"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto Anak Terbaru</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)"> 
                                                <label class="input-group-text" for="foto">Upload</label> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahPemeriksaan" class="btn btn-primary">Submit</button>
                                    </div> 
                                </form> <!--end::Form-->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-body text-center">
                                    <h5 class="form-label">Preview Foto</h5>
                                    <div class="row justify-content-between">
                                        <div class="col">
                                            <img id="preview-img" class="img-fluid rounded-3" src="assets/img/profiles/default.jpg" alt="default.jpg">
                                        </div>
                                        <div class="col">
                                            <img id="preview-img-circle" class="img-fluid rounded-circle" src="assets/img/profiles/default.jpg" alt="default.jpg">
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> 
        <?php include_once 'include/footer.php'; ?>
    </div> <!--end::App Wrapper--> 
    <?php include_once 'include/script.php'; ?>
</body><!--end::Body-->

</html>