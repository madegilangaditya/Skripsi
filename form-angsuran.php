<?php
	session_start();
	include "adminpage/koneksi.php";
	$user=$_SESSION['username'];
		if($user==""){
			
		header("Location:index.php"); 
		}
	$idw = $_POST['warna'];
	$idh = $_SESSION['hrg'];
	$bjns = $_POST['jns'];
	$_SESSION['warna']=$idw;
	$umuka = $_POST['umuka'];
	$_SESSION['umuka']=$umuka;
	$sel = mysql_query("SELECT tb_bunga.id_bunga FROM tb_bunga");
	while ($bar=mysql_fetch_array($sel)){
		//$namaf = $bar['nama_finance'];
		$idb=$bar['id_bunga'];
		$btn='btn'.$idb;
		//$bnt='btnbn'.$idb;
		
		if(isset($_POST[$btn])){
			$sel5 = mysql_query("SELECT tb_bunga.biaya_tambahan, tb_bunga.bunga_tetap, tb_bunga.bunga_menurun FROM tb_bunga");
			$c=mysql_fetch_assoc($sel5);
			$bia = $c['biaya_tambahan'];
			$butap = $c['bunga_tetap'];
			$burun = $c['bunga_menurun'];
			$ang = $_POST[$idb];
			$idj=1;
			$_SESSION['ang']=$ang;
			$_SESSION['idb']=$idb;
			
		}

	}
	//$ang = $_POST['angsuran'];
	//echo "$id $ang";
	echo "tes $_SESSION[hrg], $_SESSION[idb], $ang, $_SESSION[umuka],$umuka, $idj, $bjns , ";
	echo $_SESSION['warna'];

?>
<style type="text/css">
	#pd{
		border:0px;
	}

	#col12{
		border-bottom: solid 1px;
	}
</style>

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
				
			include "nav-user.php";
			}else{
				include "nav-member.php";
			}
		?>
	</div>

	<div class="cart" style="background: #f8f8f8;">
		<div class="container" style="background: #ffffff;">	
			<div class="col-md-12 cart-items">
				<h2>Data Penerima</h2>
				<?php
					$idl=$_SESSION['idl'];
					$sel = mysql_query("select * from tb_pelanggan where id_pelanggan = (select MIN(id_pelanggan)) AND id_login='$idl' ");
					$b = mysql_fetch_array($sel);
					$idp = $b['id_pelanggan'];
					$nama = $b['nama_pelanggan'];
					$nktp = $b['No_KTP'];
					$alamat = $b['alamat'];
					$kec = $b['id_kecamatan'];
					$kelamin = $b['jenis_kelamin'];
					$telp = $b['telp'];
					$cek = mysql_query("select tb_kecamatan.nama_kecamatan, tb_kecamatan.id_kabupaten, tb_kabupaten.nama_kabupaten, tb_kabupaten.id_provinsi, tb_provinsi.nama_provinsi from tb_kecamatan inner join tb_kabupaten 
						on tb_kecamatan.id_kabupaten = tb_kabupaten.id_kabupaten
						inner join tb_provinsi
						on tb_kabupaten.id_provinsi=tb_provinsi.id_provinsi where id_kecamatan='$kec'");
					$bar= mysql_fetch_array($cek);
					$cek1 = $bar['nama_kecamatan'];
					$cek2 = $bar['nama_kabupaten'];
					$cek3 = $bar['nama_provinsi'];
					$cek4 = $bar['id_kabupaten'];
					$cek5 = $bar['id_provinsi'];
					$se=mysql_query("select harga_cash from tb_harga where id_harga = '$idh'");
					$a=mysql_fetch_assoc($se);
					$hrg=$a['harga_cash'];
					$d=idate("d");
					$m=idate("m");
					$y=idate("y");
					$t=$d+$m+$y+$z;
					$tot = $hrg - $umuka + $bia;
					$_SESSION['harga']=$tot;
					$fe = mysql_query("select tb_bunga.id_finance, tb_bunga.jangka_waktu, tb_finance.nama_finance from tb_bunga inner join tb_finance on tb_finance.id_finance=tb_bunga.id_finance where id_bunga = '$_SESSION[idb]'");
					$b=mysql_fetch_assoc($fe);
					$idf = $b['id_finance'];
					$namaf = $b['nama_finance'];
					$jawu = $b['jangka_waktu'];
				?>

				<form method="post" action="proses-kredit.php" enctype="multipart/form-data">
					<div class="col-md-12 cart-items" id="col12">	
						<div class="col-md-6 cart-items">
							<div class="form-group">
								<label class="control-label">Nama Lengkap:</label>
			                    <input id="nama" class="form-control" type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo "".$nama;?>">
			                </div>
			                <div class="form-group">
			                	<label class="control-label">Nomor KTP:</label>
			                    <input id="ktp" class="form-control" type="number" placeholder="Nomor KTP" name="ktp" value="<?php echo "".$nktp;?>">
			                </div>
			                <div class="form-group">
				                <label class="control-label">Jenis Kelamin:</label>
				                <div>
				                    <label class="radio-inline"><input type="radio" name="kelamin" value="1" <?php if ($kelamin== 1) {echo "checked";}?>>Pria</label>
									<label class="radio-inline"><input type="radio" name="kelamin" value="2" <?php if ($kelamin== 2) {echo "checked";}?>>Wanita</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Telepon:</label>
			                    <input id="telp" class="form-control" type="number" placeholder="Telepon" name="telp" value="<?php echo "".$telp;?>">
			                </div>
						</div>

						<div class="col-md-6 cart-items">
							<div class="form-group">
								<label class="control-label" for="selector1">Provinsi</label>
								<select name="provinsi" class="form-control" id="provinsi">
									<?php echo "<option value=\"$cek5\">$cek3</option>\n"; ?>
									<?php
										$provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
											while($p=mysql_fetch_array($provinsi)){
												echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
												}
									?>
								</select>
							</div>
								
							<div class="form-group ">
								<label class="control-label" for="selector1">Kabupaten</label>
								<select name="kabupaten" class="form-control" id="kabupaten">
									<?php echo "<option value=\"$cek4\">$cek2</option>\n"; ?>
									<?php
										$kabupaten = mysql_query("SELECT * FROM tb_kabupaten  where id_provinsi=$cek5 ORDER BY nama_kabupaten");
											while($p=mysql_fetch_array($kabupaten)){
												echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
												}
									?>
								</select>
							</div>
								
							<div class="form-group ">
								<label class="control-label" for="selector1">Kecamatan</label>
								<select name="kecamatan" class="form-control" id="kecamatan">
									<?php echo "<option value=\"$kec\">$cek1</option>\n"; ?>
									<?php
										$kecamatan = mysql_query("SELECT * FROM tb_kecamatan where id_kabupaten=$cek4 ORDER BY nama_kecamatan");
											while($p=mysql_fetch_array($kecamatan)){
												echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
												}
									?>
								</select>
							</div>

							<div class="form-group">
			 					 <label for="comment">Alamat:</label>
			  					 <textarea class="form-control" rows="5" id="alamat" name="alamat"><?php echo "".$alamat;?></textarea>
							</div>
		                </div>
		            </div>

	                <div class="col-md-12 cart-items" id="col12">
		                <h2>Data Kredit</h2>
		                <div class="col-md-6 cart-items">
		                	<div class="form-group">
								<label class="control-label">Penghasilan Per Bulan:</label>
			                    <input id="nama" class="form-control" type="Number" placeholder="Penghasilan Per Bulan" name="gajip">
			                </div>
			                <div class="form-group">
								<label class="control-label">Scan Slip Gaji/Ket.Penghasilan/FC Tabungan:</label>
			                    <input id="gaji"  type="file"  name="gaji" >
			                    <p class="help-block">Penghasilan</p>
			                </div>
			                <div class="form-group">
								<label class="control-label">Biaya Listrik Per Bulan:</label>
			                    <input id="nama" class="form-control" type="Number" placeholder="Biaya Listrik Per Bulan" name="plnp">
			                </div>
			                <div class="form-group">
								<label class="control-label">Scan Rek. PLN Bulan Terakhir:</label>
			                    <input id="kk" type="file"  name="PLN" >
			                    <p class="help-block">Rek. PLN</p>
			                </div>
		                </div>
		                <div class="col-md-6 cart-items">
		                	<div class="form-group">
								<label class="control-label">FC KTP Suami dan Istri:</label>
			                    <input id="ktp"  type="file"  name="suami" >
			                    <p class="help-block">KTP Suami</p>
			                    <input id="ktp"  type="file"  name="Istri" >
			                    <p class="help-block">KTP Istri</p>
			                </div>
			                <div class="form-group">
								<label class="control-label">FC Kartu Keluarga:</label>
			                    <input id="kk"  type="file"  name="kk" >
			                    <p class="help-block">Kartu Keluarga</p>
			                </div>
			                <div class="form-group">
								<label class="control-label">FC SIM C yang Berlaku:</label>
			                    <input id="gaji"  type="file"  name="sim" >
			                    <p class="help-block">SIM C</p>
			                </div>
		                </div>
	                </div>

	                <div class="col-md-12 cart-items" id="col12">
			            <div class="col-md-6 cart-items">
			            	<div class="form-group" >
								<div id="pd" class="price-details" >
							 		<h2>Price Details</h2>
									<span style="width: 45%;">Harga Motor</span>
									<span>Rp <span class="total" style="text-align: right;"><?php echo number_format($hrg); ?></span></span>
									<span style="width: 45%;">Biaya Administrasi</span>
									<span>Rp <span class="total" style="text-align: right;"><?php 
									echo number_format(doubleval($bia)); ?></span></span>
									<span style="width: 45%;">Uang Muka</span>
									<span>Rp <span class="total" style="text-align: right;"><?php
									echo"-";
									echo number_format(doubleval($umuka)); ?></span></span>
							 		<div class="clearfix"></div>				 
								</div>	
					 			<div class="clearfix"></div>
							</div>
			            </div>

			            <div class="col-md-6 cart-items" >
			            	<div class="form-group" >
								<div id="pd" class="price-details" style="border-bottom: 0px; " >
							 		<h2>Pilihan Angsuran</h2>
							 		<span style="width: 45%;">Jangka Waktu</span>
									<span><span class="total" style="text-align: right;"><?php
									echo $jawu; ?> Bulan</span> </span>
									<span style="width: 45%;">Angsuran Per Bulan</span>
									<span>Rp <span class="total" style="text-align: right;"><?php echo $ang; ?></span></span>
							 		<div class="clearfix"></div>				 
								</div>	
								
					 			<div class="clearfix"></div>
							</div>
			            </div>
	                </div>
	                <div class="col-md-6 cart-items">
		            	<div class="form-group" >
							<h4 class="last-price" style="width: 40%;">Angsuran Pokok</h4>
							<span class="total final" name="total" style="width: 60%; text-align: right;">Rp <?php echo number_format($tot); ?></span>
				 			<div class="clearfix"></div>
						</div>
						<div class="form-group" >
							<button  class="btn btn-success" name="btn-save" id="btn-submit" style="width:200px;">Lanjutkan Proses</button>
				        </div>
		            </div>
		            
	            </form>	 
			</div>
		</div>
	</div>
	
	<?php
		include "footer.php";
	?>
</body>

<script type="text/javascript">
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#provinsi").change(function(){
            var provinsi = $("#provinsi").val();
            $.ajax({
                url: "adminpage/ambilkabupaten.php",
                data: "provinsi="+provinsi,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#kabupaten").html(msg);
                }
            });
          });
          $("#kabupaten").change(function(){
            var kabupaten = $("#kabupaten").val();
            $.ajax({
                url: "adminpage/ambilkecamatan.php",
                data: "kabupaten="+kabupaten,
                cache: false,
                success: function(msg){
                    $("#kecamatan").html(msg);
                }
            });
          });
        
        $("#kecamatan").change(function(){
            var kecamatan = $("#kecamatan").val();
            $.ajax({
                url: "ambilkelurahan.php",
                data: "kecamatan="+kecamatan,
                cache: false,
                success: function(msg){
                       $("#kelurahan").html(msg);
                }
            });
          });
        
           
      
        });
</script>
</html>