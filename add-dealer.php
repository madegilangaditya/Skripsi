 <?php
 
include "adminpage/koneksi.php";
?>
 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
	   

  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="admin.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Data Dealer</span>
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
				<!---start-chart---->
				
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="col-md-12 form-group2 group-mail" style="margin-bottom: 0px;">Add Dealer</h3>
					<form name="input_data" class="ketua-form" action="proses-add-dealer.php" method="post" enctype="multipart/form-data">
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Nama Dealer</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dealer" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Provinsi</label>
						<select name="provinsi" class="form-control" id="provinsi">
							<option>Pilih Provinsi</option>
							<?php
								$provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
									while($p=mysql_fetch_array($provinsi)){
										echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Kabupaten</label>
						<select name="kabupaten" class="form-control" id="kabupaten">
							<option>Pilih Kabupaten</option>
							<?php
								$kabupaten = mysql_query("SELECT * FROM tb_kabupaten ORDER BY nama_kabupaten");
									while($p=mysql_fetch_array($provinsi)){
										echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Kecamatan</label>
						<select name="kecamatan" class="form-control" id="kecamatan">
							<option>Pilih Kecamatan</option>
							<?php
								$kecamatan = mysql_query("SELECT * FROM tb_kecamatan ORDER BY nama_kecamatan");
									while($p=mysql_fetch_array($provinsi)){
										echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group1 ">
							<label class="control-label">Alamat</label>
							<textarea name="alamat" id="alamat" placeholder="Alamat" required=""></textarea>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Telepon</label>
							<input type="number" class="form-control" name="telp" id="telp" placeholder="Telepon" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Password</label>
							<input type="password" class="form-control password" name="pass" id="pass" placeholder="Password" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Confirm Password</label>
							<input type="password" class="form-control repassword" name="cpass" id="cpass" placeholder="Confirm Password" required>
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
	
  
		
		<!----->
		