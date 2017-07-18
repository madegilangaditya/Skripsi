<?php
	session_start(); 
	include "koneksi.php";
	$id = $_GET['id'];
	$sel = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_kecamatan.nama_kecamatan, tb_kecamatan.id_kabupaten, tb_kabupaten.id_provinsi, tb_kabupaten.nama_kabupaten, tb_provinsi.nama_provinsi from tb_kredit 
		inner join tb_pelanggan on tb_pelanggan.id_pelanggan = tb_kredit.id_pelanggan 
		inner join tb_kecamatan on tb_kecamatan.id_kecamatan = tb_pelanggan.id_kecamatan
		inner join tb_kabupaten on tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten
		inner join tb_provinsi on tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi where tb_kredit.id_kredit = '$id'");
	$row1=mysql_fetch_array($sel);
	$nama=$row1['nama_pelanggan'];
	$nktp=$row1['No_KTP'];
	$alamat=$row1['alamat'];
	$telp=$row1['telp'];
	$kelamin=$row1['jenis_kelamin'];
	$kec=$row1['nama_kecamatan'];
	$ikec=$row1['id_kecamatan'];
	$kab=$row1['nama_kabupaten'];
	$ikab=$row1['id_kabupaten'];
	$prov=$row1['nama_provinsi'];
	$iprov=$row1['id_provinsi'];
?>

<div id="page-wrapper" class="gray-bg dashbard-1">
   <div class="content-main">
		<!--banner-->	
	    <div class="banner">
	   
			<h2>
			<a href="admin.php">Home</a>
			<i class="fa fa-angle-right"></i>
			<span>Survey</span>
			</h2>
	    </div>
		<!--//banner-->

		<!--content-->
		<form name="input_data" action="proses-add-survey.php" method="post" enctype="multipart/form-data">
			<div class="content-top">
				<div class="col-md-12 ">
					<div class="grid-form">					
						<div class="grid-form1">
					 		<h3 id="forms-example" class="" style="margin-bottom: 10px;">Data Pemohon</h3>
					 		<input type="hidden" name="idk" id="idk" value="<?php echo $id; ?>" required>

							<div class="col-md-6 form-group ">
								<label class="control-label">Nama Lengkap</label>
								<input type="text" class="form-control" name="nama-P" id="nama-P" placeholder="Nama Lengkap" value="<?php echo $nama; ?>" required disabled>
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label" for="selector1">Pendidikan Terakhir</label>
								<select name="pddk" class="form-control" id="pddk">
									<option value="1">SD</option>
									<option value="2">SMP</option>
									<option value="3">SMA</option>
									<option value="4">S1</option>
									<option value="5">S2</option>
									<option value="5">S3</option>
								</select>
							</div>

							<div class="col-md-6 form-group">
				                <label class="control-label">Jenis Kelamin:</label>
				                <div>
				                    <label class="radio-inline"><input type="radio" name="kelamin-P" value="1" <?php if ($kelamin== 1) {echo "checked";}?> disabled>Pria</label>
									<label class="radio-inline"><input type="radio" name="kelamin-P" value="2" <?php if ($kelamin== 2) {echo "checked";}?>disabled>Wanita</label>
								</div>
							</div>

							<div class="col-md-6 form-group ">
								<label class="control-label">Nomor KTP</label>
								<input type="number" class="form-control" name="ktp-P" id="ktp-P" placeholder="Nomor KTP" value="<?php echo $nktp; ?>" required disabled>
							</div>

							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Provinsi</label>
								<select name="provinsi-P" class="form-control" id="provinsi" disabled>
									<?php echo "<option value=\"$iprov\">$prov</option>\n"; ?>
									<?php
										$provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
											while($p=mysql_fetch_array($provinsi)){
												echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
												}
									?>
								</select>
							</div>
							
							<div class="col-md-6 form-group">
								<label class="control-label">Telepon</label>
			                    <input id="telp-P" class="form-control" type="number" placeholder="Telepon" name="telp-P" value="<?php echo "".$telp;?>" disabled>
			                </div>
							
							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Kabupaten</label>
								<select name="kabupaten-P" class="form-control" id="kabupaten" disabled>
									<?php echo "<option value=\"$ikab\">$kab</option>\n"; ?>
									<?php
										$kabupaten = mysql_query("SELECT * FROM tb_kabupaten  where id_provinsi=$cek5 ORDER BY nama_kabupaten");
											while($p=mysql_fetch_array($kabupaten)){
												echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
												}
									?>
								</select>
							</div>

							<div class="col-md-6 form-group">
					            <label class="control-label">Umur Pemohon</label>
					            <input id="umur" class="form-control" type="number" placeholder="Umur Pemohon" name="umur" style="display: inline-block; width: 89%;">
					            <label class="control-label" style="display: inline;">Tahun</label>
					        </div>


							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Kecamatan</label>
								<select name="kecamatan-P" class="form-control" id="kecamatan" disabled>
									<?php echo "<option value=\"$ikec\">$kec</option>\n"; ?>
									<?php
										$kecamatan = mysql_query("SELECT * FROM tb_kecamatan where id_kabupaten=$cek4 ORDER BY nama_kecamatan");
											while($p=mysql_fetch_array($kecamatan)){
												echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
												}
									?>
								</select>
							</div>

			                <div class="col-md-12 form-group">
			 					 <label for="comment">Alamat:</label>
			  					 <textarea class="form-control" rows="5" id="alamat" name="alamat-P" disabled><?php echo "".$alamat;?></textarea>
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label">FC. KTP Pemohon:</label>
			                    <input id="ktp-P" type="file"  name="fktp-P" disabled>
			                    <p class="help-block">FC. KTP Pemohon</p>
			                </div>
							
							<div class="clearfix"> </div>
						</div>
							
						<div class="grid-form1">
					 		<h3 id="forms-example" class="" style="margin-bottom: 10px;">Data Penjamin</h3>
							<div class="col-md-6 form-group ">
								<label class="control-label">Nama Lengkap</label>
								<input type="text" class="form-control" name="nama-pe" id="nama-pe" placeholder="Nama Lengkap" required>
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label" for="selector1">Hubungan Penjamin</label>
								<select name="hub-pen" class="form-control" id="hub-pen">
									<option value="1">Orang Tua</option>
									<option value="2">Suami</option>
									<option value="3">Istri</option>
									<option value="4">Anak</option>
									<option value="5">Menantu</option>
								</select>
							</div>
							
							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Provinsi</label>
								<select name="provinsi-pe" class="form-control" id="provinsi1">
									<?php echo "<option>Pilih Provinsi</option>\n"; ?>
									<?php
										$provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
											while($p=mysql_fetch_array($provinsi)){
												echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
												}
									?>
								</select>
							</div>
							
							<div class="col-md-6 form-group ">
								<label class="control-label">Nomor KTP</label>
								<input type="number" class="form-control" name="ktp-pe" id="ktp-pe" placeholder="Nomor KTP" required>
							</div>

							
							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Kabupaten</label>
								<select name="kabupaten-pe" class="form-control" id="kabupaten1">
									<?php echo "<option>Pilih Kabupaten</option>\n"; ?>
									<?php
										$kabupaten = mysql_query("SELECT * FROM tb_kabupaten  where id_provinsi=$cek5 ORDER BY nama_kabupaten");
											while($p=mysql_fetch_array($kabupaten)){
												echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
												}
									?>
								</select>
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label">Telepon</label>
			                    <input id="telp-pe" class="form-control" type="number" placeholder="Telepon" name="telp-pe">
			                </div>

							
							<div class="col-md-6 form-group ">
								<label class="control-label" for="selector1">Kecamatan</label>
								<select name="kecamatan-pe" class="form-control" id="kecamatan1">
									<?php echo "<option>Pilih Kecamatan</option>\n"; ?>
									<?php
										$kecamatan = mysql_query("SELECT * FROM tb_kecamatan where id_kabupaten=$cek4 ORDER BY nama_kecamatan");
											while($p=mysql_fetch_array($kecamatan)){
												echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
												}
									?>
								</select>
							</div>
							
							<div class="col-md-6 form-group">
				                <label class="control-label">Jenis Kelamin:</label>
				                <div>
				                    <label class="radio-inline"><input type="radio" name="kelamin-pe" value="1" <?php if ($kelamin== 1) {echo "checked";}?>>Pria</label>
									<label class="radio-inline"><input type="radio" name="kelamin-pe" value="2" <?php if ($kelamin== 2) {echo "checked";}?>>Wanita</label>
								</div>
							</div>


			                <div class="col-md-12 form-group">
			 					 <label for="comment">Alamat:</label>
			  					 <textarea class="form-control" rows="5" id="alamat-pe" name="alamat-pe"></textarea>
							</div>

							<div class="col-md-6 form-group">
								<label class="control-label">FC. KTP Penjamin:</label>
			                    <input id="fktp-pe" type="file"  name="fktp-pe" >
			                    <p class="help-block">FC. KTP Penjamin</p>
			                </div>
							
							<div class="clearfix"> </div>
						</div>

						<div class="grid-form1">
							<h3 id="forms-example" class="" style="margin-bottom: 10px;">Data Penghasilan</h3>
							<div class="col-md-12 form-group">
								<label class="control-label" for="selector1" style="display: inline;">Jenis Pekerjaan:</label>
								<select name="jns-krj" class="form-control" id="kerja" style="display: inline; width: 40%; margin-left: 2em;">
									<option value="1">Karyawan</option>
									<option value="2">Wiraswasta</option>
									<option value="3">PNS</option>
								</select>
							</div>

							<div class="col-md-12 form-group" id="krj">
								
								<div class="col-md-6 form-group">
									<label class="control-label">Nama Perusahaan</label>
						            <input id="perusahaan" class="form-control" type="text" placeholder="Nama Perusahaan" name="perusahaan">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Jabatan</label>
						            <input id="jbtn" class="form-control" type="text" placeholder="Jabatan" name="jbtn">
						        </div>

								<div class="col-md-6 form-group">
									<label class="control-label">Gaji Pokok</label>
						            <input id="gaji" class="form-control" type="number" placeholder="Gaji Pokok" name="gaji">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Total Tunjangan</label>
						            <input id="tunjangan" class="form-control" type="number" placeholder="Total Tunjangan" name="tunjangan">
						        </div>

						        <div class="col-md-6 form-group">
						            <label class="control-label">Lama Bekerja</label>
						            <input id="lkerja" class="form-control" type="number" placeholder="Lama Bekerja" name="lkerja" style="display: inline-block; width: 89%;">
						            <label class="control-label" style="display: inline;">Tahun</label>
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">FC Slip Gaji</label>
						            <input id="fgaji"  type="file" placeholder="FC Slip Gaji" name="fgaji">
						            <p class="help-block">Scan Slip Gaji</p>
						        </div>
							</div>
							<div class="clearfix"> </div>
						</div>

						<div class="grid-form1">
							<h3 id="forms-example" class="" style="margin-bottom: 10px;">Data Tanggungan</h3>
							<div class="col-md-12 form-group">
								<label class="control-label" for="selector1" style="display: inline;">Jenis Rumah:</label>
								<select name="jns-rmh" class="form-control" id="rmh" style="display: inline; width: 40%; margin-left: 2em;">
									<option value="1">Rumah Sendiri</option>
									<option value="2">Rumah Orang Tua</option>
									<option value="3">Kontrak</option>
									<option value="4">Kost</option>
								</select>
								
							</div>
							<div class="col-md-6 form-group">
								<label class="control-label">Luas Rumah:</label>
							</div>

							<div class="col-md-12 form-group">
								
								<div class="col-md-6 form-group" >
									<label class="control-label" style="display: inline;">P:</label>
						            <input id="pbangunan" class="form-control" type="number" placeholder="Panjang" name="pbangunan" style="display: inline; width: 70%;">
						            <label class="control-label" style="display: inline;">Meter Persegi</label>
								</div>

								<div class="col-md-6 form-group" >
									<label class="control-label" style="display: inline;">L:</label>
						            <input id="lbangunan" class="form-control" type="number" placeholder="Lebar" name="lbangunan" style="display: inline; width: 70%;">
						            <label class="control-label" style="display: inline;">Meter Persegi</label>
								</div>
					        </div>

					        <div class="col-md-12 form-group" id="tes-rumah">
								<div class="col-md-6 form-group">
									<label class="control-label">Sewa Rumah Perbulan</label>
						            <input id="sewa-rmh" class="form-control" type="number" placeholder="Sewa Rumah Perbulan" name="sewa-rmh">
						        </div>	

						        <div class="col-md-6 form-group">
									<label class="control-label">Lama Tinggal</label>
						            <input id="tinggal" class="form-control" type="number" placeholder="Lama Tinggal" name="tinggal">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Biaya Rumah Tangga Perbulan</label>
						            <input id="bia-rt" class="form-control" type="number" placeholder="Biaya Rumah Tangga Perbulan" name="bia-rt">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Jumlah Tanggungan</label>
						            <input id="j-tng" class="form-control" type="number" placeholder="Jumlah Tanggungan" name="j-tng" style="display: inline-block; width: 89%;">
						            <label class="control-label" style="display: inline;">Orang</label>
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Tagihan Listrik Perbulan</label>
						            <input id="bia-pln" class="form-control" type="number" placeholder="Tagihan Listrik Perbulan" name="bia-pln">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">FC Rekening PLN</label>
						            <input id="fpln"  type="file" placeholder="FC Rekening PLN" name="fpln">
						            <p class="help-block">FC Rekening PLN</p>
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">Tagihan Air Perbulan</label>
						            <input id="bia-pdam" class="form-control" type="number" placeholder="Tagihan Listrik Perbulan" name="bia-pdam">
						        </div>

						        <div class="col-md-6 form-group">
									<label class="control-label">FC Rekening PDAM</label>
						            <input id="fpdam"  type="file" placeholder="FC Rekening PDAM" name="fpdam">
						            <p class="help-block">Upload foto sumur jika tidak ada rekening PDAM</p>
						        </div>

							</div>

							<div class="clearfix"> </div>
						</div>

						<div class="grid-form1">
							<div class="col-md-12 form-group">
								<button class="btn-success btn" name="submit" style="margin-right: 5em;">Save</button>
								<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</form>

	</div>
</div>

<script type="text/javascript">
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#provinsi").change(function(){
            var provinsi = $("#provinsi").val();
            $.ajax({
                url: "ambilkabupaten.php",
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
                url: "ambilkecamatan.php",
                data: "kabupaten="+kabupaten,
                cache: false,
                success: function(msg){
                    $("#kecamatan").html(msg);
                }
            });
          });
        });
</script>

<script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
		$("#kerja").change(function(){
            var kerja = $("#kerja").val();
            $.ajax({
                url: "get-kerja.php",
                data: "kerja="+kerja,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#krj").html(msg);
                }
            });
          });
	});
</script>
	
<script type="text/javascript">
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#provinsi1").change(function(){
            var provinsi = $("#provinsi1").val();
            $.ajax({
                url: "ambilkabupaten.php",
                data: "provinsi="+provinsi,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#kabupaten1").html(msg);
                }
            });
          });
          $("#kabupaten1").change(function(){
            var kabupaten = $("#kabupaten1").val();
            $.ajax({
                url: "ambilkecamatan.php",
                data: "kabupaten="+kabupaten,
                cache: false,
                success: function(msg){
                    $("#kecamatan1").html(msg);
                }
            });
          });
        });
</script> 
		
<!--script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
		$('#rmh').change(function(){
            var rmh = $('#rmh').val();
            var hsl = $('#tes-rumah');
            if (rmh==3 || rmh==4) {
            	$('<div class="col-md-6 form-group"><label class="control-label">Nama Perusahaan</label><input id="perusahaan" class="form-control" type="text" placeholder="Nama Perusahaan" name="perusahaan"></div>').appendTo(hsl);
            }
            
          });
	});
</script-->	
		