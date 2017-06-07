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
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Data Motor</h3>
					<a href="admin.php?page=add-produk" class="btn btn-info" style="float: right;">Add Motor</a><br class="clear" /><br class="clear" />
						 <table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									
									<th>Nama Motor</th>
									<th>Merk Motor</th>
									<th>Type Motor</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									include "koneksi.php";
									$query = mysql_query(" select tb_motor.id_motor,tb_motor.nama_motor, tb_merk.nama_merk, tb_type.nama_type 
									from tb_motor INNER JOIN tb_merk 
									ON tb_motor.id_merk = tb_merk.id_merk 
									INNER JOIN tb_type
									ON tb_motor.id_type = tb_type.id_type
									
									Order by nama_type ASC");
									$i = 1;
									while($baris = mysql_fetch_array($query)){
										echo "<tr>
												<td align='center'>$i</td>
												
												<td>$baris[nama_motor]</td>
												<td>$baris[nama_merk]</td>
												<td>$baris[nama_type]</td>
												
												<td>
						
													<a href='admin.php?page=edit-produk&id=$baris[id_motor]'><i class='fa fa-pencil fa-lg'></i></a>
													<a href='proses-delete-produk.php?id=$baris[id_motor]' ><i class='fa fa-trash fa-lg'></i></a>
												
												</td>													
												</tr>";
									$i++;
									}
										?>
							</tbody>
						</table>

				</div>
	
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
		
	
  
		
		<!----->
		