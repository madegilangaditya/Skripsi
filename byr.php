<?php	 
	include 'adminpage/koneksi.php';
		$id = $_REQUEST['id'];
		$sel =mysql_query("select * from tb_kredit where id_kredit=$id");
		$br=mysql_fetch_assoc($sel);
		$idt=$br['id_kredit'];
		$tgl=$br['tgl_pengajuan'];
		$umuka=$br['uang_muka'];
?>
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title">Pembayaran Uang Muka</h2>
        <small style="float: right;"> No Kredit:  <span><?php echo"".$idt; ?></span></small>
        <h5 class="modal-title"><?php echo "$tgl" ; ?></h5> 
    </div> 
    <form action="proses-byr.php" method="post" enctype="multipart/form-data">
		<div class="modal-body">
			<input type="hidden" name="idt" value="<?php echo "".$idt; ?>"> 
			<div id="modal-loader" style="display: none; text-align: center;">
				<img src="ajax-loader.gif">
			</div>
				<div class="cart-items" style="text-align: center;">
					<p>Jumlah Tagihan :</p>  	
				  	<h2>Rp <?php echo number_format($umuka);?></h2>
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
		</div> 
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success">Bayar</button>	
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div> 
	</form>
		
			
		