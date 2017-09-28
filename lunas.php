<?php	 
	include 'adminpage/koneksi.php';
		$id = $_REQUEST['id'];
		$ck=$_REQUEST['ck'];
		$sel = mysql_query("SELECT MIN(sisa_pokok) as sispok FROM tb_det_angsuran WHERE id_angsuran='$id'");
		$br= mysql_fetch_array($sel);
		$sh = $br['sispok'];
		$cek = mysql_query("SELECT tb_jawu.`jangka_waktu`, tb_kredit.`angsuran_pokok`, tb_bunga.bunga_tetap FROM tb_angsuran
			INNER JOIN tb_survey ON tb_survey.`id_survey`=tb_angsuran.`id_survey`
			INNER JOIN tb_kredit ON tb_kredit.id_kredit=tb_survey.id_kredit
			INNER JOIN tb_jawu ON tb_jawu.`id_jawu`=tb_kredit.`id_jawu`
			inner join tb_bunga on tb_bunga.id_bunga = tb_jawu.id_bunga
			WHERE tb_angsuran.`id_angsuran`='$id'");	
		$bar = mysql_fetch_array($cek);
		$jawu = $bar['jangka_waktu'];
		$bng = $bar['bunga_tetap'];
		$angpok = $bar['angsuran_pokok'];
		$sjw = $jawu - $ck;
		$bng_pok=$bng/100*$angpok*$sjw;
		$pin = round(5/100*$sh);
		$pelunas = $sh+$bng_pok+$pin;
		$sel1 = mysql_query("SELECT MAX(id_det_angsuran) as idt FROM tb_det_angsuran WHERE id_angsuran='$id'");
		$brt=mysql_fetch_array($sel1);
		$idt=$brt['idt'];
		echo "$bng_pok; $sjw; $bng; $angpok; $pin; $pelunas; $sh; $idt;";


?>
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title">Pelunasan Cicilan</h2>
        <small style="float: right;">No. Pembayaran: <span><?php echo"".$idt; ?></span></small>
        <h5 class="modal-title"><?php echo "$tgl" ; ?></h5> 
    </div> 
    <form action="proses-byr.php" method="post" enctype="multipart/form-data">
		<div class="modal-body">
			<input type="hidden" name="idt" value="<?php echo "".$idt; ?>">
			<input type="hidden" name="st" value="3">
			<input type="hidden" name="pelu" value="<?php echo "".$pelunas; ?>"> 
			<div id="modal-loader" style="display: none; text-align: center;">
				<img src="ajax-loader.gif">
			</div>
			<div class="price-details col-md-12" style="border-bottom: 1px solid; margin-bottom: 2em;" >
				<h3 style="font-weight: bold;">Rincian Pelunasan</h3>
				<span style="width: 30%;">Sisa Cicilan Pokok</span>
				<span class="total">Rp<?php echo number_format($sh); ?></span>
				<span style="width: 30%;">Sisa Bunga</span>
				<span class="total">Rp<?php echo number_format($bng_pok); ?></span>
				<span style="width: 30%;">Penalty</span>
				<span class="total">Rp<?php echo number_format($pin); ?></span>
				<div class="clearfix"></div>				 
			</div>
				<div class="cart-items" style="text-align: center; margin-top: 1em;">
					<p>Total Tagihan :</p>  	
				  	<h2>Rp <?php echo number_format($pelunas);?></h2>
					<div class="col-md-6 " style="text-align: center; padding-top: 20px; padding-bottom: 20px; ">
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
				<label class="control-label">Foto Struk Pembayaran:</label>
	            <input type="file" name="byr" >
	            <p class="help-block">Foto Struk Pembayaran</p>

	            <label class="control-label">Total Bayar:</label>
	            <input type="number" name="ttl" placeholder="Total Bayar" class="form-control" style="width: 35%;">
		</div> 
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success">Bayar</button>	
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div> 
	</form>
		
			
		