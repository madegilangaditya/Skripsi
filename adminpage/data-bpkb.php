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
			<span>Penyerahan BPKB</span>
			</h2>
	    </div>
		<!--//banner-->
	
		<!--content-->
		<div class="content-top">
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="grid-form1" id="results">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Data Penyerahan BPKB</h3>
					<!--a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a--><br class="clear" /><br class="clear" />
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Detail Kredit</th>
								<th>Nama Pelanggan</th>
								<th>Tgl Pengiriman</th>
								<!--th>Tanggal Pengajuan</th-->
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sel = mysql_query("SELECT tb_bpkb.*, tb_kredit.*,
								tb_harga.harga_cash, tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_pelanggan.nama_pelanggan,
								tb_warna.warna, tb_dealer.nama_dealer, tb_jawu.jangka_waktu, tb_bunga.biaya_tambahan FROM tb_bpkb
								INNER JOIN tb_kredit ON tb_kredit.id_kredit=tb_bpkb.id_kredit
								INNER JOIN tb_pelanggan ON tb_kredit.id_pelanggan=tb_pelanggan.id_pelanggan 
								INNER JOIN tb_harga ON tb_harga.`id_harga`=tb_kredit.`id_harga`
								INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu`
								INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
								INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
								INNER JOIN tb_warna ON tb_warna.`id_warna`=tb_kredit.`id_warna`
								INNER JOIN tb_dealer ON tb_dealer.`id_dealer`=tb_harga.`id_dealer` 
								INNER JOIN tb_det_motor ON tb_det_motor.`id_det_motor`=tb_harga.`id_det_motor`
								WHERE tb_finance.id_finance='$idf'
									"); 
								$i = 1;
								while ($baris=mysql_fetch_array($sel)) {
									$tgl = date("d F Y H:i:s", strtotime($baris['tgl_pengajuan']));
									$tglb = date("d F Y H:i:s", strtotime($baris['tgl_kirim']));

									if ($baris['tgl_konfirmasi']==null) {
										# code...
										$a="Belum Dikonfirmasi";
										$b="<a class='btn btn-success' href='konfirmasi-bpkb.php?id=$baris[id_bpkb]' >Konfirmasi</a>";
									}else{
										$a="Sudah Dikonfirmasi";
										$b="<a class='btn btn-success' href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_kredit]' id='getUser' >View</a>";
									}
									echo "<tr>
											<td align='center'>$i</td>
											<td><div>No.Kredit:<a href='#' data-toggle='modal' data-target='#view-modal' data-id='$baris[id_kredit]' id='getUser'  style='color: #b30143;'>$baris[id_kredit]</a></div>$tgl</td>
											<td>$baris[nama_pelanggan]</td>
											<td>$tglb</td>
											<td>$a</td>
											<td>$b</td>													
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
		
		$(document).on('click', '#getang', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'get-cicil.php',
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