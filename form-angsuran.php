<?php
	session_start();
	include "adminpage/koneksi.php";
	$idw = $_POST['warna'];
	$idh = $_SESSION['hrg'];
	$_SESSION['warna']=$idw;
	$umuka = $_POST['umuka'];
	$_SESSION['umuka']=$umuka;
	$sel = mysql_query("SELECT tb_bunga.id_bunga FROM tb_bunga");
	while ($bar=mysql_fetch_array($sel)){
		//$namaf = $bar['nama_finance'];
		$idb=$bar['id_bunga'];
		$btn='btn'.$idb;
		
		if(isset($_POST[$btn])){
			$ang = $_POST[$idb];
			$_SESSION['ang']=$ang;
			$_SESSION['idb']=$idb;
			echo "tes $_SESSION[hrg], $_SESSION[idb], $_SESSION[ang], $_SESSION[umuka], ";
				/*$sql1=mysql_query("select * from tb_cart where id_login=$idl AND id_harga=$idh AND id_warna=$idw");
				$bar1=mysql_fetch_array($sql1);
				if(!empty ($bar1)){
					$sql=mysql_query("update tb_cart set jumlah = $bar1[jumlah] + 1 where id_harga=$idh AND id_warna=$idw");
				}else{
						$sql = mysql_query("
					INSERT INTO tb_cart VALUES (
						'',
						$idl,
						$idh,
						$idw,
						1,
						now()
					)	
					") or die(mysql_error());
				}*/
				
			}
	}
	//$ang = $_POST['angsuran'];
	//echo "$id $ang";
	echo $_SESSION['warna'];
?>