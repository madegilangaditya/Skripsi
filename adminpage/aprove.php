<?php
	include "koneksi.php";
	$idk = $_POST['idk'];
	$ids = $_POST['ids'];
	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");
	$date=date_create("$tanggal");
	date_add($date,date_interval_create_from_date_string("1 Month"));
	$tgll= date_format($date,"Y-m-d 23:00:00");

	$sl = mysql_query("select angsuran from tb_kredit where id_kredit=$idk");
	$br=mysql_fetch_assoc($sl);
	$ang = $br['angsuran'];
	if (isset($_POST['aprove'])) {
		$upd = mysql_query("update tb_kredit set status = 6 where id_kredit='$idk'");
		$ins = mysql_query("insert into tb_angsuran(id_survey, tgl_aprove) values ('$ids','$tanggal')");
		$sel = mysql_query("SELECT MAX(id_angsuran) AS id_ang FROM tb_angsuran WHERE id_survey='$ids'");
		$bar=mysql_fetch_assoc($sel);
		$inst = mysql_query("insert into tb_det_angsuran(id_angsuran, angsuran, tgl_jatuh_tempo, denda, status) values ('$bar[id_ang]', '$ang', '$tgll', 0, 2)");
	}else if (isset($_POST['reject'])) {
		$upd = mysql_query("update tb_kredit set status = 4 where id_kredit='$idk'");
	}
	header("Location:admin.php");
?>
