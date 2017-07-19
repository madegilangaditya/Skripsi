<?php
	include "koneksi.php";
	$idk = $_POST['idk'];
	$ids = $_POST['ids'];
	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	if (isset($_POST['aprove'])) {
		$upd = mysql_query("update tb_kredit set status = 3 where id_kredit='$idk'");
		$ins = mysql_query("insert into tb_angsuran(id_survey, tgl_aprove) values ('$ids','$tanggal')");
	}else if (isset($_POST['reject'])) {
		$upd = mysql_query("update tb_kredit set status = 4 where id_kredit='$idk'");
	}
	header("Location:admin.php");
?>