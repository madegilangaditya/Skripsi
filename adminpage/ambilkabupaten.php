<?php
	include "koneksi.php";
	$provinsi = $_GET['provinsi'];
	$kabupaten = mysql_query("SELECT id_kabupaten,nama_kabupaten FROM tb_kabupaten WHERE id_provinsi='$provinsi' order by nama_kabupaten");
	echo "<option>Pilih Kabupaten</option>";
	while($k = mysql_fetch_array($kabupaten)){
		echo "<option value=\"".$k['id_kabupaten']."\">".$k['nama_kabupaten']."</option>\n";
	}
?>
