<?php
session_start();
error_reporting(E_ERROR|E_PARSE);
include "adminpage/koneksi.php";
?>
<!DOCTYPE html>
<html>

<?php
include "head.php";

?>

<body>
<!--banner-->

<div class="banner-bg banner-sec">	
	<?php

		$user=$_SESSION['username'];
		if($user==""){
			
		include "nav-user1.php";
		}else{
			include "nav-member.php";
		}

	?>  
</div>

<!--/banner-->
<form method="post" action="add-cart.php" enctype="multipart/form-data">
<div class="product" style="background: #f8f8f8;">
	<div class="container" style="background: #ffffff;">
		<div class="ctnt-bar cntnt">
			<div class="content-bar">
				<div class="single-page">
					<div class="product-head">
						<a href="index.php">Home</a><span>::</span>	
					</div>
					<!--Include the Etalage files-->
					<link rel="stylesheet" href="css/etalage.css">
					<!--script src="js/jquery.etalage.min.js"></script-->
						<?php
						 	$id=$_GET['id'];
						 	$sql = mysql_query("select * from tb_det_motor where id_det_motor=$id");
						 	$bar=mysql_fetch_array($sql);
						 	$nama=$bar['nama_det_motor'];

						 	$idm=$bar['id_motor'];
						 	$sql1=mysql_query("select * from tb_motor where id_motor=$idm");
						 	$bar1=mysql_fetch_array($sql1);
						 	$idme=$bar1['id_merk'];
						 	$idt=$bar1['id_type'];
						 	$des=$bar1['deskripsi'];
						 	$spek=$bar1['spesifikasi'];
						 	$sql2=mysql_query("select nama_merk from tb_merk where id_merk=$idme");
						 	$bar2=mysql_fetch_array($sql2);
						 	$merk=$bar2['nama_merk'];
						 	$sql2=mysql_query("select nama_type from tb_type where id_type=$idt");
						 	$bar2=mysql_fetch_array($sql2);
						 	$type=$bar2['nama_type'];
						 	$sql3=mysql_query("select * from tb_warna where id_det_motor=$id");
						 	$bar3=mysql_fetch_array($sql3);

						 	$gmb=$bar3['gambar'];
						 	$war=$bar3['warna'];
						?>
						<script src="lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
					<div class="details-left-slider col-md-4">
						<a id="gmb2" href="adminpage/<?php echo "$gmb"; ?>" data-lightbox="roadtrip" >
						<img id="gmb1"  src="adminpage/<?php echo "$gmb"; ?>" style="width: 300px;" />
						</a>
					</div>
					<div class="details-left-info">
						<h3 style="display: inline;"><?php echo "$nama"; ?></h3>
						
						<?php
							echo "<input name='iddm' type='hidden' value='$id'>";
							$sel=mysql_query("select tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer from tb_harga where id_det_motor=$id order by harga_cash ASC");
							while($baris=mysql_fetch_array($sel)){
								$sel1=mysql_query("select tb_dealer.nama_dealer from tb_dealer where id_dealer=$baris[id_dealer]");
							
								while ($baris1=mysql_fetch_array($sel1)) {
									$h=$baris['harga_cash'];
									$hrg=number_format($h, 0, ".", ".");
									
								}
							}
						?>
						<p class="size">Warna ::</p>

						<select name="warna" id="warna" class="form-control" style="display: inline; width: 25%;">
							<?php
								$warna = mysql_query("select * from tb_warna where id_det_motor = $id");
									while($p=mysql_fetch_array($warna)){
										echo "<option value=\"$p[id_warna]\">$p[warna]</option>\n";
										}
							?>
						</select>

						<div class="bike-type">
							<p>TYPE  ::<a href="#"><?php echo "$type"; ?></a></p>
							<p>BRAND  ::<a href="#"><?php echo "$merk"; ?></a></p>
						</div>


					</div>
					<div class="clearfix"></div>
				</div>
			</div>	
		</div>

		<div class="single-bottom2">
			<h6 style="font-weight: 600";>Fasilitas Antar Dealer</h6>
			<div class="product" style="margin-bottom: 20px;">
				<table class="table table-hover">
					<tr>
						<th style="width: 20%;">Fasilitas</th>
					        <?php
					        	$kmp=mysql_query("SELECT tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer, tb_dealer.nama_dealer FROM tb_harga INNER JOIN tb_dealer ON tb_dealer.id_dealer=tb_harga.id_dealer WHERE id_det_motor=$id ORDER BY harga_cash ASC");
					        		while ($fas=mysql_fetch_array($kmp)){
					        ?>
					        <td style="font-weight: bold; text-transform: capitalize;"><?php echo $fas[nama_dealer]; ?></td>
					       
							<?php
								
							
								}
									
							?>
					</tr>

					<tr>
				     	<th>Harga Cash</th>
					        <?php
					        		$kmp=mysql_query("SELECT tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer, tb_dealer.nama_dealer FROM tb_harga INNER JOIN tb_dealer ON tb_dealer.id_dealer=tb_harga.id_dealer WHERE id_det_motor=$id ORDER BY harga_cash ASC");
					        		while ($fas=mysql_fetch_array($kmp)){
					        		$hrg=number_format($fas[harga_cash], 0, ".", ".");	
					        ?>
					        <td>Rp <?php echo $hrg; ?></td>
					       
							<?php
								
							
								}
									
							?>
				    </tr>

				    <tr>
						<th>Gratis Servis</th>
							<?php
							$kmp1=mysql_query("SELECT tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer, tb_dealer.nama_dealer FROM tb_harga 
							INNER JOIN tb_dealer ON tb_dealer.id_dealer=tb_harga.id_dealer WHERE id_det_motor=$id ORDER BY harga_cash ASC");
					        		while ($fas1=mysql_fetch_array($kmp1)){
									$falsi = mysql_query("select * from tb_fasilitas where id_harga=$fas1[id_harga]");
									while ($br=mysql_fetch_array($falsi)) {
							?>
							<td style="font-weight: 400;"><?php echo $br['servis'];?> Kali</td>
							<?php
								}
										}
								?>
					</tr>

					<tr>
						<th>Proses BPKB</th>
							<?php
							$kmp1=mysql_query("SELECT tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer, tb_dealer.nama_dealer FROM tb_harga INNER JOIN tb_dealer ON tb_dealer.id_dealer=tb_harga.id_dealer WHERE id_det_motor=$id ORDER BY harga_cash ASC");
					        		while ($fas1=mysql_fetch_array($kmp1)){
									$falsi = mysql_query("select * from tb_fasilitas where id_harga=$fas1[id_harga]");

										while ($br=mysql_fetch_array($falsi)) {
									
									
							?>
								<td style="font-weight: 400;"><?php echo $br['bpkb'];?> Minggu</td>
							<?php
								}
										}
								?>
					</tr>

					<tr>
						<th>Gratis Helm</th>
							<?php
							$kmp1=mysql_query("SELECT tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer, tb_dealer.nama_dealer FROM tb_harga 
							INNER JOIN tb_dealer ON tb_dealer.id_dealer=tb_harga.id_dealer WHERE id_det_motor=$id ORDER BY harga_cash ASC");
					        		while ($fas1=mysql_fetch_array($kmp1)){
									$falsi = mysql_query("select * from tb_fasilitas where id_harga=$fas1[id_harga]");

									while ($br=mysql_fetch_array($falsi)) {
		
							?>
							  <td style="font-weight: 400;"><?php if($br['helm']==1){
						        	echo "Dapat";
						        	}else {echo "Tidak";} ?>
						        	</td>
							<?php
								}
										}
								?>
					</tr>

					<tr>
						<th></th>
							<?php
								echo "<input name='iddm' type='hidden' value='$id'>";
								$sel=mysql_query("select tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer from tb_harga where id_det_motor=$id order by harga_cash ASC");
								while($baris=mysql_fetch_array($sel)){
									echo "<td style='font-weight: 400;'>
									  <input name='id$baris[id_harga]' type='hidden' value='$baris[id_harga]'>
									  <button type='submit'class='btn btn-success' name='btn$baris[id_harga]' value='$baris[id_harga]'>Buy Now</button>
								        	</td>";
								}
									
							?>
					</tr>
				</table>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</form>
<!---->
<?php
include "footer.php";
?>
<!--div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                      
                       <div class="modal-header" id="dynamic-content"> 
                            
                        
                 </div> 
              </div>
       </div><!-- /.modal -->    
<!---->


<script type="text/javascript">

        
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#warna").change(function(){
            var warna = $("#warna").val();
            $.ajax({
                url: "ambil-warna.php",
                data: "warna="+warna,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    document.getElementById("gmb1").src=msg;
                    //document.getElementById("gmb2").src=msg;
                    //$("#gmb1").html(msg);
                    $("#gmb2").attr('href',msg);
                  
                }
            });
          });
        });
</script>

</body>
</html>

