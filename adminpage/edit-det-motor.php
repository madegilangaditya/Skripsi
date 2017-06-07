 <?php
 
include "koneksi.php";
?>
 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
	   

  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="admin.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Detail Motor</span>
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
				<!---->
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="col-md-12 form-group2 group-mail" style="margin-bottom: 0px;">Edit Detail</h3>
					<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									
									$id=$_GET['id'];
									$hasil = mysql_query("select tb_warna.id_warna, tb_warna.id_det_motor, tb_warna.warna, tb_warna.gambar, tb_det_motor.id_motor, tb_det_motor.nama_det_motor, tb_motor.nama_motor from tb_warna 
										inner join tb_det_motor
										on tb_det_motor.id_det_motor=tb_warna.id_det_motor
										inner join tb_motor
										on tb_det_motor.id_motor = tb_motor.id_motor where id_warna=$id");
										$baris=mysql_fetch_array($hasil);
										$idw = $baris['id_warna'];
										$id=$baris['id_det_motor'];
										$idm=$baris['id_motor'];
										$nama=$baris['nama_motor'];
										$namaD=$baris['nama_det_motor'];
										$warna=$baris['warna'];									
										$gambar=$baris['gambar'];
									
							?>
<form name="input_data" action="proses-edit-detail-motor.php" method="post" enctype="multipart/form-data">
	<input name="id" type="hidden" value="<?php echo "$idw"; ?>">
	<input name="idd" type="hidden" value="<?php echo "$id"; ?>">					
						<div class="col-md-12 form-group group-mail">
							<label class="control-label" for="selector1">Nama Motor</label>
									<select name="nama" id="nama" class="form-control" placeholder="Nama Motor">
										<?php
										
										$hasil=mysql_query("select * from tb_motor");
										while ($baris=mysql_fetch_array($hasil)){
										echo"<option value='$baris[id_motor]'";
										if($baris[id_motor]==$idm){
										echo "selected='selected'>";
										echo "$baris[nama_motor]</option>";
										}else {

										echo"<option value='$baris[id_motor]'>$baris[nama_motor]</option>";
										}
												} 
										?>
										
									</select>
		
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Nama Detail</label>
							<input type="text" class="form-control" name="namaD" id="namaD" placeholder="Nama Detail" value="<?php echo "$namaD"; ?>" required>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Warna</label>
							<input type="text" class="form-control" name="warna" id="warna" placeholder="Warna" required value="<?php echo "$warna"; ?>">
						</div>
						<div class="col-md-12 form-group2 group-mail">
						<img src="<?php echo"$gambar"; ?>" width="150"><br><br>
							<label for="exampleInputFile">Pilih Gambar</label>
							<input type="file" id="gambar" name="gambar">
							<p class="help-block">Ukuran Gambar 842x542</p>
						</div>
						

  <div class="clearfix"> </div>
  
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
	
  
		
		<!---->
		