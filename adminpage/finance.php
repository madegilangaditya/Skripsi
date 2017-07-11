<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$idf = $_SESSION['finance'];
	
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
					<h5>Data Kredit</h5>
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
				<div class="grid-form1" id="results">
					 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Survey Kredit Belum di Aprove</h3>
						<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Detail Survey</th>
									<th>Nama Pelanggan</th>
									<th>Surveyor</th>
									<!--th>Tanggal Pengajuan</th-->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sel = mysql_query("SELECT tb_survey.*, tb_pelanggan.nama_pelanggan, tb_pelanggan.alamat, tb_kredit.tgl_pengajuan, tb_surveyor.nama_surveyor, tb_kredit.id_kredit FROM tb_kredit 
										INNER JOIN tb_pelanggan ON tb_pelanggan.`id_pelanggan`=tb_kredit.id_pelanggan
										INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu` 
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga` = tb_jawu.`id_bunga`
										INNER JOIN tb_survey ON tb_survey.id_kredit =tb_kredit.`id_kredit`
										INNER JOIN tb_surveyor ON tb_surveyor.id_surveyor=tb_kredit.`id_surveyor`
										WHERE tb_kredit.status=2 AND tb_bunga.id_finance='$idf' ORDER BY tb_survey.tgl_survey ASC"); 
									$i = 1;
									while ($baris=mysql_fetch_array($sel)) {
										$tgl = date("d F Y H:i:s", strtotime($baris['tgl_survey']));
										
										echo "<tr>
												<td align='center'>$i</td>
												<td><div>No.Survey:<a href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_survey]' id='getUser'  style='color: #b30143;'>$baris[id_survey]</a></div>$tgl</td>
												<td>$baris[nama_pelanggan]</td>
												<td>$baris[nama_surveyor]</td>
												<td>
						
													<a class='btn btn-success' href='admin.php?page=form-survey&id=$baris[id_survey]'>Approve</a>
													<a class='btn btn-info' href='#' >View</a>
												
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
				url: 'get-survey.php',
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