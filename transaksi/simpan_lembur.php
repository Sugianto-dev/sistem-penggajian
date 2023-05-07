<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_id_presensi = $_POST['id_presensi'];

	$conn = open_connection();

	$dari_jam = strtotime($_POST['dari_jam']);
	$sampai_jam = strtotime($_POST['sampai_jam']);

	$hitung = $sampai_jam - $dari_jam;

	$lembur = floor($hitung / (60 * 60));

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
	$keterangan_lembur = $_POST['keterangan_lembur'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
			
		if($id_presensi == ''){
			$isError = TRUE;
			$error = "ID Presensi Harap diisi";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE presensi SET 
				lembur = '$lembur',
				keterangan_lembur = '$keterangan_lembur'
			WHERE 
				id_presensi = '$old_data[id_presensi]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah Lembur Kerja';
				header("Location:" . BASE_URL . "transaksi/transaksi_presensi.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}
?>