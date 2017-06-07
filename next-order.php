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
//echo "".$_SESSION['harga'];
$hrg = number_format ($_SESSION['harga']);
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
		
			
		 <div class="cart-items">
			 <h2>Pembayaran Via Transfer</h2>
			  <div class="cart-items" style="text-align: center;">
				<p>Jumlah Tagihan :</p>  	
			  	<h2>Rp <?php echo "$hrg";?></h2>
			  </div>
			<p>Pembayaran dapat dilakukan ke salah satu rekening berikut:</p>
			 
		 </div>
		 <div class="cart-items" ">
		<div class="col-md-6 cart-items" style="text-align: center; padding-top: 20px; padding-bottom: 20px; ">
			 		<div>
			 		 <img src='images/logo-bca.gif' alt=''/>
			 		<p>BCA</p>
			 		</div>
			 </div> 
			 <div class="col-md-6 cart-items" style="text-align: center; padding-top: 20px; padding-bottom: 20px;">
			 		<div>
			 		 <img src='images/logo-bni.gif' alt=''/>
			 		<p>BNI</p>
			 		</div>
			 </div> 
			 <div class="col-md-6 cart-items" style="text-align: center; padding-top: 20px; padding-bottom: 20px; ">
			 		<div>
			 		 <img src='images/logo-bri.gif' alt=''/>
			 		<p>BRI</p>
			 		</div>
			 </div> 
			 <div class="col-md-6 cart-items" style="text-align: center; padding-top: 20px; padding-bottom: 20px;">
			 		<div>
			 		 <img src='images/logo-mandiri.gif' alt=''/>
			 		<p>Mandiri</p>
			 		</div>
			 </div> 
		</div>

		 <div class="col-md-3 cart-total" id="cart-total" style="border-left: 0px; padding-bottom: 20px;">
		 	 
		 	 <a class="order" href="transaksi.php">Checkout</a>
                    
             
		 </div>
	 </div>
	 
</div>
<?php
include "footer.php";
?>

</body>
</html>