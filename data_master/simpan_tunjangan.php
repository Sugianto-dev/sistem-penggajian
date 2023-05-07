<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$id_tunjangan = isset($_POST['id_tunjangan']) ? $_POST['id_tunjangan'] : '' ;
	$nama_tunjangan = $_POST['nama_tunjangan'] ?? '';
	$tunjangan = $_POST['tunjangan'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($id_tunjangan == ''){
			$isError = TRUE;
			$error = "ID Tunjangan Harap diisi";
		}
		if($nama_tunjangan == ''){
			$isError = TRUE;
			$error = "Nama Tunjangan Harap diisi";
		}
		if($tunjangan == ''){
			$isError = TRUE;
			$error = "Tunjangan Harap diisi";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					tunjangan(
						id_tunjangan, 
						nama_tunjangan, 
						tunjangan
					)
					VALUES(
						'$id_tunjangan', 
						'$nama_tunjangan', 
						'$tunjangan'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data tunjangan';
				header("Location:" . BASE_URL . "data_master/data_tunjangan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>