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
				<span>Data Kategori</span>
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
				<!---->
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Edit Merk</h3>
							<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									
									$id=$_GET['id'];
									$hasil = mysql_query(" select * from tb_merk where id_merk=$id");
										$baris=mysql_fetch_array($hasil);

										$nama=$baris['nama_merk'];
										$gambar=$baris['gambar'];
										
									
							?>
					<form name="input_data" action="<?php echo "proses-edit-kategori.php?id=$id"; ?>" method="post" enctype="multipart/form-data" >
						<div class="form-group">
						<input name="id" type="hidden" value="<?php echo "$id"; ?>">
							<label for="exampleInputEmail1">Nama Merk</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori" value="<?php echo "$nama"; ?>">
						</div>
		
					
						<div class="form-group">
							<img src="<?php echo"$gambar"; ?>" width="150"><br><br>
							<label for="exampleInputFile">Pilih Gambar</label>
							<input type="file" id="gambar" name="gambar">
							<p class="help-block">Gambar jangan besar</p>
						</div>
  
  
			<div class="form-group">
				<button class="btn-success btn" style="margin-right: 5em;">Submit</button>
				<button class="btn-danger btn">Back</button>
			</div>
</form>






</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		<!---->
	
  
		
		<!----->
		