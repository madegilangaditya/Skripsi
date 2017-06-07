<?php
	include "koneksi.php";
	$kabupaten = $_GET['kabupaten'];
	$kecamatan = mysql_query("SELECT id_kecamatan,nama_kecamatan FROM tb_kecamatan WHERE id_kabupaten='$kabupaten' order by nama_kecamatan");
	echo "<option>Pilih Kecamatan</option>";
	while($k = mysql_fetch_array($kecamatan)){
		echo "<option value=\"".$k['id_kecamatan']."\">".$k['nama_kecamatan']."</option>\n";
	}
?>