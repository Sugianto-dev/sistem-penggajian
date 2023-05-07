<?php 
	require_once "../koneksi.php";
	require_once "../functions.php";

	check_login();

	$no_slip = $_GET['no_slip'];

	$conn = open_connection();

	$query = "DELETE FROM penggajian WHERE no_slip = '$no_slip' ";

	$hasil = mysqli_query($conn, $query);

	if($hasil){
		$_SESSION['pesan_sukses'] = "Berhasil Menghapus data penggajian dengan no slip : $no_slip";

		header("Location:".BASE_URL."transaksi/transaksi_penggajian.php");
	}else{
		$isError = TRUE;
		$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
	}

?>