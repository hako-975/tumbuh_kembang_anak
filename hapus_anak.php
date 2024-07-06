<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_anak = $_GET['id_anak'];

    $data_anak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anak WHERE id_anak = '$id_anak'"));
    $nama = $data_anak['nama'];

    $foto = $data_anak['foto'];
    $image_path = 'assets/img/profiles/' . $foto;
	
	$delete_anak = mysqli_query($conn, "DELETE FROM anak WHERE id_anak = '$id_anak'");

	if ($delete_anak) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Anak $nama berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		if ($foto != 'default.jpg' && $foto != '') {
		    if (file_exists($image_path)) {
		        unlink($image_path);
		    }
		}

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Anak " . $nama . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'anak.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Anak $nama gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Anak " . $nama . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'anak.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
