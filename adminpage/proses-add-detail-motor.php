<?php
if (isset($_POST['submit'])){
	
	session_start();
	if($_SESSION['user']==''){
		header('Location:login.php');
	}
	include "koneksi.php";
			$nama=$_POST ['motor'];
			$namaD=$_POST ['namaD'];
			$warna=$_POST ['warna'];
			$hasil = mysql_query("INSERT INTO tb_det_motor (id_motor, nama_det_motor) VALUES ('$nama','$namaD')") or die(mysql_error());
			$sql = mysql_query("select * from tb_det_motor where id_det_motor = (select MAX(id_det_motor) from tb_det_motor)");
			$bar = mysql_fetch_array($sql);
			$tes=$bar['id_det_motor'];
		$j = 0;
			$folder = "images/barang/detail";
			for($i=0;$i<count($_FILES["gambar"]["name"]);$i++){
  if($warna[$i]!="" && $_FILES["gambar"]["name"][$i]!="" )
  {

			
			$tmp_name = $_FILES["gambar"]["tmp_name"][$i];
			$name = $folder."/".$_FILES["gambar"]["name"][$i];
			move_uploaded_file($tmp_name, $name);
			$j = $j + 1;
			//echo "berhasil  ".$_FILES["gambar"]["name"][$i];
			//echo "tes ".$warna[$i];	
   mysql_query("insert into tb_warna values('', '$tes','$warna[$i]','$name')");	 
	
		//echo "<script>alert('Masukan Produk Berhasil'); location.href='admin.php?page=data-produk'</script>";
		header('location: admin.php?page=detail-motor');	
  	//echo "tes $warna[$i]";
  }
 }
}

			
				
?>