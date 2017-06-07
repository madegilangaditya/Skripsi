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
					<a href="admin.php?page=add-harga" class="btn btn-info" style="float: right;">Add Motor</a><br class="clear" /><br class="clear" />
						 <table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<!--th>Gambar</th-->
									<th>Nama Motor</th>
									<th>Type</th>
									<th>Jenis</th>
									<th>Harga Cash</th>
									<th>Stok</th>
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
									$sel1 = mysql_query("select * from tb_dealer where id_login=$idl");
									$bar1= mysql_fetch_array($sel1);
									$idd=$bar1['id_dealer'];
									$query = mysql_query(" select tb_harga.id_harga, tb_harga.id_det_motor, tb_det_motor.nama_det_motor, tb_motor.nama_motor, tb_merk.nama_merk, tb_type.nama_type, tb_harga.harga_cash, tb_harga.stok 
									from tb_harga  LEFT JOIN tb_det_motor 
									ON tb_det_motor.id_det_motor = tb_harga.id_det_motor   
									LEFT JOIN tb_motor
									ON tb_motor.id_motor = tb_det_motor.id_motor 
									LEFT JOIN tb_type
									on tb_type.id_type = tb_motor.id_type  
									LEFT JOIN tb_merk
									on tb_merk.id_merk = tb_motor.id_merk  
									where tb_harga.id_dealer = $idd");
									$i = 1;
									while($baris = mysql_fetch_array($query)){
										$h=$baris['harga_cash'];
										$hrg=number_format($h, 0, ".", ".");
										echo "<tr>
												<td align='center'>$i</td>
												<td>$baris[nama_det_motor]</td>
												<td>$baris[nama_motor]</td>
												<td>$baris[nama_type]</td>
												<td>Rp $hrg</td>
												<td>$baris[stok]</td>
												
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
		