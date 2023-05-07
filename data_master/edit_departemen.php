<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_id_departemen = $_POST['e_id_departemen'];

	$conn = open_connection();

	$query = "SELECT * FROM departemen WHERE id_departemen ='$param_id_departemen'";
	$hasil = mysqli_query($conn, $query);

	$old_data = array();
	$data_found = FALSE;

	if($row = mysqli_fetch_assoc($hasil)){
		$old_data = $row;
		$data_found = TRUE;
	}

	//deklarasi variable dan membaca nilai dari POST
	$id_departemen = isset($_POST['e_id_departemen']) ? $_POST['e_id_departemen'] : $old_data['id_departemen'] ?? '' ;
	$nama_departemen = $_POST['e_nama_departemen'] ?? $old_data['nama_departemen'] ?? '';

	$isError = FALSE;
	$error = '';

	if($data_found && isset($_POST['submit'])){
		if($id_departemen != $old_data['id_departemen']){
			$isError = TRUE;
			$error .= 'ID Departemen Tidak boleh diubah !!';
		}
		if($nama_departemen == ''){
			$isError = TRUE;
			$error = 'Nama departemen tidak boleh kosong';
		}

		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE departemen SET 
					nama_departemen = '$nama_departemen'
				WHERE 
					id_departemen = '$old_data[id_departemen]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil mengubah data dengan ID Departemen : ' . $old_data['id_departemen'];
				header("Location:".BASE_URL."data_master/data_departemen.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}
		}
	}

?>