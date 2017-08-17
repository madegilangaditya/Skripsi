<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	$umuka = $_GET['umuka'];
	$id = $_SESSION['hrg'];
	$sql = mysql_query("select harga_cash from tb_harga where id_harga='$id'");
	$b = mysql_fetch_array($sql);
	$hrg = $b['harga_cash'];
	$_SESSION['umuka']=$umuka;
	$bjns = $_GET['bjns'];
	$_SESSION['bjns']=$bjns;
	$jw=$_GET['jw'];
	$jawu=$_GET['jawu'];
	if ($jawu!=0) {
		$jw=$jawu;
	}
?>

<?php
	if ($bjns=="") {
		# code...
?>
<table class="table table-hover">
	<tr>
		<th style="width: 20%;">Finance</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
				INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
				INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
				WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				# code...
		?>
			<td style="font-weight: bold; text-transform: uppercase;"><?php echo $fas[nama_finance]; ?></td>
		<?php
			}
		?>
	</tr>

	<tr>
		<th>Bunga Angsuran</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td style="text-transform: capitalize;"><?php echo $fas[bunga_tetap]; ?>%</td>
		<?php		
			}
		?>
	</tr>	

	<tr>
		<th>Biaya Administrasi</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;">Rp <?php echo $bia; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th>Angsuran Per Bulan</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$butap = $fas['bunga_tetap'];
				$bia = $fas['biaya_tambahan'];
				$hrgh = $hrg-$umuka+$bia;
				$btap = $hrgh*$butap/100;
				$tp=round($btap);
				$angtap = $hrgh/$jw+$tp;
				$angtp =round($angtap);
				$antp = number_format(doubleval($angtp));
				//$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;"> <input name='<?php echo $fas[id_jawu]; ?>' type='hidden' value='<?php echo $angtp; ?>'> Rp <?php echo $antp; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th></th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td> <button data-toggle='modal' data-target='#view-modal' data-id='<?php echo $fas[id_jawu];?>' id='getUser' class='btn btn-info'>Detail</button> 
			<button type='submit' class='btn btn-success' name='btn<?php echo $fas[id_jawu]; ?>' value='<?php echo $fas[id_jawu]; ?>'>Buy</button> </td>
		<?php
			}
		?>
	</tr>
</table>

<?php
	}if ($bjns==1) {
?>

<table class="table table-hover">
	<tr>
		<th style="width: 20%;">Finance</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
				INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
				INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
				WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				# code...
		?>
			<td style="font-weight: bold; text-transform: uppercase;"><?php echo $fas[nama_finance]; ?></td>
		<?php
			}
		?>
	</tr>

	<tr>
		<th>Bunga Angsuran</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td style="text-transform: capitalize;"><?php echo $fas[bunga_tetap]; ?>%</td>
		<?php		
			}
		?>
	</tr>	

	<tr>
		<th>Biaya Administrasi</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;">Rp <?php echo $bia; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th>Angsuran Per Bulan</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$butap = $fas['bunga_tetap'];
				$bia = $fas['biaya_tambahan'];
				$hrgh = $hrg-$umuka+$bia;
				$btap = $hrgh*$butap/100;
				$tp=round($btap);
				$angtap = $hrgh/$jw+$tp;
				$angtp =round($angtap);
				$antp = number_format(doubleval($angtp));
				//$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;"> <input name='<?php echo $fas[id_jawu]; ?>' type='hidden' value='<?php echo $angtp; ?>'> Rp <?php echo $antp; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th></th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td> <button data-toggle='modal' data-target='#view-modal' data-id='<?php echo $fas[id_jawu];?>' id='getUser' class='btn btn-info'>Detail</button> 
			<button type='submit' class='btn btn-success' name='btn<?php echo $fas[id_jawu]; ?>' value='<?php echo $fas[id_jawu]; ?>'>Buy</button> </td>
		<?php
			}
		?>
	</tr>
</table>
<?php
	}if ($bjns==2) {
?>

<table class="table table-hover">
	<tr>
		<th style="width: 20%;">Finance</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
				INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
				INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
				WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				# code...
		?>
			<td style="font-weight: bold; text-transform: uppercase;"><?php echo $fas[nama_finance]; ?></td>
		<?php
			}
		?>
	</tr>

	<tr>
		<th>Bunga Angsuran</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td style="text-transform: capitalize;"><?php echo $fas[bunga_menurun]; ?>%</td>
		<?php		
			}
		?>
	</tr>	

	<tr>
		<th>Biaya Administrasi</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;">Rp <?php echo $bia; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th>Angsuran Per Bulan</th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
				$burun = $fas['bunga_menurun'];
				$bia = $fas['biaya_tambahan'];
				$hrgh = $hrg-$umuka+$bia;
				$brun = $hrgh*$burun/100;
				$tp=round($brun);
				$angrun = $hrgh/$jw+$tp;
				$angrn =round($angrun);
				$anrn = number_format(doubleval($angrn));
				//$bia = number_format($fas['biaya_tambahan']);
		?>
			<td style="text-transform: capitalize;"> <input name='<?php echo $fas[id_jawu]; ?>' type='hidden' value='<?php echo $angrn; ?>'> Rp <?php echo $anrn; ?></td>
		<?php		
			}
		?>
	</tr>

	<tr>
		<th></th>
		<?php
			$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
					INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
					INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
					WHERE tb_jawu.`jangka_waktu`='$jw'");
			while ($fas=mysql_fetch_array($kmp)) {
		?>
			<td> <button data-toggle='modal' data-target='#view-modal' data-id='<?php echo $fas[id_jawu];?>' id='getUser' class='btn btn-info'>Detail</button> 
			<button type='submit' class='btn btn-success' name='btn<?php echo $fas[id_jawu]; ?>' value='<?php echo $fas[id_jawu]; ?>'>Buy</button></td>
		<?php
			}
		?>
	</tr>
</table>
<?php
	}
?>