<?php
	error_reporting(E_ERROR|E_PARSE);
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$id=$_POST['id'];
	$idd=$_POST['idd'];
	$nama=$_POST ['nama'];
	$namad=$_POST ['namaD'];
	$warna=$_POST ['warna'];
	$gambar=$_POST['gambar'];
	
	
	if(!empty($_FILES["gambar"]["tmp_name"])){
				unlink($_POST['gambar']);
				$folder = "images/barang/detail";
				$tmp_name = $_FILES["gambar"]["tmp_name"];
				$name = $folder."/".$_FILES["gambar"]["name"];					
				move_uploaded_file($tmp_name, $name);
			}
	
	
	if(!empty($name)){
		$hasil = mysql_query ("update tb_warna set warna='$warna', gambar='$name' where id_warna=$id ");
		$sql = mysql_query("update tb_det_motor set id_motor='$nama', nama_det_motor='$namad' where id_det_motor=$idd");
	}else{
		$hasil = mysql_query ("update tb_warna set warna='$warna' where id_warna=$id ");
		$sql = mysql_query("update tb_det_motor set id_motor='$nama', nama_det_motor='$namad' where id_det_motor=$idd");
	}
		//echo "<script>alert('Edit Barang Berhasil'); location.href='daftar_barang.php'</script>";
		header('location: admin.php?page=detail-motor');	
	
?>