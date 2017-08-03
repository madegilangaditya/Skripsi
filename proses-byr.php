<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "adminpage/koneksi.php";

	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");
	$id = $_POST['idt'];
	$st = $_POST['st'];
	$sel=mysql_query("select id_angsuran from tb_det_angsuran where id_det_angsuran='$id'");
	$br=mysql_fetch_array($sel);
	$ida = $br['id_angsuran'];

	$byr_f = "images/struk";
	$byr_tmp =$_FILES["byr"]["tmp_name"];
	$byr_n = $byr_f."/".$_FILES["byr"]["name"];
	move_uploaded_file($byr_tmp, $byr_n);

	if ($st==1) {
		# code...
		$upd = mysql_query("insert into tb_bayar (id,gmb_struk, jenis) values ('$id', '$byr_n', 1)");
		$upt = mysql_query("update tb_det_angsuran set status=3, tgl_pembayaran='$tanggal' where id_det_angsuran='$id'");
		header("Location:pembayaran.php?id=$ida");
	}else{

		$upd = mysql_query("insert into tb_bayar (id,gmb_struk,jenis) values ('$id', '$byr_n',2)");
		$upt= mysql_query("update tb_kredit set sts_umuka=2 where id_kredit='$id'");
		header('Location:kredit-berjalanan.php');
	}
	
?>