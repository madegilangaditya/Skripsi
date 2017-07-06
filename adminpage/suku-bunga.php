<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
  		<!--banner-->	
	    <div class="banner">
	   
			<h2>
			<a href="admin.php">Home</a>
			<i class="fa fa-angle-right"></i>
			<span>Suku Bunga</span>
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
					
				<div class="grid-form">
					
										
					<div class="grid-form1">
					 	<h3 id="forms-example" class="" style="margin-bottom: 20px;">Suku Bunga</h3>
						<?php
						$idf = $_SESSION['user'];
						$sel = mysql_query("select id_login from tb_login where username='$idf'");
						$br = mysql_fetch_array($sel);
						$sel1 = mysql_query("SELECT tb_finance.id_finance, tb_bunga.bunga_tetap, tb_bunga.bunga_menurun,tb_bunga.biaya_tambahan FROM tb_finance LEFT JOIN tb_bunga ON tb_bunga.id_finance=tb_finance.id_finance WHERE id_login = '$br[id_login]'");
						$bar = mysql_fetch_array($sel1);
						$idd = $bar['id_finance'];
						$butap = $bar['bunga_tetap'];
						$burun = $bar['bunga_menurun'];
						$biaya = $bar['biaya_tambahan'];

						//echo "tes $idf ".$bar[bunga_tetap];
						?>
						<form name="input_data" action="proses-bunga.php" method="post" enctype="multipart/form-data">
							<input name="id" type="hidden" value="<?php echo "$idd"; ?>">
							
							<div class="col-md-6 form-group2 group-mail">
								<label class="control-label" style="display: block;">Bunga Tetap</label>
								<input type="text" class="form-control" name="butap" id="butap" placeholder="Bunga Tetap" required value="<?php echo $butap; ?>" style="display: inline; width: 80%;">
								<span class="control-label">%</span>
							</div>

							<div class="col-md-6 form-group2 group-mail">
								<label class="control-label">Bunga Menurun</label>
								<input type="text" class="form-control" name="burun" id="burun" placeholder="Bunga Menurun" required value="<?php echo $burun; ?>"
								style="display: inline; width: 80%;">
								<span class="control-label">%</span>
							</div>	 

							<div class="col-md-12 form-group2 group-mail">
								<label class="control-label">Biaya Administrasi</label>
								<input type="number" class="form-control" name="biaya" id="biaya" placeholder="Harga" required value="<?php echo $biaya; ?>">
							</div>
							
							<!--div class="col-md-12 form-group group-mail" id="jawu" >
								<label class="control-label" style="display: block;">Jangka Waktu</label>
								
								<!input type="text" class="form-control" name="bulan[]" id="bulan" placeholder="Jangka Waktu" required style="width: 80%; display: inline;">
								<span class="control-label">Bulan</span>
								<a  id="add" class="btn btn-primary add">Tambah</a>
							
								<?php
									
									for($i=0;$i<mysql_num_rows($sl);$i++) {
										$br = mysql_fetch_array($sl);
										$jw = $br['jangka_waktu'];
										# code...
										if ($i==0) {
											echo "<input type='text' class='form-control' name='bulan[]' id='bulan' placeholder='Jangka Waktu' required style='width: 80%; display: inline;' value='$jw'>
									<span class='control-label'>Bulan</span>
									<a  id='add' class='btn btn-primary add'>Tambah</a>";
										}else{
								?>
									
									<div id="jawu<?php echo $i; ?>" style="padding-top:10px;">
									<input type="text" class="form-control" name="bulan[]" id="bulan" placeholder="Jangka Waktu" required style="width: 80%; display: inline;" value="<?php echo $jw; ?>">
									<span class="control-label">Bulan</span>
									<a  id="remove" class="btn btn-danger add">Hapus</a> 
									</div>
										
								
								<?php
										}
									}
								?>
							</div-->
							<div class="col-md-12 form-group2 group-mail">
								<button class="btn-success btn" name="submit" style="margin-right: 5em;">Update</button>
								<button onclick="history.back();" type="button" class="btn-danger btn">Back</button>
							</div>
						</form>
							<div class="clearfix"> </div>
					</div>
					<?php
						$ef = mysql_query("select id_bunga from tb_bunga where id_finance='$idd'");
						if (mysql_num_rows($ef)==0) {
							# code...
							echo "";
						}else{

						$b=mysql_fetch_assoc($ef);
						$idb=$b['id_bunga'];
						$sl = mysql_query("select jangka_waktu from tb_jawu where id_bunga='$idb' order by jangka_waktu ASC");
					?>
					<div class="grid-form1">
						<div class="col-md-12 form-group2 group-mail">
							<label class="control-label" style="display: block;">Jangka Waktu</label>
							<input name="idb" id="idb" type="hidden" value="<?php echo "$idb"; ?>">
							<input type="number" class="form-control" name="bulan" id="bulan" placeholder="Jangka Waktu" style="display: inline; width: 80%;">
							<a id='tbh' class='btn btn-primary add' >Tambah</a>
						</div>
			
						<div class="col-md-12 form-group2 group-mail">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Jangka Waktu</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="jw">
									<?php
										while ($jw=mysql_fetch_array($sl)) {
									?>
									<tr>
										<td><?php echo $jw['jangka_waktu'];?></td>
										<td><a href='#'><i class='fa fa-trash fa-lg'></i></a></td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
						<div class="clearfix"> </div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
	
<script>

  $(document).ready(function(){
     
    $('#add').click(function(){
     
    var inp = $('#jawu');
   
     
    var i = $('input').size();
     
    $('<div id="jawu' + i +'" style="padding-top:10px;"><input type="text" class="form-control" name="bulan[]" id="bulan" placeholder="Jangka Waktu" required style="width: 80%; display: inline;"><span class="control-label" style="margin-left:0.3em; margin-right:0.25em;">Bulan</span><a  id="remove" class="btn btn-danger add">Hapus</a> </div>').appendTo(inp);

    
     
    i++;
     
    });
     
     
    /*$('body').on('click','#tbh',function(){
    	 var bulan = $(this).parent('div').val();
    	 console.log
            $.ajax({
                url: "delete-jawu.php",
                data: "bulan="+bulan,
                //data: "{'type=''"+type"','merk=''"+merk"'}",
                cache: false,
                success: function(msg){
                       $(this).html(msg);
                       $(this).parent('div').remove();
                }
            });

   
    
    });*/
     
  });

</script>

<script type="text/javascript">
var htmlobjek;
	$(document).ready(function(){
      //apabila terjadi event onchange terhadap object <select id=provinsi>
      $("#tbh").click(function(){
        var bulan = $("#bulan").val();
        var idb = $("#idb").val();
        $.ajax({
            url: "add-jawu.php",
            data: "bulan="+bulan+"&idb="+idb,
            cache: false,
            success: function(msg){
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota>
                $("#jw").html(msg);
            }
        });
      });
    });      
</script>


		