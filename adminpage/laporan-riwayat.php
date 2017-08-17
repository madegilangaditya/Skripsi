<?php
	session_start();
	$id=$_GET['id'];
	include("koneksi.php");

	$result = mysql_query("SELECT tb_det_angsuran.*, tb_angsuran.* FROM tb_det_angsuran
		INNER JOIN tb_angsuran ON tb_angsuran.`id_angsuran`=tb_det_angsuran.`id_angsuran`
		INNER JOIN tb_survey ON tb_survey.`id_survey`=tb_angsuran.`id_survey`
		INNER JOIN tb_kredit ON tb_kredit.id_kredit=tb_survey.id_kredit
		WHERE tb_kredit.id_kredit=$id ORDER BY tgl_jatuh_tempo ASC");
	$no = 1+$page_position;
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Laporan Riwayat Angsuran</title>
		<?php
			include "head.php";
		?>
	</head>
	<body onLoad="window.print()">
		<h2>Laporan Riwayat Angsuran</h2>
		<span style="display: inline; float: right;">No. Kredit: <?php echo  "$id"; ?></span>
		<div class='table' style="margin-top: 2em;">
			
			<table class="table table-bordered"'>
				<thead>
					<tr>
			      		<th>No</th>
				        <th>Jatuh Tempo</th>
				        <th>Angsuran</th>
				        <th>Denda</th>
				        <th>Status</th>
				        
			      	</tr>
				</thead>
				
				<?php 
				
					$no = 1;
					while($bar=mysql_fetch_array($result)) { 
						$tgl = date("d F Y H:i:s", strtotime($bar['tgl_jatuh_tempo']));
						$hrg=number_format($bar['angsuran'], 0, ".", ".");
				?>
				<tbody>
					<tr>
							<td><?php echo $no; ?></td>
							<td>
								<?php echo $tgl; ?>
							</td>
							<td>Rp <?php echo $hrg; ?></td>
							<td><?php 
									if($bar['denda']==0) {
										echo "-";
									}else{
										echo number_format($bar['denda'], 0, ".", ".");
									} 
								?>
							</td>
							<?php 
									if ($bar['status']==2) {
										echo "<td style='color: #eea236;     font-weight: bold;'>Belum Dibayar</td>
										";
									} else if($bar['status']==1){
										echo "<td style='color: #5cb85c;     font-weight: bold;'>Sudah Dibayar</td>
										";
									}else{
										echo "<td style='color: #000000;     font-weight: bold;'>Menunggu Konfirmasi</td>
										";
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