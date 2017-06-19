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
						 	$id=$_GET['id'];
						 	$_SESSION['hrg']=$id;
						 	//echo "tes ".$_SESSION['hrg'];
						 	$sql = mysql_query("SELECT tb_harga.id_det_motor, tb_harga.id_dealer, tb_harga.harga_cash,tb_det_motor.nama_det_motor, tb_det_motor.id_motor FROM tb_harga INNER JOIN tb_det_motor ON tb_det_motor.id_det_motor=tb_harga.id_det_motor WHERE id_harga=$id");
						 	$bar=mysql_fetch_array($sql);
						 	$nama=$bar['nama_det_motor'];
						 	$idd = $bar['id_det_motor'];
						 
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
								echo "<input name='iddm' type='hidden' value='$id'>";
								$sel=mysql_query("select tb_harga.id_harga, tb_harga.harga_cash, tb_harga.id_dealer from tb_harga where id_det_motor=$id order by harga_cash ASC");
								while($baris=mysql_fetch_array($sel)){
									$sel1=mysql_query("select tb_dealer.nama_dealer from tb_dealer where id_dealer=$baris[id_dealer]");
								
									while ($baris1=mysql_fetch_array($sel1)) {
										$h=$baris['harga_cash'];
										$hrg=number_format($h, 0, ".", ".");
										# code...
								/*echo "<p style='display:inline;'><label>Rp </label>$hrg <a href='#'>$baris1[nama_dealer] </a></p> 
									<div class='btn_form' style='display:inline;'>
								<input name='id$baris[id_harga]' type='hidden' value='$baris[id_harga]'>
								<button type='submit'class='btn btn-success' name='btn$baris[id_harga]' value='$baris[id_harga]'>Buy Now</button>
								<button data-toggle='modal' data-target='#view-modal' data-id='$baris[id_harga]' id='getUser' class='btn btn-info'>Fasilitas</button>
								</div></br>";*/
									}
								}
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

							<div>
								<p class="size">Masukan Uang Muka ::</p>
								<input type="number" name="umuka" id="umuka" placeholder="Uang Muka" class="form-control" style="display: inline; width: 35%; margin-bottom: 0px;">
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

		<div class="single-bottom2">

			<h6 style="font-weight: 600";>Harga Angsuran (Bulan)</h6>
			<select name="bjns" id="bjns" class="form-control" style="margin-top: 2em; width: 25%;">
				<option value=1>Bunga Tetap</option>
				<option value=2>Bunga Menurun</option>
			</select>
			<div class="product" style="margin-bottom: 20px;" id="hsl">			  
			
			</div>	
		</div>

	</div>
</div>
</form>
<!---->
<?php
include "footer.php";
?>

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
            $.ajax({
                url: "ambil-uang-muka.php",
                data: "umuka="+umuka,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                   
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
          $("#bjns").change(function(){
            var bjns = $("#bjns").val();
            var umuka = $("#umuka").val();
            //var session_value = '<%=Session["warna"]%>';

            $.ajax({
                url: "ambil-uang-muka.php",
                data: "bjns="+bjns+"&umuka="+umuka,
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
</body>
</html>

