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
		 		<div class=" cart-items">
					<?php
					   	$sql = mysql_query("select * from tb_transaksi where id_transaksi = (select MAX(id_transaksi) from tb_transaksi)");
					   	$row=mysql_fetch_array($sql);
						$idt=$row['id_transaksi'];
						$idp=$row['id_pelanggan'];
						$sts = $row['status'];
						if($sts==1){
							$a="Lunas";
						}else{
							$a="Menunggu Pembayaran";
						}
						$harga = $row['jumlah_harga'];
						$sql1=mysql_query("select * from tb_pelanggan where id_pelanggan=$idp");
						$row1=mysql_fetch_array($sql1);
						$nama=$row1['nama_pelanggan'];
						$alamat=$row1['alamat'];
						$telp=$row1['telp'];
						$kec=$row1['id_kecamatan'];
						$sql2=mysql_query("select tb_kecamatan.nama_kecamatan, tb_kabupaten.nama_kabupaten, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten on tb_kecamatan.id_kabupaten=tb_kabupaten.id_kabupaten
							inner join tb_provinsi on 
							tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi
							where tb_kecamatan.id_kecamatan=$kec");
						$row2=mysql_fetch_array($sql2);
					?>
			 		<h2>Detail Transaksi <small style="float: right;"> No Transaksi:  <span><?php echo"".$idt; ?></span></small> </h2>
				
				   	<?php
					 	$idl=$_SESSION['idl'];
					 	
					 	$sql=mysql_query("select tb_det_transaksi.id_det_transaksi, tb_det_transaksi.jumlah, tb_det_transaksi.id_harga,  tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.gambar, tb_warna.warna, tb_dealer.nama_dealer from tb_det_transaksi 
					 		inner join tb_harga on tb_harga.id_harga = tb_det_transaksi.id_harga
					 		inner join tb_warna on tb_warna.id_warna = tb_det_transaksi.id_warna 
					 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
					 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_det_transaksi.id_transaksi = $idt ");
					 	$i=1;
					 	$total=0;
					 	echo "<div class='cart-header col-md-12'>";
					 	while($bar=mysql_fetch_array($sql)){
					 		$jumlah=$bar['jumlah'];
							$jumlah_harga = $bar['harga_cash'] *  $jumlah;
		        			$total = $jumlah_harga + $total;
					 		$unik = $harga - $total; 

							$hrg=number_format($jumlah_harga, 0, ".", ".");

							echo "<div class='cart-header col-md-6'>
						
						 <div class='cart-sec col-md-12'>
								<div class='cart-item cyc' style='width:40%'>
									 <img class='img-responsive'src='adminpage/$bar[gambar]'/>
								</div>
							   <div class='cart-item-info' style='width:45%; border-bottom:0px;'>
									 <h3>$bar[nama_det_motor]<span>Dealer: $bar[nama_dealer]</span></h3>
									 <h4 style='display:block;margin-right:10px;'><span>Rp </span>$hrg</h4>
									 <p class='qty'>Jumlah ::<p class='qty'>$jumlah</p></p>
									 <p class='qty'>Warna ::<p class='qty'>$bar[warna]</p></p>
									 
									 
							   </div>
							   <div class='clearfix'></div>
											
						  	</div>
					 	</div>";
					 
					 	}
				 	?>
			    </div>

				<div class="price-details col-md-6" style="border-bottom: 0px;" >
					<h3 style="font-weight: bold;">Data Penerima</h3>
					<span>Nama</span>
					<span class="total"><?php echo "$nama"; ?></span>
					<span>Telp</span>
					<span class="total"><?php echo "$telp"; ?></span>
					<span>Alamat</span>
					<span class="total"><?php echo "$alamat"; ?></span>
					<span>Kecamatan</span>
					<span class="total"><?php echo "$row2[nama_kecamatan]"; ?></span>
					<span>Kabupaten</span>
					<span class="total"><?php echo "$row2[nama_kabupaten]"; ?></span>
					<span>Provinsi</span>
					<span class="total"><?php echo "$row2[nama_provinsi]"; ?></span>
					<span>Status</span>
					<span class="total"><?php echo "$a"; ?></span>
					<div class="clearfix"></div>				 
				</div>

				<div class="price-details col-md-6" >
					<h3 style="font-weight: bold;">Price Details</h3>
					<span>Total</span>
					<span class="total">Rp <?php echo number_format($total); ?></span>
					<span>Kode Unik</span>
					<span class="total">Rp <?php echo number_format($unik); ?></span>
					<!--span>Delivery Charges</span>
					<span class="total">150.00</span-->
					<div class="clearfix"></div>				 
				</div>

				<h4 class="last-price" style="width: 25%;">TOTAL</h4>
				<span class="total final" style="width: 25%;">Rp <?php echo number_format($harga); ?></span>
				<div class="clearfix"></div>
				<a class="order" href="merk.php" style="margin-top: 10px; margin-left: 1.5%;width: 15%;">Belanja Lagi</a> 
		 	</div>
	 	</div>
	<?php
		include "footer.php";
	?>
	</body>
</html>