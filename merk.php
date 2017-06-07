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
		<!--/banner-->
		<div class="parts" style="background: #f8f8f8;">
			<div class="container" style="background: #ffffff;">
				<h2 style="margin-top: 5px;">PILIH MOTOR</h2>
				<div class="bike-parts-sec">
					<div class="rsidebar span_1_of_left">
						<section  class="sky-form">
							<h4>Merk</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
									<?php
										$sql = mysql_query("select id_merk,nama_merk from tb_merk");	
										$k=0;
										while ($baris=mysql_fetch_array($sql)){
											echo "<label class='checkbox'><input type='checkbox' id='$baris[id_merk]' name='myCheck' value ='$baris[id_merk]'checked='check'><i></i>$baris[nama_merk]</label>";
											$a[$k]=$baris[id_merk];
											$k++;
										}
									?>		
								</div>
							</div>
						</section>	
							      
						<section  class="sky-form">
							<h4>Type</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
									<?php
										$sql = mysql_query("select id_type,nama_type from tb_type");
										while ($baris=mysql_fetch_array($sql)){
											echo "<label class='checkbox'><input type='checkbox' id='myCheck' name='myCheck' value ='$baris[id_type]'checked='check'><i></i>$baris[nama_type]</label>";
										}
									?>
								</div>
							</div>
							 <!--
							 <h4>Apparels</h4>
							 <div class="row row1 scroll-pane">
								 <div class="col col-4">
										<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Locks (20)</label>
								 </div>
								 <div class="col col-4">
										<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Speed Cassette (5)</label>
										<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Bike Pedals (7)</label>
										<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Handels (2)</label>
										<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other (50)</label>
								 </div>
							 </div>
						 </section>
						
						   <section  class="sky-form">
								<h4>Price</h4>
									<div class="row row1 scroll-pane">
										<div class="col col-4">
											<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>$50.00 and Under (30)</label>
										</div>
										<div class="col col-4">
											<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$100.00 and Under (30)</label>
											<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$200.00 and Under (30)</label>
											<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$300.00 and Under (30)</label>
											<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>$400.00 and Under (30)</label>
										</div>
									</div-->
						</section>		       
					</div>			 

				    <div class="bike-parts">
						<div class="top">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="#"> / </a></li>
								<li><a href="#">Motor</a></li>
							</ul>				 
						</div>

					 	<div class="bike-apparels">
							<div class="parts1">
								<?php
								 	$sql = mysql_query("select MAX(tb_harga.harga_cash),MIN(tb_harga.harga_cash), tb_harga.id_det_motor, tb_harga.stok, tb_det_motor.nama_det_motor, tb_warna.gambar from tb_harga left join tb_det_motor on tb_harga.id_det_motor=tb_det_motor.id_det_motor 
								 		left join tb_warna on 
								 		tb_warna.id_det_motor=tb_det_motor.id_det_motor group by id_det_motor");
								 	while ($baris=mysql_fetch_array($sql)){
								 		$hrg = number_format($baris['MAX(tb_harga.harga_cash)']);
								 		$hrg1 = number_format($baris['MIN(tb_harga.harga_cash)']);
								 		echo "
								 		<a href='single.php?id=$baris[id_det_motor]'><div class='part-sec'>					 
										 <img src='adminpage/$baris[gambar]' alt=''/>
										 <div class='part-info'>
											 <a href='#'><h5>$baris[nama_det_motor]<span style='text-align:left;'>Harga Terkecil: Rp $hrg1 </span><span style='text-align:left;'>Harga Terbesar: Rp $hrg</span></h5></a>
											 
											 
											 <a class='qck' href='single.php?id=$baris[id_det_motor]'>DETAIL</a>
										 </div>
									 	</div></a>
								 		";
								 	}
								?>
								<div class="clearfix"></div>
						 	</div>
						</div>
				    </div>
				</div>
			</div>
		</div>
		<!---->
		<?php
			include "footer.php";
		?>
		<!---->
	</body>
	<!--script >
		var a=<?php echo json_encode($a); ?>;
		$("input[type='checkbox']").on("change",function(){
	         var b = 0;
	         var c =[];
	         while(b<a.length){

	         if($("#a[b]").is(":checked"))
	         {
	         	c.push(+a[b]);

	         }
	         }
	             $.ajax({
	                 url: 'update.php',
	                 type: 'POST',
	                 data: "id="+$(this).val(),
	                 success:function(r){
	                     // succcess call

	                 }
	             });
	  });
		/*
	$(document).ready(function() {

	    $('#myCheck').click(function() {
	        $('.myCheck').attr('checked', false);
	    });
	    $('.myCheck').click(function() {
	        if ($('.myCheck').is(':checked')) {
	            $('#myCheck').attr('checked', false);
	        } else {
	            $('#myCheck').attr('checked', true); // IT DOESN'T WORK, WHY ?
	            alert("Checkbox Master must be checked, but it's not!");
	        }
	    });

	});*/
	</script-->
</html>

