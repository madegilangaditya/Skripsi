<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$id=$_POST['id'];
	$nama = $_POST['nama'];
	$kec = $_POST['kecamatan'];
	$alamat = $_POST['alamat'];
	$tlp = $_POST['telp'];
	
	
	
	
	
	
		
		$hasil = mysql_query ("update tb_dealer set nama_dealer='$nama', id_kecamatan='$kec', alamat='$alamat', telp='$tlp' where id_dealer='$id' ");
	
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php');	
	
?>