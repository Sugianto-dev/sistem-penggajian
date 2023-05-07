<?php
session_start();
define('BASE_URL', "http://localhost/sistem_penggajian/");

function check_login(){
	if(!isset($_SESSION['username'])){
		header("Location:http://localhost/sistem_penggajian/login.php");
	}
}

function hitung_karyawan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT count(nik) AS jumlah_karyawan FROM karyawan";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	echo $row['jumlah_karyawan'];
}

function hitung_jabatan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT count(id_jabatan) AS jumlah_jabatan FROM jabatan";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	echo $row['jumlah_jabatan'];
}

function hitung_departemen(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT count(id_departemen) AS jumlah_departemen FROM departemen";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	echo $row['jumlah_departemen'];
}

function hitung_admin(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT count(id_admin) AS jumlah_admin FROM admin";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	echo $row['jumlah_admin'];
}

function get_data_login($data){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM karyawan k JOIN admin a ON a.username = '$username' AND k.nik = a.nik";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	echo $row[$data];
}

function get_data_login2($data){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM karyawan k JOIN admin a ON a.username = '$username' AND k.nik = a.nik";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);
	return $row[$data];
}

function get_data_karyawan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT nik, nama_karyawan FROM karyawan";
	$hasil = mysqli_query($conn, $query);

	$list = array();
	while($row = mysqli_fetch_assoc($hasil)){
		$list[ $row['nik'] ] = $row['nama_karyawan'];
	}	

	return $list;
}

function get_data_jabatan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT id_jabatan, nama_jabatan FROM jabatan GROUP BY id_jabatan";
	$hasil = mysqli_query($conn, $query);

	$list = array();
	while($row = mysqli_fetch_assoc($hasil)){
		$list[ $row['id_jabatan'] ] = $row['nama_jabatan'];
	}	

	return $list;
}

function get_data_tunjangan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT id_tunjangan, nama_tunjangan FROM tunjangan";
	$hasil = mysqli_query($conn, $query);

	$list = array();
	while($row = mysqli_fetch_assoc($hasil)){
		$list[ $row['id_tunjangan'] ] = $row['nama_tunjangan'];
	}	

	return $list;
}

function get_data_departemen(){
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT id_departemen, nama_departemen FROM departemen";
	$hasil = mysqli_query($conn, $query);

	$list = array();
	while($row = mysqli_fetch_assoc($hasil)){
		$list[ $row['id_departemen'] ] = $row['nama_departemen'];
	}	

	return $list;
}

function cek_status(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['status'];
}


// Functions Sidebar

function hak_master(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<a href="#" class="nav-link disabled">';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<a href="#" class="nav-link disabled">';
	}

	// jika hrd
	if ($row['status'] == 'HRD'){
		echo '<a href="#" class="nav-link">';
	}
}

function ket_hak_master(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<span class="right badge badge-danger">Locked</span>';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<span class="right badge badge-danger">Locked</span>';
	}

	// jika hrd
	if ($row['status'] == 'HRD'){
		echo '<i class="right fas fa-angle-left"></i>';
	}
}

function hak_penggajian(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<a href="#" class="nav-link disabled">';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<a href="#" class="nav-link disabled">';
	}

	// jika hrd
	if ($row['status'] == 'HRD'){
		echo '<a href="'.BASE_URL.'transaksi/transaksi_penggajian.php" class="nav-link">';
	}
}

function ket_hak_penggajian(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<span class="right badge badge-danger">Locked</span>';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<span class="right badge badge-danger">Locked</span>';
	}
}

function hak_laporan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<a href="#" class="nav-link">';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<a href="#" class="nav-link disabled">';
	}

	// jika hrd
	if ($row['status'] == 'HRD'){
		echo '<a href="#" class="nav-link">';
	}
}

function ket_hak_laporan(){
	require_once "koneksi.php";
	$conn = open_connection();

	$username = $_SESSION['username'];
	$query = "SELECT * FROM admin WHERE username = '$username'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	// jika manager
	if ($row['status'] == 'Manager'){
		echo '<i class="right fas fa-angle-left"></i>';
	}

	// jika karyawan
	if ($row['status'] == 'Karyawan'){
		echo '<span class="right badge badge-danger">Locked</span>';
	}

	// jika hrd
	if ($row['status'] == 'HRD'){
		echo '<i class="right fas fa-angle-left"></i>';
	}
}


// Functions Transaksi

function rupiah($angka){	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function hapus_rupiah($angka){	
	$rp = $angka;
  	$hasil = preg_replace('/[Rp. ]/','',$rp);
  	return $hasil;
}

function jumlah_hari_kerja_bulan_ini(){
	date_default_timezone_set("Asia/Jakarta");
	$kalender = CAL_GREGORIAN;
	$bulan = date('m');
	$tahun = date('Y');

	$hari = cal_days_in_month($kalender, $bulan, $tahun);

	$awal = strtotime($tahun.'-'.$bulan.'-01');
	$akhir = strtotime($tahun.'-'.$bulan.'-'.$hari);

	$harikerja = array();
	$sabtuminggu = array();

	for ($i=$awal; $i <= $akhir; $i += (60 * 60 * 24)) {
	    if (date('w', $i) !== '0' && date('w', $i) !== '6') {
	        $harikerja[] = $i;
	    } else {
	        $sabtuminggu[] = $i;
	    }
	 
	}

	$jumlah_kerja = count($harikerja);
	$jumlah_sabtuminggu = count($sabtuminggu);

	$total_hari_kerja = $hari - $jumlah_sabtuminggu;

	return $total_hari_kerja;
}

function generate_no_slip(){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$query = "SELECT count(no_slip) AS jumlah_penggajian FROM penggajian";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	$nomor = $row['jumlah_penggajian']+1;
	$tanggal = date('dmyHis');

	echo 'GJ'.$nomor.$tanggal;
}

function generate_id_presensi(){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$tanggal_hari_ini = date('Y-m-d');

	$nik = get_data_login2('nik');

	$query = "SELECT *, count(id_presensi) as jumlah_presensi FROM presensi WHERE tanggal = '$tanggal_hari_ini' AND nik = '$nik'";
	$hasil = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($hasil);

	if ($row['jumlah_presensi'] > 0) {
		echo $row['id_presensi'];
	} else {
		$query2 = "SELECT count(id_presensi) AS jumlah_presensi FROM presensi";
		$hasil2 = mysqli_query($conn, $query2);

		$row2 = mysqli_fetch_assoc($hasil2);

		$nomor = $row2['jumlah_presensi']+1;
		$tanggal = date('dmyHis');

		echo 'PR'.$nomor.$tanggal;
	}
}

function cek_presensi($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$tanggal = date('Y-m-d');

	$query = "SELECT count(id_presensi) AS jumlah_presensi FROM presensi WHERE nik = '$nik' AND tanggal = '$tanggal'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['jumlah_presensi'];
}

function cek_jam_masuk($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$tanggal = date('Y-m-d');

	$query = "SELECT jam_masuk FROM presensi WHERE nik = '$nik' AND tanggal = '$tanggal'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['jam_masuk'];
}

function cek_jam_keluar($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$tanggal = date('Y-m-d');

	$query = "SELECT jam_keluar FROM presensi WHERE nik = '$nik' AND tanggal = '$tanggal'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['jam_keluar'];
}

function cek_absen($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$tanggal = date('Y-m-d');

	$query = "SELECT absen FROM presensi WHERE nik = '$nik' AND tanggal = '$tanggal'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['absen'];
}

function hitung_lembur($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$bulan = date('m');

	$query = "SELECT SUM(lembur) AS total_lembur FROM presensi WHERE nik = '$nik' AND bulan = '$bulan'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['total_lembur'];
}

function hitung_absen($nik){
	date_default_timezone_set("Asia/Jakarta");
	require_once "koneksi.php";
	$conn = open_connection();

	$bulan = date('m');

	$query = "SELECT count(absen) AS total_absen FROM presensi WHERE nik = '$nik' AND bulan = '$bulan' AND absen != 'Masuk'";
	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

	return $row['total_absen'];
}


// Functions Laporan
function generate_laporan(){
	date_default_timezone_set("Asia/Jakarta");
	$tanggal = date('dmyHis');

	return 'LP'.$tanggal;
}
?>