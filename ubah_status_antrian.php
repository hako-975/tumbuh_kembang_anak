<?php 
    require_once 'connection.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_antrian = $_POST['id_antrian'];
    $status = $_POST['status'];

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <title>Ubah Antrian</title>
    <?php include_once 'include/head.php'; ?>
</head> <!--end::Head--> <!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<?php 
    $update_antrian = mysqli_query($conn, "UPDATE antrian SET status = '$status' WHERE id_antrian = '$id_antrian'");
    if ($update_antrian) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian No. ' . $id_antrian . ' berhasil diubah menjadi '. $status .'!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Antrian No. " . $id_antrian . " berhasil diubah menjadi ". $status ."!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'antrian.php';
                    }
                });
            </script>
        ";
        exit;
    } else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian No. '.$id_antrian.' gagal diubah!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Antrian No. " . $id_antrian . " gagal diubah!'
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