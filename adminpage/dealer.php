<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
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
			<!-- <div class="col-md-4 ">
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
						<h5>Data Transaksi </h5>
						<label><?php echo $data1['dea'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Tes</h5>
						<label><?php echo $data2['fin'] ?></label>
					</div>
						<div class="clearfix"> </div>
				</div>
			</div> -->
			<!--div class="col-md-12" style="margin-top: 20px;"-->
			<div class="content-top" >
				<div class="col-md-12 " style="margin-top: 20px;">
					<div class="grid-form">				
						<div class="grid-form1">
						 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Konfirmasi Penjualan Cash</h3>
							<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<!--th>Gambar</th-->
										<th>Tanggal</th>
										<th>Nama Motor</th>
										<th>Total</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$user=$_SESSION['user'];
										$sel = mysql_query("Select id_login from tb_login where username='$user'");
										$bar= mysql_fetch_array($sel);
										$idl=$bar['id_login'];
										$sel1 = mysql_query("select * from tb_dealer where id_login=$idl");
										$bar1= mysql_fetch_array($sel1);
										$idd=$bar1['id_dealer'];
										$qw = mysql_query("select * from tb_harga where id_dealer ='$idd'");
										while ($br=mysql_fetch_array($qw)) {
											# code...
										
										$query = mysql_query(" SELECT tb_det_transaksi.id_transaksi, tb_transaksi.tgl_transaksi, tb_transaksi.id_pelanggan, tb_harga.harga_cash, tb_det_motor.nama_det_motor FROM tb_det_transaksi 
											INNER JOIN tb_transaksi ON tb_det_transaksi.id_transaksi=tb_transaksi.id_transaksi 
											INNER JOIN tb_harga ON tb_det_transaksi.id_harga = tb_harga.id_harga 
											INNER JOIN tb_det_motor ON tb_det_motor.id_det_motor= tb_harga.id_det_motor 
											WHERE tb_det_transaksi.id_harga = $br[id_harga] AND tb_transaksi.status = 3  Order BY tb_transaksi.tgl_transaksi DESC ");
										$i = 1;
										while($baris = mysql_fetch_array($query)){
											$tgl = date("d F Y", strtotime($baris['tgl_transaksi']));
											$hrg=number_format($baris['harga_cash'], 0, ".", ".");
											echo "<tr>
													<td align='center'>$i</td>
												<td><div>No.Transaksi:<a href=# data-toggle='modal' data-target='#view-modal' data-id='$baris[id_transaksi]' id='getUser' style='color: #b30143;'>$baris[id_transaksi]</a></div>$tgl</td>
												<td>$baris[nama_det_motor]</td>
												<td>$hrg</td>
												<td>Belum Dikirim</td>
												<td>
						
													<a class='btn btn-success' href='konfirmasi-kirim.php?id=$baris[id_transaksi]'>Konfirmasi</a>
													<a class='btn btn-info' href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_transaksi]' id='getUser' >View</a>
												</td>																		
													</tr>";
											$i++;
											}
										}
									?>
								</tbody>
							</table>

						</div>

						<div class="grid-form1">
						 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Konfirmasi Pengiriman Transaksi Kredit</h3>
							<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<!--th>Gambar</th-->
										<th>Tanggal</th>
										<th>Nama Motor</th>
										<th>Total</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$user=$_SESSION['user'];
										$sel = mysql_query("Select id_login from tb_login where username='$user'");
										$bar= mysql_fetch_array($sel);
										$idl=$bar['id_login'];
										$sel1 = mysql_query("select * from tb_dealer where id_login=$idl");
										$bar1= mysql_fetch_array($sel1);
										$idd=$bar1['id_dealer'];
										$qw = mysql_query("select * from tb_harga where id_dealer ='$idd'");
										while ($br=mysql_fetch_array($qw)) {
											# code...
										
										$query = mysql_query(" SELECT tb_kredit.*, tb_harga.harga_cash, tb_det_motor.nama_det_motor FROM tb_kredit 
											INNER JOIN tb_harga ON tb_kredit.id_harga = tb_harga.id_harga 
											INNER JOIN tb_det_motor ON tb_det_motor.id_det_motor= tb_harga.id_det_motor 
											WHERE tb_kredit.id_harga = $br[id_harga] AND tb_kredit.status = 7  Order BY tb_kredit.tgl_pengajuan DESC ");
										$i = 1;
										while($baris = mysql_fetch_array($query)){
											$tgl = date("d F Y", strtotime($baris['tgl_pengajuan']));
											$hrg=number_format($baris['harga_cash'], 0, ".", ".");
											echo "<tr>
													<td align='center'>$i</td>
												<td><div>No.Kredit:<a href=# style='color: #b30143;'>$baris[id_kredit]</a></div>$tgl</td>
												<td>$baris[nama_det_motor]</td>
												<td>$hrg</td>
												<td>Belum Dikirim</td>
												<td>
						
													<a class='btn btn-success' href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_kredit]' id='getbap'>Konfirmasi</a>
													<a class='btn btn-info' href='#' >View</a>
												</td>																		
													</tr>";
											$i++;
											}
										}
									?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
				<!--start-chart-->
				<!--->
				<!--div class="content-graph">
				<div class="content-color">
					<div class="content-ch"><p><i></i>Chrome </p><span>100%</span>
					<div class="clearfix"> </div>
					</div>
					<div class="content-ch1"><p><i></i>Safari</p><span> 50%</span>
					<div class="clearfix"> </div>
					</div>
				</div-->
				<!--graph>
		<link rel="stylesheet" href="css/graph.css">
		<!//graph-->
							
				<!--div class="graph-container">
									
									<div id="graph-lines"> </div>
									<div id="graph-bars"> </div>
								</div-->
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
		
		$(document).on('click', '#getbap', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'get-bap.php',
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

<script>
	$(document).ready(function(){
		
		$(document).on('click', '#getUser', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'get-trans.php',
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