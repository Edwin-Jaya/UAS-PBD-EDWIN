<?php
include 'koneksi.php';
$id = $_SESSION['id'];


if (isset($_POST['simpan'])) {
    $nama_tempat_up = $_POST['nama_tempat'];
	$kota_up = $_POST['kota_tempat'];
    $alamat_up = $_POST['alamat_tempat'];
	$sql = "insert into tempat (nama_tempat, kota_tempat, alamat_tempat) values ('$nama_tempat_up','$kota_up','$alamat_up')";
	$query = mysqli_query($db, $sql);
	if ($query) {
		$pesan = "Data berhasil ditambah";
		header("location:admin.php?url=data_cabang&pesan=$pesan");
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
</div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            $query = mysqli_query($db, "CALL selectTempat()");
            $count = mysqli_num_rows($query);
            if ($count < 1) {
                echo "Data Tidak Ada";
            } else {
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tempat</th>
                            <th>Kota</th>
                            <th>Alamat</th>
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
                                    $nama_depan = $row['nama_tempat'];
                                    echo $nama_depan;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $nama_belakang = $row['kota_tempat'];
                                    echo $nama_belakang;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $alamat = $row['alamat_tempat'];
                                    echo $alamat;
                                    ?>
                                </td>
                                <td>
                                    <a href="?url=hapus_tempat&id=<?php echo $row['kode_tempat']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">
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