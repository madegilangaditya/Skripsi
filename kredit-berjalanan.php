<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	$idl=$_SESSION['idl'];
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
						<h2 style="display: inline;">Daftar Kredit</h2>
						<table class="table table-hover">
							<thead>
						    	<tr>
						      		<th>No</th>
							        <th>Detail Kredit</th>
							        <th>Angsuran Pokok</th>
							        <th>Jenis</th>
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
								$result = mysql_query("SELECT tb_pelanggan.*, tb_kredit.*, tb_angsuran.id_angsuran FROM tb_pelanggan
									INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
									INNER JOIN tb_kredit ON tb_pelanggan.id_pelanggan=tb_kredit.id_pelanggan 
									INNER JOIN tb_survey ON tb_survey.id_kredit = tb_kredit.id_kredit
									INNER JOIN tb_angsuran ON tb_survey.id_survey=tb_angsuran.id_survey
									WHERE tb_pelanggan.id_login=$idl AND tb_kredit.status=3 OR tb_kredit.status=5 or tb_kredit.status=6 or tb_kredit.status=7 ORDER BY id_kredit ASC");
								$no = 1+$page_position;
								while($bar=mysql_fetch_array($result)) { 
									$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
									$hrg=number_format($bar['angsuran_pokok'], 0, ".", ".");
									$idan= $bar['id_angsuran'];
									$sel1=mysql_query("SELECT tb_det_angsuran.*, tb_kredit.*, tb_bunga.* FROM tb_det_angsuran
										INNER JOIN tb_angsuran ON tb_det_angsuran.id_angsuran=tb_angsuran.`id_angsuran`
										INNER JOIN tb_survey ON tb_survey.id_survey=tb_angsuran.`id_survey`
										INNER JOIN tb_kredit ON tb_survey.id_kredit=tb_kredit.`id_kredit`
										INNER JOIN tb_jawu ON tb_kredit.`id_jawu`=tb_jawu.`id_jawu`
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										WHERE tb_det_angsuran.id_angsuran='$idan'");

							?>
							<tbody>
							<?php
								while ($br=mysql_fetch_array($sel1)) {
										# code...
										if ($br['tgl_jatuh_tempo']<$tanggal&&$br['status']==2) {

											$datetime1 = date_create($br['tgl_jatuh_tempo']);
											$datetime2 = date_create($tanggal);
											$interval = date_diff($datetime1, $datetime2);
											$a=$interval->d;
											$dd=$a*$br['denda_tetap'];
											$dnd=$dd/100*$br['angsuran'];
											$upd =mysql_query("update tb_det_angsuran set denda='$dnd' where id_det_angsuran=$br[id_det_angsuran]");
											
										}
									}
							?>
								<tr>
									<td><?php echo $no; ?></td>
									<td>
										<div>No.Kredit:
											<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>
										</div><?php echo $tgl; ?>
									</td>
									<td>Rp <?php echo $hrg; ?></td>
									<?php 
											if ($bar['status']==3) {
												echo "<td style='color: #eea236;     font-weight: bold;'>Aktif</td>";
											} else if ($bar['status']==5) {
												# code...
												echo "<td style='color: #5cb85c;     font-weight: bold;'>Lunas</td>";
											}else{
												echo "<td style='font-weight: bold;'>Pending</td>";
											}
										?>
									<td><?php if ($bar['jenis']==1) {
										# code...
										echo "Bunga Tetap";
										}else{
											echo "Bunga Menurun";
											} ?></td>	
									
									<td style="width: 299px;">
										<?php
											if ($bar['status']==6||$bar['status']==7) {
												$by = mysql_query("select id_bayar from tb_bayar where id=$bar[id_kredit]");
												if (mysql_num_rows($by)==0) {
										?>
												<a class='btn btn-success' href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='byr'>Bayar Uang Muka</a>
											<?php
												}else{
											?>
												<i class='btn btn-success' >Menunggu Konfirmasi</i>		
											<?php			
												}
											?>
										
										<?php		
											}else{


										?>
										<a class='btn btn-info' href='pembayaran.php?id=<?php echo $bar[id_angsuran];?>'>Riwayat Pembayaran</a>
										<a class='btn btn-danger' href='#' >Hapus</a>
										<?php
											}
										?>
									</td>
								</tr>
							</tbody>
							<?php $no++;} ?> 
						</table>
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
<script>
	$(document).ready(function(){
		
		$(document).on('click', '#getUser', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'get-kredit.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);	
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
	var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("body").on("click", "#responds .btn btn-danger", function(e){
          	var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 	var DbNumberID = clickedID[1]; //and get number from array
			var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
           	alert("tes");
            //var session_value = '<%=Session["warna"]%>';

            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
				url: "delete-trans.php", //Where to make Ajax calls
				dataType:"text", // Data type, HTML, json etc.
				data:myData, //Form variables
                success:function(response){
				//on success, hide  element user wants to delete.
				$('#item_'+DbNumberID).fadeOut();
				}
            });
          });
        });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(document).on('click', '#byr', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'byr.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);	
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
<!-- <script type="text/javascript">
	$(document).ready(function() {
		$("#results" ).load( "riwayat.php");
		
		$("#results").on( "click", ".pagination a", function (e){
			e.preventDefault();
			var page = $(this).attr("data-page");
			$("#results").load("riwayat.php",{"page":page}, function(){});
		});
	});
</script> -->