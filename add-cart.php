<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	include 'adminpage/koneksi.php';
	
	if(isset($_SESSION['username'])){
		$idl=$_SESSION['idl'];
		$idw = $_POST['warna'];
		$iddm = $_POST['iddm'];
		$sel = mysql_query("select tb_harga.id_harga from tb_harga where id_det_motor = $iddm");
		while($bar=mysql_fetch_array($sel)){
			$idh=$bar['id_harga'];
			$btn='btn'.$idh;
			if(isset($_POST[$btn])){
				$sql1=mysql_query("select * from tb_cart where id_login=$idl AND id_harga=$idh AND id_warna=$idw");
				$bar1=mysql_fetch_array($sql1);
				if(!empty ($bar1)){
					$sql=mysql_query("update tb_cart set jumlah = $bar1[jumlah] + 1 where id_harga=$idh AND id_warna=$idw");
				}else{
						$sql = mysql_query("
					INSERT INTO tb_cart VALUES (
						'',
						$idl,
						$idh,
						$idw,
						1,
						now()
					)	
					") or die(mysql_error());
				}
				
			}
		}
		
		/*for($i=0;$i<count($_POST['submit']);$i++){
			if(isset($_POST['submit'][$i])){

			}
		}*/
		
		
	/*
	$cariid=mysql_query("select id_login from tb_login where email='$_SESSION[member]'");
	$barisid=mysql_fetch_array($cariid);
	
	$cariharga=mysql_query("select harga from tb_barang where id_barang=$_GET[id];");
	$baris=mysql_fetch_array($cariharga);*/
	header('Location:cart.php');
	}else{
		header('Location:index.php');
	}
?>