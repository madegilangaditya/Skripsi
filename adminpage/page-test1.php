<?php
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("koneksi.php"); 
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{
		$page_number = 1;
	}
	$item_per_page = 10;
	$results = mysql_query("SELECT * FROM tb_transaksi where status=2");
	$get_total_rows = mysql_num_rows($results);
	
	$total_pages = ceil($get_total_rows/$item_per_page);
	
	$page_position = (($page_number-1) * $item_per_page);
	//echo "tes $get_total_rows, $total_pages, $page_position";
	echo "tes $_SESSION[user]";
?>
	<div class='table'>
		<h2 align='center'>Penjualan Belum Dikonfirmasi <br><br></h2>
		<table class="table table-bordered"'>
			<thead>
				<tr>
					<th>No</th>
					<th>Detail Kredit</th>
					<th>Nama Pelanggan</th>
					<th>Alamat</th>
					<!--th>Tanggal Pengajuan</th-->
					<th>Action</th>
				</tr>
			</thead>
			
			<?php 
				$result = mysql_query("SELECT tb_pelanggan.nama_pelanggan, tb_pelanggan.alamat, tb_kredit.tgl_pengajuan, tb_kredit.id_kredit FROM tb_kredit INNER JOIN tb_pelanggan ON tb_pelanggan.`id_pelanggan`=tb_kredit.id_pelanggan  WHERE tb_kredit.status=1 AND tb_kredit.id_surveyor=$_SESSION[surveyor] ORDER BY tb_kredit.tgl_pengajuan DESC LIMIT $page_position, $item_per_page");
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
					//$hrg=number_format($bar['jumlah_harga'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td>
						<div>No.Kredit:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>
						</div><?php echo $tgl; ?>
					</td>
					<td><?php echo $bar[nama_pelanggan]; ?></td>
					<td><?php echo $bar[alamat]; ?></td>
					<td>
						<a class='btn btn-success' href='konfirmasi-trans.php?id=<?php echo $bar[id_kredit]; ?>'>Konfirmasi</a>
						<a class='btn btn-info' href='proses-delete-harga.php?id=<?php echo $bar[id_kredit]; ?>' >View</a>
					</td>
				</tr>
			</tbody>
			<?php $no++;} ?>
		</table>
		<?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?></td>
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



