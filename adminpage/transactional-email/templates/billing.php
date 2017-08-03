<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Billing e.g. invoices and receipts</title>
<link href="styles.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">
<?php
	include "../../koneksi.php";
	$sql = mysql_query("select * from tb_transaksi where id_transaksi = (select MAX(id_transaksi) from tb_transaksi)");
   	$row=mysql_fetch_array($sql);
	$idt=$row['id_transaksi'];
	$idp=$row['id_pelanggan'];
	$sts = $row['status'];
	$tanggal=$row['tgl_transaksi'];
	if($sts==1){
		$a="Lunas";
	}else{
		$a="Menunggu Pembayaran";
	}
	$harga = $row['jumlah_harga'];
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

	$idl=$_SESSION['idl'];
					 	
 	$sql5=mysql_query("select tb_det_transaksi.id_det_transaksi, tb_det_transaksi.jumlah, tb_det_transaksi.id_harga,  tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_warna.gambar, tb_warna.warna, tb_dealer.nama_dealer from tb_det_transaksi 
 		inner join tb_harga on tb_harga.id_harga = tb_det_transaksi.id_harga
 		inner join tb_warna on tb_warna.id_warna = tb_det_transaksi.id_warna 
 		inner join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
 		inner join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_det_transaksi.id_transaksi = $idt ");
 	$i=1;
 	$total=0;

 	//date_default_timezone_set('Asia/Makassar');
	
?>
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" width="600">
			<div class="content">
				<table class="main" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="content-wrap aligncenter">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td class="content-block">
										<h1 class="aligncenter">Detail Belanja</h1>
									</td>
								</tr>
								
								<tr>
									<td class="content-block aligncenter">
										<table class="invoice">
											<tr>
												<td><?php echo "$nama"; ?><br>No. Transaksi: <?php echo "$idt"; ?><br><?php echo "$tanggal"; ?></td>
											</tr>
											
											<tr>
												<td>
													<table class="invoice-items" cellpadding="0" cellspacing="0">
														<tr>
															<td style="padding-right: 10em;">Barang</td>
															<td>Harga</td>
															<td class="alignright">Jumlah</td>
															<td class="alignright" style="padding-left: 3em;">Subtotal</td>
														</tr>
														<?php
															while($bar=mysql_fetch_array($sql5)){
																$jumlah=$bar['jumlah'];
																$jumlah_harga = $bar['harga_cash'] *  $jumlah;
											        			$total = $jumlah_harga + $total;
														 		$unik = $harga - $total; 

																$hrg=number_format($jumlah_harga, 0, ".", ".");
														?>
														<tr>
															<td><div><?php echo "$bar[nama_det_motor]<br>$bar[nama_dealer]";?></div></td>
															<td><?php echo number_format($harga); ?></td>
															<td class="alignright"><?php echo "$jumlah"; ?></td>
															<td class="alignright"><?php echo "$hrg"; ?></td>
														</tr>
														
														<?php
															}
														?>
														<tr ">
															<td>Kode Unik</td>
															<td></td>
															<td class="alignright" width="100%"></td>
															<td class="alignright"><?php echo "$unik"; ?></td>
														</tr>
														<tr class="total">
															<td></td>
															<td></td>
															<td class="alignright" width="100%">Total</td>
															<td class="alignright"><?php echo number_format($harga); ?></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										Terima Kasih Sudah Berbelanja
									</td>
								</tr>
								
							</table>
						</td>
					</tr>
				</table>
				<!-- <div class="footer">
					<table width="100%">
						<tr>
							<td class="aligncenter content-block">Questions? Email <a href="mailto:">support@acme.inc</a></td>
						</tr>
					</table>
				</div> --></div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>
