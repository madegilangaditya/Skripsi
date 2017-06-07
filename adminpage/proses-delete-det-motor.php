<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$sql = mysql_query("select id_det_motor from tb_warna where id_warna='$_GET[id]'");
	$bar = mysql_fetch_array($sql);
	$idw = $bar['id_det_motor'];
	$sel = mysql_query("select * from tb_warna where id_det_motor=$idw");
	if(mysql_num_rows($sel)==1){

		$hasil = mysql_query("DELETE tb_warna, tb_det_motor FROM tb_warna inner join tb_det_motor on tb_warna.id_det_motor = tb_det_motor.id_det_motor WHERE tb_warna.id_warna='$_GET[id]'");
	}else{
		$hasil = mysql_query("delete from tb_warna where id_warna = '$_GET[id]'");
	}
		
		header('Location:admin.php?page=detail-motor');

?>