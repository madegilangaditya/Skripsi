<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['nama'];
			
	$hasil = mysql_query("
			INSERT INTO tb_type
			(nama_type)
			VALUES
			('$nama')
		") or die(mysql_error());
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-type');	
?>