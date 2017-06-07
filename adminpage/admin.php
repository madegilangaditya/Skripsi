<?php
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	$user=$_SESSION['user'];
	include "koneksi.php";
	
?>

<!DOCTYPE HTML>
<html>
	<?php
		include "head.php";
	?>
<body>
	<div id="wrapper">
		<!---->
		<?php
			$sql=mysql_query("SELECT otoritas from tb_login WHERE username='$user'");
			$result2= mysql_fetch_array($sql);
			//echo"".$level;
			if($result2['otoritas']=="2"){
			include "nav-admin.php";
			}
			elseif($result2['otoritas']=="3"){
			include "nav-dealer.php";
			}
			elseif ($result2['otoritas']=="4") {
			include "nav-finance.php";
			}else{
				header('location:login.php');
			}
		?>
		
		<?php 
			if(isset($_GET["page"])){
				$page=$_GET["page"];
				$halaman = "$page.php";
				if(!file_exists($halaman) || empty($page)){
					include"404.php";
				}else{
					include"$halaman";
				}
			}else if ($result2['otoritas']=="2"){
				include"home.php";
			}else if ($result2['otoritas']=="3"){
				include"dealer.php";
			}else if ($result2['otoritas']=="4"){
				include "finance.php";
			}

		?>	
       


		<?php 
		include "footer.php";
		?>	 
		<!---->

</body>
</html>

