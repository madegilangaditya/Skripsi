<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "koneksi.php";
	$id=$_REQUEST['id'];
	//echo "test $id";
?>
	<div class="modal-header"> 
		                        
		<h2 style="display: inline;">Riwayat Angsuran</h2>
		<span style="display: inline; float: right;">No. Kredit: <?php echo  "$id"; ?></span>                    
	</div>

	<div class="modal-body" style="background: #ffffff;">
		<div class="col-md-12 cart-items">
			<div class="col-md-12 cart-items" style="margin-bottom: 1em;" id="results">
				<?php
					date_default_timezone_set('Asia/Makassar');
					$tanggal=date("Y-m-d H:i:s");
						$date=date_create("$tanggal");
						date_add($date,date_interval_create_from_date_string("1 Month"));
						$tgll= date_format($date,"Y-m-d");
						//echo "$tgll";
					?>
				
				<table class="table table-hover">
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
						
						// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
						// $bar=mysql_fetch_assoc($sel);
						// $idp=$bar['id_pelanggan'];
						//echo "tes $idp";
						
						//echo "tes $get_total_rows, $total_pages, $page_position";
						$result = mysql_query("SELECT tb_det_angsuran.*, tb_angsuran.* FROM tb_det_angsuran
							INNER JOIN tb_angsuran ON tb_angsuran.`id_angsuran`=tb_det_angsuran.`id_angsuran`
							INNER JOIN tb_survey ON tb_survey.`id_survey`=tb_angsuran.`id_survey`
							INNER JOIN tb_kredit ON tb_kredit.id_kredit=tb_survey.id_kredit
							WHERE tb_kredit.id_kredit=$id ORDER BY tgl_jatuh_tempo ASC");
						$no = 1+$page_position;
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
			</div>
			
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="modal-footer">
		<a target="_blank" class='btn btn-success' href='laporan-riwayat.php?id=<?php echo $id; ?>' id="cetak"><i class="fa fa-print"></i> Cetak</a> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
    </div> 
