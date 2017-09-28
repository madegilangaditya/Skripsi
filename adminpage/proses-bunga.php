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
$jns_asu = $_POST['jns_asu'];
$b_tarik = $_POST['b_tarik'];
//$bulan = $_POST['bulan'];
/*for ($i=0; $i < count($bulan) ; $i++) { 
	
}*/
	$sel = mysql_query("select id_bunga from tb_bunga where id_finance='$idf'");
	$br = mysql_fetch_array($sel);
	$idb = $br['id_bunga'];
	if (mysql_num_rows($sel)==0) {
		$hasil = mysql_query("insert into tb_bunga (id_finance, bunga_tetap, bunga_menurun, biaya_tambahan, jenis_asuransi, batas_penarikan) values ('$idf','$butap','$burun', '$biaya', '$jns_asu','$b_tarik')");
	}else{
		$hasil = mysql_query("update tb_bunga set id_finance='$idf', bunga_tetap='$butap', bunga_menurun='$burun', biaya_tambahan='$biaya', jenis_asuransi='$jns_asu', batas_penarikan='$b_tarik' where id_bunga='$idb'");
	}
	
	header('location: admin.php?page=suku-bunga');
?>