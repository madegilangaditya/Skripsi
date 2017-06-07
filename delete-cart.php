<?php
include "adminpage/koneksi.php";
		
		$hasil = mysql_query("DELETE FROM tb_cart WHERE id_cart='$_GET[id]'");
		header('Location:cart.php');
?>