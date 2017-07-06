<?php
session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
include "koneksi.php";
$idf = $_POST['id'];
$butap = $_POST['butap'];
$burun = $_POST['burun'];
$biaya = $_POST['biaya'];
//$bulan = $_POST['bulan'];
/*for ($i=0; $i < count($bulan) ; $i++) { 
	
}*/
	$sel = mysql_query("select id_bunga, jangka_waktu from tb_bunga where id_finance='$idf'");
	$br = mysql_fetch_array($sel);
	$idb = $br['id_bunga'];
	if (mysql_num_rows($sel)==0) {
		$hasil = mysql_query("insert into tb_bunga (id_finance, bunga_tetap, bunga_menurun, biaya_tambahan) values ('$idf','$butap','$burun', '$biaya')");
	}else{
		$hasil = mysql_query("update tb_bunga set id_finance='$idf', bunga_tetap='$butap', bunga_menurun='$burun', biaya_tambahan='$biaya' where id_bunga='$idb'");
	}
	
	header('location: admin.php?page=suku-bunga');
?>