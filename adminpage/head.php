<head>
<title>Dealer Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<script src="ckeditor/ckeditor.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>



<!--pie-chart-->
<script src="js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#3bb2d0',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#fbb03b',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ed6498',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
			
			$(".ketua-form").submit(function(){
			var password = $(".password").val();
			var repassword = $(".repassword").val();
			if(password != repassword){
				alert("Password tidak sama");
				return false;
			}else{
				alert("Data berhasil di simpan");
			}
		});

           
        });
		var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#provinsi").change(function(){
            var provinsi = $("#provinsi").val();
            $.ajax({
                url: "ambilkabupaten.php",
                data: "provinsi="+provinsi,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#kabupaten").html(msg);
                }
            });
          });
          $("#kabupaten").change(function(){
            var kabupaten = $("#kabupaten").val();
            $.ajax({
                url: "ambilkecamatan.php",
                data: "kabupaten="+kabupaten,
                cache: false,
                success: function(msg){
                    $("#kecamatan").html(msg);
                }
            });
          });
        
        $("#kecamatan").change(function(){
            var kecamatan = $("#kecamatan").val();
            $.ajax({
                url: "ambilkelurahan.php",
                data: "kecamatan="+kecamatan,
                cache: false,
                success: function(msg){
                       $("#kelurahan").html(msg);
                }
            });
          });
        $("#merk").change(function(){
                 var merk = $("#merk").val();
            $.ajax({
                url: "ambilmerk.php",
                data: "merk="+merk,
                cache: false,
                success: function(msg){
                       $("#motor").html(msg);
                }
            });
            });
       
            $("#type").change(function(){
                 var type = $("#type").val();
                 var merk = $("#merk").val();
            $.ajax({
                url: "ambilmotor.php",
                data: {"type":type,"merk":merk},
                //data: "{'type=''"+type"','merk=''"+merk"'}",
                cache: false,
                success: function(msg){
                       $("#motor").html(msg);
                }
            });
            });
             $("#motor").change(function(){
                 var motor = $("#motor").val();
            $.ajax({
                url: "ambildetmotor.php",
                data: "motor="+motor,
                cache: false,
                success: function(msg){
                       $("#detmotor").html(msg);
                }
            });
            });
           
      
        });

    </script>
   
	

<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
<script>

  $(document).ready(function(){
     
    $('#add').click(function(){
     
    var inp = $('#box');
    var but = $('#but');
     
    var i = $('input').size();
     
    $('<div id="box' + i +'" style="padding-top:10px;"><input type="text" class="form-control" name="warna[]" id="warna" placeholder="Warna" required style="width: 80%; display: inline;"><a  id="remove" class="btn btn-danger add" style="margin-left:10px;">Hapus</a><label for="exampleInputFile" style="display:block;">Pilih Gambar</label><input type="file" id="gambar" name="gambar[]"><p class="help-block" id="remove">Ukuran Gambar 842x542</p> </div>').appendTo(inp);

    
     
    i++;
     
    });
     
     
    $('body').on('click','#remove',function(){
     
    $(this).parent('div').remove();
     
    });
     
  });

</script>
</head>


<!--!DOCTYPE HTML>
<html><head>

<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>

<script>

$(document).ready(function(){
   
  $('#add').click(function(){
   
  var inp = $('#box');
   
  var i = $('input').size() + 1;
   
  $('<div id="box' + i +'"><input type="text" id="name" class="name" name="name' + i +'" placeholder="Input '+i+'"/><img src="http://findicons.com/files/icons/753/gnome_desktop/64/gnome_edit_delete.png" title="Hapus"  width="32" height="32" border="0" align="top" class="add" id="remove" /> </div>').appendTo(inp);
   
  i++;
   
  });
   
   
  $('body').on('click','#remove',function(){
   
  $(this).parent('div').remove();
   
  });
   
});

</script>

<style>

body{ font-family:Tahoma, Geneva, sans-serif; color:#000; font-size:11px; margin:0; padding:0; background-color:#edecec}

.bachors{ width:480px;height:auto;margin:0 auto;margin-top:100px; padding:10px;}

.name{width:400px; height:30px; padding:10px; border-radius:5px; border:solid #0CF 1px; margin-bottom:15px; font-size:24px;-webkit-box-shadow: 1px 1px 10px #CCC;box-shadow: 1px 1px 10px #CCC; outline:none;}

input{ margin-top:5px;}

.add{margin-left:10px; margin-top:15px; cursor:pointer;}

</style>

</head>

<body>

<div class="bachors">

<div id="box">
<input name="name" type="text" id="name" class="name" placeholder="Input 1">
<img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Fairytale_button_add.png" title="Tambah" width="32" height="32" border="0" align="top" class="add" id="add" />
</div>

</div>

</body>
</html-->
