<?php 
	require_once "../koneksi.php";
    require_once "../functions.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM penggajian WHERE no_slip LIKE '%$kata_kunci%' OR  nik LIKE '%$kata_kunci%' OR tanggal LIKE '%$kata_kunci%' OR bulan LIKE '%$kata_kunci%' OR tahun LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[no_slip]</td>";
        echo "<td>$row[nik]</td>";
        echo "<td>$row[tanggal]</td>";
        echo "<td>".rupiah($row['gaji_pokok'])."</td>";
        echo "<td>".rupiah($row['total_tunjangan'])."</td>";
        echo "<td>".rupiah($row['uang_lembur'])."</td>";
        echo "<td>$row[total_absen]</td>";
        echo "<td>".rupiah($row['pph21'])."</td>";
        echo "<td>".rupiah($row['bpjs_ketenagakerjaan'])."</td>";
        echo "<td>".rupiah($row['bpjs_kesehatan'])."</td>";
        echo "<td>".rupiah($row['total_gaji'])."</td>";
        echo "<td> 
        <div class='btn-group'>
            <a id='hapus_penggajian' href='hapus_penggajian.php?no_slip=$row[no_slip]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>