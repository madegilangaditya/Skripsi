<?php
session_start();
error_reporting(E_ERROR|E_PARSE);
	include 'adminpage/koneksi.php';
	//1. Cek data login ke database
	$uname = $_POST['username'];
	$passwd = $_POST['password'];

	$hasil = mysql_query("
		SELECT * FROM tb_login
		WHERE username='$uname' AND password='$passwd'
	");
	$baris = mysql_fetch_array($hasil);
	$idl= $baris['id_login'];
	if ($baris['username'] == $uname AND $baris['password'] == $passwd) {
	
	 $_SESSION['username'] = $uname;
	 $_SESSION['idl'] = $idl;
	// $_SESSION['oto'] = $baris['otoritas'];
	/*$_SESSION['username'] = $username;
	if(mysql_num_rows($hasil)==1){
		//2. Jika ada, maka set session nya
		session_start();
		$baris = mysql_fetch_array($hasil);
		if($login['otoritas'] == 1)
		$_SESSION['islogin'] = $baris['username'];*/
		
		header('Location: index.php');
	}else{
		echo "<script>shakeModal();</script>";
	}

?>