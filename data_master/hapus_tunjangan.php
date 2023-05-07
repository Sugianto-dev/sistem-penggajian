<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$id_tunjangan = $_GET['id_tunjangan'];

	$conn = open_connection();

	$query = "DELETE FROM tunjangan WHERE id_tunjangan = '$id_tunjangan' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data tunjangan dengan id tunjangan : $id_tunjangan";

		header("Location:".BASE_URL."data_master/data_tunjangan.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>