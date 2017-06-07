<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['nama'];
			$type=$_POST ['type'];
			$merk=$_POST ['merk'];
			$desc=$_POST ['deskripsi'];
			$spek=$_POST ['spesifikasi'];
				
				
	$hasil = mysql_query("
			INSERT INTO tb_motor
			(id_merk,id_type,nama_motor,deskripsi,spesifikasi)
			VALUES
			('$merk','$type','$nama','$desc','$spek')
		") or die(mysql_error());
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-produk');	
?>