<?php
	session_start();
	$idd=$_SESSION['idd'];
	include("koneksi.php");
	$bln = $_GET['bln'];
	$thn = $_GET['thn'];
	$result= mysql_query("select tgl_pengajuan from tb_kredit WHERE MONTH(tgl_pengajuan)='$bln' and YEAR(tgl_pengajuan)='$thn'");
	if ($idd==0) {
		# code...
		$results = mysql_query("SELECT tb_transaksi.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_det_transaksi.* FROM tb_transaksi 
		inner join tb_pelanggan on tb_transaksi.id_pelanggan = tb_pelanggan.id_pelanggan
		inner join tb_det_transaksi on tb_det_transaksi.id_transaksi = tb_transaksi.id_transaksi
		inner join tb_harga on tb_det_transaksi.id_harga = tb_harga.id_harga
		inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
		inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
		WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn'");
	}else{
		$results = mysql_query("SELECT tb_transaksi.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_det_transaksi.* FROM tb_transaksi 
					inner join tb_pelanggan on tb_transaksi.id_pelanggan = tb_pelanggan.id_pelanggan
					inner join tb_det_transaksi on tb_det_transaksi.id_transaksi = tb_transaksi.id_transaksi
					inner join tb_harga on tb_det_transaksi.id_harga = tb_harga.id_harga
					inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
					inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
					WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn' AND tb_harga.id_dealer='$idd'");		
	}
	$br=mysql_fetch_assoc($result);
	$mon = date("F Y", strtotime($br['tgl_pengajuan']));
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laporan Penjualan Cash</title>
		<?php
			include "head.php";
		?>
	</head>
	<body onLoad="window.print()">
		<h2>Laporan Penjualan Cash</h2>
		<div class='table' style="margin-top: 2em;">
			<span>Periode <?php echo "$mon"; ?> </span>
			<table class="table table-bordered"'>
				<thead>
					<tr>
						<th>No</th>
						<!--th>Gambar</th-->
						<th>Detail Transaksi</th>
						<th>Nama Pelanggan</th>
						<th>Nama Barang</th>
						<th>Harga Motor</th>
						<th>Dealer</th>
						
						
					</tr>
				</thead>
				
				<?php 
				
					$no = 1;
					while($bar=mysql_fetch_array($results)) { 
						$tgl = date("d F Y H:i:s", strtotime($bar['tgl_transaksi']));
						$hrg=number_format($bar['harga_cash'], 0, ".", ".");
				?>
				<tbody>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td>
							<div>No.Transaksi:
								<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_transaksi]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_transaksi]; ?></a>
								<br>No. Detail: <?php echo "$bar[id_det_transaksi]"; ?>

							</div><?php echo $tgl; ?>
						</td>
						<td><?php echo "$bar[nama_pelanggan]"; ?></td>
						<td><?php echo "$bar[nama_det_motor]"; ?></td>
						<td><?php echo $hrg; ?></td>
						<td><?php echo "$bar[nama_dealer]"; ?></td>
					</tr>
				</tbody>
				<?php $no++;} ?>
			</table>
			<!-- <?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?> --></td>
		</div>	
	</body>
</html>