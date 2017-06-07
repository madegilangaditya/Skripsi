<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$idl = $_SESSION['user'];
	$idd=$_POST['id'];
			$nama=$_POST ['detmotor'];
			$harga=$_POST ['hrg'];
			$stok=$_POST ['stok'];
			$srv = $_POST['srv'];
			$bpkb = $_POST['bpkb'];
			$helm = $_POST['helm'];
	
	
	
	
	
	
		
		$hasil = mysql_query ("update tb_harga set id_det_motor='$nama', harga_cash='$harga', stok='$stok' where id_harga='$idd' ");
		$hasil1 = mysql_query ("update tb_fasilitas set servis='$srv', bpkb='$bpkb', helm='$helm' where id_harga='$idd' ");
	
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php?page=data-harga');	
	
?>