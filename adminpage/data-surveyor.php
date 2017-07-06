 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
	   

  		<!--banner-->	
		    <div class="banner">
		   
				<h2>
				<a href="admin.php">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Data Surveyor</span>
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
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Data Surveyor</h3>
					<a href="admin.php?page=add-surveyor" class="btn btn-info" style="float: right;">Add Surveyor</a><br class="clear" /><br class="clear" />
						 <table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<!--th>Gambar</th-->
									<th>Nama Surveyor</th>
									<th>Cabang</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									include "koneksi.php";
									$user=$_SESSION['user'];
									$sel = mysql_query("Select id_login from tb_login where username='$user'");
									$bar= mysql_fetch_array($sel);
									$idl=$bar['id_login'];
									$sel1 = mysql_query("select id_finance from tb_finance where id_login=$idl");
									$bar1= mysql_fetch_array($sel1);
									$idf=$bar1['id_finance'];
									$query = mysql_query("select tb_surveyor.nama_surveyor, tb_kabupaten.nama_kabupaten from tb_surveyor inner join tb_kabupaten on tb_surveyor.id_kabupaten = tb_kabupaten.id_kabupaten where id_finance = $idf");
									$i = 1;
									while($baris = mysql_fetch_array($query)){
										$h=$baris['harga_cash'];
										$hrg=number_format($h, 0, ".", ".");
										echo "<tr>
												<td align='center'>$i</td>
												<td>$baris[nama_surveyor]</td>
												<td>$baris[nama_kabupaten]</td>
												
												<td>
						
													<a href='admin.php?page=edit-harga&id=$baris[id_harga]'><i class='fa fa-pencil fa-lg'></i></a>
													<a href='proses-delete-harga.php?id=$baris[id_harga]' ><i class='fa fa-trash fa-lg'></i></a>
												
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
		