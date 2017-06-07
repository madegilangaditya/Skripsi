<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['nama'];
			$kec=$_POST ['kecamatan'];
			$alamat=$_POST ['alamat'];
			$telp=$_POST ['telp'];
			$uname=$_POST ['uname'];
			$pwd=$_POST ['pass'];
			$cpwd=$_POST ['cpass'];
			
			$hasil = mysql_query("INSERT INTO tb_login (username, password, otoritas) VALUES ('$uname','$pwd', 3)") or die(mysql_error());
			$sel = mysql_query("select id_login from tb_login where username='$uname'");
			$baris= mysql_fetch_array($sel);
			$idl=$baris['id_login'];
			$hasil2 = mysql_query("INSERT INTO tb_dealer (id_kecamatan, nama_dealer, alamat, telp, id_login) 
			VALUES ('$kec','$nama', '$alamat', '$telp', '$idl')") or die(mysql_error());
		
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=data-dealer');	

			
?>