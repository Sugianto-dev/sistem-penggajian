<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$id_jabatan = isset($_POST['id_jabatan']) ? $_POST['id_jabatan'] : '' ;
	$nama_jabatan = $_POST['nama_jabatan'] ?? '';
	$gaji_pokok = $_POST['gaji_pokok'] ?? '';
	$id_tunjangan = $_POST['id_tunjangan'] ?? '';
	$id_departemen = $_POST['id_departemen'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($id_jabatan == ''){
			$isError = TRUE;
			$error = "ID Jabatan Harap diisi";
		}
		if($id_departemen == ''){
			$isError = TRUE;
			$error = "Departemen Harap dipilih";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					jabatan(
						id_jabatan, 
						nama_jabatan, 
						gaji_pokok, 
						id_tunjangan, 
						id_departemen
					)
					VALUES(
						'$id_jabatan', 
						'$nama_jabatan', 
						'$gaji_pokok', 
						'$id_tunjangan', 
						'$id_departemen'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data jabatan';
				header("Location:" . BASE_URL . "data_master/data_jabatan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>