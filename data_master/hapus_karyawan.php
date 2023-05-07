<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$nik = $_GET['nik'];
	$foto = $_GET['foto'];

	$conn = open_connection();

	$query = "DELETE FROM karyawan WHERE nik = '$nik' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data karyawan dengan NIK : $nik";

		unlink('../dist/uploads/'.$foto);

		header("Location:".BASE_URL."data_master/data_karyawan.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>