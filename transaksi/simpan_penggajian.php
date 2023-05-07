<?php 
	require_once "../functions.php";
	require_once "../koneksi.php";

	check_login();

	//deklarasi variable dan membaca nilai dari POST
	$no_slip = isset($_POST['no_slip']) ? $_POST['no_slip'] : '' ;
	$nik = $_POST['nik'] ?? '';
	$tanggal = $_POST['tanggal'] ?? '';
	$bulan = $_POST['bulan'] ?? '';
	$tahun = $_POST['tahun'] ?? '';
	$gp = $_POST['gaji_pokok'] ?? '';
	$tt = $_POST['total_tunjangan'] ?? '';
	$ul = $_POST['uang_lembur'] ?? '';
	$total_absen = $_POST['total_absen'] ?? '';
	$p = $_POST['pph21'] ?? '';
	$bkt = $_POST['bpjs_ketenagakerjaan'] ?? '';
	$bks = $_POST['bpjs_kesehatan'] ?? '';
	$tg = $_POST['total_gaji'] ?? '';

	$gaji_pokok = hapus_rupiah($gp);
	$total_tunjangan = hapus_rupiah($tt);
	$uang_lembur = hapus_rupiah($ul);
	$pph21 = hapus_rupiah($p);
	$bpjs_ketenagakerjaan = hapus_rupiah($bkt);
	$bpjs_kesehatan = hapus_rupiah($bks);
	$total_gaji = hapus_rupiah($tg);

	$isError = FALSE;
	$error = '';
	//cek apakah sudah disubmit / belum
	if(isset($_POST)){
		
		if($no_slip == ''){
			$isError = TRUE;
			$error = "No Slip Harap diisi";
		}
		if($nik == ''){
			$isError = TRUE;
			$error = "NIK Harap dipilih";
		}

		//kalau gak eror / isError = false, maka proses data ke DB
		if($isError == FALSE){
			$conn = open_connection();

			$query = "INSERT INTO 
					penggajian(
						no_slip, 
						nik, 
						tanggal, 
						bulan, 
						tahun, 
						gaji_pokok, 
						total_tunjangan, 
						uang_lembur, 
						total_absen, 
						pph21, 
						bpjs_ketenagakerjaan, 
						bpjs_kesehatan,
						total_gaji
					)
					VALUES(
						'$no_slip', 
						'$nik', 
						'$tanggal', 
						'$bulan', 
						'$tahun', 
						'$gaji_pokok', 
						'$total_tunjangan', 
						'$uang_lembur', 
						'$total_absen', 
						'$pph21', 
						'$bpjs_ketenagakerjaan', 
						'$bpjs_kesehatan',
						'$total_gaji'
					);
			";

			$hasil = mysqli_query($conn, $query);

			if($hasil){
				$_SESSION['pesan_sukses'] = 'Berhasil Menambah data penggajian';
				header("Location:" . BASE_URL . "transaksi/transaksi_penggajian.php");
			}else{
				$isError = TRUE;
				$error = "Gagal menyimpan ke database : " . mysqli_error($conn);
			}

		}
	}

?>