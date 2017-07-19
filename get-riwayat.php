<?php
	session_start();
	include("adminpage/koneksi.php"); 
	$idl=$_SESSION['idl'];
	
	
	
	
	$tjns=$_GET['tjns'];
?>

	<?php
		if ($tjns==1) {
			
	?>
			<thead>
		    	<tr>
		      		<th>No</th>
			        <th>Detail Transaksi</th>
			        <th>Total Harga</th>
			        <th>Status</th>
			        <th>Action</th>
		      	</tr>
		    </thead>
			
			<?php 
				
				// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
				// $bar=mysql_fetch_assoc($sel);
				// $idp=$bar['id_pelanggan'];
				//echo "tes $idp";
				
				//echo "tes $get_total_rows, $total_pages, $page_position";
				$result = mysql_query("SELECT tb_pelanggan.*, tb_transaksi.* FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_transaksi ON tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan WHERE tb_pelanggan.id_login=$idl ORDER BY id_transaksi DESC LIMIT $page_position, $item_per_page");
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_transaksi']));
					$hrg=number_format($bar['jumlah_harga'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<div>No.Transaksi:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_transaksi]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_transaksi]; ?></a>
						</div><?php echo $tgl; ?>
					</td>
					<td>Rp <?php echo $hrg; ?></td>
					<td>Menunggu Pembayaran</td>
					<td>
						<a class='btn btn-info' href='#'>Beli Lagi</a>
						<a class='btn btn-danger' href='#' >Hapus</a>
					</td>
				</tr>
			</tbody>
			<?php $no++;} ?>
		
		
<?php
	}else{
?>
			<thead>
		    	<tr>
		      		<th>No</th>
			        <th>Detail Kredit</th>
			        <th>Angsuran Pokok</th>
			        <th>Status</th>
			        <th>Action</th>
		      	</tr>
		    </thead>
			
			<!-- <?php 
				
				// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
				// $bar=mysql_fetch_assoc($sel);
				// $idp=$bar['id_pelanggan'];
				//echo "tes $idp";
				
				//echo "tes $get_total_rows, $total_pages, $page_position";
				$result = mysql_query("SELECT tb_pelanggan.*, tb_kredit.* FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_kredit ON tb_pelanggan.id_pelanggan=tb_kredit.id_pelanggan WHERE tb_pelanggan.id_login=$idl ORDER BY id_transaksi DESC LIMIT $page_position, $item_per_page");
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
					$hrg=number_format($bar['angsuran_pokok'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<div>No.Transaksi:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>
						</div><?php echo $tgl; ?>
					</td>
					<td>Rp <?php echo $hrg; ?></td>
					<td>Menunggu Pembayaran</td>
					<td>
						<a class='btn btn-info' href='#'>Beli Lagi</a>
						<a class='btn btn-danger' href='#' >Hapus</a>
					</td>
				</tr>
			</tbody>
			<?php $no++;} ?> -->
<?php
	}
?>