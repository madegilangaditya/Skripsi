<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
	
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
			<?php
				$sql=mysql_query("select count(id_motor) as jml from tb_motor");
				$data=mysql_fetch_assoc($sql);
				$sql=mysql_query("select count(id_dealer) as dea from tb_dealer");
				$data1=mysql_fetch_assoc($sql);
				$sql=mysql_query("select count(id_finance) as fin from tb_finance");
				$data2=mysql_fetch_assoc($sql);
				//echo $data['jml'];
			?>
			
			<div class="col-md-4 ">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Motor</h5>
						<label><?php echo $data['jml'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Dealer Mitra</h5>
						<label><?php echo $data1['dea'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="content-top-1">
					<div class="col-md-12 top-content">
						<h5>Finance Mitra</h5>
						<label><?php echo $data2['fin'] ?></label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="grid-form">				
					<div class="grid-form1" id="results">

					</div>

					<div class="grid-form1" id="results1">

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
		$("#results" ).load( "page-test.php");
		
		$("#results").on( "click", ".pagination a", function (e){
			e.preventDefault();
			var page = $(this).attr("data-page");
			$("#results").load("page-test.php",{"page":page}, function(){});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#results1" ).load( "page-test3.php");
		
		$("#results1").on( "click", ".pagination a", function (e){
			e.preventDefault();
			var page = $(this).attr("data-page");
			$("#results1").load("page-test3.php",{"page":page}, function(){});
		});
	});
</script>