<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";

	$id = $_GET['id'];
	$upd = mysql_query("update tb_kredit set status=7 where id_kredit='$id'");
	header('Location:admin.php');
?>