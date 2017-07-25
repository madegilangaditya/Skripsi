<?php
	session_start();
	error_reporting(E_ERROR|E_PARSE);
	include "adminpage/koneksi.php";
?>
<!DOCTYPE html>
<html>
	<?php
		include "head.php";
	?>

	<body>
		<!--banner-->
		<div class="banner-bg banner-sec">	
			<?php
				$user=$_SESSION['username'];
				if($user==""){
				include "nav-user.php";
				}else{
					include "nav-member.php";
				}
			?>
		</div>
		<div class="cart" style="background: #f8f8f8;">
			<div class="container" style="background: #ffffff;">
				<div class="col-md-12 cart-items">
					<div class="col-md-12 cart-items" style="margin-bottom: 1em;">
						<h2 style="display: inline;">Riwayat Transaksi</h2>
						<select name="tjns" id="tjns" class="form-control" style="float:right; width: 25%; display: inline;">
							<option value=1>Transaksi Cash</option>
							<option value=2>Transaksi Kredit</option>
						</select>
						<div class="col-md-12" id="results">
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php
			include "footer.php";
		?>
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

	</body>
</html>
<!-- <script>
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

</script> -->

<script type="text/javascript"> 
	var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("body").on("click", "#responds .btn btn-danger", function(e){
          	var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 	var DbNumberID = clickedID[1]; //and get number from array
			var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
           	alert("tes");
            //var session_value = '<%=Session["warna"]%>';

            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
				url: "delete-trans.php", //Where to make Ajax calls
				dataType:"text", // Data type, HTML, json etc.
				data:myData, //Form variables
                success:function(response){
				//on success, hide  element user wants to delete.
				$('#item_'+DbNumberID).fadeOut();
				}
            });
          });
        });
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#results" ).load( "riwayat.php");

		$("#results").on( "click", ".pagination a", function (e){
					e.preventDefault();
					var page = $(this).attr("data-page");
					$("#results").load("riwayat.php",{"page":page}, function(){});
				});
		$("#tjns").change(function(){
			var tjns = $("#tjns").val();
			console.log(tjns)
			if (tjns==1) {
				$("#results" ).load( "riwayat.php");
				$("#results").on( "click", ".pagination a", function (e){
					e.preventDefault();
					var page = $(this).attr("data-page");
					$("#results").load("riwayat.php",{"page":page}, function(){});
				});
			}else if (tjns==2) {
				$("#results" ).load( "get-riwayat.php");
				$("#results").on( "click", ".pagination a", function (e){
					e.preventDefault();
					var page = $(this).attr("data-page");
					$("#results").load("get-riwayat.php",{"page":page}, function(){});
				});
			}
		});
	});
</script>