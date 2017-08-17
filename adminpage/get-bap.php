<style type="text/css">
	#plg{
		padding: 0px !important;
	}
</style>
<?php	 
	include 'koneksi.php';
		$id = $_REQUEST['id'];
		$sql = mysql_query("SELECT tb_kredit.*, tb_finance.nama_finance,
			tb_harga.harga_cash, tb_harga.id_det_motor, tb_det_motor.nama_det_motor, 
			tb_warna.warna, tb_dealer.nama_dealer, tb_jawu.jangka_waktu, tb_bunga.biaya_tambahan FROM tb_kredit 
			INNER JOIN tb_harga ON tb_harga.`id_harga`=tb_kredit.`id_harga`
			INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu`
			INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
			INNER JOIN tb_finance ON tb_bunga.`id_finance`=tb_finance.`id_finance`
			INNER JOIN tb_warna ON tb_warna.`id_warna`=tb_kredit.`id_warna`
			INNER JOIN tb_dealer ON tb_dealer.`id_dealer`=tb_harga.`id_dealer` 
			INNER JOIN tb_det_motor ON tb_det_motor.`id_det_motor`=tb_harga.`id_det_motor` WHERE id_kredit = '$id'");
	   	$row=mysql_fetch_array($sql);
	   	$namaf = $row['nama_finance'];
		$idt=$row['id_kredit'];
		$idp=$row['id_pelanggan'];
		$idj = $row['id_jawu'];
		$idh = $row['id_harga'];
		$wrn = $row['warna'];
		$jawu = $row['jangka_waktu'];
		$mtor = $row['nama_det_motor'];
		$namad = $row['nama_dealer'];
		$jns = $row['jenis'];
		$bitam = $row['biaya_tambahan'];
		if ($jns==1) {
			$bng = "Bunga Tetap";
		}else{
			$bng = "Bunga Menurun";
		}
		$ang = $row['angsuran'];
		$angpok = $row['angsuran_pokok'];
		$umuka = $row['uang_muka'];

		$sts = $row['status'];
		$tgl = date("d F Y H:i:s", strtotime($row['tgl_pengajuan']));
		if($sts==1){
			$a="Belum Di Survey";
		}else{
			$a="Menunggu Pembayaran";
		}
		$harga = $row['harga_cash'];
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
			 	
			 	$sql=mysql_query("select tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.warna, tb_dealer.nama_dealer from tb_harga 
			 		inner join tb_warna on tb_warna.id_warna = tb_det_transaksi.id_warna 
			 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
			 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_det_transaksi.id_transaksi = $idt ");
			 	$i=1;
			 	$total=0;
			?>
			<div class='cart-header col-md-12'>
				<?php
				 	 
				 	
						/*echo "<div class='cart-header col-md-6'>
					
					 <div class='cart-sec col-md-12'>
							<div class='cart-item cyc' style='width:40%'>
								 <img class='img-responsive'src='$bar[gambar]'/>
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
				 	";*/
				 
				 	
			 	?>
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th>No</th>
			 				<th>Nama Barang</th>
			 				<th>Nama Dealer</th>
			 				<th>Warna</th>
			 				<th>Jangka Waktu</th>
			 				<th>Jenis Angsuran</th>
			 				<th>Harga</th>
			 			</tr>
			 		</thead>
			 		<tbody>
 				<?php
 					$i=1;
 					
				 		$jumlah=$bar['jumlah'];
						$jumlah_harga = $bar['harga_cash'] *  $jumlah;
	        			$total = $jumlah_harga + $total;
				 		$unik = $harga - $total; 

						$hrg=number_format($jumlah_harga, 0, ".", ".");
						
				?>
			 			<tr>
			 				<td><?php echo $i; ?></td>
			 				<td><?php echo $mtor; ?></td>
			 				<td><?php echo $namad; ?></td>
			 				<td><?php echo $wrn; ?></td>
			 				<td><?php echo $jawu; ?> Bulan</td>
			 				<td><?php echo $bng; ?></td>
			 				<td style="width: 143px; text-align: right;"><?php echo number_format($harga); ?></
			 			</tr>
			 			
			 		</tbody>
			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Uang Muka</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($umuka); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Biaya Tambahan</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($bitam); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Angsuran Pokok</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($angpok); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>

			 		<table class="table table-bordered">
			 			<tbody>
			 			<tr>
			 				<th style="text-align: center;">Angsuran</th>
			 				
			 				<th style="width: 143px; text-align: right;"><?php echo number_format($ang); ?></th>
			 			</tr>
			 		</tbody>
			 		</table>
			 		
			 	</table>
			 	
		 	</div>
			<div class="price-details col-md-12" style="border-bottom: 0px;" >
				<h4 style="font-weight: bold; margin-top: 1em; margin-bottom: 1em;">Data Penerima</h4>
				<table class="table">
					<tr>
						<td id="plg">Nama</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$nama"; ?></td>
					</tr>
					<tr>
						<td id="plg">Telp</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$telp"; ?></td>
					</tr>
					<tr>
						<td id="plg">Alamat</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$alamat"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kecamatan</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_kecamatan]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Kabupaten</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_kabupaten]"; ?></td>
					</tr>
					<tr>
						<td id="plg">Provinsi</td>
						<td id="plg">:</td>
						<td id="plg"><?php echo "$row2[nama_provinsi]"; ?></td>
					</tr>
					
				</table>
				
				<div class="clearfix"></div>				 
			</div>
			<div class="clearfix"></div>
		</div>
	    <p style="margin-top: 2em;">Dengan ini menyatakan bahwa BPKB sudah dikirim ke <?php echo "$namaf"; ?></p>
	</div> 

    <div class="modal-footer">
    	<a class='btn btn-success' href='konfirmasi-kirim2.php?id=<?php echo $id; ?>' >Konfirmasi</a> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
    </div> 
		
			
		