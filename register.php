<?php
error_reporting(E_ERROR|E_PARSE);
include "adminpage/koneksi.php";
$nama=$_POST['nama'];
$ktp=$_POST['ktp'];
$kelamin=$_POST['kelamin'];
$alamat = $_POST['alamat'];
$telp=$_POST['telp'];
$kec=$_POST['kecamatan'];
//$idl = $_SESSION['idl'];
$uname=$_POST['user_name'];
$email=$_POST['user_email'];
$pwd=$_POST['password'];
$cpwd=$_POST['cpassword'];

$sql = mysql_query("select * from tb_login where username='$uname'");
 

if (mysql_num_rows($sql) == 0){
    $sql1 = mysql_query("insert into tb_login (username, password, otoritas) value ('$uname','$pwd', 1)");
    $sel= mysql_query("select * from tb_login where id_login= (select MAX(id_login) from tb_login) AND otoritas=1 ");

    $b = mysql_fetch_array($sel);
    $c = $b['id_login'];
    
    //echo "tes ".$c;
    $sql1= mysql_query("insert into tb_pelanggan (No_KTP, nama_pelanggan, alamat, id_kecamatan, jenis_kelamin, telp, email, id_login) value ('$ktp', '$nama', '$alamat', '$kec', '$kelamin', '$telp', '$email', '$c')") or die(mysql_error());
 
	echo "<script >alert('daftar berhasil')</script>";
} else
            {
	echo "<script>alert('user sudah ada')</script>";
            }
?>