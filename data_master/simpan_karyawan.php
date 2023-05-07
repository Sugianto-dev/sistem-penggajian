<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$nik = isset($_POST['nik']) ? $_POST['nik'] : '' ;
	$id_jabatan = $_POST['id_jabatan'] ?? '';
	$nama_karyawan = $_POST['nama_karyawan'] ?? '';
	$alamat = $_POST['alamat'] ?? '';
	$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
	$no_telepon = $_POST['no_telepon'] ?? '';
	$ptkp = $_POST['ptkp'] ?? '';
	$npwp = $_POST['npwp'] ?? '';
	$tanggal_masuk = $_POST['tanggal_masuk'] ?? '';

	// ambil data file
	$ext = end(explode('.', $_FILES["foto"]["name"]));
	$namaFile = md5(rand()) . '.' . $ext;
	$namaSementara = $_FILES['foto']['tmp_name'];

	// tentukan lokasi file akan dipindahkan
	$dirUpload = "../dist/uploads/";

	// pindahkan file
	move_uploaded_file($namaSementara, $dirUpload.$namaFile);

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($nik == ''){
			$isError = TRUE;
			$error = "NIK Harap diisi";
		}
		if($id_jabatan == ''){
			$isError = TRUE;
			$error = "Jabatan Harap dipilih";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					karyawan(
						nik, 
						id_jabatan, 
						nama_karyawan, 
						alamat, 
						jenis_kelamin, 
						no_telepon, 
						ptkp, 
						npwp, 
						foto,
						tanggal_masuk,
						tanggal_keluar
					)
					VALUES(
						'$nik', 
						'$id_jabatan', 
						'$nama_karyawan', 
						'$alamat', 
						'$jenis_kelamin', 
						'$no_telepon', 
						'$ptkp', 
						'$npwp', 
						'$namaFile', 
						'$tanggal_masuk', 
						'' 
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data karyawan';
				header("Location:" . BASE_URL . "data_master/data_karyawan.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>