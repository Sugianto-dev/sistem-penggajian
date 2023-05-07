<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$id_admin = isset($_POST['id_admin']) ? $_POST['id_admin'] : '' ;
	$nik = $_POST['nik'] ?? '';
	$username = $_POST['username'] ?? '';
	$password = $_POST['password'] ?? '';
	$status = $_POST['status'] ?? '';

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($id_admin == ''){
			$isError = TRUE;
			$error = "ID Admin Harap diisi";
		}
		if($nik == ''){
			$isError = TRUE;
			$error = "NIK Harap dipilih";
		}
		if($status == ''){
			$isError = TRUE;
			$error = "Status Harap dipilih";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					admin(
						id_admin, 
						nik, 
						username, 
						password, 
						status
					)
					VALUES(
						'$id_admin', 
						'$nik', 
						'$username', 
						md5('$password'), 
						'$status'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data admin';
				header("Location:" . BASE_URL . "data_master/data_admin.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>