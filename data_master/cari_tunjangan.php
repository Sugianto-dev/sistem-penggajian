<?php 
	require_once "../koneksi.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM tunjangan WHERE nama_tunjangan LIKE '%$kata_kunci%' OR  id_tunjangan LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){

		echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[id_tunjangan]</td>";
        echo "<td>$row[nama_tunjangan]</td>";
        echo "<td>$row[tunjangan]</td>";
        echo "<td> 
        <div class='btn-group'>
            <a href='#' onclick='edit_tunjangan(".'"'."$row[id_tunjangan]".'","'."$row[nama_tunjangan]".'",'."$row[tunjangan])' class='btn btn-info'><i class='fas fa-edit'></i></a>
            <a href='hapus_tunjangan.php?id_tunjangan=$row[id_tunjangan]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>