<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
		
		$hasil = mysql_query("DELETE FROM tb_login WHERE id_login='$_GET[id]'");
	
		header('Location:admin.php?page=data-admin');

		

?>