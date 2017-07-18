<?php
	include "koneksi.php";
	$idk = $_POST['idk'];
	if (isset($_POST['aprove'])) {
		$upd = mysql_query("update tb_kredit set status = 3 where id_kredit='$idk'");
		//$ins = mysql
	}else if (isset($_POST['reject'])) {
		$upd = mysql_query("update tb_kredit set status = 4 where id_kredit='$idk'");
	}
	header("Location:admin.php");
?>