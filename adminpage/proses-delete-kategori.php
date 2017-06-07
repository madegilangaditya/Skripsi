<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
		
		$hasil = mysql_query("DELETE FROM tb_merk WHERE id_merk='$_GET[id]'");
		header('Location:admin.php?page=data-kategori');

?>