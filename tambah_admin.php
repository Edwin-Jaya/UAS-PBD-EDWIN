<?php
include 'koneksi.php';
$id = $_SESSION['id'];


if (isset($_POST['simpan'])) {
    $kode_pegawai_up = $_POST['kode_pegawai'];
	$password_up = $_POST['password'];
	$query = mysqli_query($db, "CALL InsertIntoAdmin('$kode_pegawai_up', '$password_up')");
	if ($query) {
		$pesan = "Data berhasil ditambah";
		header("location:admin.php?url=tambah_admin&pesan=$pesan");
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


<div class="card">
    <div class="card-header">
        <a class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#myModal">
            <span class="icon text-white-50">
                <i class="fa fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="post" action="" ;>
            <div class="form-group">
				<label>Kode Pegawai</label>
				<input value="" name="kode_pegawai" type="text" class="form-control" placeholder="Masukan Kode Pegawai">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input value="" name="password" type="text" class="form-control" placeholder="Masukan password">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> SIMPAN</button>
			</div>
		</form>
      </div>
    </div>

  </div>
</div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
			$query = mysqli_query($db, "CALL SelectAdminPegawaiDetails()");
			$count = mysqli_num_rows($query);
            if ($count < 1) {
                echo "Data Tidak Ada";
            } else {
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pegawai</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Jenis Kelamin</th>
							<th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <?php
                                    $kode_pegawai = $row['kode_pegawai'];
                                    echo $kode_pegawai;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $nama_depan = $row['nama_depan'];
                                    echo $nama_depan;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $nama_belakang = $row['nama_belakang'];
                                    echo $nama_belakang;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $alamat = $row['alamat'];
                                    echo $alamat;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $kota = $row['kota'];
                                    echo $kota;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $jk = $row['jenis_kelamin'];
                                    echo $jk;
                                    ?>
                                </td>
                                <td>
                                    <a href="?url=hapus_admin&id=<?php echo $row['id_admin']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>