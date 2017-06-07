<?php
$host='localhost';
$userff='root';
$pass='';
$db='db_dealer';
// koneksi ke server mysql
$koneksi=mysql_connect($host,$userff,$pass) or die ("Koneksi gagal!");
// pemilihan database yang akan digunakan
if($koneksi){
mysql_select_db($db,$koneksi) or die (mysql_error());
}
?>