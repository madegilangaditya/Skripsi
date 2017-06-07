<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
		//echo "".$_GET[id];
		$hasil = mysql_query("DELETE FROM tb_harga WHERE id_harga='$_GET[id]'");
		header('Location:admin.php?page=data-harga');

?>