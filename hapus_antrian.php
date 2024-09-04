<body>
<?php 
	require 'connection.php';
 	include_once 'include/head.php';
 	include_once 'include/script.php';

	if (!isset($_SESSION['id_user'])) {
	    header("Location: login.php");
	    exit;
	}
	
	$id_antrian = $_GET['id_antrian'];

	$delete_antrian = mysqli_query($conn, "DELETE FROM antrian WHERE id_antrian = '$id_antrian'");

	if ($delete_antrian) {
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian $id_antrian berhasil dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

		echo "
	        <script>
	            Swal.fire({
	                icon: 'success',
	                title: 'Berhasil!',
	                text: 'Antrian No. " . $id_antrian . " berhasil dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'antrian.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	} else {
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Antrian $id_antrian gagal dihapus!', CURRENT_TIMESTAMP(), " . $dataUser['id_user'] . ")");

	    echo "
	        <script>
	            Swal.fire({
	                icon: 'error',
	                title: 'Gagal!',
	                text: 'Antrian No. " . $id_antrian . " gagal dihapus!'
	            }).then((result) => {
	                if (result.isConfirmed) {
	                    window.location.href = 'antrian.php';
	                }
	            });
	        </script>
	    ";
	    exit;
	}

?>
</body>
