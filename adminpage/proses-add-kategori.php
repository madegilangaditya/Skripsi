<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['nama'];
			$folder = "images/barang/merk";
			$tmp_name = $_FILES["gambar"]["tmp_name"];
			$name = $folder."/".$_FILES["gambar"]["name"];
			move_uploaded_file($tmp_name, $name);	
	$hasil = mysql_query("
			INSERT INTO tb_merk
			(nama_merk,gambar)
			VALUES
			('$nama','$name')
		") or die(mysql_error());
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-kategori');	
?>