<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['nama'];
			$kab=$_POST ['kabupaten'];
			$uname=$_POST ['uname'];
			$pwd=$_POST ['pass'];
			$cpwd=$_POST ['cpass'];
			$idf=$_SESSION['finance'];
			
			$hasil = mysql_query("INSERT INTO tb_login (username, password, otoritas) VALUES ('$uname','$pwd', 5)") or die(mysql_error());
			$sel = mysql_query("select id_login from tb_login where username='$uname'");
			$baris= mysql_fetch_array($sel);
			$idl=$baris['id_login'];
			$hasil2 = mysql_query("INSERT INTO tb_surveyor (id_finance, id_login, id_kabupaten, nama_surveyor) 
			VALUES ('$idf','$idl', '$kab', '$nama')") or die(mysql_error());
		
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-surveyor');	

			
?>