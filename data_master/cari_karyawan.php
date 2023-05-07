<?php 
	require_once "../koneksi.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM karyawan WHERE nama_karyawan LIKE '%$kata_kunci%' OR  nik LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){

		$query_j = "SELECT * FROM jabatan WHERE id_jabatan = '$row[id_jabatan]'";
        $hasil_j = mysqli_query($conn, $query_j);
        $row_j = mysqli_fetch_assoc($hasil_j);

		echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[nik]</td>";
        echo "<td>$row_j[nama_jabatan]</td>";
        echo "<td>$row[nama_karyawan]</td>";
        echo "<td>$row[alamat]</td>";
        echo "<td>$row[jenis_kelamin]</td>";
        echo "<td>$row[no_telepon]</td>";
        echo "<td>$row[tanggal_masuk]</td>";
        echo "<td>$row[tanggal_keluar]</td>";
        echo "<td> 
        <div class='btn-group'>
            <a href='#' onclick='edit_karyawan($row[nik],".'"'."$row[id_jabatan]".'","'."$row_j[nama_jabatan]".'","'."$row[nama_karyawan]".'","'."$row[alamat]".'","'."$row[jenis_kelamin]".'","'."$row[no_telepon]".'","'."$row[foto]".'","'."$row[tanggal_masuk]".'","'."$row[tanggal_keluar]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
            <a href='hapus_karyawan.php?nik=$row[nik]&foto=$row[foto]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>