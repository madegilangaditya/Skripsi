<?php
session_start();
$idl=$_SESSION['idl'];
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("adminpage/koneksi.php"); 
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		if(!is_numeric($page_number)){die('Invalid page number!');}
	}else{
		$page_number = 1;
	}
	$item_per_page = 10;
?>
	
					
		

		<table class="table table-hover" id="hasil">
			<thead>
		    	<tr>
		      		<th>No</th>
			        <th>Detail Kredit</th>
			        <th>Angsuran Pokok</th>
			        <th>Angsuran</th>
			        <th>Jangka Waktu</th>
			        <th>Status</th>
			        <th>Action</th>
		      	</tr>
		    </thead>
			
			<?php 
				$results = mysql_query("SELECT tb_kredit.* FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_kredit ON tb_pelanggan.id_pelanggan=tb_kredit.id_pelanggan WHERE tb_pelanggan.id_login=$idl");
				
				$get_total_rows = mysql_num_rows($results);
				
				$total_pages = ceil($get_total_rows/$item_per_page);
				
				$page_position = (($page_number-1) * $item_per_page);
				// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
				// $bar=mysql_fetch_assoc($sel);
				// $idp=$bar['id_pelanggan'];
				//echo "tes $idp";
				
				//echo "tes $get_total_rows, $total_pages, $page_position";
				$result = mysql_query("SELECT tb_kredit.*, tb_jawu.jangka_waktu FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_kredit ON tb_pelanggan.id_pelanggan=tb_kredit.id_pelanggan 
							INNER JOIN tb_jawu ON tb_jawu.id_jawu=tb_kredit.id_jawu
							WHERE tb_pelanggan.id_login=$idl ORDER BY tb_kredit.id_kredit DESC LIMIT $page_position, $item_per_page");
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_pengajuan']));
					$hrg=number_format($bar['angsuran_pokok'], 0, ".", ".");
					$ang=number_format($bar['angsuran'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<div>No.Kredit:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_kredit]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_kredit]; ?></a>
						</div><?php echo $tgl; ?>
					</td>
					<td>Rp <?php echo $hrg; ?></td>
					<td>Rp <?php echo $ang; ?></td>
					<td><?php echo $bar['jangka_waktu'] ?> Bulan</td>
					<?php if ($bar['status']==1 || $bar['status']==6) {
							echo "<td style='color: #eea236; font-weight: bold;'>Belum Disurvey</td>";
							} else if ($bar['status']==2) {
								echo "<td style='font-weight: bold;'>Menunggu Konfirmasi</td>";
							}else if ($bar['status']==3) {
								echo "<td style='color: #5bc0de; font-weight: bold;'>Diterima</td>";
							}else if ($bar['status']==4) {
								echo "<td style='color: #d2322d; font-weight: bold;'>Ditolak</td>";
							}else if ($bar['status']==5) {
								echo "<td style='color: #5cb85c; font-weight: bold;'>Lunas</td>";
							}
						?>
					<td>
						<a class='btn btn-info' href='#'>Beli Lagi</a>
						<a class='btn btn-danger' href='#' >Hapus</a>
					</td>
				</tr>
			</tbody>
			<?php $no++;} ?>
		</table>
		<?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?>
	
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
				url: 'get-kredit.php',
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



