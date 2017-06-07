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
				 	<h3 id="forms-example" class="col-md-12 form-group2 group-mail" style="margin-bottom: 0px;">Add Detail</h3>
<form name="input_data" action="proses-add-detail-motor.php" method="post" enctype="multipart/form-data">
						
						<div class="col-md-12 form-group group-mail">
									<label for="selector1">Merk Motor</label>
									<select name="merk" id="merk" class="form-control" placeholder="Select Merk">
									<option>Pilih Merk</option>
										<?php
										$hasil=mysql_query("select * from tb_merk");
										while ($baris=mysql_fetch_array($hasil)){
										echo"<option value=\"$baris[id_merk]\">$baris[nama_merk]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group group-mail">
									<label for="selector1">Jenis Motor</label>
									<select name="type" id="type" class="form-control" placeholder="Select Jenis">
									<option>Pilih Type</option>
										<?php
										$type=mysql_query("select * from tb_type order by nama_type");
										while ($baris=mysql_fetch_array($type)){
										echo"<option value=\"$baris[id_type]\">$baris[nama_type]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group group-mail">
									<label for="selector1">Nama Motor</label>
									<select name="motor" id="motor" class="form-control" placeholder="Select Nama">
									<option>Pilih Motor</option>
										<?php
										$motor=mysql_query("select * from tb_motor order by nama_motor");
										while ($baris=mysql_fetch_array($type)){
										echo"<option value=\"$baris[id_motor]\">$baris[nama_motor]</option>\n";
												} 
										?>
										
									</select>
						</div>
						<div class="col-md-12 form-group group-mail">
							<label class="control-label">Nama Detail</label>
							<input type="text" class="form-control" name="namaD" id="namaD" placeholder="Nama Detail" required>
						</div>
						
						<div class="col-md-12 form-group group-mail" id="box" >
							<label class="control-label" style="display: block;">Warna</label>
							
							<input type="text" class="form-control" name="warna[]" id="warna" placeholder="Warna 1" required style="width: 80%; display: inline;">
							<a  id="add" class="btn btn-primary add">Tambah</a>
							<label for="exampleInputFile" style="display: block;">Pilih Gambar</label>
							<input type="file" id="gambar" name="gambar[]">
							<p class="help-block">Ukuran Gambar 842x542</p>

						</div>
						
						
						

  <div class="clearfix"> </div>
  
			<div class="col-md-12 form-group">
				<button class="btn-success btn" name="submit" style="margin-right: 5em;">Submit</button>
				<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
			</div>
			<div class="clearfix"> </div>
</form>

<!--div id="box">
<input name="name" type="text" id="name" class="name" placeholder="Input 1">
<img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Fairytale_button_add.png" title="Tambah" width="32" height="32" border="0" align="top" class="add" id="add" />
</div-->

</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		<!---->

  
		
		<!---->
		