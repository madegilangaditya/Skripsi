<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
  		<!--banner-->	
	    <div class="banner">
	   
			<h2>
			<a href="admin.php">Home</a>
			<i class="fa fa-angle-right"></i>
			<span>Dashboard</span>
			</h2>
	    </div>
		<!--//banner-->

		<!--graph-->
		<link rel="stylesheet" href="css/graph.css">
		<!--//graph-->
		<script src="js/jquery.flot.js"></script>
		<!--content-->

		<div class="content-top">
			<?php
				$sql=mysql_query("select count(id_motor) as jml from tb_motor");
				$data=mysql_fetch_assoc($sql);
				$sql=mysql_query("select count(id_dealer) as dea from tb_dealer");
				$data1=mysql_fetch_assoc($sql);
				$sql=mysql_query("select count(id_finance) as fin from tb_finance");
				$data2=mysql_fetch_assoc($sql);
				//echo $data['jml'];
			?>
			
			<div class="col-md-4 ">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Motor</h5>
						<label><?php echo $data['jml'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Dealer Mitra</h5>
						<label><?php echo $data1['dea'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Finance Mitra</h5>
						<label><?php echo $data2['fin'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="grid-form">				
					<div class="grid-form1" id="results">
					 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Penjualan Belum Di Konfirmasi</h3>
						<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<!--th>Gambar</th-->
									<th>Detail Transaksi</th>
									<th>Total Harga</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sel = mysql_query("select * from tb_transaksi where status=2 order by tgl_transaksi DESC"); 
									$i = 1;
									while ($baris=mysql_fetch_array($sel)) {
										$tgl = date("d F Y H:i:s", strtotime($baris['tgl_transaksi']));
										$hrg=number_format($baris['jumlah_harga'], 0, ".", ".");
										if($baris['status']==1){
											$st='Lunas';
										}else if ($baris['status']==2){
											$st='Menunggu Pembayaran';
										}else{
											$st='Salah';
										}
										echo "<tr>
												<td align='center'>$i</td>
												<td><div>No.Transaksi:<a href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_transaksi]' id='getUser'  style='color: #b30143;'>$baris[id_transaksi]</a></div>$tgl</td>
												<td>$hrg</td>
												<td>$st</td>
												<td>
						
													<a class='btn btn-success' href='konfirmasi-trans.php?id=$baris[id_transaksi]'>Konfirmasi</a>
													<a class='btn btn-info' href='proses-delete-harga.php?id=$baris[id_transaksi]' >View</a>
												
												</td>													
												</tr>";
										$i++;
										}
									
								?>
							</tbody>
						</table>

					</div>
				</div>
			</div>

			<div class="col-md-12" style="margin-top: 20px;">
				<!---start-chart---->
				<!----->
				<div class="content-graph">
				<div class="content-color">
					<div class="content-ch"><p><i></i>Chrome </p><span>100%</span>
					<div class="clearfix"> </div>
					</div>
					<div class="content-ch1"><p><i></i>Safari</p><span> 50%</span>
					<div class="clearfix"> </div>
					</div>
				</div>
				<!--graph-->
				<link rel="stylesheet" href="css/graph.css">
				<!--//graph-->
				<script src="js/jquery.flot.js"></script>
					<script>
						$(document).ready(function () {
						
							// Graph Data ##############################################
							var graphData = [{
									// Visits
									data: [ [1, 1300], [7, 1600], [8, 1900], [9, 2100], [10, 2500], [11, 2200], [12, 2000], [13, 1950], [14, 1900], [15, 2000] ],
									color: '#999999'
								}, {
									// Returning Visits
									data: [ [6, 500], [7, 600], [8, 550], [9, 600], [10, 800], [11, 900], [12, 800], [13, 850], [14, 830], [15, 1000] ],
									color: '#999999',
									points: { radius: 4, fillColor: '#7f8c8d' }
								}
							];
						
							// Lines Graph #############################################
							$.plot($('#graph-lines'), graphData, {
								series: {
									points: {
										show: true,
										radius: 5
									},
									lines: {
										show: true
									},
									shadowSize: 0
								},
								grid: {
									color: '#7f8c8d',
									borderColor: 'transparent',
									borderWidth: 20,
									hoverable: true
								},
								xaxis: {
									tickColor: 'transparent',
									tickDecimals: 2
								},
								yaxis: {
									tickSize: 1000
								}
							});
						
							// Bars Graph ##############################################
							$.plot($('#graph-bars'), graphData, {
								series: {
									bars: {
										show: true,
										barWidth: .9,
										align: 'center'
									},
									shadowSize: 0
								},
								grid: {
									color: '#7f8c8d',
									borderColor: 'transparent',
									borderWidth: 20,
									hoverable: true
								},
								xaxis: {
									tickColor: 'transparent',
									tickDecimals: 2
								},
								yaxis: {
									tickSize: 1000
								}
							});
						
							// Graph Toggle ############################################
							$('#graph-bars').hide();
						
							$('#lines').on('click', function (e) {
								$('#bars').removeClass('active');
								$('#graph-bars').fadeOut();
								$(this).addClass('active');
								$('#graph-lines').fadeIn();
								e.preventDefault();
							});
						
							$('#bars').on('click', function (e) {
								$('#lines').removeClass('active');
								$('#graph-lines').fadeOut();
								$(this).addClass('active');
								$('#graph-bars').fadeIn().removeClass('hidden');
								e.preventDefault();
							});
						
							// Tooltip #################################################
							function showTooltip(x, y, contents) {
								$('<div id="tooltip">' + contents + '</div>').css({
									top: y - 16,
									left: x + 20
								}).appendTo('body').fadeIn();
							}
						
							var previousPoint = null;
						
							$('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
								if (item) {
									if (previousPoint != item.dataIndex) {
										previousPoint = item.dataIndex;
										$('#tooltip').remove();
										var x = item.datapoint[0],
											y = item.datapoint[1];
											showTooltip(item.pageX, item.pageY, y + ' visitors at ' + x + '.00h');
									}
								} else {
									$('#tooltip').remove();
									previousPoint = null;
								}
							});
						
						});
					</script>
				<div class="graph-container">
					<div id="graph-lines"> </div>
					<div id="graph-bars"> </div>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>

		<!--//content-->
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
<script>
	$(document).ready(function(){
		
		$(document).on('click', '#getUser', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: '../get-trans.php',
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
	$(document).ready(function() {
		$("#results" ).load( "page-test.php");
		
		$("#results").on( "click", ".pagination a", function (e){
			e.preventDefault();
			var page = $(this).attr("data-page");
			$("#results").load("page-test.php",{"page":page}, function(){});
		});
	});
</script>