<?php	 
	include 'adminpage/koneksi.php';
		$id = $_REQUEST['id'];
		$sql = mysql_query("select * from tb_kredit where id_kredit = '$id'");
	   	$row=mysql_fetch_array($sql);
		$idt=$row['id_kredit'];
		$idp=$row['id_pelanggan'];
		$sts = $row['status'];
		$umuka = $row['uang_muka'];
		$ang = $row['angsuran'];
		if ($row['jenis']==1) {
			$jns="Bunga Tetap";
		}else{
			$jns="Bunga Menurun";
		}
		$tgl = date("d F Y H:i:s", strtotime($row['tgl_pengajuan']));
		if ($sts==1) {
			$a= "Belum Disurvey";
			} else if ($sts==2) {
				$a= "Menunggu Konfirmasi";
			}else if ($sts==3) {
				$a= "Diterima";
			}else if ($sts==4) {
				$a= "Ditolak";
			}else{
				$a= "Lunas";
		}
		$harga = $row['angsuran_pokok'];
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
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title">Detail Kredit  </h2>
        <small style="float: right;"> No Kredit:  <span><?php echo"".$idt; ?></span></small>
        <h5 class="modal-title"><?php echo "$tgl" ; ?></h5> 
    </div> 
    
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>
	                        
		<div>
			<?php
			 	$idl=$_SESSION['idl'];
			 	
			 	$sql=mysql_query("SELECT tb_kredit.id_harga, tb_jawu.jangka_waktu, tb_harga.harga_cash, tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.gambar, tb_warna.warna, tb_dealer.nama_dealer, tb_finance.`nama_finance` FROM tb_kredit 
			 		INNER JOIN tb_harga ON tb_harga.id_harga = tb_kredit.id_harga
			 		INNER JOIN tb_warna ON tb_warna.id_warna = tb_kredit.id_warna
			 		INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu`
			 		INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
			 		INNER JOIN tb_finance ON tb_finance.id_finance= tb_bunga.id_finance
			 		INNER JOIN tb_det_motor ON tb_harga.id_det_motor = tb_det_motor.id_det_motor 
			 		INNER JOIN tb_dealer ON tb_dealer.id_dealer = tb_harga.id_dealer 
			 		
			 		WHERE tb_kredit.id_kredit =$idt ");
			 	$i=1;
			 	$total=0;
			?>
			<div class='cart-header col-md-12'>
				<?php
				 	 
				 	while($bar=mysql_fetch_array($sql)){
				 		$jumlah=1;
						$jumlah_harga = $bar['harga_cash'] *  $jumlah;
	        			$total = $jumlah_harga + $total;
				 		//$unik = $harga - $total; 
	        			$namaf=$bar['nama_finance'];
	        			$jawu=$bar['jangka_waktu'];
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
				 	</div>
				 	";
				 
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


			<div class="price-details col-md-6" style="border-bottom: 0px;">
				<h3 style="font-weight: bold;">Pilihan Kredit</h3>
				<span>Nama Finance</span>
				<span class="total"><?php echo $namaf; ?></span>
				<span>Jenis Kredit</span>
				<span class="total"><?php echo $jns; ?></span>
				<span>Jangka Waktu</span>
				<span class="total"><?php echo $jawu; ?> Bulan</span>
				<span>Harga Motor</span>
				<span class="total">Rp <?php echo number_format($total); ?></span>
				<span>Uang Muka</span>
				<span class="total">Rp <?php echo number_format($umuka); ?></span>
				<span>Angsuran Pokok</span>
				<span class="total">Rp <?php echo number_format($harga); ?></span>
				<span>Angsuran</span>
				<span class="total">Rp <?php echo number_format($ang); ?></span>
				<!--span>Delivery Charges</span>
				<span class="total">150.00</span-->
				<div class="clearfix"></div>				 
			</div>

			<div class="clearfix"></div>
		</div>
	     
	</div> 

    <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
    </div> 
		
			
		