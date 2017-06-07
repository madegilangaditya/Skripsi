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
				<!---start-chart-->
				<!---->
			<div class="grid-form">
				
									
				<div class="grid-form1">
				 	<h3 id="forms-example" class="" style="margin-bottom: 0px;">Data Dealer</h3>
					<a href="admin.php?page=add-dealer" class="btn btn-info" style="float: right;">Add Dealer</a><br class="clear" /><br class="clear" />
						 <table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th style="width:500px;">Alamat</th>
									<th>Telp</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									error_reporting(E_ERROR|E_PARSE);
									session_start();
									include "koneksi.php";
									$query = mysql_query("select tb_dealer.id_dealer, tb_dealer.nama_dealer, tb_kecamatan.nama_kecamatan,
														  tb_dealer.alamat, tb_dealer.telp, tb_kabupaten.nama_kabupaten, 
														  tb_provinsi.nama_provinsi from tb_dealer inner join tb_kecamatan 
														  on tb_dealer.id_kecamatan=tb_kecamatan.id_kecamatan
														  inner join tb_kabupaten
														  on tb_kecamatan.id_kabupaten=tb_kabupaten.id_kabupaten
														  inner join tb_provinsi
														  on tb_kabupaten.id_provinsi = tb_provinsi.id_provinsi");
									$i = 1;
									while($baris = mysql_fetch_array($query)){
										echo "<tr>
												<td align='center'>$i</td>
												<td>$baris[nama_dealer]</td>
												<td>$baris[alamat] kec. $baris[nama_kecamatan], kab. $baris[nama_kabupaten], prov. $baris[nama_provinsi]</td>
												<td>$baris[telp]</td>
												<td>
													<a href='admin.php?page=edit-dealer&id=$baris[id_dealer]'><i class='fa fa-pencil fa-lg'></i></a>
													<a href='proses-delete-dealer.php?id=$baris[id_dealer]' onclick='return delete(\"Apa anda yakin untuk menghapus".$baris["username"]."?\")'><i class='fa fa-trash fa-lg'></i></a>
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
		<!---->
	
  
		
		<!----->
		