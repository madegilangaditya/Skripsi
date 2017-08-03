<?php
session_start();
$idf=$_SESSION['finance'];
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("koneksi.php"); 
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{
		$page_number = 1;
	}
	$item_per_page = 3;
	$bln = $_GET['bln'];
	$thn = $_GET['thn'];
	$_SESSION['bln']=$bln;
	$_SESSION['thn']=$thn;
	$pg = $_GET['pg'];
	$srv=$_GET['srv'];
	$_SESSION['pg']=$pg;
	$sr=$_SESSION['srv'];
	$results = mysql_query("SELECT * FROM tb_transaksi WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn'");
	$get_total_rows = mysql_num_rows($results);
	
	$total_pages = ceil($get_total_rows/$item_per_page);
	
	$page_position = (($page_number-1) * $item_per_page);
	//echo "tes $get_total_rows, $total_pages, $page_position";

	
?>
	<div class='table' style="margin-top: 2em;">
		<a target="_blank" class='btn btn-success' href='laporan-penjualan-kredit.php?bln=<?php echo $bln; ?>&thn=<?php echo $thn; ?>&srv=<?php echo $sr; ?>' id="cetak" style="margin-bottom: 2em;"><i class="fa fa-print"></i> Cetak</a>
		<?php
			if ($idf!=0) {
				# code...
			
		?>
			<select name="srv" id="srv" class="form-control" style="float:right; width: 25%; display: inline;">
				<option value="0">Semua Surveyor</option>
				<?php
					$th = mysql_query("SELECT * FROM tb_surveyor where id_finance='$idf'");
					while ($t=mysql_fetch_array($th)) {
						echo "<option value=$t[id_surveyor]>$t[nama_surveyor]</option>";
					}
				?>
				
			</select>
		<?php
			}
		?>
		<div id="rsl">
			<input type="hidden" name="pg" id="pg" value="<?php echo "$pg"; ?>">
			<table class="table table-bordered"'>
				<thead>
					<tr>
						<th>No</th>
						<!--th>Gambar</th-->
						<th>Detail Kredit</th>
						<th>Nama Pelanggan</th>
						<th>Nama Barang</th>
						<th>Dealer</th>
						<th>Harga Motor</th>
						<th>Uang Muka</th>
						<?php
							if ($idf==0) {
								echo "<th>Finance</th>";
								# code...
							}else if ($idf!=0) {
								echo "<th>Surveyor</th>";
							}
						?>
						<th>Jenis</th>
						<!-- <th>Status</th> -->				
					</tr>
				</thead>
				
				<?php
					if ($idf==0) {
					 	# code...
					$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn'");

					 } else if ($pg==1) {
					 	$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_finance.*, tb_surveyor.nama_surveyor FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf'");	

					 }else if ($pg==2) {
					 	$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=3");

					 }else if ($pg==3) {
					 	$result = mysql_query("SELECT tb_kredit.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_surveyor.nama_surveyor, tb_finance.* FROM tb_kredit
						inner join tb_pelanggan on tb_kredit.id_pelanggan = tb_pelanggan.id_pelanggan
						inner join tb_harga on tb_kredit.id_harga = tb_harga.id_harga
						inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
						inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
						inner join tb_jawu on tb_jawu.id_jawu=tb_kredit.id_jawu
						inner join tb_bunga on tb_jawu.id_bunga = tb_bunga.id_bunga
						inner join tb_finance on tb_bunga.id_finance=tb_finance.id_finance
						left join tb_surveyor on tb_surveyor.id_surveyor=tb_kredit.id_surveyor
						WHERE MONTH(tgl_pengajuan)='$bln' AND YEAR(tgl_pengajuan)='$thn' and tb_finance.id_finance='$idf' and tb_kredit.status=4");
					 } 
					$no = 1+$page_position;
					while($bar=mysql_fetch_array($result)) { 
						$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
						$hrg=number_format($bar['harga_cash'], 0, ".", ".");
						$umuka = number_format($bar['uang_muka'], 0, ".", ".");
				?>
				<tbody>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td>
							<div>No.Kredit:
								<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>

							</div><?php echo $tgl; ?>
						</td>
						<td><?php echo "$bar[nama_pelanggan]"; ?></td>
						<td><?php echo "$bar[nama_det_motor]"; ?></td>
						<td><?php echo "$bar[nama_dealer]"; ?></td>
						<td><?php echo $hrg; ?></td>
						<td><?php echo $umuka; ?></td>
						<?php 
							if ($idf==0) {
							 	# code...
							 	echo "<td>$bar[nama_finance]</td>"; 
							 } else if ($idf!=0) {
							 	echo "<td>$bar[nama_surveyor]</td>";
							 }
						?>
						<td><?php if ($bar['jenis']==1) {
							echo "Bunga Tetap";
						}else{
							echo "Bunga Menurun";
						}?></td>
						

						
					</tr>
				</tbody>
				<?php $no++;} ?>
			</table>
		</div>
		<!-- <?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?> --></td>
	</div>
	<!--Modal-->
		<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		    <div class="modal-dialog" style="width: 80%;"> 
		        <div class="modal-content"> 
		                  
		            <div class="modal-header" id="dynamic-content"> 
		                        
		                    
		            </div> 
		        </div>
		   	</div>
		</div>
		<!--Modal-->

<script>
	$(document).ready(function(){
		
		$(document).on('click', '#getUser', function(e){
			
			e.preventDefault();
			
			var uid = $(this).data('id');   // it will get id of clicked row
			
			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader
			
			$.ajax({
				url: 'get-trans.php',
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

<script type="text/javascript">
	$(document).ready(function() {
		var pg = $("#pg").val();
		$("#srv").change(function(){
				var srv = $("#srv").val();
				console.log(srv)
				$.ajax({
					url: 'kredit-srv.php',
					data: 'srv='+srv+'&pg='+pg,
					cache: false,
					success: function(msg){
	                    $("#rsl").html(msg);
	                  
	                }
				});
		// $("#results").on( "click", ".pagination a", function (e){
		// 	e.preventDefault();
		// 	var page = $(this).attr("data-page");
		// 	$("#results").load("page-penjualan.php",{"page":page}, function(){});

				
				
			});
		});
		//$("#results" ).load( "page-penjualan.php");
		
	//});
</script>
<?php	
	exit;
}
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 1;
        $next 	        = $current_page + 1;
        $first_link     = true;
        
        if($current_page > 1){
			$previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li><a href="#" data-page="1" title="First">First</a></li>';
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">Previous</a></li>';
                for($i = ($previous); $i < $current_page; $i++){
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false;
        }
        
        if($first_link){
            $pagination .= '<li class="active"><a href="#" data-page="1" title="First">'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){
            $pagination .= '<li class="active"><a href="#" data-page="1" title="First">'.$current_page.'</a></li>';
        }else{
            $pagination .= '<li class="active"><a href="#" data-page="1" title="First">'.$current_page.'</a></li>';
        }
                
        for($i = $current_page+1; $i < $right_links; $i++){
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">Next</a></li>';
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">Last</a></li>';
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination;
}
?>
