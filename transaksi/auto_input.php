<?php 
	require_once "../koneksi.php";
    require_once "../functions.php";

	$conn = open_connection();

	$nik = $_POST['nik'];

	$query = "SELECT * FROM karyawan k JOIN jabatan j ON k.nik = '$nik' AND j.id_jabatan = k.id_jabatan";

	$hasil = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($hasil);

    $query2 = "SELECT SUM(tunjangan) AS total_tunjangan FROM karyawan k JOIN jabatan j ON k.nik = '$nik' AND j.id_jabatan = k.id_jabatan JOIN tunjangan t ON t.id_tunjangan = j.id_tunjangan";

    $hasil2 = mysqli_query($conn, $query2);

    $row2 = mysqli_fetch_assoc($hasil2);

    $jumlah_hari_kerja = jumlah_hari_kerja_bulan_ini();
    $total_tunjangan = $row2['total_tunjangan'] * $jumlah_hari_kerja;

    $hitung_lembur = hitung_lembur($nik);
    $uang_lembur = $hitung_lembur * 30000;

    $hitung_absen = hitung_absen($nik);
    $total_absen = $hitung_absen;

    // PPh 21
    $bruto = ($row['gaji_pokok'] + $total_tunjangan + $uang_lembur) * 12;
    $biaya_jabatan = $bruto * 5 / 100;
    if ($biaya_jabatan > 6000000) {
        $biaya_jabatan = 6000000;
    }
    $jht = $row['gaji_pokok'] * 2 / 100;
    $jp = $row['gaji_pokok'] * 1 / 100;
    $iuran_pensiun = $jht + $jp;
    $neto = $bruto - $biaya_jabatan - $iuran_pensiun;
    if ($row['ptkp'] == 'TK/0') {
        $ptkp = 54000000;
    } else if ($row['ptkp'] == 'TK/1') {
        $ptkp = 58500000;
    } else if ($row['ptkp'] == 'TK/2') {
        $ptkp = 63000000;
    } else if ($row['ptkp'] == 'TK/3') {
        $ptkp = 67500000;
    } else if ($row['ptkp'] == 'K/0') {
        $ptkp = 58500000;
    } else if ($row['ptkp'] == 'K/1') {
        $ptkp = 63000000;
    } else if ($row['ptkp'] == 'K/2') {
        $ptkp = 67500000;
    } else if ($row['ptkp'] == 'K/3') {
        $ptkp = 72000000;
    } else if ($row['ptkp'] == 'K/I/0') {
        $ptkp = 112500000;
    } else if ($row['ptkp'] == 'K/I/1') {
        $ptkp = 117000000;
    } else if ($row['ptkp'] == 'K/I/2') {
        $ptkp = 121500000;
    } else if ($row['ptkp'] == 'K/I/3') {
        $ptkp = 126000000;
    } else {
        $ptkp = 0;
    }
    $pkp = $neto - $ptkp;
    if ($row['npwp'] = '') {
        if ($pkp <= 60000000) {
            $tarif_l1 = ($pkp * 5 / 100) * 120 / 100;
            $tarif_l2 = 0;
            $tarif_l3 = 0;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 250000000) {
            $tarif_l1 = (60000000 * 5 / 100) * 120 / 100;
            $tarif_l2 = (($pkp - 60000000) * 15 / 100) * 120 / 100;
            $tarif_l3 = 0;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 500000000) {
            $tarif_l1 = (60000000 * 5 / 100) * 120 / 100;
            $tarif_l2 = (190000000 * 15 / 100) * 120 / 100;
            $tarif_l3 = (($pkp - 190000000 - 60000000) * 25 / 100) * 120 / 100;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 5000000000) {
            $tarif_l1 = (60000000 * 5 / 100) * 120 / 100;
            $tarif_l2 = (190000000 * 15 / 100) * 120 / 100;
            $tarif_l3 = (250000000 * 25 / 100) * 120 / 100;
            $tarif_l4 = (($pkp - 250000000 - 190000000 - 60000000) * 30 / 100) * 120 / 100;
            $tarif_l5 = 0;
        } else if ($pkp > 5000000000) {
            $tarif_l1 = (60000000 * 5 / 100) * 120 / 100;
            $tarif_l2 = (190000000 * 15 / 100) * 120 / 100;
            $tarif_l3 = (250000000 * 25 / 100) * 120 / 100;
            $tarif_l4 = (4500000000 * 30 / 100) * 120 / 100;
            $tarif_l5 = (($pkp - 4500000000 - 250000000 - 190000000 - 60000000) * 35 / 100) * 120 / 100;
        }
    } else {
        if ($pkp <= 60000000) {
            $tarif_l1 = $pkp * 5 / 100;
            $tarif_l2 = 0;
            $tarif_l3 = 0;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 250000000) {
            $tarif_l1 = 60000000 * 5 / 100;
            $tarif_l2 = ($pkp - 60000000) * 15 / 100;
            $tarif_l3 = 0;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 500000000) {
            $tarif_l1 = 60000000 * 5 / 100;
            $tarif_l2 = 190000000 * 15 / 100;
            $tarif_l3 = ($pkp - 190000000 - 60000000) * 25 / 100;
            $tarif_l4 = 0;
            $tarif_l5 = 0;
        } else if ($pkp <= 5000000000) {
            $tarif_l1 = 60000000 * 5 / 100;
            $tarif_l2 = 190000000 * 15 / 100;
            $tarif_l3 = 250000000 * 25 / 100;
            $tarif_l4 = ($pkp - 250000000 - 190000000 - 60000000) * 30 / 100;
            $tarif_l5 = 0;
        } else if ($pkp > 5000000000) {
            $tarif_l1 = 60000000 * 5 / 100;
            $tarif_l2 = 190000000 * 15 / 100;
            $tarif_l3 = 250000000 * 25 / 100;
            $tarif_l4 = 4500000000 * 30 / 100;
            $tarif_l5 = ($pkp - 4500000000 - 250000000 - 190000000 - 60000000) * 35 / 100;
        }
    }
    $pph21_setahun = $tarif_l1 + $tarif_l2 + $tarif_l3 + $tarif_l4 + $tarif_l5;
    $pph21 = $pph21_setahun / 12;
    if ($pph21 < 0) {
        $pph21 = 0;
    }

    $bpjs_ketenagakerjaan = $row['gaji_pokok'] * 2 / 100;
    $bpjs_kesehatan = $row['gaji_pokok'] * 1 / 100;

    $total_gaji = ($row['gaji_pokok'] + $total_tunjangan + $uang_lembur) - ($total_absen * 100000) - round($pph21) - $bpjs_ketenagakerjaan - $bpjs_kesehatan;

    $data = array(
        'nama_karyawan' => $row['nama_karyawan'],
        'gaji_pokok' => rupiah($row['gaji_pokok']),
        'total_tunjangan' => rupiah($total_tunjangan),
        'uang_lembur' => rupiah($uang_lembur),
        'total_absen' => $total_absen,
        'pph21' => rupiah(round($pph21)),
        'bpjs_ketenagakerjaan' => rupiah($bpjs_ketenagakerjaan),
        'bpjs_kesehatan' => rupiah($bpjs_kesehatan),
        'total_gaji' => rupiah($total_gaji)
    );

    echo json_encode($data);
?>