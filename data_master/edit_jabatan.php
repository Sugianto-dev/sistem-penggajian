<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_id_jabatan = $_POST['e_id_jabatan'];

	$conn = open_connection();

	$query = "SELECT * FROM jabatan WHERE id_jabatan ='$param_id_jabatan'";
	$hasil = mysqli_query($conn, $query);

	$old_data = array();
	$data_found = FALSE;

	if($row = mysqli_fetch_assoc($hasil)){
		$old_data = $row;
		$data_found = TRUE;
	}

	//ambil list jabatan & departemen
	$list_tunjangan = get_data_tunjangan();
	$list_departemen = get_data_departemen();

	//deklarasi variable dan membaca nilai dari POST
	$id_jabatan = isset($_POST['e_id_jabatan']) ? $_POST['e_id_jabatan'] : $old_data['id_jabatan'] ?? '' ;
	$nama_jabatan = $_POST['e_nama_jabatan'] ?? $old_data['nama_jabatan'] ?? '';
	$gaji_pokok = $_POST['e_gaji_pokok'] ?? $old_data['gaji_pokok'] ?? '';
	$id_tunjangan = $_POST['e_id_tunjangan'] ?? $old_data['id_tunjangan'] ?? '';
	$id_departemen = $_POST['e_id_departemen'] ?? $old_data['id_departemen'] ?? '';

	$isError = FALSE;
	$error = '';

	if($data_found && isset($_POST['submit'])){
		if($id_jabatan != $old_data['id_jabatan']){
			$isError = TRUE;
			$error .= 'ID Jabatan Tidak boleh diubah !!';
		}
		if($nama_jabatan == ''){
			$isError = TRUE;
			$error = 'Nama jabatan tidak boleh kosong';
		}

		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE jabatan SET 
					nama_jabatan = '$nama_jabatan',
					gaji_pokok = '$gaji_pokok',
					id_tunjangan = '$id_tunjangan',
					id_departemen = '$id_departemen'
				WHERE 
					id_jabatan = '$old_data[id_jabatan]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil mengubah data dengan ID Jabatan : ' . $old_data['id_jabatan'];
				header("Location:".BASE_URL."data_master/data_jabatan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}
		}
	}

?>