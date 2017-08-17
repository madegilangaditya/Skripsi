<?php
	session_start();
	$idf=$_SESSION['finance'];
	include("koneksi.php");
	$pg=$_SESSION['pg'];
	$bln = $_GET['bln'];
	$thn = $_GET['thn'];
	$srv=$_SESSION['srv'];
	$result= mysql_query("select tgl_pengajuan from tb_kredit WHERE MONTH(tgl_pengajuan)='$bln' and YEAR(tgl_pengajuan)='$thn'");
	if ($srv==0) {
		if ($pg==1) {
			# code...
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.*, tb_surveyor.nama_surveyor FROM tb_kredit
						left join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						left join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						left join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						left join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						left join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						left join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						left join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf'");
		}else if ($pg==2) {
			# code...
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=3");
		}else if ($pg==3) {
			# code...
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=4");
		}else if ($pg==4) {
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=5");
		}
	
	}else if ($srv!=0 && $pg==1) {
		
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.*, tb_surveyor.nama_surveyor FROM tb_kredit
							left join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
							left join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
							left join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
							left join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
							left join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
							left join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
							left join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
							left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
							WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.id_surveyor='$srv'");
		}else if ($srv!=0 && $pg==2) {
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=3 and tb_kredit.id_surveyor='$srv'");
		}else if ($srv!=0 && $pg==3) {
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=4 and tb_kredit.id_surveyor='$srv'");
		}else if ($srv!=0 && $pg==4) {
			$results = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=5 and tb_kredit.id_surveyor='$srv'");
		}
	
	$br=mysql_fetch_assoc($result);
	//$tl='11'.$thn.$bln;
	$mon = date("F Y", strtotime($br['tgl_pengajuan']));
	//$th = date("Y", strtotime($thn));
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laporan Penjualan Kredit</title>
		<?php
			include "head.php";
		?>
	</head>
	<body onLoad="window.print()">
		<h2>Laporan Penjualan Kredit</h2>
		<div class='table' style="margin-top: 2em;">
			<span>Periode <?php echo "$mon"; ?> </span>
			<table class="table table-bordered"'>
				<thead>
					<tr>
						<th>No</th>
						<!--th>Gambar</th-->
						<th>Detail Kredit</th>
						<th>Nama Pelanggan</th>
						<th>Nama Barang</th>
						<th>Dealer</th>
						<th>Harga Motor</th>
						<th>Uang Muka</th>
						<?php
							if ($idf==0) {
								# code...
							echo "<th>Finance</th>";
							}else if ($idf!=0) {
								echo "<th>Surveyor</th>";
							}
						?>
						<th>Jenis</th>
						<?php
							if ($pg==1) {
								echo "<th>Status</th>";
								# code...
							}
						?>
										
					</tr>
				</thead>
				
				<?php 
				
					$no = 1;
					while($bar=mysql_fetch_array($results)) { 
						$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
						$hrg=number_format($bar['harga_cash'], 0, ".", ".");
						$umuka = number_format($bar['uang_muka'], 0, ".", ".");
				?>
				<tbody>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td>
						<div>No.Kredit:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>

						</div><?php echo $tgl; ?>
					</td>
					<td><?php echo "$bar[nama_pelanggan]"; ?></td>
					<td><?php echo "$bar[nama_det_motor]"; ?></td>
					<td><?php echo "$bar[nama_dealer]"; ?></td>
					<td><?php echo $hrg; ?></td>
					<td><?php echo $umuka; ?></td>

					<?php
							if ($idf==0) {
								# code...
							echo "<td>$bar[nama_finance]</td>";
							}else if ($idf!=0) {
							 	echo "<td>$bar[nama_surveyor]</td>";
							}
						?>
					<td><?php if ($bar['jenis']==1) {
						echo "Bunga Tetap";
					}else{
						echo "Bunga Menurun";
					}?></td>

					<?php 
						if ($pg==1 && $bar['status']==5) {
							echo "<td style='color:#449d44;'>Lunas</td>";
						}else if($pg==1 && $bar['status']==4){
							echo "<td style='color:#eea236;'>Ditolak</td>";
						}else if($pg==1 && $bar['status']!=5){
							echo "<td style='color:#31b0d5;'>Aktif</td>";
						}
					?>
					</tr>
				</tbody>
				<?php $no++;} ?>
			</table>
			<!-- <?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?> --></td>
		</div>	
	</body>
</html>