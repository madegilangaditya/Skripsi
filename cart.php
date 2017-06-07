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
				<div class="col-md-9 cart-items">
					<h2>My Shopping Bag</h2>	
					<?php
						$idl=$_SESSION['idl'];
					 	$sql=mysql_query("select tb_cart.id_cart, tb_cart.jumlah, tb_cart.id_harga, tb_cart.tanggal, tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.gambar, tb_warna.warna, tb_dealer.nama_dealer from tb_cart 
					 		inner join tb_harga on tb_harga.id_harga = tb_cart.id_harga
					 		inner join tb_warna on tb_warna.id_warna = tb_cart.id_warna 
					 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
					 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_cart.id_login = $idl");
					 	$i=1;
					 	$total=0;
					 	while($bar=mysql_fetch_array($sql)){
					 		$jumlah=$bar['jumlah'];
							$jumlah_harga = $bar['harga_cash'] *  $jumlah;
		        			$total = $jumlah_harga + $total;
					 		$_SESSION['sub']=$total;
							$hrg=number_format($jumlah_harga, 0, ".", ".");
							echo "<div class='cart-header'>
							<button type='submit' class='btn btn-danger' style='top: 0px; right: 0px; float: right; position: absolute;' onclick='hapusCart($bar[id_cart])'>delete</button>
							
						 <div class='cart-sec'>
								<div class='cart-item cyc'>
									 <img src='adminpage/$bar[gambar]'/>
								</div>
							   <div class='cart-item-info'>
									 <h3>$bar[nama_det_motor]<span>Dealer: $bar[nama_dealer]</span></h3>
									 <h4><span>Rp </span>$hrg</h4>
									 <p class='qty'>Qty ::</p>
									 <input min='1' type='number' id='quantity' name='quantity' value='$jumlah' class='form-control input-small' style='width:10%; display:inline;'>
									 
							   </div>
							   <div class='clearfix'></div>
								<div class='delivery'>
									 <p>Warna:: $bar[warna]</p>
									 
									 <div class='clearfix'></div>
						        </div>						
						  </div>
					 </div>";
					 	}

					?>
					 
				</div>
				 
				<div class="col-md-3 cart-total" id="cart-total">
					<!--div class="price-details" >
					 <h3>Price Details</h3>
					 <span>Total</span>
					 <span class="total"><?php echo number_format($total); ?></span>
					 <span>Discount</span>
					 <span class="total">---</span>
					 <span>Delivery Charges</span>
					 <span class="total">150.00</span>
					 <div class="clearfix"></div>				 
					</div-->	
					<h4 class="last-price" style="width: 40%;">TOTAL</h4>
					<span class="total final" style="width: 60%;">Rp <?php echo number_format($total); ?></span>
					<div class="clearfix"></div>
					<a class="order" href="order.php">Checkout</a>
					<a class="order" href="merk.php" style="margin-top: 10px;">Belanja Lagi</a>
					<!--div class="total-item">
					 <h3>OPTIONS</h3>
					 <h4>COUPONS</h4>
					 <a class="cpns" href="#">Apply Coupons</a>
					 <p><a href="#">Log In</a> to use accounts - linked coupons</p>
					</div-->
				</div>
			</div>
		</div>
		<?php
			include "footer.php";
		?>

	</body>
</html>

<script>
	$(document).ready(function(c) {
		$('.close1').on('click', function(c){
			$('.cart-header').fadeOut('slow', function(c){
				$('.cart-header').remove();
			});
		});	  
	});
</script>

<script>
	$(document).ready(function(c) {
		$('.close2').on('click', function(c){
				$('.cart-header2').fadeOut('slow', function(c){
			$('.cart-header2').remove();
				});
			});	  
		});
	function hapusCart(id){
		if(confirm ("hapus??")== true){
			location.href = "delete-cart.php?id="+id;
		}
	}
</script>

<script type="text/javascript">
 	$(function() {

	    var $sidebar   = $("#cart-total"), 
	        $window    = $(window),
	        offset     = $sidebar.offset(),
	        topPadding = 15;

	    $window.scroll(function() {
	        if ($window.scrollTop() > offset.top) {
	            $sidebar.stop().animate({
	                marginTop: $window.scrollTop() - offset.top + topPadding
	            });
	        } else {
	            $sidebar.stop().animate({
	                marginTop: 0
	            });
	        }
	    });
	    
	});
</script>