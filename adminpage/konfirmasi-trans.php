<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	require 'PHPMailer/PHPMailerAutoload.php';
	require 'fpdf/fpdf.php';

	 $id = $_GET['id'];
	 $sel = mysql_query("SELECT tb_transaksi.*, tb_det_transaksi.*, tb_harga.harga_cash, tb_dealer.`nama_dealer`, tb_pelanggan.*, tb_warna.warna, 
			tb_kecamatan.`nama_kecamatan`, tb_kabupaten.`nama_kabupaten`, tb_provinsi.`nama_provinsi` FROM tb_transaksi 
			INNER JOIN tb_det_transaksi ON tb_transaksi.`id_transaksi`=tb_det_transaksi.`id_transaksi`
			INNER JOIN tb_harga ON tb_det_transaksi.`id_harga`=tb_harga.id_harga
			INNER JOIN tb_dealer ON tb_harga.`id_dealer`=tb_dealer.id_dealer
			INNER JOIN tb_pelanggan ON tb_transaksi.`id_pelanggan`=tb_pelanggan.id_pelanggan
			INNER JOIN tb_warna ON tb_det_transaksi.`id_warna`=tb_warna.id_warna
			INNER JOIN tb_kecamatan ON tb_pelanggan.`id_kecamatan`=tb_kecamatan.id_kecamatan
			INNER JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten`=tb_kecamatan.id_kabupaten
			INNER JOIN tb_provinsi ON tb_provinsi.`id_provinsi`=tb_kabupaten.id_provinsi
			WHERE tb_transaksi.id_transaksi='$id'");
	 $bar=mysql_fetch_array($sel);
	 $tgl = date("d F Y H:i:s", strtotime($bar['tgl_transaksi']));
	 $tp ="$bar[nama_pelanggan]
$bar[alamat], $bar[nama_kecamatan]
$bar[nama_kabupaten], $bar[nama_provinsi] 
No. Telp: $bar[telp]";
	
	
	 $sel1 = mysql_query("SELECT tb_transaksi.*, tb_det_transaksi.*, tb_harga.harga_cash, tb_dealer.`nama_dealer`, tb_pelanggan.*, tb_warna.warna, tb_det_motor.nama_det_motor,
			tb_kecamatan.`nama_kecamatan`, tb_kabupaten.`nama_kabupaten`, tb_provinsi.`nama_provinsi` FROM tb_transaksi 
			INNER JOIN tb_det_transaksi ON tb_transaksi.`id_transaksi`=tb_det_transaksi.`id_transaksi`
			INNER JOIN tb_harga ON tb_det_transaksi.`id_harga`=tb_harga.id_harga
			inner join tb_det_motor on tb_det_motor.id_det_motor=tb_harga.id_det_motor
			INNER JOIN tb_dealer ON tb_harga.`id_dealer`=tb_dealer.id_dealer
			INNER JOIN tb_pelanggan ON tb_transaksi.`id_pelanggan`=tb_pelanggan.id_pelanggan
			INNER JOIN tb_warna ON tb_det_transaksi.`id_warna`=tb_warna.id_warna
			INNER JOIN tb_kecamatan ON tb_pelanggan.`id_kecamatan`=tb_kecamatan.id_kecamatan
			INNER JOIN tb_kabupaten ON tb_kabupaten.`id_kabupaten`=tb_kecamatan.id_kabupaten
			INNER JOIN tb_provinsi ON tb_provinsi.`id_provinsi`=tb_kabupaten.id_provinsi
			WHERE tb_det_transaksi.id_transaksi='$id'");

	$pdf_filename = "invoice.pdf";
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(130,10,'Bukti Transaksi',0,'L');
	$pdf->Cell(40,10,'No. Transaksi:');
	$pdf->Cell(10,10,$bar['id_transaksi']);
	$pdf->Ln(20);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(9,10,'Dear');
	$pdf->Cell(40,10,$bar['nama_pelanggan']);
	$pdf->Ln(10);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(180,5,'Rincian Belanja',1,1,C);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(80,8,'Tanggal Transaksi',1);
	$pdf->Cell(100,8,$tgl,1,1);

	$pdf->Cell(80,20,'Tujuan Pengiriman',1);
	$pdf->MultiCell(100,5,$tp,1,'L');
	$pdf->Ln();

	$pdf->Cell(50,8,'Nama Motor',1);
	$pdf->Cell(50,8,'Dealer',1);
	$pdf->Cell(20,8,'Jumlah',1);
	$pdf->Cell(30,8,'Warna',1);
	$pdf->Cell(30,8,'Harga',1,1);

	while ($br=mysql_fetch_array($sel1)) {
		# code...
		$harga = $br['jumlah_harga'];
		$jumlah=$br['jumlah'];
		$jumlah_harga = $br['harga_cash'] *  $jumlah;
		$total = $jumlah_harga + $total;
 		$unik = $harga - $total; 

		$hrg=number_format($jumlah_harga, 0, ".", ".");

		$pdf->Cell(50,8,$br['nama_det_motor'],1);
		$pdf->Cell(50,8,$br['nama_dealer'],1);
		$pdf->Cell(20,8,$br['jumlah'],1);
		$pdf->Cell(30,8,$br['warna'],1);
		$pdf->Cell(30,8,'Rp '.$hrg,1,1,R);
	}
	$tot=number_format($total, 0, ".", ".");
	$unk=number_format($unik, 0, ".", ".");
	$hr=number_format($harga, 0, ".", ".");

	$pdf->Cell(150,8,'Subtotal',1);
	$pdf->Cell(30,8,'Rp '.$tot,1,1,R);

	$pdf->Cell(150,8,'Kode Unik',1);
	$pdf->Cell(30,8,'Rp '.$unk,1,1,R);

	$pdf->Cell(150,8,'Total Pembayaran',1);
	$pdf->Cell(30,8,'Rp '.$hr,1,1,R);
    $pdf->Output($pdf_filename, 'F');
	//$pdf->Output('C:/xampp/invoice.pdf','S');
	//$pdf->Output();



	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'dealermotor32@gmail.com';          // SMTP username
	$mail->Password = 'fuckingmyass1@'; 			// SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to
	$mail->setFrom('dealermotor32@gmail.com', 'Dealer');
	$mail->addReplyTo('dealermotor32@gmail.com', 'Dealer');
	$mail->addAddress('madegilangaditya32@gmail.com');   // Add a recipient
	
	//$mail->isHTML(true);  // Set email format to HTML

	//$bodyContent = file_get_contents('transactional-email/templates/billing.php');
		
	$mail->AddAttachment($pdf_filename);
	$mail->Subject = 'Invoice Pembayaran';
	$mail->Body    = 'tes';

	if(!$mail->send()) {
    	echo "file tidak terkirim";
	} else {
		$upd = mysql_query("update tb_transaksi set status=3 where id_transaksi='$id'");
	    header('Location:admin.php');
	}

	unlink($pdf_filename);
	//exit;
	
?>