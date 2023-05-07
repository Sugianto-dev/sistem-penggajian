<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$id_admin = $_GET['id_admin'];

	$conn = open_connection();

	$query = "DELETE FROM admin WHERE id_admin = '$id_admin' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data admin dengan id admin : $id_admin";

		header("Location:".BASE_URL."data_master/data_admin.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>