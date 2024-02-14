<?php
include 'koneksi.php';
$judul = "edit data siswa";
$id = $_GET['id'];
$que = mysqli_query($db, "select * from pegawai where id_pegawai=$id");
$row = mysqli_fetch_array($que);

if (isset($_POST['simpan'])) {
	$nama_depan_up = $_POST['nama_depan'];
	$nama_belakang_up = $_POST['nama_belakang'];
	$alamat_up = $_POST['alamat'];
	$kota_up = $_POST['kota'];
	$jk_up = $_POST['jenis_kelamin'];
	$jb_up = $_POST['kode_jabatan'];
	$cb_up = $_POST['kode_tempat'];
	$query = mysqli_query($db, "CALL UpdatePegawai('$id', '$nama_depan_up', '$nama_belakang_up', '$alamat_up', '$kota_up', '$jk_up', '$jb_up', '$cb_up')");
	if ($query) {
		$pesan = "Data berhasil diubah";
		header("location:admin.php?url=data_pegawai&pesan=$pesan");
	} else {
		echo '
				<script type="text/javascript">
				alert("Gagal mengubah data!");
				window.history.back();
			</script>
			';
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<div class="card">
	<div class="card-header">
		<a href="<?='admin.php'?>" class="btn btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fa fa-arrow-left"></i>
			</span>
			<span class="text">Kembali</span>
		</a>
	</div>
	<div class="card-body">
		<form method="post" action="" ;>
			<div class="form-group">
				<label>Nama Depan</label>
				<input value="<?php echo $row['nama_depan']; ?>" name="nama_depan" type="text" class="form-control" placeholder="Masukan Nama Depan">
			</div>
			<div class="form-group">
				<label>Nama Belakang</label>
				<input value="<?php echo $row['nama_belakang']; ?>" name="nama_belakang" type="text" class="form-control" placeholder="Masukan Nama Belakang">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<input value="<?php echo $row['alamat']; ?>" name="alamat" type="text" class="form-control" placeholder="Masukan Alamat">
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input value="<?php echo $row['kota']; ?>" name="kota" type="text" class="form-control" placeholder="Masukan Kota">
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="jenis_kelamin" class="form-control">
					<option value="Pria" <?= $row['jenis_kelamin'] == 'Pria' ? 'selected' : '' ?>>Pria</option>
					<option value="Wanita" <?= $row['jenis_kelamin'] == 'Wanita' ? 'selected' : '' ?>>Wanita</option>
				</select>
			</div>
			<div class="form-group">
				<label>Jabatan</label>
				<select name="kode_jabatan" class="form-control">
					<option value=1 <?= $row['kode_jabatan'] == 'Conservator' ? 'selected' : '' ?>>Conservator</option>
					<option value=2 <?= $row['kode_jabatan'] == 'Exhibit Designer' ? 'selected' : '' ?>>Exhibit Designer</option>
					<option value=3 <?= $row['kode_jabatan'] == 'Visitor Services Coordina' ? 'selected' : '' ?>>Visitor Services Coordina</option>
					<option value=4 <?= $row['kode_jabatan'] == 'Curator' ? 'selected' : '' ?>>Curator</option>
					<option value=5 <?= $row['kode_jabatan'] == 'Archivist' ? 'selected' : '' ?>>Archivist</option>
				</select>
			</div>
			<div class="form-group">
				<label>Nama Cabang</label>
				<select name="kode_tempat" class="form-control">
					<option value=1 <?= $row['kode_tempat'] == 'National Museum of Indonesia' ? 'selected' : '' ?>>National Museum of Indonesia</option>
					<option value=2 <?= $row['kode_tempat'] == 'Museum Nasional' ? 'selected' : '' ?>>Museum Nasional</option>
					<option value=3 <?= $row['kode_tempat'] == 'Museum Seni Rupa dan Keramik' ? 'selected' : '' ?>>Museum Seni Rupa dan Keramik</option>
					<option value=4 <?= $row['kode_tempat'] == 'Museum Sejarah' ? 'selected' : '' ?>>Museum Sejarah</option>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> SIMPAN</button>
			</div>
		</form>
	</div>
</div>