<?php 
	require_once "../koneksi.php";

	$conn = open_connection();

	$kata_kunci = $_POST['kunci'];

	$query = "
		SELECT * FROM departemen WHERE nama_departemen LIKE '%$kata_kunci%' OR  id_departemen LIKE '%$kata_kunci%'
		";

	$hasil = mysqli_query($conn, $query);

	$i = 1;

	while($row = mysqli_fetch_assoc($hasil)){

		echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>$row[id_departemen]</td>";
        echo "<td>$row[nama_departemen]</td>";
        echo "<td> 
        <div class='btn-group'>
          <a href='#' onclick='edit_departemen(".'"'."$row[id_departemen]".'","'."$row[nama_departemen]".'"'.")' class='btn btn-info'><i class='fas fa-edit'></i></a>
          <a href='hapus_departemen.php?id_departemen=$row[id_departemen]' class='btn btn-danger'><i class='fas fa-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
	}
?>