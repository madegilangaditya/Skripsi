<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	$pg = $_GET['pg'];
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
  		<!--banner-->	
	    <div class="banner">
	   
			<h2>
			<a href="admin.php">Home</a>
			<i class="fa fa-angle-right"></i>
			<span>Dashboard</span>
			</h2>
	    </div>
		<!--//banner-->

		<!--graph-->
		<link rel="stylesheet" href="css/graph.css">
		<!--//graph-->
		<script src="js/jquery.flot.js"></script>
		<!--content-->

		<div class="content-top">
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="grid-form">
					<div class="grid-form1">
						<?php
							if ($pg==1) {
								echo '<h2 style="display: inline; padding-bottom: 3em;">Laporan Penjualan Kredit</h2>';
							}else if ($pg==2) {
								echo '<h2 style="display: inline; padding-bottom: 3em;">Laporan Kredit Berjalan</h2>';
							}else if ($pg==3){
								echo '<h2 style="display: inline; padding-bottom: 3em;">Laporan Kredit Ditolak</h2>';
							}else if ($pg==4) {
								echo '<h2 style="display: inline; padding-bottom: 3em;">Laporan Kredit Lunas</h2>';
							}else{
								echo '<h2 style="display: inline; padding-bottom: 3em;">Laporan Penjualan Kredit</h2>';
							}
						?>
						<input type="hidden" name="pg" id="pg" value="<?php echo "$pg"; ?>">
						<select name="bln" id="bln" class="form-control" style="float:right; width: 25%; display: inline; margin-left: 2em;">
							<option>--Pilih Bulan--</option>
							<option value=1>January</option>
							<option value=2>February</option>
							<option value=3>Maret</option>
							<option value=4>April</option>
							<option value=5>Mei</option>
							<option value=6>Juni</option>
							<option value=7>Juli</option>
							<option value=8>Agustus</option>
							<option value=9>September</option>
							<option value=10>Oktober</option>
							<option value=11>November</option>
							<option value=12>Desember</option>
						</select>			
						<select name="thn" id="thn" class="form-control" style="float:right; width: 25%; display: inline;">
							<option>--Pilih Tahun--</option>
							<?php
								$th = mysql_query("SELECT YEAR(tgl_pengajuan) AS thn FROM tb_kredit GROUP BY thn");
								while ($t=mysql_fetch_array($th)) {
									echo "<option value=$t[thn]>$t[thn]</option>";
								}
							?>
							
						</select>
							
						<div id="results-kred">
							
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="clearfix"> </div>
	</div>

		<!--//content-->
	

<script type="text/javascript">
	$(document).ready(function() {
		var pg = $("#pg").val();
		$("#thn").change(function(){
				var thn =$("#thn").val();

			$("#bln").change(function(){
				var bln =$("#bln").val();
				$.ajax({
					url: 'page-kredit.php',
					data: 'bln='+bln+"&thn="+thn+"&pg="+pg,
					cache: false,
					success: function(msg){
	                    $("#results-kred").html(msg);
	                  
	                }
				});
		// $("#results").on( "click", ".pagination a", function (e){
		// 	e.preventDefault();
		// 	var page = $(this).attr("data-page");
		// 	$("#results").load("page-penjualan.php",{"page":page}, function(){});

				
				});
			});
		});
		//$("#results" ).load( "page-penjualan.php");
		
	//});
</script>



