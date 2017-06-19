<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	$umuka = $_GET['umuka'];
	$id = $_SESSION['hrg'];
	$sql = mysql_query("select harga_cash from tb_harga where id_harga='$id'");
	$b = mysql_fetch_array($sql);
	$hrg = $b['harga_cash'];
	//$_SESSION['umuka']=$umuka;
	$bjns = $_GET['bjns'];
?>
<?php
	if ($bjns=="") {
		# code...
	
?>
<table class="table table-bordered">
	<h3 style="text-align: center; margin: 1em;">Bunga Tetap</h3>
	<thead>
		<tr>
	  		<th>Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.id_finance");
		  		$jum_fi = mysql_num_rows($sel2);
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf</th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select  jangka_waktu from tb_bunga group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
				
		?>
		<tr>
			<?php		
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select id_bunga, id_finance from tb_bunga where jangka_waktu='$jawu'");
				
				$jumjw = mysql_num_rows($sel3);
				if ($jumjw<$jum_fi) {
					echo "<td>---</td>";
					while ( $br = mysql_fetch_array($sel3)) {
						
						$sel1= mysql_query("select  bunga_tetap, biaya_tambahan from tb_bunga where id_finance=$br[id_finance] group by id_finance");
						
						while ($br1 = mysql_fetch_array($sel1)) {
							
							$butap = $br1['bunga_tetap'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$btap = $hr*$butap/100;
							$tp=round($btap);
							$angtap = $hr/$jawu+$tp;
							$angtp =number_format (round($angtap));

							echo "<td>Rp $angtp  
							<input name='$br[id_bunga]' type='hidden' value='$angtp'>
							<input name='jns' type='hidden' value=1>
							<button type='submit'class='btn btn-success' name='btnbt$br[id_bunga]' value='$br[id_bunga]' style='float:right;'>Buy</button>
							</td>";
						}
					}

				}else{
					while ( $br = mysql_fetch_array($sel3)) {
						
						$sel1= mysql_query("select  bunga_tetap, biaya_tambahan from tb_bunga where id_finance=$br[id_finance] group by id_finance");
						
						while ($br1 = mysql_fetch_array($sel1)) {
							
							$butap = $br1['bunga_tetap'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$btap = $hr*$butap/100;
							$tp=round($btap);
							$angtap = $hr/$jawu+$tp;
							$angtp =number_format (round($angtap));

							echo "<td>Rp $angtp  
							<input name='$br[id_bunga]' type='hidden' value='$angtp'>
							<input name='jns' type='hidden' value=1>
							<button type='submit'class='btn btn-success' name='btnbt$br[id_bunga]' value='$br[id_bunga]' style='float:right;'>Buy</button>
							</td>";
						}
					}
				}
					
					
				}
			?>
		</tr>
	</tbody>
</table>
<?php
	}else if ($bjns==1) {
		# code...
	
?>
<table class="table table-bordered">
	<h3 style="text-align: center; margin: 1em;">Bunga Tetap</h3>
	<thead>
		<tr>
	  		<th>Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.nama_finance");
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf</th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select  jangka_waktu from tb_bunga group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
				
		?>
		<tr>
			<?php		
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select id_bunga, id_finance from tb_bunga where jangka_waktu='$jawu'");
					if (mysql_num_rows($sel3)=="") {
						echo "<td>-</td>";
					}
					while ( $br = mysql_fetch_array($sel3)) {
						
						$sel1= mysql_query("select  bunga_tetap, biaya_tambahan from tb_bunga where id_finance=$br[id_finance] group by id_finance");
						while ($br1 = mysql_fetch_array($sel1)) {
							
							$butap = $br1['bunga_tetap'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$btap = $hr*$butap/100;
							$tp=round($btap);
							$angtap = $hr/$jawu+$tp;
							$angtp =number_format (round($angtap));

							echo "<td>Rp $angtp  <input name='$br[id_bunga]' type='hidden' value='$angtp'><input name='jns' type='hidden' value=1><button type='submit'class='btn btn-success' name='btnbt$br[id_bunga]' value='$br[id_bunga]' style='float:right;'>Buy</button></td>";
						}
					}
				}
			?>
		</tr>
	</tbody>
</table>
<?php
	}else{


?>

<table class="table table-bordered">
	<h3 style="text-align: center; margin: 1em;">Bunga Menurun</h3>
	<thead>
		<tr>
	  		<th>Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.nama_finance");
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf</th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select jangka_waktu from tb_bunga group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
		?>

		<tr>
			<?php			
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select id_bunga, id_finance from tb_bunga where jangka_waktu='$jawu'");
					if (mysql_num_rows($sel3)=="") {
						echo "<td>-</td>";
					}
					while ( $br = mysql_fetch_array($sel3)) {
						
						$sel1= mysql_query("select bunga_menurun, biaya_tambahan from tb_bunga where id_finance=$br[id_finance] group by id_finance");
						while ($br1 = mysql_fetch_array($sel1)) {
							# code...
							//$butap = $br1['bunga_tetap'];
							$burun = $br1['bunga_menurun'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$brun = $hr*$burun/100;
							$tb=round($brun);
							$angrun = $hr/$jawu+$tb;
							$angrn = number_format (round($angrun));

						
						echo "<td>Rp $angrn  <input name='$br[id_bunga]' type='hidden' value='$angrn'><input name='jns' type='hidden' value=2><button type='submit'class='btn btn-success' name='btnbn$br[id_bunga]' value='$br[id_bunga]' style='float:right;'>Buy</button></td>";
						}
					}
				}
			?>
		</tr>
	</tbody>
</table>
<?php
	}
?>
