<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_id_admin = $_POST['e_id_admin'];

	$conn = open_connection();

	$query = "SELECT * FROM admin WHERE id_admin ='$param_id_admin'";
	$hasil = mysqli_query($conn, $query);

	$old_data = array();
	$data_found = FALSE;

	if($row = mysqli_fetch_assoc($hasil)){
		$old_data = $row;
		$data_found = TRUE;
	}

	//ambil list karyawan
	$list_karyawan = get_data_karyawan();

	//deklarasi variable dan membaca nilai dari POST
	$id_admin = isset($_POST['e_id_admin']) ? $_POST['e_id_admin'] : $old_data['id_admin'] ?? '' ;
	$nik = $_POST['e_nik'] ?? $old_data['nik'] ?? '';
	$username = $_POST['e_username'] ?? $old_data['username'] ?? '';
	$password = $_POST['e_password'] ?? $old_data['password'] ?? '';
	$status = $_POST['e_status'] ?? $old_data['status'] ?? '';

	$isError = FALSE;
	$error = '';

	if($data_found && isset($_POST['submit'])){
		if($id_admin != $old_data['id_admin']){
			$isError = TRUE;
			$error .= 'ID Admin Tidak boleh diubah !!';
		}
		if($nik == ''){
			$isError = TRUE;
			$error = 'NIK tidak boleh kosong';
		}

		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE admin SET 
					nik = '$nik',
					username = '$username',
					password = md5('$password'),
					status = '$status'
				WHERE 
					id_admin = '$old_data[id_admin]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil mengubah data dengan ID Admin : ' . $old_data['id_admin'];
				header("Location:".BASE_URL."data_master/data_admin.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}
		}
	}

?>