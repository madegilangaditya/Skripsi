<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$id=$_POST['id'];
	$nama=$_POST ['nama'];
	$type=$_POST ['type'];
	$merk=$_POST ['merk'];
	$desc=$_POST ['deskripsi'];
	$spek=$_POST ['spesifikasi'];
	$gambar=$_POST ['gambar'];
	
	
	if(!empty($_FILES["gambar"]["tmp_name"])){
				unlink($_POST['gambar']);
				$folder = "images/barang/motor";
				$tmp_name = $_FILES["gambar"]["tmp_name"];
				$name = $folder."/".$_FILES["gambar"]["name"];					
				move_uploaded_file($tmp_name, $name);
			}
	
	
	if(!empty($name)){
		$hasil = mysql_query ("update tb_motor set id_merk='$merk', id_type='$type', nama_motor='$nama',
			deskripsi='$desc', spesifikasi='$spek', gambar='$name' where id_motor=$id ");
	}else{
		$hasil = mysql_query ("update tb_motor set id_merk='$merk', id_type='$type', nama_motor='$nama',
			deskripsi='$desc', spesifikasi='$spek' where id_motor=$id ");
	}
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php?page=data-produk');	
	
?>