<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$id_jabatan = $_GET['id_jabatan'];

	$conn = open_connection();

	$query = "DELETE FROM jabatan WHERE id_jabatan = '$id_jabatan' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data jabatan dengan id jabatan : $id_jabatan";

		header("Location:".BASE_URL."data_master/data_jabatan.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>