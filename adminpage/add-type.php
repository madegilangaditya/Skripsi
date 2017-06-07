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
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Add Type</h3>
					<form name="input_data" action="proses-add-type.php" method="post" enctype="multipart/form-data" >
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Type</label>
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Type">
						</div>
						
  
  
			<div class="form-group">
				<button class="btn-success btn" name="submit" style="margin-right: 5em;">Submit</button>
				<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
			</div>
</form>
</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		<!---->
	
  
		
		<!----->
		