<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$id_departemen = isset($_POST['id_departemen']) ? $_POST['id_departemen'] : '' ;
	$nama_departemen = $_POST['nama_departemen'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($id_departemen == ''){
			$isError = TRUE;
			$error = "ID Departemen Harap diisi";
		}
		if($nama_departemen == ''){
			$isError = TRUE;
			$error = "Nama Departemen Harap diisi";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					departemen(
						id_departemen, 
						nama_departemen
					)
					VALUES(
						'$id_departemen', 
						'$nama_departemen'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data departemen';
				header("Location:" . BASE_URL . "data_master/data_departemen.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>