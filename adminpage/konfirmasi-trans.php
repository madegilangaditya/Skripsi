<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";

	$id = $_GET['id'];
	$upd = mysql_query("update tb_transaksi set status=3 where id_transaksi='$id'");
	header('Location:admin.php');
?>