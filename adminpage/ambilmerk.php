<?php
	include "koneksi.php";
	
	$merk = $_GET['merk'];
	if (isset($_GET['type'])) {
		$jenis = $_GET['type'];
		$motor = mysql_query("SELECT id_motor,nama_motor FROM tb_motor WHERE id_type='$jenis' AND id_merk='$merk' order by nama_motor");
		echo "<option>Pilih Motor</option>";
		while($k = mysql_fetch_array($motor)){
			echo "<option value=\"".$k['id_motor']."\">".$k['nama_motor']."</option>\n";
		}
	}else{
		$motor = mysql_query("SELECT id_motor,nama_motor FROM tb_motor WHERE id_merk='$merk' order by nama_motor");
		echo "<option>Pilih Motor</option>";
		while($k = mysql_fetch_array($motor)){
			echo "<option value=\"".$k['id_motor']."\">".$k['nama_motor']."</option>\n";
		}
	}
	
?>
