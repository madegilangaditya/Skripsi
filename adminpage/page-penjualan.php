<?php
session_start();
$idd=$_SESSION['idd'];
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
	$results = mysql_query("SELECT * FROM tb_transaksi WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn'");
	$get_total_rows = mysql_num_rows($results);
	
	$total_pages = ceil($get_total_rows/$item_per_page);
	
	$page_position = (($page_number-1) * $item_per_page);
	//echo "tes $get_total_rows, $total_pages, $page_position";
	
?>
	<div class='table' style="margin-top: 2em;">
		<a target="_blank" class='btn btn-success' href='laporan-penjualan-cash.php?bln=<?php echo $bln; ?>&thn=<?php echo $thn; ?>' id="cetak" style="margin-bottom: 2em;"><i class="fa fa-print"></i> Cetak</a>
		
		<table class="table table-bordered"'>
			<thead>
				<tr>
					<th>No</th>
					<!--th>Gambar</th-->
					<th>Detail Transaksi</th>
					<th>Nama Pelanggan</th>
					<th>Nama Barang</th>
					<th>Harga Motor</th>
					<th>Dealer</th>				
				</tr>
			</thead>
			
			<?php
				if ($idd==0) {
				 	# code...
				$result = mysql_query("SELECT tb_transaksi.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_det_transaksi.* FROM tb_transaksi 
					inner join tb_pelanggan on tb_transaksi.id_pelanggan = tb_pelanggan.id_pelanggan
					inner join tb_det_transaksi on tb_det_transaksi.id_transaksi = tb_transaksi.id_transaksi
					inner join tb_harga on tb_det_transaksi.id_harga = tb_harga.id_harga
					inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
					inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
					WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn'");
				 }else{
				 	$result = mysql_query("SELECT tb_transaksi.*, tb_pelanggan.*, tb_harga.*, tb_det_motor.nama_det_motor, tb_dealer.nama_dealer, tb_det_transaksi.* FROM tb_transaksi 
					inner join tb_pelanggan on tb_transaksi.id_pelanggan = tb_pelanggan.id_pelanggan
					inner join tb_det_transaksi on tb_det_transaksi.id_transaksi = tb_transaksi.id_transaksi
					inner join tb_harga on tb_det_transaksi.id_harga = tb_harga.id_harga
					inner join tb_det_motor on tb_det_motor.id_det_motor = tb_harga.id_det_motor
					inner join tb_dealer on tb_harga.id_dealer = tb_dealer.id_dealer
					WHERE MONTH(tgl_transaksi)='$bln' AND YEAR(tgl_transaksi)='$thn' AND tb_harga.id_dealer='$idd'");
				 }
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_transaksi']));
					$hrg=number_format($bar['jumlah_harga'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td>
						<div>No.Transaksi:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_transaksi]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_transaksi]; ?></a>
							<br>No. Detail: <?php echo "$bar[id_det_transaksi]"; ?>

						</div><?php echo $tgl; ?>
					</td>
					<td><?php echo "$bar[nama_pelanggan]"; ?></td>
					<td><?php echo "$bar[nama_det_motor]"; ?></td>
					<td><?php echo $hrg; ?></td>
					<td><?php echo "$bar[nama_dealer]"; ?></td>
					
					
				</tr>
			</tbody>
			<?php $no++;} ?>
		</table>
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
