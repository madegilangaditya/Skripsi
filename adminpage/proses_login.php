<?php
session_start(); // memulai fungsi session	
	include 'koneksi.php';
	//1. Cek data login ke database
	$uname = $_POST['username'];
	$passwd = $_POST['password'];

	$hasil = mysql_query("
		SELECT * FROM tb_login
		WHERE username='$uname' AND password='$passwd'
	");
	$baris = mysql_fetch_array($hasil);
	if ($baris['username'] == $uname AND $baris['password'] == $passwd) {
	
	 $_SESSION['user'] = $uname;
	/*$_SESSION['username'] = $username;
	if(mysql_num_rows($hasil)==1){
		//2. Jika ada, maka set session nya
		session_start();
		$baris = mysql_fetch_array($hasil);
		if($login['otoritas'] == 1)
		$_SESSION['islogin'] = $baris['username'];*/
		
		header('Location: admin.php');
	}else{
		header('Location: login.php');
	}

?>