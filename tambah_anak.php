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
    <title>Tambah Anak</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php 
        if (isset($_POST['btnTambahAnak'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
            $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
            $nama_ibu_kandung = htmlspecialchars($_POST['nama_ibu_kandung']);
            $no_telepon_orang_tua = htmlspecialchars($_POST['no_telepon_orang_tua']);
            $alamat_orang_tua = htmlspecialchars($_POST['alamat_orang_tua']);

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

                if(!in_array($extension_lower, $acc_extension))
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

            $insert_anak = mysqli_query($conn, "INSERT INTO anak VALUES ('', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$nama_ibu_kandung', '$no_telepon_orang_tua', '$alamat_orang_tua', '$foto', CURRENT_TIMESTAMP())");

            if ($insert_anak) {
                $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Anak $nama berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

                if ($foto != '') {
                    $file_tmp = $_FILES['foto']['tmp_name'];     
                    move_uploaded_file($file_tmp, 'assets/img/profiles/' . $foto);
                }

                echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Anak " . $nama . " berhasil ditambahkan!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'anak.php';
                            }
                        });
                    </script>
                ";
                exit;
            } else {
                $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Anak $nama gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Anak " . $nama . " gagal ditambahkan!'
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
                            <h3 class="mb-0">Tambah Anak</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="anak.php">Anak</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Anak
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
                                            <label for="nama" class="form-label">Nama Anak</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir Anak</label>
                                            <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin Anak</label> 
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="laki-laki"><?= ucwords('laki-laki'); ?></option>
                                                <option value="perempuan"><?= ucwords('perempuan'); ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="nama_ibu_kandung" class="form-label">Nama Ibu Kandung</label>
                                            <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="no_telepon_orang_tua" class="form-label">No. Telepon Orang Tua</label> 
                                            <input type="number" class="form-control" id="no_telepon_orang_tua" name="no_telepon_orang_tua" required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="alamat_orang_tua" class="form-label">Alamat Orang Tua</label>
                                            <textarea class="form-control" id="alamat_orang_tua" name="alamat_orang_tua" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)"> 
                                                <label class="input-group-text" for="foto">Upload</label> 
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="card-footer pt-3">
                                        <button type="submit" name="btnTambahAnak" class="btn btn-primary">Submit</button>
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