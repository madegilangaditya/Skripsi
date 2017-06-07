<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
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
					<h2>Riwayat Transaksi</h2>
					<table class="table table-hover">
						<thead>
					    	<tr>
					      		<th>No</th>
						        <th>Detail Transaksi</th>
						        <th>Total Harga</th>
						        <th>Status</th>
						        <th>Action</th>
					      	</tr>
					    </thead>

					    <tbody id="responds"> 
						<?php
							$idl=$_SESSION['idl'];
							$sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
							while($bar=mysql_fetch_array($sel)){
								$idp = $bar['id_pelanggan'];
								$sel1 = mysql_query("select * from tb_transaksi where id_pelanggan=$idp order by tgl_transaksi DESC");
								while($res=mysql_fetch_array($sel1)){
									$tgl = date("d F Y H:i:s", strtotime($res['tgl_transaksi']));
									$hrg=number_format($res['jumlah_harga'], 0, ".", ".");
									$nomor++;
									echo "<tr id='item_$res[id_transaksi]'>
										<td>$nomor</td>
										<td><div>No.Transaksi:
										<a href='#' data-toggle='modal' data-target='#view-modal' data-id='$res[id_transaksi]' id='getUser'  style='color: #b30143;'>$res[id_transaksi]</a></div>$tgl</td>
										
										<td>Rp $hrg</td>";
										if($res['status']==1){
											$st='Lunas';
										}else{
											$st='Menunggu Pembayaran';
										}
									echo "		
										<td>$st</td>
										<td>
											<a href='#' class='btn btn-info'>Beli Lagi</a>
											<a id='del-$res[id_transaksi]' href='#' class='btn btn-danger'>Hapus</a>
											
										</td>			
										</tr>";
								}
							}	
						?>
					 	</tbody>
					</table> 
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