<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	$id = $_GET['id'];
	$upd = mysql_query("update tb_bpkb set tgl_konfirmasi='$tanggal' where id_bpkb='$id'");
	header('Location:admin.php?page=data-bpkb');
?>