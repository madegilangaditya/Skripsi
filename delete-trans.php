<?php
	include "adminpage/koneksi.php";
	if (isset($_POST["recordToDelete"])&& strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"])) {
		# code...
		$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT);
		$delete = mysql_query("DELETE FROM tb_det_transaksi WHERE id_transaksi=".$idToDelete);
		$delete1 = mysql_query("DELETE FROM tb_transaksi WHERE id_transaksi=".$idToDelete);
	}
?>