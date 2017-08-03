<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
	require 'adminpage/PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'dealermotor32@gmail.com';          // SMTP username
	$mail->Password = 'fuckingmyass'; 			// SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to

	

	$nama=$_POST['nama'];
	$ktp=$_POST['ktp'];
	$kelamin=$_POST['kelamin'];
	$alamat = $_POST['alamat'];
	$telp=$_POST['telp'];
	$kec=$_POST['kecamatan'];
	$idl = $_SESSION['idl'];
	$harga = $_SESSION['harga'];
	date_default_timezone_set('Asia/Makassar');
	$tanggal=date("Y-m-d H:i:s");

	$se=mysql_query("select * from tb_pelanggan where No_KTP='$ktp' AND nama_pelanggan='$nama' AND alamat='$alamat' AND id_kecamatan='$kec' AND jenis_kelamin='$kelamin' AND telp='$telp' AND id_login='$idl'") or die(mysql_error());

	if (mysql_num_rows($se)==0){
		$sql = mysql_query("insert into tb_pelanggan (No_KTP, nama_pelanggan, alamat, id_kecamatan, jenis_kelamin, telp, id_login) value ('$ktp', '$nama', '$alamat', '$kec', '$kelamin', '$telp', '$idl')") or die(mysql_error());
		$sel= mysql_query("select * from tb_pelanggan where id_login=$idl AND id_pelanggan= (select MAX(id_pelanggan) from tb_pelanggan)");
		$bar = mysql_fetch_array($sel);
		$tes=$bar['id_pelanggan'];
		$email=$bar['email'];
	}else{
		$sel= mysql_query("SELECT MIN(id_pelanggan)AS id FROM tb_pelanggan WHERE id_login='$idl' ");
		$bar = mysql_fetch_array($sel);
		$tes=$bar['id'];
		$email=$bar['email'];
	}
		$sql1=mysql_query("select sum(tb_cart.jumlah), tb_cart.id_harga, tb_cart.tanggal, tb_harga.harga_cash,tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_det_motor.gambar, tb_dealer.nama_dealer from tb_cart 
				 		left join tb_harga on tb_harga.id_harga = tb_cart.id_harga 
				 		left join tb_det_motor on tb_harga.id_det_motor = tb_det_motor.id_det_motor 
				 		left join tb_dealer on tb_dealer.id_dealer = tb_harga.id_dealer where tb_cart.id_login = $idl group by id_harga");
	 	
		$ins=mysql_query("insert into tb_transaksi (id_pelanggan, tgl_transaksi, jumlah_harga, status, jenis_transaksi) values ('$tes','$tanggal','$harga',2,1)");
		$sel= mysql_query("select * from tb_transaksi where id_pelanggan=$tes AND id_transaksi= (select MAX(id_transaksi) from tb_transaksi)");
		$row=mysql_fetch_array($sel);
		$idt=$row['id_transaksi'];

		$sel1=mysql_query("select id_harga,jumlah, id_warna from tb_cart where id_login=$idl");
		while($row1=mysql_fetch_array($sel1)){
				
					$query=mysql_query("
					insert into tb_det_transaksi(id_transaksi,id_harga,id_warna, jumlah) value('$idt','$row1[id_harga]','$row1[id_warna]','$row1[jumlah]')
					") or die(mysql_error());
					
					$query=mysql_query("update tb_harga set stok=stok-$row1[jumlah] where id_harga=$row1[id_harga]");
						
				}
					$query=mysql_query("delete from tb_cart where id_login=$idl");
					//header('Location:next-order.php');

	$mail->setFrom('dealermotor32@gmail.com', 'Dealer');
	$mail->addReplyTo('dealermotor32@gmail.com', 'Dealer');
	$mail->addAddress('madegilangaditya32@gmail.com');   // Add a recipient
	
	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = file_get_contents('adminpage/transactional-email/templates/billing.php');
		

	$mail->Subject = 'Invoice Pembayaran';
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
    	header('Location:next-order.php');
	} else {
	    header('Location:next-order.php');
	}
?>