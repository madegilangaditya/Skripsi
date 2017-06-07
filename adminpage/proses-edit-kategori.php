<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$id=$_GET['id'];
	$nama = $_POST['nama'];
	$gambar=$_POST['gambar'];
	
	if(!empty($_FILES["gambar"]["tmp_name"])){
				unlink($_POST['gambar']);
				$folder = "images/barang/merk";
				$tmp_name = $_FILES["gambar"]["tmp_name"];
				$name = $folder."/".$_FILES["gambar"]["name"];					
				move_uploaded_file($tmp_name, $name);
			}
	
	
	if(!empty($name)){
		$hasil = mysql_query ("update tb_merk set nama_merk='$nama', gambar='$name' where id_merk='$id' ");
	}else{
		$hasil = mysql_query ("update tb_merk set nama_merk='$nama' where id_merk='$id' ");
	}
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php?page=data-kategori');	
	
?>