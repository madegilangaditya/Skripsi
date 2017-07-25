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
	  		<th style="vertical-align: top;">Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.`id_finance`, tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.id_finance");
		  		$jum_fi = mysql_num_rows($sel2);
		  		$id_fi_arr = array();
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			array_push($id_fi_arr, $bar2['id_finance']); 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf <button data-toggle='modal' data-target='#view-modal' data-id='$baris[id_harga]' id='getUser' class='btn btn-info' style='float:right;'>Fasilitas</button></th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select id_bunga, jangka_waktu from tb_jawu group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
				
		?>
		<tr>
			<?php		
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select tb_bunga.id_bunga, tb_bunga.id_finance, tb_jawu.id_jawu from tb_bunga inner join tb_jawu on tb_bunga.id_bunga=tb_jawu.id_bunga where tb_jawu.jangka_waktu='$jawu' group by tb_bunga.id_finance");

				$jumjw = mysql_num_rows($sel3);
				//if ($jumjw<$jum_fi) {
					//$id_fi=1;
					$id_fi_sel3_arr = array();
					$id_bunga_sel3_arr = array();
					while ( $br = mysql_fetch_array($sel3)) {
						array_push($id_fi_sel3_arr, $br['id_finance']);
						array_push($id_bunga_sel3_arr, $br['id_jawu']);
						
					}
					$counter=0;
					for($x=0; $x<count($id_fi_arr); $x++){
						if  (in_array($id_fi_arr[$x], $id_fi_sel3_arr)){
							$sel1= mysql_query("select  bunga_tetap, biaya_tambahan from tb_bunga where id_finance=$id_fi_arr[$x] ");
					
							$br1 = mysql_fetch_array($sel1);
							
							$butap = $br1['bunga_tetap'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$btap = $hr*$butap/100;
							$tp=round($btap);
							$angtap = $hr/$jawu+$tp;
							$angtp =round($angtap);
							$antp = number_format(doubleval($angtp));

							echo "<td>Rp $antp  
							<input name='$id_bunga_sel3_arr[$counter]' type='hidden' value='$angtp'>
							<input name='jns' type='hidden' value=1>
							<button type='submit'class='btn btn-success' name='btn$id_bunga_sel3_arr[$counter]' value='$id_bunga_sel3_arr[$counter]' style='float:right;'>Buy</button>
							</td>";
							$counter++;
						}  else{
							echo "<td>-</td>";

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
	  		<th style="vertical-align: top;">Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.`id_finance`, tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.id_finance");
		  		$jum_fi = mysql_num_rows($sel2);
		  		$id_fi_arr = array();
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			array_push($id_fi_arr, $bar2['id_finance']); 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf <button data-toggle='modal' data-target='#view-modal' data-id='$baris[id_harga]' id='getUser' class='btn btn-info' style='float:right;'>Fasilitas</button></th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select id_bunga, jangka_waktu from tb_jawu group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
				
		?>
		<tr>
			<?php		
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select tb_bunga.id_bunga, tb_bunga.id_finance, tb_jawu.id_jawu from tb_bunga inner join tb_jawu on tb_bunga.id_bunga=tb_jawu.id_bunga where tb_jawu.jangka_waktu='$jawu' group by tb_bunga.id_finance");

				$jumjw = mysql_num_rows($sel3);
				//if ($jumjw<$jum_fi) {
					//$id_fi=1;
					$id_fi_sel3_arr = array();
					$id_bunga_sel3_arr = array();
					while ( $br = mysql_fetch_array($sel3)) {
						array_push($id_fi_sel3_arr, $br['id_finance']);
						array_push($id_bunga_sel3_arr, $br['id_jawu']);
						
					}
					$counter=0;
					for($x=0; $x<count($id_fi_arr); $x++){
						if  (in_array($id_fi_arr[$x], $id_fi_sel3_arr)){
							$sel1= mysql_query("select  bunga_tetap, biaya_tambahan from tb_bunga where id_finance=$id_fi_arr[$x] ");
					
							$br1 = mysql_fetch_array($sel1);
							
							$butap = $br1['bunga_tetap'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$btap = $hr*$butap/100;
							$tp=round($btap);
							$angtap = $hr/$jawu+$tp;
							$angtp =round($angtap);
							$antp = number_format(doubleval($angtp));

							echo "<td>Rp $antp  
							<input name='$id_bunga_sel3_arr[$counter]' type='hidden' value='$angtp'>
							<input name='jns' type='hidden' value=1>
							<button type='submit'class='btn btn-success' name='btn$id_bunga_sel3_arr[$counter]' value='$id_bunga_sel3_arr[$counter]' style='float:right;'>Buy</button>
							</td>";
							$counter++;
						}  else{
							echo "<td>-</td>";

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
	  		<th style="vertical-align: top;">Jangka Waktu</th>
		  	<?php
		  		$sel2= mysql_query("select tb_finance.`id_finance`, tb_finance.nama_finance from tb_bunga 
		  			inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance group by tb_finance.id_finance");
		  		$jum_fi = mysql_num_rows($sel2);
		  		$id_fi_arr = array();
		  		while ($bar2=mysql_fetch_array($sel2)) { 
		  			array_push($id_fi_arr, $bar2['id_finance']); 
		  			$namaf = $bar2['nama_finance'];
					echo "<th>$namaf<button data-toggle='modal' data-target='#view-modal' data-id='$baris[id_harga]' id='getUser' class='btn btn-info' style='float:right;'>Fasilitas</button></th>";
				}
		  	?>
		</tr>
	</thead>
	<tbody>
		
		<?php
			$sel2= mysql_query("select id_bunga, jangka_waktu from tb_jawu group by jangka_waktu ASC");
			while ($bar3=mysql_fetch_array($sel2)) { 
				$jawu = $bar3['jangka_waktu'];
				
		?>
		<tr>
			<?php		
				echo "<td>$jawu</td>";
				$sel3= mysql_query("select tb_bunga.id_bunga, tb_bunga.id_finance, tb_jawu.id_jawu from tb_bunga inner join tb_jawu on tb_bunga.id_bunga=tb_jawu.id_bunga where tb_jawu.jangka_waktu='$jawu' group by tb_bunga.id_finance");

				$jumjw = mysql_num_rows($sel3);
				//if ($jumjw<$jum_fi) {
					//$id_fi=1;
					$id_fi_sel3_arr = array();
					$id_bunga_sel3_arr = array();
					while ( $br = mysql_fetch_array($sel3)) {
						array_push($id_fi_sel3_arr, $br['id_finance']);
						array_push($id_bunga_sel3_arr, $br['id_jawu']);
						
					}
					$counter=0;
					for($x=0; $x<count($id_fi_arr); $x++){
						if  (in_array($id_fi_arr[$x], $id_fi_sel3_arr)){
							$sel1= mysql_query("select  bunga_menurun, biaya_tambahan from tb_bunga where id_finance=$id_fi_arr[$x] ");
					
							$br1 = mysql_fetch_array($sel1);
							
							$burun = $br1['bunga_menurun'];
							$bia = $br1['biaya_tambahan'];
							$hr = $hrg-$umuka+$bia;
							$brun = $hr*$burun/100;
							$tb=round($brun);
							$angrun = $hr/$jawu+$tb;
							$angrn =round($angrun);
							$anrn = number_format(doubleval($angrn));

							echo "<td>Rp $anrn  
							<input name='$id_bunga_sel3_arr[$counter]' type='hidden' value='$angrn'>
							<input name='jns' type='hidden' value=2>
							<button type='submit'class='btn btn-success' name='btn$id_bunga_sel3_arr[$counter]' value='$id_bunga_sel3_arr[$counter]' style='float:right;'>Buy</button>
							</td>";
							$counter++;
						}  else{
							echo "<td>-</td>";

						}

						//for ($y=0; $y<count($id_fi_sel3_arr); $y++){
							//if ($id_fi_arr[$x]<=$id_fi_sel3_arr[$y]){
								
							//}		
						//}
					}
				
				}
			?>
		</tr>
	</tbody>
</table>

<?php
	}

?>
	<!-- /.modal -->
		<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		    <div class="modal-dialog"> 
		        <div class="modal-content"> 
		                  
		            <div class="modal-header" id="dynamic-content"> 
		                        
		                    
		            </div> 
		        </div>
		   </div>
		</div>
	<!-- /.modal -->

<!--table class="table table-bordered">
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
</table-->