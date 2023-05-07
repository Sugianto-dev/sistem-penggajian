<?php 
	require_once "../koneksi.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM admin WHERE nik LIKE '%$kata_kunci%' OR  id_admin LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){

		$query_k = "SELECT * FROM karyawan WHERE nik = '$row[nik]'";
        $hasil_k = mysqli_query($conn, $query_k);
        $row_k = mysqli_fetch_assoc($hasil_k);

		echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[id_admin]</td>";
        echo "<td>$row[nik]</td>";
        echo "<td>$row[username]</td>";
        echo "<td>$row[password]</td>";
        echo "<td>$row[status]</td>";
        echo "<td> 
        <div class='btn-group'>
            <a href='#' onclick='edit_admin(".'"'."$row[id_admin]".'","'."$row_k[nama_karyawan]".'","'."$row[nik]".'","'."$row[username]".'","'."$row[password]".'","'."$row[status]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
            <a href='hapus_admin.php?id_admin=$row[id_admin]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>