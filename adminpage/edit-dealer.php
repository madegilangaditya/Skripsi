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
				 	<h3 id="forms-example" class="col-md-12 form-group2 group-mail" style="margin-bottom: 0px;">Edit Dealer</h3>
				 	<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									
									$id=$_GET['id'];
									$hasil = mysql_query(" select * from tb_dealer where id_dealer=$id");
										$baris=mysql_fetch_array($hasil);
										$id=$baris['id_dealer'];
										$nama=$baris['nama_dealer'];
										$kec=$baris['id_kecamatan'];
										$alamat=$baris['alamat'];									
										$tlp=$baris['telp'];
										$cek = mysql_query("
											select tb_kecamatan.nama_kecamatan, tb_kecamatan.id_kabupaten, tb_kabupaten.nama_kabupaten, tb_kabupaten.id_provinsi, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten 
									 		on tb_kecamatan.id_kabupaten = 
									 		tb_kabupaten.id_kabupaten
									 		inner join tb_provinsi
									 		on tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi where id_kecamatan='$kec'");
			 	$bar= mysql_fetch_array($cek);
			 	$cek1 = $bar['nama_kecamatan'];
			 	$cek2 = $bar['nama_kabupaten'];
			 	$cek3 = $bar['nama_provinsi'];
			 	$cek4 = $bar['id_kabupaten'];
			 	$cek5 = $bar['id_provinsi'];
									
							?>
					<form name="input_data" class="ketua-form" action="proses-edit-dealer.php" method="post" enctype="multipart/form-data">
					<input name="id" type="hidden" value="<?php echo "$id"; ?>">
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Nama Dealer</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dealer" value="<?php echo "$nama"; ?>" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Provinsi</label>
						<select name="provinsi" class="form-control" id="provinsi">
							
							<?php echo "<option value=\"$cek5\">$cek3</option>\n"; ?>
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
							<?php echo "<option value=\"$cek4\">$cek2</option>\n"; ?>
							<?php
								$kabupaten = mysql_query("SELECT * FROM tb_kabupaten where id_provinsi=$cek5 ORDER BY nama_kabupaten");
									while($p=mysql_fetch_array($provinsi)){
										echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
						<label class="control-label" for="selector1">Kecamatan</label>
						<select name="kecamatan" class="form-control" id="kecamatan">
							<?php echo "<option value=\"$kec\">$cek1</option>\n"; ?>
							<?php
								$kecamatan = mysql_query("SELECT * FROM tb_kecamatan where id_kabupaten=$cek4 ORDER BY nama_kecamatan");
									while($p=mysql_fetch_array($kecamatan)){
										if($p[id_kecamatan]==$kec){
										echo "selected='selected'>";
										echo "$baris[nama_kecamatan]</option>";
										}
										echo "<option value='$p[id_kecamatan]'>$p[nama_kecamatan]</option>\n";
										}
							?>
						</select>
						</div>
						
						<div class="col-md-12 form-group1 ">
							<label class="control-label">Alamat</label>
							<textarea name="alamat" id="alamat" placeholder="Alamat" required=""><?php echo "$alamat"; ?></textarea>
						</div>
						
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Telepon</label>
							<input type="number" class="form-control" name="telp" id="telp" placeholder="Telepon" value="<?php echo "$tlp"; ?>" required>
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
		