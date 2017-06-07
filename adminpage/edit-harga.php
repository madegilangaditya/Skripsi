 <?php
 
include "koneksi.php";
$user=$_SESSION['user'];
$sel = mysql_query("Select id_login from tb_login where username='$user'");
$bar= mysql_fetch_array($sel);
$idl=$bar['id_login'];
$sel1 = mysql_query("select * from tb_dealer where id_login=$idl");
$bar1= mysql_fetch_array($sel1);
$idd=$bar1['id_dealer'];
$id = $_GET['id'];
$sel = mysql_query("SELECT tb_harga.harga_cash, tb_harga.stok, tb_det_motor.id_det_motor, tb_det_motor.nama_det_motor, tb_merk.id_merk, tb_merk.nama_merk,
tb_type.id_type, tb_type.nama_type,tb_motor.id_motor, tb_motor.nama_motor, tb_fasilitas.bpkb, tb_fasilitas.helm, tb_fasilitas.servis FROM tb_harga
INNER JOIN tb_fasilitas ON tb_harga.id_harga= tb_fasilitas.id_harga
INNER JOIN tb_det_motor ON tb_harga.id_det_motor= tb_det_motor.id_det_motor
INNER JOIN tb_motor ON tb_det_motor.id_motor = tb_motor.id_motor
INNER JOIN tb_merk ON tb_motor.id_merk=tb_merk.id_merk
INNER JOIN tb_type ON tb_motor.id_type=tb_type.id_type WHERE tb_harga.id_harga ='$id'");
$bar = mysql_fetch_array($sel);
$dtm = $bar['id_motor'];
$nm = $bar['nama_motor'];

?>
 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
	   

  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="admin.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Data Motor</span>
				</h2>
		    </div>
		<!--//banner-->
		
				<!--graph-->
				<link rel="stylesheet" href="css/graph.css">
				<!--//graph-->
							<script src="js/jquery.flot.js"></script>
		<!--content-->
	<div class="content-top">
		<div class="col-md-12 ">
				<!---start-chart-->
			
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Add Motor</h3>
					<form name="input_data" action="proses-edit-harga.php" method="post" enctype="multipart/form-data">
			
					<input name="id" type="hidden" value="<?php echo "$id"; ?>">
						<div class="col-md-12 form-group2 group-mail">
									<label for="selector1">Merk Motor</label>
									<select name="merk" id="merk" class="form-control" placeholder="Select Merk">
									
									<?php echo "<option value=\"$dtm\">$nm</option>\n"; ?>
										<?php
										$hasil=mysql_query("select * from tb_merk");
										while ($baris=mysql_fetch_array($hasil)){
										echo"<option value=\"$baris[id_merk]\">$baris[nama_merk]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group2 group-mail">
									<label for="selector1">Jenis Motor</label>
									<select name="type" id="type" class="form-control" placeholder="Select Jenis">
									
									<?php echo "<option value=\"$bar[id_type]\">$bar[nama_type]</option>\n"; ?>
										<?php
										$type=mysql_query("select * from tb_type order by nama_type");
										while ($baris=mysql_fetch_array($type)){
										echo"<option value=\"$baris[id_type]\">$baris[nama_type]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group2 group-mail">
									<label for="selector1">Nama Motor</label>
									<select name="motor" id="motor" class="form-control" placeholder="Select Nama">
									
									<?php echo "<option value=\"$bar[id_motor]\">$bar[nama_motor]</option>\n"; ?>
										<?php
										$motor=mysql_query("select * from tb_motor order by nama_motor");
										while ($baris=mysql_fetch_array($type)){
										echo"<option value=\"$baris[id_motor]\">$baris[nama_motor]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group2 group-mail">
									<label for="selector1">Nama Detail</label>
									<select name="detmotor" id="detmotor" class="form-control" placeholder="Pilih Detail">
									
									<?php echo "<option value=\"$bar[id_det_motor]\">$bar[nama_det_motor]</option>\n"; ?>
										<?php
										$detmotor=mysql_query("select * from tb_det_motor order by nama_det_motor");
										while ($baris=mysql_fetch_array($type)){
										echo"<option value=\"$baris[id_det_motor]\">$baris[nama_det_motor]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Harga</label>
							<input type="number" class="form-control" name="hrg" id="hrg" placeholder="Harga" value="<?php echo "".$bar[harga_cash];?>" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Stok</label>
							<input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo "".$bar[stok];?>" required>
						</div>
						
  	<h3 id="forms-example" class="">Fasilitas Dealer</h3>
  						<div class="col-md-12 form-group2 group-mail">
							<label for="selector1" style="display: block;">Gratis Servis</label>
							<input type="number" class="form-control" name="srv" id="srv" placeholder="Servis" value="<?php echo "".$bar[servis];?>" required style="display: inline; width: 80%"> <span class="control-label">Kali</span>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label for="selector1" style="display: block;">Proses BPKB</label>
							<input type="number" class="form-control" name="bpkb" id="bpkb" placeholder="BPKB" value="<?php echo "".$bar[bpkb];?>" required style="display: inline; width: 80%"> <span class="control-label">Minggu</span>
						</div>
						 <div class="col-md-12 form-group2 group-mail">
			                <label for="selector1">Gratis Helm:</label>
			                <div>
	                      	<label class="radio-inline"><input type="radio" name="helm" value="1" <?php if ($bar['helm']== 1) {echo "checked";}?>>Dapat</label>
							<label class="radio-inline"><input type="radio" name="helm" value="2" <?php if ($bar['helm']== 2) {echo "checked";}?>>Tidak Dapat</label>
						</div>
						</div>
			<div class="col-md-12 form-group">
				<button class="btn-success btn" name="submit" style="margin-right: 5em;">Submit</button>
				<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
			</div>
			<div class="clearfix"> </div>
</form>






</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		<!---->
	
  
		
	
		