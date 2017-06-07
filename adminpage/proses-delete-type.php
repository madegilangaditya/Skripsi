<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
		
		$hasil = mysql_query("DELETE FROM tb_type WHERE id_type='$_GET[id]'");
		header('Location:admin.php?page=data-type');

?>