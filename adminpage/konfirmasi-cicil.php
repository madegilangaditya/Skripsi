<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";

	date_default_timezone_set('Asia/Makassar');
	
	

	$id = $_POST['idt'];
	$sel=mysql_query("SELECT tb_det_angsuran.*, tb_angsuran.jenis, tb_kredit.angsuran_pokok, tb_kredit.id_kredit, tb_jawu.`jangka_waktu`, tb_bunga.bunga_menurun FROM tb_det_angsuran 
		INNER JOIN tb_angsuran ON tb_det_angsuran.id_angsuran=tb_angsuran.id_angsuran 
		INNER JOIN tb_survey ON tb_survey.`id_survey`=tb_angsuran.`id_survey`
		INNER JOIN tb_kredit ON tb_kredit.`id_kredit`=tb_survey.`id_kredit`
		INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu` 
		INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga` 
		WHERE id_det_angsuran='$id'");

	$bar=mysql_fetch_array($sel);
	$ida=$bar['id_angsuran'];
	$idk=$bar['id_kredit'];
	$tanggal=$bar['tgl_jatuh_tempo'];
	$jns=$bar['jenis'];
	$jawu = $bar['jangka_waktu'];
	$angpok = $bar['angsuran_pokok'];
	$sistot = $bar['sisa_pokok'];
	$ang=$bar['angsuran'];
	$burun=$bar['bunga_menurun'];

	$date=date_create("$tanggal");
	$dt=date_add($date,date_interval_create_from_date_string("1 Month"));
	$tgll= date_format($dt,"Y-m-d H:i:s");

	$ang_tmp=round($angpok/$jawu);
	$bg_tmp=$ang-$ang_tmp;
	//echo "tes $ang_tmp, $bg_tmp";

	$sl=mysql_query("select id_angsuran as jml from tb_det_angsuran where id_angsuran='$ida'");
	$jml=mysql_num_rows($sl);
	if ($jml<$jawu) {
		if ($jns==1) {
			# code...
			$tot=$sistot-$ang_tmp;
			$ins = mysql_query("insert into tb_det_angsuran (id_angsuran, angsuran, tgl_jatuh_tempo, denda, status, sisa_pokok) value ('$ida','$bar[angsuran]', '$tgll', 0, 2, '$tot')");
		}else if ($jns==2) {
			# code...
			//$angtot=$ag+$ang_tmp;
			$tot=$sistot-$ang_tmp;
			$ag = round($tot*$burun/100);
			$angtot = $ag+$ang_tmp;
			$ins = mysql_query("insert into tb_det_angsuran (id_angsuran, angsuran, tgl_jatuh_tempo, denda, status, sisa_pokok) value ('$ida','$angtot', '$tgll', 0, 2, '$tot')");
			//echo "tes $tot, $ag, $angtot";
		}

	}else if ($jml==$jawu) {
		# code...
		$upt = mysql_query("update tb_kredit set status=5 where id_kredit='$idk'");
	}
	$upd = mysql_query("update tb_det_angsuran set status=1 where id_det_angsuran='$id'");
	
	// echo "tes $jml";
	
	
	header("Location:admin.php");
?>