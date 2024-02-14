<?php
include 'koneksi.php';
$id = $_SESSION['id'];



if (isset($_POST['simpan'])) {
    $kode_pegawai_up = $_POST['kode_pegawai'];
	$nama_depan_up = $_POST['nama_depan'];
	$nama_belakang_up = $_POST['nama_belakang'];
	$alamat_up = $_POST['alamat'];
	$kota_up = $_POST['kota'];
	$jk_up = $_POST['jenis_kelamin'];
	$jb_up = $_POST['kode_jabatan'];
	$cb_up = $_POST['kode_tempat'];
	$query_simpan = mysqli_query($db, "CALL InsertIntoPegawai('$kode_pegawai_up', '$nama_depan_up', '$nama_belakang_up', '$alamat_up', '$kota_up', '$jk_up', '$jb_up', '$cb_up')");
	if ($query_simpan) {
		$pesan = "Data berhasil ditambah";
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
				<label>Nama Depan</label>
				<input value="" name="nama_depan" type="text" class="form-control" placeholder="Masukan Nama Depan">
			</div>
			<div class="form-group">
				<label>Nama Belakang</label>
				<input value="" name="nama_belakang" type="text" class="form-control" placeholder="Masukan Nama Belakang">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<input value="" name="alamat" type="text" class="form-control" placeholder="Masukan Alamat">
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input value="" name="kota" type="text" class="form-control" placeholder="Masukan Kota">
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="jenis_kelamin" class="form-control">
					<option value="Pria" >Pria</option>
					<option value="Wanita">Wanita</option>
				</select>
			</div>
			<div class="form-group">
				<label>Jabatan</label>
				<select name="kode_jabatan" class="form-control">
					<option value=1 >Conservator</option>
					<option value=2 >Exhibit Designer</option>
					<option value=3 >Visitor Services Coordina</option>
					<option value=4 >Curator</option>
					<option value=5 >Archivist</option>
				</select>
			</div>
			<div class="form-group">
				<label>Nama Cabang</label>
				<select name="kode_tempat" class="form-control">
					<option value=1 >National Museum of Indonesia</option>
					<option value=2 >Museum Nasional</option>
					<option value=3 >Museum Seni Rupa dan Keramik</option>
					<option value=4 >Museum Sejarah</option>
				</select>
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
            <?php $query = mysqli_query($db, "CALL selectPegawai();");
            $count = mysqli_num_rows($query); ?>
            <?php
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
                            <th>Jabatan</th>
                            <th>Cabang</th>
                            <th></th>
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
                                    <?php
                                    $jabatan = $row['nama_jabatan'];
                                    echo $jabatan;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $cabang = $row['nama_tempat'];
                                    echo $cabang;
                                    ?>
                                </td>
                                <td>
                                    <a href="?url=edit_pegawai&id=<?php echo $row['id_pegawai']; ?> " class="btn btn-warning">
                                        <i class="fa fa-pen"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <a href="?url=hapus_pegawai&id=<?php echo $row['id_pegawai']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">
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