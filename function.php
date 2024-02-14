<?php 
function tampilkan($query) {
	global $db;
	$rows = array();
	$cek = mysqli_query($db, $query);
	while($row = mysqli_fetch_assoc($cek)) {
		$rows = $row;
	}
	return $rows;
}

?>

