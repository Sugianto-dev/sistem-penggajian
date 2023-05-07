<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$cek_presensi = cek_presensi($_POST['nik']);

	if ($cek_presensi == 0){
		//deklarasi variable dan membaca nilai dari POST
		$id_presensi = isset($_POST['id_presensi']) ? $_POST['id_presensi'] : '' ;
		$nik = $_POST['nik'] ?? '';
		$tanggal = $_POST['tanggal'] ?? '';
		$bulan = $_POST['bulan'] ?? '';
		$tahun = $_POST['tahun'] ?? '';
		$jam_masuk = $_POST['waktu'] ?? '';

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
							'$jam_masuk', 
							'', 
							'', 
							'', 
							'Masuk'
						);
				";

				$hasil = mysqli_query($conn, $query);

				if($hasil){
					$_SESSION['pesan_sukses'] = 'Berhasil Menambah Jam Masuk';
					header("Location:" . BASE_URL . "transaksi/transaksi_presensi.php");
				}else{
					$isError = TRUE;
					$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
				}

			}
		}
	} else {
		$param_id_presensi = $_POST['id_presensi'];

		$conn = open_connection();

		$query = "SELECT * FROM presensi WHERE id_presensi ='$param_id_presensi'";
		$hasil = mysqli_query($conn, $query);

		$old_data = array();
		$data_found = FALSE;

		if($row = mysqli_fetch_assoc($hasil)){
			$old_data = $row;
			$data_found = TRUE;
		}

		//deklarasi variable dan membaca nilai dari POST
		$id_presensi = isset($_POST['id_presensi']) ? $_POST['id_presensi'] : $old_data['id_presensi'] ?? '' ;
		$nik = $_POST['nik'] ?? '';
		$tanggal = $_POST['tanggal'] ?? '';
		$bulan = $_POST['bulan'] ?? '';
		$tahun = $_POST['tahun'] ?? '';
		$jam_keluar = $_POST['waktu'] ?? '';

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

				$query = "UPDATE presensi SET 
					jam_keluar = '$jam_keluar'
				WHERE 
					id_presensi = '$old_data[id_presensi]'
				";

				$hasil = mysqli_query($conn, $query);

				if($hasil){
					$_SESSION['pesan_sukses'] = 'Berhasil Menambah Jam Keluar';
					header("Location:" . BASE_URL . "transaksi/transaksi_presensi.php");
				}else{
					$isError = TRUE;
					$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
				}

			}
		}
	}
?>