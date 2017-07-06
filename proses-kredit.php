<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	$nama=$_POST['nama'];
	$ktp=$_POST['ktp'];
	$kelamin=$_POST['kelamin'];
	$alamat = $_POST['alamat'];
	$telp=$_POST['telp'];
	$kec=$_POST['kecamatan'];
	$idl = $_SESSION['idl'];
	$angtot = $_SESSION['angtot'];
	$idb=$_SESSION['idb'];
	$idh = $_SESSION['hrg'];
	$ang = $_SESSION['ang'];
	$umuka = $_SESSION['umuka'];
	$jns = $_POST['jns'];
	$wrn = $_SESSION['warna'];

	$gajip = $_POST['gajip'];
	$plnp = $_POST['plnp'];

	$gaji_f = "images/gaji";
	$pln_f = "images/pln";
	$suami_f = "images/ktp/suami";
	$istri_f = "images/ktp/istri";
	$kk_f = "images/kk";
	$sim_f = "images/sim";

	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	$se=mysql_query("select * from tb_pelanggan where No_KTP='$ktp' AND nama_pelanggan='$nama' AND alamat='$alamat' AND id_kecamatan='$kec' AND jenis_kelamin='$kelamin' AND telp='$telp' AND id_login='$idl'") or die(mysql_error());

	if (mysql_num_rows($se)==0){
		$sql = mysql_query("insert into tb_pelanggan (No_KTP, nama_pelanggan, alamat, id_kecamatan, jenis_kelamin, telp, id_login) value ('$ktp', '$nama', '$alamat', '$kec', '$kelamin', '$telp', '$idl')") or die(mysql_error());
		$sel= mysql_query("select * from tb_pelanggan where id_login=$idl AND id_pelanggan= (select MAX(id_pelanggan) from tb_pelanggan)");
		$bar = mysql_fetch_array($sel);
		$idp=$bar['id_pelanggan'];
	}else{
		$sel= mysql_query("SELECT MIN(id_pelanggan)AS id FROM tb_pelanggan WHERE id_login='$idl' ");
		$bar = mysql_fetch_array($sel);
		$idp=$bar['id'];
	}
		//echo "$kec";
		$kb = mysql_query("select id_kabupaten from tb_kecamatan where id_kecamatan='$kec'");
		$bk = mysql_fetch_assoc($kb);
		$idkb = $bk['id_kabupaten'];
		$id_suv_arr = array();

			$total_suv = mysql_query("SELECT tb_surveyor.id_surveyor, COUNT(tb_surveyor.id_surveyor) AS total FROM tb_surveyor 
				INNER JOIN tb_kredit 
				ON tb_surveyor.`id_surveyor` = tb_kredit.`id_surveyor`
				WHERE id_kabupaten=4 GROUP BY tb_kredit.`id_surveyor` ORDER BY total LIMIT 1;");
			while ($tot_suv_row=mysql_fetch_array($total_suv)) {
				$tot_suv_id = $tot_suv_row["id_surveyor"];
				//echo $tot_suv_id;
			}

		/*$svk = mysql_query("select id_surveyor from tb_surveyor where id_kabupaten='$idkb'");
		while ($bsv=mysql_fetch_array($svk)) {
			array_push($id_suv_arr, $bsv['id_surveyor']);
			//echo " <br>tes $bsv[id_surveyor]";
			$sl = mysql_query("SELECT count(id_surveyor) as srv FROM tb_kredit WHERE id_surveyor = '$bsv[id_surveyor]' ");
			$id_fi_sl_arr = array();
			
			while ($c = mysql_fetch_array($sl)) {
				array_push($id_fi_sl_arr, $c['srv']);
				//echo "<br>tes ".$c['srv'];
			
				//echo "$x";
			}
			$x=0;
			for ($i=0; $i < count($id_suv_arr); $i++) { 
				echo "<br>".$id_fi_sl_arr[$x];	# code...
					$x++;
			}

		}
		$a = max($id_fi_sl_arr);*/
		//echo $a;

 	$gaji_tmp =$_FILES["gaji"]["tmp_name"];
	$gaji_n = $gaji_f."/".$_FILES["gaji"]["name"];
	move_uploaded_file($gaji_tmp, $gaji_n);

	$pln_tmp =$_FILES["pln"]["tmp_name"];
	$pln_n = $pln_f."/".$_FILES["pln"]["name"];
	move_uploaded_file($pln_tmp, $pln_n);

	$suami_tmp =$_FILES["suami"]["tmp_name"];
	$suami_n = $suami_f."/".$_FILES["suami"]["name"];
	move_uploaded_file($suami_tmp, $suami_n);

	$istri_tmp =$_FILES["istri"]["tmp_name"];
	$istri_n = $istri_f."/".$_FILES["istri"]["name"];
	move_uploaded_file($istri_tmp, $istri_n);
	
	$kk_tmp =$_FILES["kk"]["tmp_name"];
	$kk_n = $kk_f."/".$_FILES["kk"]["name"];
	move_uploaded_file($kk_tmp, $kk_n);

	$sim_tmp =$_FILES["sim"]["tmp_name"];
	$sim_n = $sim_f."/".$_FILES["sim"]["name"];
	move_uploaded_file($sim_tmp, $sim_n);

	$ins=mysql_query("insert into tb_kredit (id_jawu, id_pelanggan, id_harga, id_warna, id_surveyor, jenis, angsuran, angsuran_pokok, uang_muka, gaji, gmb_gaji, pln, gmb_pln, gmb_suami, gmb_istri, gmb_kk, gmb_sim, tgl_pengajuan, status) values ('$idb','$idp','$idh','$wrn','$tot_suv_id', '$jns', '$ang', '$angtot','$umuka', '$gajip', '$gaji_n', '$plnp', '$pln_n', '$suami_n', '$istri_n', '$kk_n', '$sim_n', '$tanggal', 1 )");
	/*$sel= mysql_query("select * from tb_transaksi where id_pelanggan=$tes AND id_transaksi= (select MAX(id_transaksi) from tb_transaksi)");
	$row=mysql_fetch_array($sel);
	$idt=$row['id_transaksi'];

	$sel1=mysql_query("select id_harga,jumlah, id_warna from tb_cart where id_login=$idl");
	while($row1=mysql_fetch_array($sel1)){
			
				$query=mysql_query("
				insert into tb_det_transaksi(id_transaksi,id_harga,id_warna, jumlah) value('$idt','$row1[id_harga]','$row1[id_warna]','$row1[jumlah]')
				") or die(mysql_error());
				
				$query=mysql_query("update tb_harga set stok=stok-$row1[jumlah] where id_harga=$row1[id_harga]");
					
			}
				$query=mysql_query("delete from tb_cart where id_login=$idl");*/
				header('Location:detail-kredit.php');

?>