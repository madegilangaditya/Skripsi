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
					
				include "nav-user1.php";
				}else{
					include "nav-member.php";
				}
			?>  
		</div>
	<!--/banner-->

		<div class="product" style="background: #f8f8f8;">
			<div class="container" style="background: #ffffff;">
			 	<div class="ctnt-bar cntnt">
					<div class="content-bar">
						<div class="single-page">
							<div class="product-head">
								<a href="index.php">Home</a> <span>::</span>	
							</div>
							<!--Include the Etalage files-->
							<!--link rel="stylesheet" href="css/etalage.css"-->
							<!--script src="js/jquery.etalage.min.js"></script-->
							<?php
							 	$id=$_GET['id'];
							 	$_SESSION['motor']=$id;
							 	$sql = mysql_query("select * from tb_det_motor where id_det_motor=$id");
							 	$bar=mysql_fetch_array($sql);
							 	$nama=$bar['nama_det_motor'];
							 	$idm=$bar['id_motor'];
							 	$sql1=mysql_query("select * from tb_motor where id_motor=$idm");
							 	$bar1=mysql_fetch_array($sql1);
							 	$idme=$bar1['id_merk'];
							 	$idt=$bar1['id_type'];
							 	$des=$bar1['deskripsi'];
							 	$spek=$bar1['spesifikasi'];
							 	$sql2=mysql_query("select nama_merk from tb_merk where id_merk=$idme");
							 	$bar2=mysql_fetch_array($sql2);
							 	$merk=$bar2['nama_merk'];
							 	$sql2=mysql_query("select nama_type from tb_type where id_type=$idt");
							 	$bar2=mysql_fetch_array($sql2);
							 	$type=$bar2['nama_type'];
							 	$sql3=mysql_query("select * from tb_warna where id_det_motor=$id");
							 	$bar3=mysql_fetch_array($sql3);

							 	$gmb=$bar3['gambar'];
							 	$war=$bar3['warna'];
							 ?>
							
								<!--//details-product-slider-->
							<div class="details-left-slider col-md-4">
								<a id="gmb2" href="adminpage/<?php echo "$gmb"; ?>" data-lightbox="roadtrip" >
									<img id="gmb1"  src="adminpage/<?php echo "$gmb"; ?>" style="width: 300px;" />
								</a>
							</div>
							   
							<div class="details-left-info">
								<h3 style="display: inline;"><?php echo "$nama"; ?><!--div><a class="btn">$baris1[nama_dealer] </a></div--></h3>
								<a href=<?php echo "kompare.php?id=$id";?> class="btn btn-info" style="display: inline; float: right;">Kompare Dealer</a>
										<!--h4>Model No: 3498</h4-->
								<h4></h4>
								<form method="post" action="add-cart.php" enctype="multipart/form-data">
									<?php
										echo "<input name='iddm' type='hidden' value='$id'>";
										$sel=mysql_query("select tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer from tb_harga where id_det_motor=$id order by harga_cash ASC");
										while($baris=mysql_fetch_array($sel)){
											$sel1=mysql_query("select tb_dealer.nama_dealer from tb_dealer where id_dealer=$baris[id_dealer]");
										
											while ($baris1=mysql_fetch_array($sel1)) {
												$h=$baris['harga_cash'];
												$hrg=number_format($h, 0, ".", ".");
												# code...
										echo "<p style='display:inline;'><label>Rp </label>$hrg <a href='#'>$baris1[nama_dealer] </a></p> 
											<div class='btn_form' style='display:inline; float:right; margin-top: 1em;'>
										<input name='id$baris[id_harga]' type='hidden' value='$baris[id_harga]'>
										<button type='submit'class='btn btn-success' name='btn$baris[id_harga]' value='$baris[id_harga]'>Buy Now</button>
										<a href='angsuran.php?id=$baris[id_harga]' class='btn btn-info' name='btn$baris[id_harga]' value='$baris[id_harga]' style='padding: 6px 12px; text-transform: none; margin-left: 0px;'>Angsuran</a>
										<button data-toggle='modal' data-target='#view-modal' data-id='$baris[id_harga]' id='getUser' class='btn btn-info'>Fasilitas</button>
									</div></br>";
											}
										}
									?>

									<p class="size">Warna ::</p>
									<select name="warna" id="warna" class="form-control" style="display: inline; width: 25%;">
										<?php

											$warna = mysql_query("select * from tb_warna where id_det_motor = $id");
												while($p=mysql_fetch_array($warna)){
													echo "<option value=\"$p[id_warna]\">$p[warna]</option>\n";
													}
										?>
									</select>
								</form>

								<div class="bike-type">
								<p>TYPE  ::<a href="#"><?php echo "$type"; ?></a></p>
								<p>BRAND  ::<a href="#"><?php echo "$merk"; ?></a></p>
								</div>
									
							</div>
								<div class="clearfix"></div>				 	
						</div>
					</div>
				</div>
				
		  
		  <!--ul class="nav nav-tabs" style="background: #969696;">
		    <li ><a data-toggle="tab" href="#menu" style="color: black; background: #969696;">Deskripsi</a></li>
		    <li><a data-toggle="tab" href="#menu1" style="color: black; background: #969696;">Spesifikasi</a></li>
		    <li><a data-toggle="tab" href="#menu2" style="color: black; background: #969696;">Angsuran</a></li>
		  </ul>

		  <div class="tab-content" style="
		    margin-bottom: 30px;
		    margin-top: 30px;
		">
		    <div id="menu" class="tab-pane fade in active" >
		      
		      <p><?php echo"$des"; ?></p>
		    </div>
		    <div id="menu1" class="tab-pane fade" style="color: black;">
		     
		      <p><?php echo"$spek"; ?></p>
		    </div>
		    <div id="menu2" class="tab-pane fade" style="color: black;">
		     
		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		    </div>
		    <div id="menu3" class="tab-pane fade">
		      
		      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		    </div>
		  </div>
		  

		<div class="clearfix"></div>	
		-->
			    <div class="single-bottom2">
					<h6>Deskripsi</h6>
					<div class="product" style="margin-bottom: 20px;">
						<div class="product-desc">
							<div class="prod1-desc">
								<p class="product_descr"><?php echo "$des"; ?> </p>
							</div>
								<div class="clearfix"></div>
						</div>
							<div class="clearfix"></div>
					</div>
					
					<h6>Spesifikasi</h6>
					<div class="product" style="margin-bottom: 20px;">
					 	<div class="product-desc">
						  	<div class="prod1-desc">
								<p class="product_descr"> <?php echo"$spek"; ?> </p>	
						 	</div>
						 		<div class="clearfix"></div>
					 	</div>
							<div class="clearfix"></div>
					</div> 
				</div>	 
			</div>
		</div>
	<!---->
	<?php
		include "footer.php";
	?>
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                      
                       <div class="modal-header" id="dynamic-content"> 
                            
                        
                 </div> 
              </div>
       </div><!-- /.modal -->
	</body>
</html>

<!---->
<script src="lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getUser', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: 'getinfo.php',
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
          $("#warna").change(function(){
            var warna = $("#warna").val();
            $.ajax({
                url: "ambil-warna.php",
                data: "warna="+warna,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    document.getElementById("gmb1").src=msg;
                    //document.getElementById("gmb2").src=msg;
                    //$("#gmb1").html(msg);
                    $("#gmb2").attr('href',msg);
                  
                }
            });
          });
        });
</script>

