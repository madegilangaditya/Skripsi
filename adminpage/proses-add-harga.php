<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	
			$idd=$_POST['id'];
			$nama=$_POST ['detmotor'];
			$harga=$_POST ['hrg'];
			$stok=$_POST ['stok'];
			$srv = $_POST['srv'];
			$bpkb = $_POST['bpkb'];
			$helm = $_POST['helm'];

	$hasil = mysql_query("INSERT INTO tb_harga (id_det_motor,id_dealer,harga_cash,stok) VALUES ('$nama','$idd','$harga','$stok') ") or die(mysql_error());
	$sel =mysql_query("select max(id_harga) from tb_harga where id_dealer='$idd'");
	$bar =  mysql_fetch_array($sel);
	$idh = $bar['max(id_harga)'];
	$hasil1 = mysql_query("INSERT INTO tb_fasilitas (id_harga,servis,helm,bpkb) VALUES ('$idh','$srv','$helm','$bpkb') ") or die(mysql_error());
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-harga');	
?>