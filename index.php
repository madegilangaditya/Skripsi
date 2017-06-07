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
<div class="banner-bg banner-bg1">	
<?php

$user=$_SESSION['username'];
//$oto = $_SESSION['oto'];
if($user!=""){
	
	include "nav-member.php";
}else{
include "nav-user.php";
	
}

?>

<div class="caption">
		 <div class="slider">
					   <div class="callbacks_container">
						   <ul class="rslides" id="slider">
						   
							    <li><h1>WELCOME TO SHOP </h1></li>
						  </ul>
						  <p>You <span>create</span> the <span>journey,</span> we supply the <span>bike</span></p>
						  <a class="morebtn" href="merk.php">GO TO STORE</a>
					  </div>
				  </div>
	 </div>
	  <div class="dwn">
		<a class="scroll" href="#cate"><img src="images/scroll.png" alt=""/></a>
	 </div>		
</div>
<!--
<!--/banner-->
<!--div id="cate" class="categories">
	 <div class="container">
		 <h3>CATEGORIES</h3>
		 <?php
		 	
		 	$query = mysql_query("select * from tb_type");
		 		echo" <div class='categorie-grids'>";
		 	while($baris = mysql_fetch_array($query)){
		 		echo"<a href='motor.php?id=$baris[id_type]'><div class='col-md-4 cate-grid grid1' style='margin-top:10px;'>
				 <h4 style='text-transform:uppercase;'>$baris[nama_type]</h4>
				 <p>Happy Shopping</p>
				 <a class='store' href='motor.php?id=$baris[id_type]'>GO TO STORE</a>
			 </div></a>";
		 	}
			 echo "</div>";
		 ?>
	 </div>
</div>
<!--bikes-->
<div class="bikes">	
		 <h3>MOTOR TERLARIS</h3>
		 <div class="bikes-grids">			 
		 <?php
		 	$sel = mysql_query("SELECT tb_det_transaksi.id_harga, tb_harga.id_det_motor, SUM(jumlah) jumlah FROM tb_det_transaksi INNER JOIN tb_harga ON tb_harga.id_harga=tb_det_transaksi.id_harga GROUP BY id_det_motor ORDER BY jumlah DESC LIMIT 3");
		 	while($bar=mysql_fetch_array($sel)){
		 		$sel1 = mysql_query("select MAX(tb_harga.harga_cash),MIN(					tb_harga.harga_cash) harga_cash, tb_harga.id_det_motor, tb_harga.stok, tb_det_motor.nama_det_motor, tb_warna.gambar from tb_harga left join tb_det_motor on tb_harga.id_det_motor=tb_det_motor.id_det_motor 
					left join tb_warna on 
					tb_warna.id_det_motor=tb_det_motor.id_det_motor where id_harga=$bar[id_harga] group by id_det_motor
					");
		 	while ($bar2=mysql_fetch_array($sel1)) {
		 		# code...
		 		$hrg = number_format($bar2['harga_cash']);
		 ?>
			 
				 <div class="col-md-4">
					 <img src="adminpage/<?php echo "$bar2[gambar]"; ?>" alt="" style="width: 100%" />
					 <div class="bike-info">
						 <div class="model">
							 <h4><?php echo "$bar2[nama_det_motor]"; ?><span>Mulai Rp <?php echo "$hrg"; ?> </span></h4>							 
						 </div>
						 <div class="model-info">
						     <!--select>
							  <option value="volvo">OPTION</option>
							  <option value="saab">Option</option>
							  <option value="opel">Option</option>
							  <option value="audi">Option</option>
							 </select-->
							 <a href="single.php?id=<?php echo "$bar2[id_det_motor]"; ?>">Detail</a>
						 </div>						 
						 <div class="clearfix"></div>
					 </div>
					
				 </div>
				 <?php
				}
			}
				 ?>
				
				 <li>
					 
				 </li>
		    
			<script type="text/javascript">
			 $(window).load(function() {			
			  $("#flexiselDemo1").flexisel({
				visibleItems: 3,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover:true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:480,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:640,
						visibleItems: 2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>			 
	</div>
</div>
<!---->
<!--div class="contact">
	<div class="container">
		<h3>CONTACT US</h3>
		<p>Please contact us for all inquiries and purchase options.</p>
		<form>
			 <input type="text" placeholder="NAME" required="">
			 <input type="text" placeholder="SURNAME" required="">			 
			 <input class="user" type="text" placeholder="USER@DOMAIN.COM" required=""><br>
			 <textarea placeholder="MESSAGE"></textarea>
			 <input type="submit" value="SEND">
		</form>
	</div>
</div>
<!---->
<?php
include "footer.php";
?>
<!---->

</body>
</html>

