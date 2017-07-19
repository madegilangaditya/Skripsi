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
	<div class='table' >
		<div class="col-md-12 cart-items" style="margin-bottom: 1em;" id="results">
			<h2 style="display: inline;">Riwayat Transaksi</h2>
			<select name="tjns" id="tjns" class="form-control" style="float:right; width: 25%; display: inline;">
				<option value=1>Transaksi Cash</option>
				<option value=2>Transaksi Kredit</option>
			</select>		
		

		<table class="table table-hover" id="hasil">
			<thead>
		    	<tr>
		      		<th>No</th>
			        <th>Detail Transaksi</th>
			        <th>Total Harga</th>
			        <th>Status</th>
			        <th>Action</th>
		      	</tr>
		    </thead>
			
			<?php 
				$results = mysql_query("SELECT tb_pelanggan.*, tb_transaksi.* FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_transaksi ON tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan WHERE tb_pelanggan.id_login=$idl");

				$get_total_rows = mysql_num_rows($results);
				
				$total_pages = ceil($get_total_rows/$item_per_page);
				
				$page_position = (($page_number-1) * $item_per_page);
				// $sel = mysql_query("select id_pelanggan from tb_pelanggan where id_login=$idl");
				// $bar=mysql_fetch_assoc($sel);
				// $idp=$bar['id_pelanggan'];
				//echo "tes $idp";
				
				//echo "tes $get_total_rows, $total_pages, $page_position";
				$result = mysql_query("SELECT tb_pelanggan.*, tb_transaksi.* FROM tb_pelanggan
							INNER JOIN tb_login ON tb_login.id_login=tb_pelanggan.id_login
							INNER JOIN tb_transaksi ON tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan WHERE tb_pelanggan.id_login=$idl ORDER BY id_transaksi DESC LIMIT $page_position, $item_per_page");
				$no = 1+$page_position;
				while($bar=mysql_fetch_array($result)) { 
					$tgl = date("d F Y H:i:s", strtotime($bar['tgl_transaksi']));
					$hrg=number_format($bar['jumlah_harga'], 0, ".", ".");
			?>
			<tbody>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<div>No.Transaksi:
							<a href='#' data-toggle='modal' data-target='#view-modal' data-id='<?php echo $bar[id_transaksi]; ?>' id='getUser'  style='color: #b30143;'><?php echo $bar[id_transaksi]; ?></a>
						</div><?php echo $tgl; ?>
					</td>
					<td>Rp <?php echo $hrg; ?></td>
					<td>Menunggu Pembayaran</td>
					<td>
						<a class='btn btn-info' href='#'>Beli Lagi</a>
						<a class='btn btn-danger' href='#' >Hapus</a>
					</td>
				</tr>
			</tbody>
			<?php $no++;} ?>
		</table>
		<?php echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages); ?>
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
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#tjns").change(function(){
            var tjns = $("#tjns").val();
            $.ajax({
                url: "get-riwayat.php",
                data: "tjns="+tjns,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#hasil").html(msg);
                }
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



