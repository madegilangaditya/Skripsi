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
<!--Include the Etalage files-->
<link rel="stylesheet" href="css/etalage.css">
<!--script src="js/jquery.etalage.min.js"></script-->
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
<form method="post" action="form-angsuran.php" enctype="multipart/form-data">
<!--/banner-->
	<div class="product" style="background: #f8f8f8;">
		<div class="container" style="background: #ffffff;">
			<div class="ctnt-bar cntnt">
				<div class="content-bar">
					<div class="single-page">
						<div class="product-head">
							<a href="index.php">Home</a> <span>::</span>	
						</div>
						<?php
							 	$id=$_SESSION['hrg'];
							 	$umuka=$_GET['um'];
							 	$_SESSION['umuka']=$umuka;
							 	$jw=$_GET['jw'];
							 	$sql = mysql_query("select harga_cash from tb_harga where id_harga='$id'");
								$b = mysql_fetch_array($sql);
								$hrg = $b['harga_cash'];
								//$_SESSION['umuka']=$umuka;
								$bjns = $_GET['bjns'];
							 	//echo "tes ".$_SESSION['hrg'];
							 	$sql = mysql_query("SELECT tb_harga.id_det_motor, tb_harga.id_dealer, tb_dealer.nama_dealer, tb_harga.harga_cash,tb_det_motor.nama_det_motor, tb_det_motor.id_motor FROM tb_harga 
							 		INNER JOIN tb_det_motor ON tb_det_motor.id_det_motor=tb_harga.id_det_motor 
							 		inner join tb_dealer on tb_harga.id_dealer=tb_dealer.id_dealer WHERE id_harga=$id");
							 	$bar=mysql_fetch_array($sql);
							 	$nama=$bar['nama_det_motor'];
							 	$idd = $bar['id_det_motor'];
							 	$namad = $bar['nama_dealer'];
							 	$hr=$bar['harga_cash'];
							 	$hrg = number_format($bar['harga_cash'],0, ".", ".");
							 
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
							 	$sql3=mysql_query("select * from tb_warna where id_det_motor=$idd");
							 	$bar3=mysql_fetch_array($sql3);

							 	$gmb=$bar3['gambar'];
							 	$war=$bar3['warna'];
						 	?>
						<!--//details-product-slider-->
						<div class="details-left-slider col-md-4">
							<a id="gmb2" href="adminpage/<?php echo "$gmb"; ?>" data-lightbox="roadtrip" >
							<img id="gmb1"  src="adminpage/<?php echo "$gmb"; ?>" style="width: 300px;" />
							</a>
						</div>

						<div class="details-left-info">
							<h3 style="display: inline;"><?php echo "$nama"; ?><!--div><a class="btn">$baris1[nama_dealer] </a></div--></h3>
							<h4></h4>
							<!--h4>Model No: 3498</h4-->
							
								<?php
									
									echo "<p style='display:inline;'><label>Rp </label>$hrg <a href='#'>$namad </a></p> 
										</br>";
										
								?>
								<p class="size">Warna ::</p>
								<select name="warna" id="warna" class="form-control" style="display: inline; width: 25%;">
									<?php
										$warna = mysql_query("select * from tb_warna where id_det_motor = $idd");
											while($p=mysql_fetch_array($warna)){
												echo "<option value=\"$p[id_warna]\">$p[warna]</option>\n";
												
											}

									?>
								</select>
								<?php
									$dp=mysql_query("select max(min_dp) as max_dp from tb_bunga");
									$bdp=mysql_fetch_assoc($dp);
									$mdp=$bdp['max_dp'];
									$dp_min=$bar['harga_cash']*($mdp/100);
									
								?>
								<div>
									<p class="size">Masukan Uang Muka ::</p>
									<input type="hidden" name="mumuka" id="mumuka" value="<?php echo "$dp_min"; ?>">
									<input type="hidden" name="jw" id="jw" value="<?php echo "$jw"; ?>">
									<input type="number" name="umuka" id="umuka" placeholder="Uang Muka" class="form-control" style="display: inline; width: 35%; margin-bottom: 0px;" value="<?php echo $umuka; ?>">
									<a id="ang" class="btn btn-primary add" style="color:#fff;">Lihat</a>
								</div>

								<div class="bike-type">
									<p>TYPE  ::<a href="#"><?php echo "$type"; ?></a></p>
									<p>BRAND  ::<a href="#"><?php echo "$merk"; ?></a></p>
								</div>
								
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>						
			</div>

			<div class="single-bottom2" id="hsll">

				<h6 style="font-weight: 600";>Fasilitas Finance</h6>
				<select name="bjns" id="bjns" class="form-control" style="display: inline; margin-top: 1em; width: 25%;">
					<option value=1>Bunga Tetap</option>
					<option value=2>Bunga Menurun</option>
				</select>
				<div style="float: right; width: 30%;">
					<label style="display: inline;">Jangka Waktu:</label>
					<select name="jawu" id="jawu" class="form-control" style="display: inline; margin-top: 1em; width: 50%;">
						<?php
							echo "<option value=$jw>$jw Bulan</option>";
							$mkl=mysql_query("select jangka_waktu from tb_jawu group by jangka_waktu");
							while ($bs=mysql_fetch_array($mkl)) {
								# code...
								echo "<option value=$bs[jangka_waktu]>$bs[jangka_waktu] Bulan</option>";
							}
						?>
					</select>
				</div>
				<div class="product" style="margin-bottom: 20px;" id="hsl">			  
					<table class="table table-hover">
						<tr>
							<th style="width: 20%;">Finance</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
									INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
									INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
									WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									# code...
							?>
								<td style="font-weight: bold; text-transform: uppercase;"><?php echo $fas[nama_finance]; ?></td>
							<?php
								}
							?>
						</tr>

						<tr>
							<th>Bunga Angsuran</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
							?>
								<td style="text-transform: capitalize;"><?php echo $fas[bunga_tetap]; ?>%</td>
							<?php		
								}
							?>
						</tr>	

						<tr>
							<th>Biaya Administrasi</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									$bia = number_format($fas['biaya_tambahan']);
							?>
								<td style="text-transform: capitalize;">Rp <?php echo $bia; ?></td>
							<?php		
								}
							?>
						</tr>

						<tr>
							<th>Batas Penarikan</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									$bts = $fas['batas_penarikan'];

							?>
								<td style="text-transform: capitalize;"><?php echo $bts; ?> Bulan Terlambat</td>
							<?php		
								}
							?>
						</tr>

						<tr>
							<th>Pelunasan Awal</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									$min_lunas = $fas['min_lunas'];

							?>
								<td style="text-transform: capitalize;">Min. <?php echo $min_lunas; ?> Bulan Cicilan</td>
							<?php		
								}
							?>
						</tr>

						<tr>
							<th>Jenis Asuransi</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									$jns = $fas['jenis_asuransi'];

							?>
								<td style="text-transform: capitalize;">
								<?php if ($jns==1) {
										echo "Total Lost Only";
									} else{
										echo "All Risk";
									}
								?>
										
								</td>
							<?php		
								}
							?>
						</tr>

						<tr>
							<th>Angsuran Per Bulan</th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
									$butap = $fas['bunga_tetap'];
									$bia = $fas['biaya_tambahan'];
									$hrgh = $hr-$umuka+$bia;
									$btap = $hrgh*$butap/100;
									$tp=round($btap);
									$angtap = $hrgh/$jw+$tp;
									$angtp =round($angtap);
									$antp = number_format(doubleval($angtp));
									//$bia = number_format($fas['biaya_tambahan']);
							?>
								<td style="text-transform: capitalize;">
								<input name='<?php echo $fas[id_jawu]; ?>' type='hidden' value='<?php echo $angtp; ?>'> Rp <?php echo $antp; ?></td>
							<?php		
								}
							?>
						</tr>

						<tr>
							<th></th>
							<?php
								$kmp=mysql_query("SELECT tb_jawu.*, tb_finance.`nama_finance`, tb_bunga.* FROM tb_jawu
										INNER JOIN tb_bunga ON tb_bunga.`id_bunga`=tb_jawu.`id_bunga`
										INNER JOIN tb_finance ON tb_finance.`id_finance`=tb_bunga.`id_finance`
										WHERE tb_jawu.`jangka_waktu`='$jw'");
								while ($fas=mysql_fetch_array($kmp)) {
							?>
								<td> <button data-toggle='modal' data-target='#view-modal' data-id='<?php echo $fas[id_jawu];?>' id='getUser' class='btn btn-info'>Detail</button>

								<button type='submit' class='btn btn-success' name='btn<?php echo $fas[id_jawu]; ?>' value='<?php echo $fas[id_jawu]; ?>'>Buy</button></td>
							<?php
								}
							?>
						</tr>
					</table>
				</div>	
			</div>

		</div>
	</div>
</form>
<!---->
<?php
include "footer.php";
?>

<!-- /.modal -->
		<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		    <div class="modal-dialog" style="width: 80%;"> 
		        <div class="modal-content"> 
		                  
		            <div class="modal-header" id="dynamic-content"> 
		                        
		                    
		            </div> 
		        </div>
		   </div>
		</div>
		<!-- /.modal -->
<!---->

<script src="lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>


<script type="text/javascript">
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#warna").change(function(){
            var warna = $("#warna").val();
           
            //var session_value = '<%=Session["warna"]%>';

            $.ajax({
                url: "ambil-warna.php",
                data: "warna="+warna,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    // <%Session["warna"] = warna ;%>
                    document.getElementById("gmb1").src=msg;

                    //document.getElementById("gmb2").src=msg;
                    //$("#gmb1").html(msg);
                    $("#gmb2").attr('href',msg);
                  
                }
            });
          });
        });
</script>

<script type="text/javascript">

        
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#ang").click(function(){
            var umuka = $("#umuka").val();
            var mumuka = $("#mumuka").val();
            var jw = $("#jw").val();
            if (mumuka>umuka) {
            	alert("Uang Muka minimal "+mumuka);
				return false;
            }else{

	            $.ajax({
	                url: "kompare-finance.php",
	                data: "umuka="+umuka+"&jw="+jw,
	                cache: false,
	                success: function(msg){
	                    //jika data sukses diambil dari server kita tampilkan
	                    //di <select id=kota>
	                   
	                    //document.getElementById("gmb2").src=msg;
	                    //$("#gmb1").html(msg);
	                    $("#hsl").html(msg);
	                  
	                }
	            });
            }
          });
        });
</script>



<script type="text/javascript">

        
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#bjns").change(function(){
            var bjns = $("#bjns").val();
            var umuka = $("#umuka").val();
            var jw = $("#jw").val();
            //var session_value = '<%=Session["warna"]%>';

            $.ajax({
                url: "kompare-finance.php",
                data: "bjns="+bjns+"&umuka="+umuka+"&jw="+jw,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    // <%Session["warna"] = warna ;%>
                    
                    //document.getElementById("gmb2").src=msg;
                    //$("#gmb1").html(msg);
                    $("#hsl").html(msg);
                  
                }
            });
          });
        });
</script>

<script type="text/javascript">

        
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#jawu").change(function(){
            var bjns = $("#bjns").val();
            var umuka = $("#umuka").val();
            var jw = $("#jw").val();
            var jawu = $("#jawu").val();
            //var session_value = '<%=Session["warna"]%>';

            $.ajax({
                url: "kompare-finance.php",
                data: "bjns="+bjns+"&umuka="+umuka+"&jw="+jw+"&jawu="+jawu,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    // <%Session["warna"] = warna ;%>
                    
                    //document.getElementById("gmb2").src=msg;
                    //$("#gmb1").html(msg);
                    $("#hsl").html(msg);
                  
                }
            });
          });
        });
</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getUser', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: 'getsimul.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#dynamic-content').html('');    
			$('#dynamic-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>


</body>
</html>

