<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
		$sel = mysql_query("select id_login from tb_dealer where id_dealer='$_GET[id]'");
		$bar = mysql_fetch_array($sel);

		$hasil = mysql_query("DELETE tb_dealer, tb_login FROM tb_dealer INNER JOIN tb_login ON tb_login.id_login = tb_dealer.id_login WHERE tb_dealer.id_login = '$bar[id_login]'");
	
		header('Location:admin.php?page=data-dealer');

		

?>