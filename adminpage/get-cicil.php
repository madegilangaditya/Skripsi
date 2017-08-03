<?php	 
	include 'koneksi.php';
		$id = $_REQUEST['id'];
		//$st=$_REQUEST['st'];
		
			$sel =mysql_query("select * from tb_det_angsuran where id_det_angsuran=$id");
			$br=mysql_fetch_assoc($sel);
			$idt=$br['id_det_angsuran'];
			$tgl=$br['tgl_jatuh_tempo'];
			$ang=$br['angsuran'];
			$dnd=$br['denda'];
			$umuka=$ang+$dnd;
			$sl=mysql_query("select * from tb_bayar where id=$idt and jenis=1");
			$bar=mysql_fetch_array($sl);
?>
	<div class="modal-header"> 
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <h2 class="modal-title">Pembayaran Cicilan</h2>
        <small style="float: right;">No Pembayaran:<span><?php echo"".$idt; ?></span></small>
        <h5 class="modal-title"><?php echo "$tgl" ; ?></h5> 
    </div> 
    <form action="konfirmasi-cicil.php" method="post" enctype="multipart/form-data">
		<div class="modal-body">
			<input type="hidden" name="idt" value="<?php echo "".$idt; ?>">
			<input type="hidden" name="st" value="<?php echo "".$st; ?>"> 
			<div id="modal-loader" style="display: none; text-align: center;">
				<img src="ajax-loader.gif">
			</div>
				<div class="cart-items" style="text-align: center;">
					<p>Jumlah Tagihan :</p>  	
				  	<h2>Rp <?php echo number_format($umuka);?></h2>
					
				</div>
				<label class="control-label">Foto Struk Pembayaran:</label>
				<br><img src="../<?php echo"$bar[gmb_struk]"; ?>" width="300">
	            
		</div> 
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success">Konfirmasi</button>	
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div> 
	</form>
		
			
		