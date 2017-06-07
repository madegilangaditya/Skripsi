<?php	 
	include 'adminpage/koneksi.php';
		$id = $_REQUEST['id'];
		$query = "SELECT tb_harga.id_dealer, tb_dealer.nama_dealer, tb_dealer.alamat, tb_dealer.id_kecamatan, tb_dealer.telp, tb_fasilitas.* FROM tb_harga 
		INNER JOIN tb_dealer ON tb_harga.id_dealer = tb_dealer.id_dealer 
		INNER JOIN tb_fasilitas ON tb_harga.id_harga = tb_fasilitas.id_harga WHERE tb_harga.id_harga='$id'";
		$stmt = mysql_query($query);
		
		$row=mysql_fetch_array($stmt);
		$kec = $row['id_kecamatan'];
		$cek = mysql_query("select tb_kecamatan.nama_kecamatan, tb_kecamatan.id_kabupaten, tb_kabupaten.nama_kabupaten, tb_kabupaten.id_provinsi, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten 
			 		on tb_kecamatan.id_kabupaten = tb_kabupaten.id_kabupaten
			 		inner join tb_provinsi
			 		on tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi where id_kecamatan='$kec'");
		$row1=mysql_fetch_array($cek);
		$keca=$row1['nama_kecamatan'];
		$kab=$row1['nama_kabupaten'];
		$prov=$row1['nama_provinsi'];
			
?>
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title"><?php echo $row[nama_dealer]; ?></h2>
        <h5 class="modal-title"><?php echo "$row[alamat], Kec. $keca, Kab $kab, Prov $prov" ; ?></h5> 
    </div> 
    
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>
	                        
		<div>
			<h5 style="font-weight: bold;">Fasilitas Dealer</h5>
			<li>Gratis Servis <?php echo $row[servis]; ?> Kali</li>
			<li><?php if($row[helm]==1){echo "Gratis Helm";}else{echo "Tidak Dapat Helm Gratis";}  ?></li>
			<li>Proses BPKB <?php echo $row[bpkb]; ?> Minggu</li>
		</div>
	     
	</div> 

    <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
    </div> 
		
			
		