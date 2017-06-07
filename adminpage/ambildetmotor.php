<?php
	include "koneksi.php";
	$motor = $_GET['motor'];
	
	$detmotor = mysql_query("SELECT id_det_motor,nama_det_motor FROM tb_det_motor WHERE id_motor='$motor' order by nama_det_motor");
	echo "<option>Pilih Detail</option>";
	while($k = mysql_fetch_array($detmotor)){
		echo "<option value=\"".$k['id_det_motor']."\">".$k['nama_det_motor']."</option>\n";
	}
?>
