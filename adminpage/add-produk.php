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
				<!---start-chart---->
			
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Add Motor</h3>
					<form name="input_data" action="proses-add-produk.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Motor</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Motor">
						</div>
						<div class="form-group">
									<label for="selector1">Merk Motor</label>
									<select name="merk" id="merk" class="form-control" placeholder="Select Merk">
										<?php
										$hasil=mysql_query("select * from tb_merk");
										while ($baris=mysql_fetch_array($hasil)){
										echo"<option value='$baris[id_merk]'>$baris[nama_merk]</option>";
												} 
										?>
										
									</select>
						</div>
						<div class="form-group">
									<label for="selector1">Type Motor</label>
									<select name="type" id="type" class="form-control" placeholder="Select Type">
										<?php
										$hasil=mysql_query("select * from tb_type");
										while ($baris=mysql_fetch_array($hasil)){
										echo"<option value='$baris[id_type]'>$baris[nama_type]</option>";
												} 
										?>
										
									</select>
						</div>
						<div class="form-group">
							<label for="comment">Deskripsi</label>
							<textarea style="height:250px;"  id="deskripsi" name="deskripsi"></textarea>
						</div>
						<div class="form-group">
							<label for="comment">Spesifikasi</label>
							<textarea style="height:250px;"  id="spesifikasi" name="spesifikasi"></textarea>
						</div>
					
  
			<div class="form-group">
				<button class="btn-success btn" name="submit" style="margin-right: 5em;">Submit</button>
				<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
			</div>
</form>



<script>
		 CKEDITOR.replace( 'deskripsi', {
				toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Image', 'NumberedList','BulletedList', 'Table', 'Subscript', 'Superscript', '-', 'RemoveFormat', 'SpecialChar','Font'] },
				{name: 'links', items: ['Link', 'Unlink', 'CreateDiv']}
				],
		
			});
			CKEDITOR.replace( 'spesifikasi', {
				toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Image', 'NumberedList','BulletedList', 'Table', 'Subscript', 'Superscript', '-', 'RemoveFormat', 'SpecialChar'] },
				{name: 'links', items: ['Link', 'Unlink', 'CreateDiv']}
				],
				filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
				filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
				filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
			});
</script>


</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		<!---->
	
  
		
	
		