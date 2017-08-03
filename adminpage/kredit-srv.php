<?php
	session_start();
	include "koneksi.php";
	$idf=$_SESSION['finance'];
	$bln=$_SESSION['bln'];
	$thn=$_SESSION['thn'];

	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	$srv=$_GET['srv'];
	$pg=$_GET['pg'];
	$_SESSION['srv']=$srv;
	//echo "$srv";
	if ($srv==0) {
		if ($pg==1) {
			# code...
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.*, tb_surveyor.nama_surveyor FROM tb_kredit
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
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
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
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=4");
		}
	
	}else if ($srv!=0 && $pg==1) {
		
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.*, tb_surveyor.nama_surveyor FROM tb_kredit
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
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
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
			$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=4 and tb_kredit.id_surveyor='$srv'");
		}

	

	
	
?>
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
						echo "<th>Finance</th>";
						# code...
					}else if ($idf!=0) {
								echo "<th>Surveyor</th>";
					}
				?>
				<th>Jenis</th>
				<!-- <th>Status</th> -->				
			</tr>
		</thead>
			<?php
				$no=1;
				while($bar=mysql_fetch_array($result)) { 
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
				<td><?php echo "$bar[nama_surveyor]"; ?></td>
				
				<td><?php if ($bar['jenis']==1) {
					echo "Bunga Tetap";
				}else{
					echo "Bunga Menurun";
				}?></td>
				

				
			</tr>
		</tbody>
		<?php $no++;} ?>
		</table>
	</table>
			<?php 
				
				exit;
			}
			?>