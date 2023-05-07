<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_id_tunjangan = $_POST['e_id_tunjangan'];

	$conn = open_connection();

	$query = "SELECT * FROM tunjangan WHERE id_tunjangan ='$param_id_tunjangan'";
	$hasil = mysqli_query($conn, $query);

	$old_data = array();
	$data_found = FALSE;

	if($row = mysqli_fetch_assoc($hasil)){
		$old_data = $row;
		$data_found = TRUE;
	}

	//deklarasi variable dan membaca nilai dari POST
	$id_tunjangan = isset($_POST['e_id_tunjangan']) ? $_POST['e_id_tunjangan'] : $old_data['id_tunjangan'] ?? '' ;
	$nama_tunjangan = $_POST['e_nama_tunjangan'] ?? $old_data['nama_tunjangan'] ?? '';
	$tunjangan = $_POST['e_tunjangan'] ?? $old_data['tunjangan'] ?? '';

	$isError = FALSE;
	$error = '';

	if($data_found && isset($_POST['submit'])){
		if($id_tunjangan != $old_data['id_tunjangan']){
			$isError = TRUE;
			$error .= 'ID Tunjangan Tidak boleh diubah !!';
		}
		if($nama_tunjangan == ''){
			$isError = TRUE;
			$error = 'Nama tunjangan tidak boleh kosong';
		}

		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE tunjangan SET 
					nama_tunjangan = '$nama_tunjangan',
					tunjangan = '$tunjangan'
				WHERE 
					id_tunjangan = '$old_data[id_tunjangan]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil mengubah data dengan ID Tunjangan : ' . $old_data['id_tunjangan'];
				header("Location:".BASE_URL."data_master/data_tunjangan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}
		}
	}

?>