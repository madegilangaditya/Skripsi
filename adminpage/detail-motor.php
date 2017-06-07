 <?php
	//session_cache_limiter('private_no_expire'); // works
	session_cache_limiter('public'); // works too
	session_start();
 ?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
		<!--banner-->	
	    <div class="banner">   
			<h2>
			<a href="admin.php">Home</a>
			<i class="fa fa-angle-right"></i>
			<span>Detail Motor</span>
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
					 	<h3 id="forms-example" class="col-md-4" style="margin-bottom: 0px;">Detail Motor</h3>
						<a href="admin.php?page=add-detail-motor" class="btn btn-info" style="float: right;">Add Detail</a>
						<form class=" navbar-left-right"  method="post" name="pencarian" id="pencarian" style="margin-top: 0px; float: right;">
	              			<input type="text" name="search" id="search" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}" style="padding-bottom: 6px; padding-top: 6px; margin-top: 2px;">
	             			<input type="submit" name="submit" id="submit" value="" class="fa fa-search" style="margin-right: 20px;">
	            		</form>
						<br class="clear" /><br class="clear" />

						<?php
							include "koneksi.php";
							if ((isset($_POST['submit'])) AND ($_POST['search'] != "")) { 
							$search = $_POST['search']; 
							$hal=$_GET['page'];
							$batas = 10;
							$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
							 
							if ( empty( $pg ) ) {

							$posisi = 0;
							$pg = 1;
							} else {
							$posisi = ( $pg - 1 ) * $batas;
							}
							$sql = mysql_query("select tb_warna.id_warna, tb_warna.id_det_motor, tb_warna.warna, tb_warna.gambar, tb_det_motor.nama_det_motor, tb_motor.nama_motor from tb_warna 
								inner join tb_det_motor on tb_det_motor.id_det_motor=tb_warna.id_det_motor 
								inner join tb_motor on tb_det_motor.id_motor = tb_motor.id_motor 
								where nama_det_motor LIKE '%$search%' Limit $posisi, $batas");
							$jumlah = mysql_num_rows($sql); 
							if ($jumlah > 0) { 
							echo ' Ada '.$jumlah.' data yang sesuai.';
							echo " <table class='table table-bordered'>
									<thead>
										<tr>
											<th>No</th>
											<th>Gambar</th>
											<th>Nama Motor</th>
											<th>Nama Detail</th>
											<th>Warna</th>
											<th>Action</th>
										</tr>
									</thead>";
							 
							echo "<tbody>"; 

							$no = 1+$posisi;
							while ($res=mysql_fetch_array($sql)) { 
							$nomor++;  
							 echo "<tr>
										<td align='center'>$nomor</td>
										<td><img src='$res[gambar]' width=150></td>
										<td>$res[nama_motor]</td>
										<td>$res[nama_det_motor]</td>
										<td>$res[warna]</td>
										<td>
											<a href='admin.php?page=edit-det-motor&id=$res[id_warna]'><i class='fa fa-pencil fa-lg'></i></a>
											<a href='proses-delete-det-motor.php?id=$res[id_warna]' onclick='return delete(\"Apa anda yakin untuk menghapus".$baris["username"]."?\")'><i class='fa fa-trash fa-lg'></i></a>
										</td>			
									</tr>";
							} 
							echo "</tbody>";
							echo "</table>";

							$paging2 = mysql_query("select * from tb_warna");
							$jmldata = $nomor;
							$jmlhalaman = ceil($jmldata/$batas);

							 
							 
							echo"<br \> Halaman : ";
							for($i=1; $i<=$jmlhalaman; $i++){
							    if($i != $halaman){
							        echo"<a href=\"admin.php?page=$hal&pg=$i\">$i</a> | ";
							    }else{
							        echo"<b>$i</b> | ";
							    }
							}
							 
							    echo "<p>Total data : <b>$jmldata</b> buah</p>";
							} 
							else { // menampilkan pesan zero data 
							echo 'Maaf, hasil pencarian tidak ditemukan.'; 
							} 
							}else {


							/*else { 
								echo 'Masukkan dulu kata kuncinya';
							}*/
						?>			
						<?php

							$hal=$_GET['page'];

							$batas = 10;
							$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
							 
							if ( empty( $pg ) ) {

							$posisi = 0;
							$pg = 1;
							} else {
							$posisi = ( $pg - 1 ) * $batas;
							}
							echo " <table class='table table-bordered'>
										<thead>
											<tr>
												<th>No</th>
												<th>Gambar</th>
												<th>Nama Motor</th>
												<th>Nama Detail</th>
												<th>Warna</th>
												<th>Action</th>
											</tr>
										</thead>";
							 
							echo "<tbody>";
							$sql = mysql_query("select tb_warna.id_warna, tb_warna.id_det_motor, tb_warna.warna, tb_warna.gambar, tb_det_motor.nama_det_motor, tb_motor.nama_motor from tb_warna 
								inner join tb_det_motor on tb_det_motor.id_det_motor=tb_warna.id_det_motor 
								inner join tb_motor on tb_det_motor.id_motor = tb_motor.id_motor Limit $posisi, $batas ");
							$no = 1+$posisi;
							while ( $baris = mysql_fetch_assoc( $sql ) ) {
							echo "<tr>
										<td align='center'>$no</td>
										<td><img src='$baris[gambar]' width=150></td>
										<td>$baris[nama_motor]</td>
										<td>$baris[nama_det_motor]</td>
										<td>$baris[warna]</td>
										<td>
											<a href='admin.php?page=edit-det-motor&id=$baris[id_warna]'><i class='fa fa-pencil fa-lg'></i></a>
											<a href='proses-delete-det-motor.php?id=$baris[id_warna]' onclick='return delete(\"Apa anda yakin untuk menghapus".$baris["username"]."?\")'><i class='fa fa-trash fa-lg'></i></a>
										</td>			
									</tr>";
								$no++;
							}
							echo "</tbody>";
							echo "</table>";

							$paging2 = mysql_query("select * from tb_warna");
							$jmldata = mysql_num_rows($paging2);
							$jmlhalaman = ceil($jmldata/$batas);

							echo"<br \> Halaman : ";
							for($i=1; $i<=$jmlhalaman; $i++){
							    if($i != $halaman){
							        echo"<a href=\"admin.php?page=$hal&pg=$i\">$i</a> | ";
							    }else{
							        echo"<b>$i</b> | ";
							    }
							}
							 
							    echo "<p>Total data : <b>$jmldata</b> buah</p>";
							}
						?>

<!--nav>
      <ul class="pagination pagination-sm" style="
    margin-bottom: 0px;
">
        <li><a href="?page=detail-motor&pg=$link" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
      </ul>
    </nav-->
						
							</tbody>
						</table>

			</div>
		</div>
	</div>
		<div class="clearfix"> </div>
</div>
		<!---->
	
  
		
		<!---->
		