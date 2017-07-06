<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$sel = mysql_query("select tb_login.id_login, tb_surveyor.id_surveyor from tb_login inner join tb_surveyor on tb_login.id_login=tb_surveyor.id_login  where username='$_SESSION[user]'");
    $br=mysql_fetch_assoc($sel);
    $_SESSION['surveyor']=$br['id_surveyor'];
    $ids = $_SESSION['surveyor'];
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
				<input type="hidden" name="ids" id="ids" value="<?php echo "$ids";?>">
				<div class="col-md-12" style="margin-bottom: 20px;">
				<div class="grid-form">				
					<div class="grid-form1" id="results">
					 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Permintaan Kredit Belum di Survey</h3>
						<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Detail Kredit</th>
									<th>Nama Pelanggan</th>
									<th>Alamat</th>
									<!--th>Tanggal Pengajuan</th-->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sel = mysql_query("SELECT tb_pelanggan.nama_pelanggan, tb_pelanggan.alamat, tb_kredit.tgl_pengajuan, tb_kredit.id_kredit FROM tb_kredit 
										INNER JOIN tb_pelanggan ON tb_pelanggan.`id_pelanggan`=tb_kredit.id_pelanggan 
										WHERE tb_kredit.status=1 AND tb_kredit.id_surveyor=$_SESSION[surveyor] ORDER BY tb_kredit.tgl_pengajuan DESC"); 
									$i = 1;
									while ($baris=mysql_fetch_array($sel)) {
										$tgl = date("d F Y H:i:s", strtotime($baris['tgl_pengajuan']));
										
										echo "<tr>
												<td align='center'>$i</td>
												<td><div>No.kredit:<a href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_kredit]' id='getUser'  style='color: #b30143;'>$baris[id_kredit]</a></div>$tgl</td>
												<td>$baris[nama_pelanggan]</td>
												<td>$baris[alamat]</td>
												<td>
						
													<a class='btn btn-success' href='admin.php?page=form-survey&id=$baris[id_kredit]'>Survey</a>
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
		</div>
		<div class="clearfix"> </div>
	</div>

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

<!--script type="text/javascript">
	$(document).ready(function() {
		$("#results" ).load( "page-test1.php");
		
		$("#results").on( "click", ".pagination a", function (e){
			e.preventDefault();
			var ids = $("#ids").val();
			var page = $(this).attr("data-page");
			$("#results").load("page-test1.php",{"page":page}, function(){});
		});
	});
</script-->
		
	
  
		
		<!--//content-->