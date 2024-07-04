<?php 
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'tumbuh_kembang_anak';

	$koneksi = mysqli_connect($host, $user, $pass, $database);

	// if ($koneksi) {
	// 	echo "berhasil terkoneksi";
	// }
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>
