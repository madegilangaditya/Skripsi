<?php
	include "adminpage/koneksi.php";
	$warna = $_GET['warna'];
	$gmb = mysql_query("select * from tb_warna where id_warna='$warna'");
	//echo "<option>Pilih Kabupaten</option>";
	$k = mysql_fetch_array($gmb);
	$g = $k['gambar'];
		
		echo "adminpage/$g";
		
	
?>
