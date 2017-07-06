<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "koneksi.php";
	$bln=$_GET['bulan'];
	$idb=$_GET['idb'];
	//echo "$bln, $idb";

	$ins = mysql_query("insert into tb_jawu (id_bunga, jangka_waktu) values ('$idb','$bln')");

	$sel = mysql_query("select * from tb_jawu where id_bunga='$idb' order by jangka_waktu ASC");
	while ($br=mysql_fetch_array($sel)) {
		# code...
		echo "
		<tr>
			<td>$br[jangka_waktu]</td>
			<td><a href='#'><i class='fa fa-trash fa-lg'></i></a></td>
		</tr>
		";
	}
?>