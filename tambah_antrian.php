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
    <title>Tambah Antrian</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<?php 
    $insert_antrian = mysqli_query($conn, "INSERT INTO antrian VALUES ('', CURRENT_TIMESTAMP(), 'Menunggu')");

    if ($insert_antrian) {
        $id_antrian = mysqli_insert_id($conn);
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian No. '. $id_antrian .' berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Antrian No. " . $id_antrian . " berhasil ditambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'antrian.php';
                    }
                });
            </script>
        ";
        exit;
    } else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Antrian gagal ditambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
            </script>
        ";
        exit;
    }
?>