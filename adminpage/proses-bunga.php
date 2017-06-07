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
$bulan = $_POST['bulan'];
for ($i=0; $i < count($bulan) ; $i++) { 
	$sel = mysql_query("select id_bunga, jangka_waktu from tb_bunga where id_finance='$idf' and jangka_waktu='$bulan[$i]'");
	$br = mysql_fetch_array($sel);
	$idb = $br['id_bunga'];
	if (mysql_num_rows($sel)==0) {
		$hasil = mysql_query("insert into tb_bunga (id_finance, bunga_tetap, bunga_menurun, biaya_tambahan, jangka_waktu) values ('$idf','$butap','$burun', '$biaya', '$bulan[$i]')");
	}else{
		$delete = mysql_query("delete from tb_bunga where id_bunga='$idb'");
		$hasil = mysql_query("insert into tb_bunga (id_finance, bunga_tetap, bunga_menurun, biaya_tambahan, jangka_waktu) values ('$idf','$butap','$burun', '$biaya', '$bulan[$i]')");
	}
	
	header('location: admin.php?page=suku-bunga');
}
?>