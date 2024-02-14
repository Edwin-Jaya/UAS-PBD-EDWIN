<?php
	include "koneksi.php";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = mysqli_query($db,"CALL DeleteAdmin('$id')");
		if($query){
			$pesan = "data berhasil dihapus";
			header("location:admin.php?url=tambah_admin&pesan=$pesan");
		}
	}
?>
