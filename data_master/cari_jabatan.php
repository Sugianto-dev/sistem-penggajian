<?php 
	require_once "../koneksi.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM jabatan WHERE nama_jabatan LIKE '%$kata_kunci%' OR  id_jabatan LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){

		$query_t = "SELECT * FROM tunjangan WHERE id_tunjangan = '$row[id_tunjangan]'";
        $hasil_t = mysqli_query($conn, $query_t);
        $row_t = mysqli_fetch_assoc($hasil_t);

        $query_d = "SELECT * FROM departemen WHERE id_departemen = '$row[id_departemen]'";
        $hasil_d = mysqli_query($conn, $query_d);
        $row_d = mysqli_fetch_assoc($hasil_d);

		echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[id_jabatan]</td>";
        echo "<td>$row[nama_jabatan]</td>";
        echo "<td>$row[gaji_pokok]</td>";
        echo "<td>$row_t[id_tunjangan]</td>";
        echo "<td>$row_d[id_departemen]</td>";
        echo "<td> 
        <div class='btn-group'>
            <a href='#' onclick='edit_jabatan(".'"'."$row[id_jabatan]".'","'."$row[nama_jabatan]".'",'."$row[gaji_pokok]".',"'."$row_t[id_tunjangan]".'","'."$row_d[id_departemen]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
            <a href='hapus_jabatan.php?id_jabatan=$row[id_jabatan]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>