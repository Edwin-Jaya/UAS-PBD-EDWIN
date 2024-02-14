<?php

session_start();

include 'koneksi.php';

$kode_pegawai = $_POST['kode_pegawai'];
$password = $_POST['password'];
$result = mysqli_query($db, "CALL SelectAdminPegawai('$kode_pegawai', '$password')");
$cek = mysqli_num_rows($result);

if ($cek>0) {
	$data = mysqli_fetch_assoc($result);
	echo $data;
	$_SESSION['id'] = $data['id_admin'];
	$_SESSION['NamaPanjang'] = $data['nama_depan'] . " " . $data['nama_belakang']; // changed to nama from another_table
	$_SESSION['kode_pegawai'] = $data['kode_pegawai'];
	header("location:admin.php");
}
	// } else {
// 	header("location:index.php?pesan=gagal");
// }

?>
