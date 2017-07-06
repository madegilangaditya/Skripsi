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
					   	$sql = mysql_query("select tb_kredit.*, tb_jawu.jangka_waktu, tb_finance.`nama_finance`, tb_surveyor.nama_surveyor from tb_kredit 
					   		inner join tb_jawu on tb_jawu.id_jawu = tb_kredit.id_jawu
					   		INNER JOIN tb_bunga ON tb_bunga.id_bunga= tb_jawu.`id_bunga`
							INNER JOIN tb_finance ON tb_bunga.id_finance= tb_finance.`id_finance`
							inner join tb_surveyor on tb_surveyor.id_surveyor = tb_kredit.id_surveyor
					   		where id_kredit = (select MAX(id_kredit) from tb_kredit)");
					   	$row=mysql_fetch_array($sql);
						$idt=$row['id_kredit'];
						$idp=$row['id_pelanggan'];
						$idh = $row['id_harga'];
						$jns = $row['jenis'];
						$nsuv = $row['nama_surveyor'];
						$namaf = $row['nama_finance'];

						if($jns==1){
							$a="Bunga Tetap";
						}else{
							$a="Bunga Menurun";
						}
						
						$jw = $row['jangka_waktu'];
						$ang = $row['angsuran'];
						$angpok = $row['angsuran_pokok'];
						$umuka = $row['uang_muka'];
						$status = $row['status'];
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
			 		<h2>Detail Pengajuan Kredit <small style="float: right;"> No Kredit:  <span><?php echo"".$idt; ?></span></small> </h2>
				
				   	<?php
					 	$idl=$_SESSION['idl'];
					 	
					 	$sql=mysql_query("select tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.gambar, tb_warna.warna, tb_dealer.nama_dealer from tb_kredit 
					 		inner join tb_harga on tb_harga.id_harga = tb_kredit.id_harga
					 		inner join tb_warna on tb_warna.id_warna = tb_kredit.id_warna 
					 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
					 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_kredit.id_kredit = $idt ");
					 	$i=1;
					 	$total=0;
					 	echo "<div class='cart-header col-md-12'>";
					 	while($bar=mysql_fetch_array($sql)){
					 		$jumlah=$bar['jumlah'];
							$jumlah_harga = $bar['harga_cash'] *  $jumlah;
		        			$total = $jumlah_harga + $total;
					 		$unik = $harga - $total; 

							$hrg=number_format($bar[harga_cash], 0, ".", ".");

							echo "<div class='cart-header col-md-6'>
						
						 <div class='cart-sec col-md-12'>
								<div class='cart-item cyc' style='width:40%'>
									 <img class='img-responsive'src='adminpage/$bar[gambar]'/>
								</div>
							   <div class='cart-item-info' style='width:45%; border-bottom:0px;'>
									 <h3>$bar[nama_det_motor]<span>Dealer: $bar[nama_dealer]</span></h3>
									 <h4 style='display:block;margin-right:10px;'><span>Rp </span>$hrg</h4>
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
					<span class="total">Belum di Survey</span>
					<div class="clearfix"></div>				 
				</div>

				<div class="price-details col-md-6" style="border-bottom: 0px;" >
					<h3 style="font-weight: bold;">Pilihan Angsuran</h3>
					<span>Jenis Angsuran</span>
					<span class="total"><?php echo $a; ?></span>
					<span>Nama Finance</span>
					<span class="total"><?php echo $namaf; ?></span>
					<span>Surveyor</span>
					<span class="total"><?php echo $nsuv; ?></span>
					<span>Jangka Waktu</span>
					<span class="total"><?php echo $jw; ?> Bulan</span>
					<span>Angsuran Pokok</span>
					<span class="total">Rp <?php echo number_format($angpok); ?></span>
					<span>Angsuran</span>
					<span class="total">Rp <?php echo number_format($ang); ?></span>
					<!--span>Delivery Charges</span>
					<span class="total">150.00</span-->
					<div class="clearfix"></div>				 
				</div>

				<!--h4 class="last-price" style="width: 25%;">TOTAL</h4>
				<span class="total final" style="width: 25%;">Rp <?php echo number_format($harga); ?></span-->
				<div class="clearfix"></div>
			
		 	</div>
	 	</div>

	 	<div class="cart" style="background: #f8f8f8;">
			<div class="container" style="background: #ffffff;">
				<div class="cart-items">
					<h2>Pembayaran Uang Muka Via Transfer</h2>
					<div class="cart-items" style="text-align: center;">
						<p>Jumlah Tagihan :</p>  	
					  	<h2>Rp <?php echo number_format($umuka);?></h2>
					</div>
					<p>Pembayaran kredit dapat dilakukan ke salah satu rekening berikut:</p>
					 
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
				 	 
				 	 <a class="order" href="merk.php">Belanja Lagi</a>
		                    
		             
				</div>
			</div> 
		</div>
	<?php
		include "footer.php";
	?>
	</body>
</html>