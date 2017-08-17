<?php
	include "koneksi.php";
	$user=$_SESSION['user'];
	$sel = mysql_query("Select id_login from tb_login where username='$user'");
	$bar= mysql_fetch_array($sel);
	$idl=$bar['id_login'];
	$sel1 = mysql_query("select * from tb_dealer where id_login=$idl");
	$bar1= mysql_fetch_array($sel1);
	$idd=$bar1['id_dealer'];
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
					<form name="input_data" action="proses-add-harga.php" method="post" enctype="multipart/form-data">
			
					<input name="id" type="hidden" value="<?php echo "$idd"; ?>">
						<div class="col-md-12 form-group2 group-mail">
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
						<div class="col-md-12 form-group2 group-mail">
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
						<div class="col-md-12 form-group2 group-mail">
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
						<div class="col-md-12 form-group2 group-mail">
									<label for="selector1">Nama Detail</label>
									<select name="detmotor" id="detmotor" class="form-control" placeholder="Pilih Detail">
									<option>Pilih Detail</option>
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
							<input type="number" class="form-control" name="hrg" id="hrg" placeholder="Harga" required>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label">Stok</label>
							<input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" required>
						</div>
						
  	<h3 id="forms-example" class="">Fasilitas Dealer</h3>
  						<div class="col-md-12 form-group2 group-mail">
							<label for="selector1" style="display: block;">Gratis Servis</label>
							<input type="number" class="form-control" name="srv" id="srv" placeholder="Servis" required style="display: inline; width: 80%"> <span class="control-label">Kali</span>
						</div>
						<div class="col-md-12 form-group2 group-mail">
							<label for="selector1" style="display: block;">Proses BPKB</label>
							<input type="number" class="form-control" name="bpkb" id="bpkb" placeholder="BPKB" required style="display: inline; width: 80%"> <span class="control-label">Minggu</span>
						</div>
						 <div class="col-md-12 form-group2 group-mail">
			                <label for="selector1">Gratis Helm:</label>
			                <div>
	                      	<label class="radio-inline"><input type="radio" name="helm" id="helm" value="1" >Dapat</label>
							<label class="radio-inline"><input type="radio" name="helm" id="helm" value="2" >Tidak Dapat</label>
						</div>
						</div>
			<div class="col-md-12 form-group">
				<button class="btn-success btn" name="submit" id="submit" style="margin-right: 5em;">Submit</button>
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
	
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$("#submit").click(function(){
			var id1 = $("#id").val();
			var detmotor1 = $("#detmotor").val();
			var hrg1 = $("#hrg").val();
			var stok1 = $("#stok").val();
			var srv1 = $("#srv").val();
			var bpkb1 = $("#bpkb").val();
			var helm1 = $("#helm").val();
			$.post("proses-add-harga.php", {
				id:id1,
				detmotor:detmotor1,
				hrg:hrg1,
				stok:stok1,
				srv:srv1,
				bpkb:bpkb1,
				helm:helm1
			},
			function(data){
				if (data== 'Motor Sudah Ada') {
					
					alert("Motor Sudah ada");
				}
			});
			
			console.log(data);
		});
	});
</script> -->
		
	
		