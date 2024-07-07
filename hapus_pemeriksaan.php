<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_pemeriksaan = $_GET['id_pemeriksaan'];

    $data_pemeriksaan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT *, anak.nama as nama_anak FROM pemeriksaan LEFT JOIN anak ON pemeriksaan.id_anak = anak.id_anak WHERE id_pemeriksaan = '$id_pemeriksaan'"));
    $nama_anak = $data_pemeriksaan['nama_anak'];

    $foto = $data_pemeriksaan['foto'];
    $image_path = 'assets/img/profiles/' . $foto;
	
	$delete_pemeriksaan = mysqli_query($conn, "DELETE FROM pemeriksaan WHERE id_pemeriksaan = '$id_pemeriksaan'");

	if ($delete_pemeriksaan) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pemeriksaan $nama_anak berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

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
	                text: 'Pemeriksaan " . $nama_anak . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'pemeriksaan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Pemeriksaan $nama_anak gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Pemeriksaan " . $nama_anak . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'pemeriksaan.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
