<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$id_presensi = isset($_POST['id_presensi']) ? $_POST['id_presensi'] : '' ;
	$nik = $_POST['nik'] ?? '';
	$tanggal = $_POST['tanggal'] ?? '';
	$bulan = $_POST['bulan'] ?? '';
	$tahun = $_POST['tahun'] ?? '';
	$absen = $_POST['absen'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($id_presensi == ''){
			$isError = TRUE;
			$error = "ID Presensi Harap diisi";
		}
		if($nik == ''){
			$isError = TRUE;
			$error = "NIK Harap dipilih";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					presensi(
						id_presensi, 
						nik, 
						tanggal, 
						bulan, 
						tahun, 
						jam_masuk, 
						jam_keluar, 
						lembur,
						keterangan_lembur,
						absen
					)
					VALUES(
						'$id_presensi', 
						'$nik', 
						'$tanggal', 
						'$bulan', 
						'$tahun', 
						'', 
						'', 
						'', 
						'', 
						'$absen'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil! Anda sedang absen hari ini';
				header("Location:" . BASE_URL . "transaksi/transaksi_presensi.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}
?>