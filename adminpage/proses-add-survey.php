<?php
	session_start();
	include "koneksi.php";
	$idk = $_POST['idk'];
	$namap = $_POST['nama-P'];
	$pend = $_POST['pddk'];
	$kelaminp = $_POST['kelamin-P'];
	$ktpp = $_POST['ktp-P'];
	$telpp = $_POST['telp-P'];
	$umur = $_POST['umur'];
	$kecp = $_POST['kecamatan-P'];
	$alamatp = $_POST['alamat-P'];

	$namape = $_POST['nama-pe'];
	$hub = $_POST['hub-pen'];
	$ktppe = $_POST['ktp-pe'];
	$telppe = $_POST['telp-pe'];
	$kecpe = $_POST['kecamatan-pe'];
	$kelaminpe = $_POST['kelamin-pe'];
	$alamatpe = $_POST['alamat-pe'];

	$jns_krj=$_POST['jns-krj'];
	$prshan = $_POST['perusahaan'];
	$jbtn = $_POST['jbtn'];
	$gaji = $_POST['gaji'];
	$tnjgn = $_POST['tunjangan'];
	$lkerja = $_POST['lkerja'];

	$nusaha = $_POST['nusaha'];
	$jusaha = $_POST['j-usaha'];
	$untung = $_POST['untung'];
	$karyawan = $_POST['karyawan'];

	$jrmh = $_POST['jns-rmh'];
	$p_rmh = $_POST['pbangunan'];
	$l_rmh = $_POST['lbangunan'];
	$sewa = $_POST['sewa-rmh'];
	$tinggal = $_POST['tinggal'];
	$bia_rt = $_POST['bia-rt'];
	$tanggungan = $_POST['j-tng'];
	$bia_pln = $_POST['bia-pln'];
	$bia_pdam = $_POST['bia-pdam'];

	$pln_f = "../images/pln";
	$pajak_f = "../images/pajak"; 
	$gaji_f = "../images/gaji";
	$pemohon_f = "../images/ktp/suami";
	$penjamin_f = "../images/ktp/istri";
	$pdam_f = "../images/pdam";

	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	$pemohon_tmp =$_FILES["fktp-P"]["tmp_name"];
	$pemohon_n = $pemohon_f."/".$_FILES["fktp-P"]["name"];
	move_uploaded_file($pemohon_tmp, $pemohon_n);

	$penjamin_tmp =$_FILES["fktp-pe"]["tmp_name"];
	$penjamin_n = $penjamin_f."/".$_FILES["fktp-pe"]["name"];
	move_uploaded_file($penjamin_tmp, $penjamin_n);

	$pln_tmp =$_FILES["fpln"]["tmp_name"];
	$pln_n = $pln_f."/".$_FILES["fpln"]["name"];
	move_uploaded_file($pln_tmp, $pln_n);

	$pdam_tmp =$_FILES["fpdam"]["tmp_name"];
	$pdam_n = $pdam_f."/".$_FILES["fpdam"]["name"];
	move_uploaded_file($pdam_tmp, $pdam_n);
	
	$ins = mysql_query("insert into tb_survey(id_kredit, nama_penjamin, hubungan_penjamin, no_ktp, telepon, jk_pe, id_kec_pe, alamat, gmb_ktp, j_rmh, p_rmh, l_rmh, sw_rmh, l_tinggal, b_rumah, tanggungan, b_listrik, b_pdam, gmb_pln, gmb_pdam, tgl_survey, umur_p) values ('$idk', '$namape', '$hub', '$ktppe', '$telppe', '$kelaminpe', '$kecpe', '$alamatpe', '$penjamin_n', '$jrmh','$p_rmh','$l_rmh','$sewa','$tinggal','$bia_rt','$tanggungan', '$bia_pln','$bia_pdam','$pln_n', '$pdam_n', '$tanggal', '$umur')");

	$upd = mysql_query("update tb_kredit set gmb_suami='$pemohon_n', status=2 where id_kredit='$idk'");

	$sel = mysql_query("SELECT MAX(id_survey) AS ids FROM tb_survey");
	$br=mysql_fetch_assoc($sel);

	if ($jns_krj==2) {
		# code...
		$gaji_tmp =$_FILES["fpenghasilan"]["tmp_name"];
		$gaji_n = $gaji_f."/".$_FILES["fpenghasilan"]["name"];
		move_uploaded_file($gaji_tmp, $gaji_n);

		$pajak_tmp =$_FILES["fpajak"]["tmp_name"];
		$pajak_n = $pajak_f."/".$_FILES["fpajak"]["name"];
		move_uploaded_file($pajak_tmp, $pajak_n);
		$inst=mysql_query("insert into tb_krj_wiraswasta(id_survey, nama_usaha, jenis_usaha, untung, karyawan, gmb_SPT, gmb_rek) values('$br[ids]', '$nusaha', '$jusaha', '$untung', '$karyawan','$pajak_n', '$gaji_n')");
	}else  {
		$gaji_tmp =$_FILES["fgaji"]["tmp_name"];
		$gaji_n = $gaji_f."/".$_FILES["fgaji"]["name"];
		move_uploaded_file($gaji_tmp, $gaji_n);

		$inst=mysql_query("insert into tb_krj_karyawan(id_survey, jns_karyawan, nama_perusahaan, jabatan, gaji_pokok, tunjangan, lama_bekerja, gmb_gaji) values('$br[ids]', '$jns_krj', '$prshan', '$jbtn', '$gaji','$tnjgn', '$lkerja', '$gaji_n')");
	}

	header('Location:admin.php');
?>