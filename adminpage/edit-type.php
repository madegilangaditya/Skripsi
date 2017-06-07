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
				<span>Data Type</span>
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
				<!----->
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Edit Type</h3>
							<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									
									$id=$_GET['id'];
									$hasil = mysql_query(" select * from tb_type where id_type=$id");
										$baris=mysql_fetch_array($hasil);

										$nama=$baris['nama_type'];
										
							?>
					<form name="input_data" action="<?php echo "proses-edit-type.php?id=$id"; ?>" method="post" enctype="multipart/form-data" >
						<div class="form-group">
						<input name="id" type="hidden" value="<?php echo "$id"; ?>">
							<label for="exampleInputEmail1">Nama Type</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Type" value="<?php echo "$nama"; ?>">
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
		