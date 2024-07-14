<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}

	if ($dataUser['jabatan'] == 'petugas') {
        header("Location: index.php");
        exit;
    }
        
	
	$id_dokter = $_GET['id_dokter'];

    $data_dokter = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM dokter WHERE id_dokter = '$id_dokter'"));
    $nama = $data_dokter['nama'];

    $foto = $data_dokter['foto'];
    $image_path = 'assets/img/profiles/' . $foto;
	
	$delete_dokter = mysqli_query($conn, "DELETE FROM dokter WHERE id_dokter = '$id_dokter'");

	if ($delete_dokter) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Dokter $nama berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

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
	                text: 'Dokter " . $nama . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'dokter.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Dokter $nama gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Dokter " . $nama . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'dokter.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
