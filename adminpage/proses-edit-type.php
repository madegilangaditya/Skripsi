<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$id=$_GET['id'];
	$nama = $_POST['nama'];
	
	
	
	
	
	
		
		$hasil = mysql_query ("update tb_type set nama_type='$nama' where id_type='$id' ");
	
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php?page=data-type');	
	
?>