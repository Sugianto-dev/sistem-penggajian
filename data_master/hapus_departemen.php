<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$id_departemen = $_GET['id_departemen'];

	$conn = open_connection();

	$query = "DELETE FROM departemen WHERE id_departemen = '$id_departemen' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data departemen dengan id departemen : $id_departemen";

		header("Location:".BASE_URL."data_master/data_departemen.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>