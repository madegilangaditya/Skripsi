<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	require 'PHPMailer/PHPMailerAutoload.php';
	require 'fpdf/fpdf.php';

	// $id = $_GET['id'];
	// $upd = mysql_query("update tb_transaksi set status=3 where id_transaksi='$id'");
	
	class PDF extends FPDF{
		
		function Header(){
			global $title;
			// Logo
		    $this->Image('../images/logo2.png',10,6,30);
		    // Arial bold 15
		    $this->SetFont('Arial','B',15);
		    // Move to the right
		    $this->Cell(70);
		    // Title
		    $this->Cell(50,10,'Bukti Transaksi',1,0,'C');
		    // Line break
		    $this->Ln(20);
		}

		function isi(){

		}
		function myBody(){

		}

		function Layout(){

		}

		function footer(){
			 // Position at 1.5 cm from bottom
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Page number
		    $this->Cell(0,10,'Bike Shop Admin',0,0,'C');
		}
	}

	$pdf_filename = "invoice.pdf";
	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(40,10,'Hello World!');
	//$pdf->Output($pdf_filename, "F");
	$pdf->Output();



	// $mail = new PHPMailer;

	// $mail->isSMTP();                            // Set mailer to use SMTP
	// $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	// $mail->SMTPAuth = true;                     // Enable SMTP authentication
	// $mail->Username = 'dealermotor32@gmail.com';          // SMTP username
	// $mail->Password = 'fuckingmyass'; 			// SMTP password
	// $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	// $mail->Port = 587;                          // TCP port to connect to
	// $mail->setFrom('dealermotor32@gmail.com', 'Dealer');
	// $mail->addReplyTo('dealermotor32@gmail.com', 'Dealer');
	// $mail->addAddress('madegilangaditya32@gmail.com');   // Add a recipient
	
	// // $mail->isHTML(true);  // Set email format to HTML

	// $bodyContent = file_get_contents('transactional-email/templates/billing.php');
		
	// $mail->AddAttachment($pdf_filename);
	// $mail->Subject = 'Invoice Pembayaran';
	// $mail->Body    = 'tes';

	// if(!$mail->send()) {
 //    	echo "file tidak terkirim";
	// } else {
	//     header('Location:admin.php');

	// }

	// unlink($pdf_filename);

	
?>