<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	$id=$_GET['id'];

?>

<!DOCTYPE html>
<html>
	<?php
		include "head.php";
	?>

	<body>
		<!--banner-->
		<div class="banner-bg banner-sec">	
			<?php
				$user=$_SESSION['username'];
				if($user==""){
				include "nav-user.php";
				}else{
					include "nav-member.php";
				}
			?>
		</div>
		<div class="cart" style="background: #f8f8f8;">
			<div class="container" style="background: #ffffff;">
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
						<div style="margin-bottom: 2em;">
							
							<h2 style="display: inline;">Daftar Angsuran</h2>
							<span style="display: inline; float: right;">No. Angsuran: <?php echo  "$id"; ?></span>
						</div>
						<table class="table table-hover">
							<thead>
						    	<tr>
						      		<th>No</th>
							        <th>Jatuh Tempo</th>
							        <th>Angsuran Bunga</th>
							        <th>Angsuran Pokok</th>
							        <th>Angsuran Total</th>
							        <!-- <th>Denda</th> -->
							        <th>Cicilan Pokok</th>
							        <th>Total Bunga</th>
							        <th>Status</th>
							        <th>Action</th>
						      	</tr>
						    </thead>
							
							<?php 
								
								// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
								// $bar=mysql_fetch_assoc($sel);
								// $idp=$bar['id_pelanggan'];
								//echo "tes $idp";
								
								//echo "tes $get_total_rows, $total_pages, $page_position";
								$result = mysql_query("SELECT tb_det_angsuran.*, tb_angsuran.jenis, tb_kredit.angsuran_pokok, tb_kredit.id_kredit, tb_jawu.`jangka_waktu`, tb_jawu.min_lunas, tb_bunga.bunga_menurun FROM tb_det_angsuran 
									INNER JOIN tb_angsuran ON tb_det_angsuran.id_angsuran=tb_angsuran.id_angsuran 
									INNER JOIN tb_survey ON tb_survey.`id_survey`=tb_angsuran.`id_survey`
									INNER JOIN tb_kredit ON tb_kredit.`id_kredit`=tb_survey.`id_kredit`
									INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu` 
									INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga` 
									WHERE tb_det_angsuran.id_angsuran='$id'");
								$no = 0;
								while($bar=mysql_fetch_array($result)) { 
									++$no;
									$tgl = date("d F Y H:i:s", strtotime($bar['tgl_jatuh_tempo']));
									$ang=$bar['angsuran'];
									$angpok = $bar['angsuran_pokok'];
									$burun = $bar['bunga_menurun'];
									$jawu = $bar['jangka_waktu'];
									$min_lunas = $bar['min_lunas'];
									$ang_tmp=round($angpok/$jawu);
									if ($bar['jenis']==1) {
										$angbung = $ang-$ang_tmp;
										$btot+=$angbung;
									}else{
										$angbung = round($bar['sisa_pokok']*$burun/100);
										//$angtot = $ag+$ang_tmp;
										$btot+=$angbung;
									}
									
									
									
								
									$hrg=number_format($bar['angsuran'], 0, ".", ".");
									$hrgg=number_format($bar['sisa_pokok'], 0, ".", ".");
							?>
							<tbody>
								<tr>
									<td><?php echo $no; ?></td>
									<td>
										<?php echo $tgl; ?>
									</td>
									<td>Rp <?php echo number_format($angbung, 0, ".", "."); ?></td>
									<td>Rp <?php echo number_format($ang_tmp, 0, ".", "."); ?></td>
									<td>Rp <?php echo $hrg; ?></td>
									<!-- <td><?php 
											if($bar['denda']==0) {
												echo "-";
											}else{
												echo number_format($bar['denda'], 0, ".", ".");
											} 
										?>
									</td> -->
									<td>Rp <?php echo $hrgg; ?></td>
									<td>Rp <?php echo number_format($btot, 0, ".", "."); ?></td>
									<?php 
											if ($bar['status']==2) {
												echo "<td style='color: #eea236;     font-weight: bold;'>Belum Dibayar</td>
												<td>
													<a class='btn btn-info' href='#' data-toggle='modal' data-target='#view-modal' data-id='$bar[id_det_angsuran];' id='byr'>Bayar </a>
												</td>";
											} else if($bar['status']==1){
												echo "<td style='color: #5cb85c;     font-weight: bold;'>Sudah Dibayar</td>
												<td>
													<a class='btn btn-success'>Lunas</a>
												</td>";
											}else{
												echo "<td style='color: #000000;     font-weight: bold;'>Menunggu Konfirmasi</td>
												<td>
													<a class='btn btn-success'>Pending</a>
												</td>";
											}
										?>

								</tr>
								<?php
									if ($jawu==$no) {
								?>
								<tr style="font-weight: bold;">
									<td>Total</td>
									<td>
										-
									</td>
									<td>-</td>
									<td>-</td>
									<!-- <td>-
									</td> -->
									<td>0</td>
									<td>-</td>
									<td>Rp <?php echo number_format($btot, 0, ".", "."); ?></td>
									<td>-</td>
									<td><a class='btn btn-success'>Lunas</a></td>

								</tr>
								<?php			
										}		
								?>
									
							</tbody>
							<?php 

							} ?> 
						</table>
						<?php
							// $cek = mysql_query("SELECT status from tb_det_angsuran where id_angsuran=''");
							$ck=$no-1;	
							//echo "$ck; $min_lunas";
							if ($ck>=$min_lunas&&$no<$jawu) {
								# code...
							
						?>
						<div>
							
							<a href="#" class="btn btn-info" data-toggle='modal' data-target='#view-modal' data-id="<?php echo $id; ?>" id='lunas'>Bayar Lunas</a>
							<input type="hidden" name="ck" value="<?php echo $ck; ?>" id="ck" >
						</div>
						<?php
							}
						?>
					</div>
					
				</div>
			</div>
		</div>
		<?php
			include "footer.php";
		?>
		<!--Modal-->
		<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		    <div class="modal-dialog" style="width: 80%;"> 
		        <div class="modal-content"> 
		                  
		            <div class="modal-header" id="dynamic-content"> 
		                        
		                    
		            </div> 
		        </div>
		   	</div>
		</div>
		<!--Modal-->

	</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click', '#byr', function(e){
			
			e.preventDefault();
			var st = 1;
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'byr.php',
				type: 'POST',
				data: 'id='+uid+'&st='+st,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				console.log(uid);	
				$('#dynamic-content').html('');    
				$('#dynamic-content').html(data); // load response 
				$('#modal-loader').hide();		  // hide ajax loader	
			})
			.fail(function(){
				$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#modal-loader').hide();
			});
			
		});
		
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
			var ck = $("#ck").val();
		$(document).on('click', '#lunas', function(e){
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'lunas.php',
				type: 'POST',
				data: 'id='+uid+'&ck='+ck,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				console.log(uid);	
				$('#dynamic-content').html('');    
				$('#dynamic-content').html(data); // load response 
				$('#modal-loader').hide();		  // hide ajax loader	
			})
			.fail(function(){
				$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#modal-loader').hide();
			});
			
		});
		
	});
</script>