<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	$param_nik = $_POST['e_nik'];

	$conn = open_connection();

	$query = "SELECT * FROM karyawan WHERE nik ='$param_nik'";
	$hasil = mysqli_query($conn, $query);

	$old_data = array();
	$data_found = FALSE;

	if($row = mysqli_fetch_assoc($hasil)){
		$old_data = $row;
		$data_found = TRUE;
	}

	//ambil list jabatan
	$list_jabatan = get_data_jabatan();

	//deklarasi variable dan membaca nilai dari POST
	$nik = isset($_POST['e_nik']) ? $_POST['e_nik'] : $old_data['nik'] ?? '' ;
	$id_jabatan = $_POST['e_id_jabatan'] ?? $old_data['id_jabatan'] ?? '';
	$nama_karyawan = $_POST['e_nama_karyawan'] ?? $old_data['nama_karyawan'] ?? '';
	$alamat = $_POST['e_alamat'] ?? $old_data['alamat'] ?? '';
	$jenis_kelamin = $_POST['e_jenis_kelamin'] ?? $old_data['jenis_kelamin'] ?? '';
	$no_telepon = $_POST['e_no_telepon'] ?? $old_data['no_telepon'] ?? '';
	$ptkp = $_POST['e_ptkp'] ?? $old_data['ptkp'] ?? '';
	$npwp = $_POST['e_npwp'] ?? $old_data['npwp'] ?? '';
	if($_FILES['e_foto']["name"] == ''){
		$namaFile = $old_data['foto'];
	}else{
		// ambil data file
		$ext = end(explode('.', $_FILES["e_foto"]["name"]));
		$namaFile = md5(rand()) . '.' . $ext;
		$namaSementara = $_FILES['e_foto']['tmp_name'];

		// tentukan lokasi file akan dipindahkan
		$dirUpload = "../dist/uploads/";

		// pindahkan file
		move_uploaded_file($namaSementara, $dirUpload.$namaFile);

		// hapus foto lama
		unlink('../dist/uploads/'.$old_data['foto']);
	}
	$tanggal_masuk = $_POST['e_tanggal_masuk'] ?? $old_data['tanggal_masuk'] ?? '';
	$tanggal_keluar = $_POST['e_tanggal_keluar'] ?? $old_data['tanggal_keluar'] ?? '';

	$isError = FALSE;
	$error = '';

	if($data_found && isset($_POST['submit'])){
		if($nik != $old_data['nik']){
			$isError = TRUE;
			$error .= 'NIK Tidak boleh diubah !!';
		}
		if($id_jabatan == ''){
			$isError = TRUE;
			$error = 'Jabatan tidak boleh kosong';
		}

		if($isError == FALSE){
			$conn = open_connection();

			$query = "UPDATE karyawan SET 
					id_jabatan = '$id_jabatan',
					nama_karyawan = '$nama_karyawan',
					alamat = '$alamat',
					jenis_kelamin = '$jenis_kelamin',
					no_telepon = '$no_telepon', 
					ptkp = '$ptkp', 
					npwp = '$npwp', 
					foto = '$namaFile', 
					tanggal_masuk = '$tanggal_masuk',
					tanggal_keluar = '$tanggal_keluar'
				WHERE 
					nik = '$old_data[nik]'
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil mengubah data dengan NIK : ' . $old_data['nik'];
				header("Location:".BASE_URL."data_master/data_karyawan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}
		}
	}

?>