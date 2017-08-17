<?php
	session_start();
	include"adminpage/koneksi.php";
	$idj=$_REQUEST['id'];
	$id=$_SESSION['hrg'];
	$bjns=$_SESSION['bjns'];
 	$umuka=$_SESSION['umuka'];
 	$sql = mysql_query("select harga_cash from tb_harga where id_harga='$id'");
	$b = mysql_fetch_array($sql);
	$hrg = $b['harga_cash'];
	
	$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
						INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
						INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
						WHERE tb_jawu.`id_jawu`='$idj'");
	$fas=mysql_fetch_array($kmp);
	$jw=$fas['jangka_waktu'];
	$butap = $fas['bunga_tetap'];
	$burun = $fas['bunga_menurun'];
	$bia = $fas['biaya_tambahan'];
?>

<div class="modal-header"> 
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
    <h2 class="modal-title"><?php echo $fas[nama_finance]; ?></h2>
    
</div> 
<?php
	if ($bjns=="") {
		# code...
	
?>
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>

		<div class="col-md-6" style="margin-bottom: 1em;">
			<table>
				<tr>
					<th>Harga Motor</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($hrg)); ?></th>
				</tr>
				<tr>
					<th>Uang Muka</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($umuka)); ?></th>
				</tr>
				<tr>
					<th>Biaya Administrasi</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($bia)); ?></th>
				</tr>
				<tr>
					<th>Bunga</th>
					<th>:</th>
					<th style="float: right;"><?php echo "$butap"; ?>%</th>
				</tr>
			</table>
			
		</div>

		<div>

			<table class="table table-bordered">
				<tr>
					<th>Bulan ke</th>
					<th>Angsuran Pokok Per Bulan</th>
					<th>Angsuran Bunga Per Bulan</th>
					<th>Angsuran Total Per Bulan</th>
					<th>Cicilan Pokok</th>
					<th>Cicilan Bunga</th>
					<th>Cicilan Total</th>
				</tr>

				
					<?php
						
						
						
						$cipok=$hrg-$umuka+$bia;
						$btap = $cipok*$butap/100;
						$tp=round($btap);
						$angtap = $cipok/$jw+$tp;
						$angtp =round($angtap);
						$antp = number_format(doubleval($angtp));
						$angpok = round($cipok/$jw);
						$anpok = number_format(doubleval($angpok));
						$angbung = round($angtp-$angpok);
						$anbung = number_format(doubleval($angbung));
						$cibung=($angtp-$angpok)*$jw;
						$citol=$cipok+$cibung;
						//$j=1;
						for ($i=1; $i <= $jw ; $i++) { 
							# code...
							$cpok=number_format(doubleval($cipok));
							$ctol=number_format(doubleval($citol));
							$cbung=number_format(doubleval($cibung));
							echo "<tr>
								<td>$i</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antp</td>
								<td>$cpok</td>
								<td>$cbung</td>
								<td>$ctol</td>
							</tr>";
							$cipok=$cipok-$angpok;
							$cibung = $cibung-$angbung;
							$citol = $cipok+$cibung;
							
						}
						echo "<tr style='font-weight:bold;'>
								<td>Total</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antp</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>";
					?>
				
			</table>
		</div>
	     
	</div> 
<?php
	}else if ($bjns==1) {
?>
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>

		<div class="col-md-6" style="margin-bottom: 1em;">
			<table>
				<tr>
					<th>Harga Motor</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($hrg)); ?></th>
				</tr>
				<tr>
					<th>Uang Muka</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($umuka)); ?></th>
				</tr>
				<tr>
					<th>Biaya Administrasi</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($bia)); ?></th>
				</tr>
				<tr>
					<th>Bunga</th>
					<th>:</th>
					<th style="float: right;"><?php echo "$butap"; ?>%</th>
				</tr>
			</table>
			
		</div>

		<div>

			<table class="table table-bordered">
				<tr>
					<th>Bulan ke</th>
					<th>Angsuran Pokok Per Bulan</th>
					<th>Angsuran Bunga Per Bulan</th>
					<th>Angsuran Total Per Bulan</th>
					<th>Cicilan Pokok</th>
					<th>Cicilan Bunga</th>
					<th>Cicilan Total</th>
				</tr>

				
					<?php
						
						
						
						$cipok=$hrg-$umuka+$bia;
						$btap = $cipok*$butap/100;
						$tp=round($btap);
						$angtap = $cipok/$jw+$tp;
						$angtp =round($angtap);
						$antp = number_format(doubleval($angtp));
						$angpok = round($cipok/$jw);
						$anpok = number_format(doubleval($angpok));
						$angbung = round($angtp-$angpok);
						$anbung = number_format(doubleval($angbung));
						$cibung=($angtp-$angpok)*$jw;
						$citol=$cipok+$cibung;
						//$j=1;
						for ($i=1; $i <= $jw ; $i++) { 
							# code...
							$cpok=number_format(doubleval($cipok));
							$ctol=number_format(doubleval($citol));
							$cbung=number_format(doubleval($cibung));
							echo "<tr>
								<td>$i</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antp</td>
								<td>$cpok</td>
								<td>$cbung</td>
								<td>$ctol</td>
							</tr>";
							$cipok=$cipok-$angpok;
							$cibung = $cibung-$angbung;
							$citol = $cipok+$cibung;
							
						}
						echo "<tr style='font-weight:bold;'>
								<td>Total</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antp</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>";
					?>
				
			</table>
		</div>
	     
	</div> 
<?php
	}else if ($bjns==2) {
?>
	<div class="modal-body"> 
		<div id="modal-loader" style="display: none; text-align: center;">
			<img src="ajax-loader.gif">
		</div>

		<div class="col-md-6" style="margin-bottom: 1em;">
			<table>
				<tr>
					<th>Harga Motor</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($hrg)); ?></th>
				</tr>
				<tr>
					<th>Uang Muka</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($umuka)); ?></th>
				</tr>
				<tr>
					<th>Biaya Administrasi</th>
					<th>:</th>
					<th style="float: right;"><?php echo number_format(doubleval($bia)); ?></th>
				</tr>
				<tr>
					<th>Bunga</th>
					<th>:</th>
					<th style="float: right;"><?php echo "$burun"; ?>%</th>
				</tr>
			</table>
			
		</div>

		<div>

			<table class="table table-bordered">
				<tr>
					<th>Bulan ke</th>
					<th>Angsuran Pokok Per Bulan</th>
					<th>Angsuran Bunga Per Bulan</th>
					<th>Angsuran Total Per Bulan</th>
					<th>Cicilan Pokok</th>
					<th>Total Bunga</th>
					
				</tr>

				
					<?php
						
						
						
						$cipok=$hrg-$umuka+$bia;
						$btap = $cipok*$burun/100;
						$tp=round($btap);
						$angtap = $cipok/$jw+$tp;
						$angtp =round($angtap);
						$antp = number_format(doubleval($angtp));
						$angpok = round($cipok/$jw);
						$anpok = number_format(doubleval($angpok));
						$angbung = round($angtp-$angpok);
						$anbung = number_format(doubleval($angbung));
						$cibung=$angbung;
						$citol=$cipok+$cibung;
						$angtol=$btap;
						//$j=1;
						for ($i=1; $i <= $jw ; $i++) { 
							# code...
							$cpok=number_format(doubleval($cipok));
							$ctol=number_format(doubleval($citol));
							$cbung=number_format(doubleval($cibung));
							echo "<tr>
								<td>$i</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antp</td>
								<td>$cpok</td>
								<td>$cbung</td>
								
							</tr>";
							$cipok=$cipok-$angpok;
							$angbung=round($cipok*$burun/100);
							$anbung = number_format(doubleval($angbung));
							$angtap = round($angpok+$angbung);
							$antp = number_format(doubleval($angtap));
							$cibung = $cibung+$angbung;
							$citol = $cipok+$cibung;
							$angtol += $angtap;
							
							$antl = number_format(doubleval($angtol));
							
						}
						//$angtol = $angtol-$angpok;
						echo "<tr style='font-weight:bold;'>
								<td>Total</td>
								<td>$anpok</td>
								<td>$anbung</td>
								<td>$antl</td>
								<td>0</td>
								<td>$cbung</td>
								
							</tr>";
					?>
				
			</table>
		</div>
	     
	</div> 
<?php
	}
?>

<div class="modal-footer"> 
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
</div>