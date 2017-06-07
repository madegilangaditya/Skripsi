<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<?php
include "adminpage/koneksi.php";
include "head.php";
?>
<body>
<!--banner-->

<div class="banner-bg banner-sec">	
<?php
include "nav-user.php";
?>	 
</div>
<!--/banner-->
<div class="bikes">	
<?php
$id=$_GET['id'];
if($id=="0"){
//$query = mysql_query("select tb_motor.id_motor, tb_motor.id_type, tb_type.nama_type, tb_motor.nama_motor, tb_motor.gambar from tb_motor inner join tb_type on tb_motor.id_type=tb_type.id_type");
$jum= mysql_query("select * from tb_type ");
while($baris = mysql_fetch_array($jum)){
	$idty = $baris['id_type'];
	echo "<div class='mountain-sec'>
		 <h2>$baris[nama_type]</h2>";
		$sel1 = mysql_query("select tb_motor.id_motor,  tb_motor.nama_motor, tb_motor.gambar from tb_motor  where id_type= $idty");
	while ($col = mysql_fetch_array($sel1)){
	echo"
		 <a href='single.html'><div class='bike'>				 
			 <img src='adminpage/$col[gambar]' alt=''/>
		     <div class='bike-cost'>
					 <div class='bike-mdl'>
						 <h4>NAME<span>$col[nama_motor]</span></h4>
					 </div>
					 <div class='bike-cart'>						 
						 <a class='buy' href='single.html'>BUY NOW</a>
					 </div>
					 <div class='clearfix'></div>
				 </div>
				 <div class='fast-viw'>
						<a href='single.html'>Quick View</a>
				 </div>
			 </div></a>
			 ";
	}
	
	echo "<div class='clearfix'></div>
			</div>";
}
}
	

?>	 
	 <div class="mountain-sec">
		 <h2>MOUNTAIN BIKES</h2>
		 <a href="single.html"><div class="bike">				 
			 <img src="images/bik3.jpg" alt=""/>
		     <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike">				 
				 <img src="images/bik1.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none2">				 
				 <img src="images/bik4.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none1">				 
				 <img src="images/bik6.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>

			 <a href="single.html"><div class="bike none1">				 
				 <img src="images/bik6.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <div class="clearfix"></div>
	  </div>
		 
	  <div class="mountain-sec">
		   <h2>SINGLE SPEED-BIKES</h2>
			 <a href="single.html"><div class="bike">				 
				 <img src="images/s1.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike">				 
				 <img src="images/s2.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none2">				 
				 <img src="images/s3.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none1">				 
				 <img src="images/s4.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <div class="clearfix"></div>
		 </div>
		 
		 <div class="road-sec">
		   <h2>ROAD-BIKES</h2>
			 <a href="single.html"><div class="bike">				 
				 <img src="images/r1.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike">				 
				 <img src="images/r3.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none2">				 
				 <img src="images/r2.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <a href="single.html"><div class="bike none1">				 
				 <img src="images/r4.jpg" alt=""/>
				 <div class="bike-cost">
					 <div class="bike-mdl">
						 <h4>NAME<span>Model:M4585</span></h4>
					 </div>
					 <div class="bike-cart">						 
						 <a class="buy" href="single.html">BUY NOW</a>
					 </div>
					 <div class="clearfix"></div>
				 </div>
				 <div class="fast-viw">
						<a href="single.html">Quick View</a>
				 </div>
			 </div></a>
			 <div class="clearfix"></div>
		 </div>
		 
	 </div>
</div>
<!---->
<div class="footer">
	 <div class="container wrap">
		<div class="logo2">
			 <a href="index.html"><img src="images/logo2.png" alt=""/></a>
		</div>
		<div class="ftr-menu">
			 <ul>
				 <li><a href="bicycles.html">BICYCLES</a></li>
				 <li><a href="parts.html">PARTS</a></li>
				 <li><a href="accessories.html">ACCESSORIES</a></li>
				 <li><a href="404.html">EXTRAS</a></li>
			 </ul>
		</div>
		<div class="clearfix"></div>
	 </div>
</div>
<!---->

</body>
</html>

