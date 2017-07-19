<?php
include "adminpage/koneksi.php";
?>
	  <div class="container">
			 <div class="header">
			       <div class="logo">
						 <a href="index.php"><img src="images/logo.png" alt=""/></a>
				   </div>							 
				  <div class="top-nav">										 
						<label class="mobile_menu" for="mobile_menu">
						<span>Menu</span>
						</label>
						<input id="mobile_menu" type="checkbox">
					   <ul class="nav">
					   <li class="dropdown1"><a href="index.php">Home</a></li>
						  <li class="dropdown1"><a href="merk.php">Motor</a></li>
						<li class="dropdown1"><a href="#" ><?php echo "" .$_SESSION['username'];?></a>
                         <ul class="dropdown2">
  	                       	<li><a href="data-trans.php">Riwayat Belanja</a></li>
                         	<li><a href="kredit-berjalan.php">Kredit Berjalan</a></li>
                         	<li><a href="logout.php">Logout</a></li>
                         </ul>       
                         </li>
						  <a class="shop" href="cart.php"><img src="images/cart.png" alt=""/></a>
						 
					  </ul>
				 </div>
				 <div class="clearfix"></div>
			 </div>
	  </div>	 
	 
			 
