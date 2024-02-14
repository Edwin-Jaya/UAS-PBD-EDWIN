<?php
	include "koneksi.php";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$query = mysqli_query($db,"CALL DeleteTempat('$id')");
		if($query){
			$pesan = "data berhasil dihapus";
			header("location:admin.php?url=data_cabang&pesan=$pesan");
		}
	}
?>
