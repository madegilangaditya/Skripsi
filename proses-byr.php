<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "adminpage/koneksi.php";

	$id = $_POST['idt'];

	$byr_f = "images/struk";
	$byr_tmp =$_FILES["byr"]["tmp_name"];
	$byr_n = $byr_f."/".$_FILES["byr"]["name"];
	move_uploaded_file($byr_tmp, $byr_n);

	$upd = mysql_query("insert into tb_bayar (id_kredit,gmb_struk) values ('$id', '$byr_n')");
	header('Location:kredit-berjalanan.php');
?>