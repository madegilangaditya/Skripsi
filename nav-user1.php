<?php
include "adminpage/koneksi.php";
?>
	  <div class="container">
			 <div class="header">
			       <div class="logo">
						 <a href="index.php"><img src="images/logo.png" alt=""/></a>
				   </div>							 
				  <div class="top-nav">										 
						<label class="mobile_menu" for="mobile_menu">
						<span>Menu</span>
						</label>
						<input id="mobile_menu" type="checkbox">
					   <ul class="nav">
					   <li class="dropdown1"><a href="index.php">Home</a></li>
						  <li class="dropdown1"><a href="merk.php">Motor</a></li>
 						 <li class="dropdown1"><a href="#" data-toggle="modal" data-target="#loginModal" >Login</a></li>
						  <a class="shop" href="cart.php"><img src="images/cart.png" alt=""/></a>
						 
					  </ul>
				 </div>
				 <div class="clearfix"></div>
			 </div>
	  </div>	 
	 
			 
<!-- Modal -->
 
       
       
         
		 <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated" style="width:50%;">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
                               
                                <div  id="error"></div>
                                <div class="form loginBox">
                                    <form method="post" action="login.php" >
                                    <input id="username" class="form-control" type="text" placeholder="Username" name="username" required="">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                                   <button type="submit" class="btn btn-login" name="btn-save" id="btn-submit">
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
                </button>
                                    </form>
                                </div>
                             </div>
                        </div>

                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form method="post" class="register-form" id="register-form" action="register.php" >
                <div class="col-md-6" >
                <div class="col-md-12 form-group">
                      <label class="control-label">Nama Lengkap:</label>
                      <input id="nama" class="form-control" type="text" placeholder="Nama Lengkap" name="nama" required="">
                </div>
                <div class="col-md-12 form-group">
                      <label class="control-label">Nomor KTP:</label>  
                      <input id="ktp" class="form-control" type="number" placeholder="Nomor KTP" name="ktp" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" required="">
                </div>
                <div class="col-md-12 form-group">
                <label class="control-label">Jenis Kelamin:</label>
                <div>
                      <label class="radio-inline"><input type="radio" name="kelamin" value="1" <?php if (isset($gender) && $gender=="1") echo "checked";?> required="">Pria</label>
                    <label class="radio-inline"><input type="radio" name="kelamin" value="2" <?php if (isset($gender) && $gender=="2") echo "checked";?> required="">Wanita</label>
                </div>
                </div>
                    <div class="col-md-12 form-group ">
                    <label class="control-label">Username:</label>
                    <input id="user_name" class="form-control" type="text" placeholder="Username" name="user_name" required="">
                    </div>
                    <div class="col-md-12 form-group ">
                    <label class="control-label">Password:</label>
                    <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                    </div>
                    <div class="col-md-12 form-group ">
                    <label class="control-label">Confirm Password:</label>
                    <input id="cpassword" class="form-control" type="password" placeholder="Repeat Password" name="cpassword" required="">
                    </div>
                </div>
                 
                <div class="col-md-6" style="border-left: 1px solid #000000;">
                
                <div class="col-md-12 form-group">
                <label class="control-label">Alamat Lengkap:</label>        
                        <select name="provinsi" class="form-control" id="provinsi" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" required="">>
                            <option>Pilih Provinsi</option>
                            <?php
                                $provinsi = mysql_query("SELECT * FROM tb_provinsi ORDER BY nama_provinsi");
                                    while($p=mysql_fetch_array($provinsi)){
                                        echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
                                        }
                            ?>
                        </select>
                        </div>
                        
                        <div class="col-md-12 form-group ">
                       
                        <select name="kabupaten" class="form-control" id="kabupaten" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" >>
                            <option>Pilih Kabupaten</option>
                            <?php
                                $kabupaten = mysql_query("SELECT * FROM tb_kabupaten ORDER BY nama_kabupaten");
                                    while($p=mysql_fetch_array($provinsi)){
                                        echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
                                        }
                            ?>
                        </select>
                        </div>
                        
                        <div class="col-md-12 form-group ">
                        <select name="kecamatan" class="form-control" id="kecamatan" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" >
                            <option>Pilih Kecamatan</option>
                            <?php
                                $kecamatan = mysql_query("SELECT * FROM tb_kecamatan ORDER BY nama_kecamatan");
                                    while($p=mysql_fetch_array($provinsi)){
                                        echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
                                        }
                            ?>
                        </select>
                        </div>
                <div class="col-md-12 form-group">
                     
                     <textarea class="form-control" rows="5" id="alamat" name="alamat" placeholder="Alamat" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 30%;
    margin-bottom: 5px;
    padding: 13px 12px;
" required="" ></textarea>
                </div>
                <div class="col-md-12 form-group">
                <label class="control-label">Telepon:</label>
                      <input id="telp" class="form-control" type="number" placeholder="Telepon" name="telp" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" required="">
                </div>

                                <div class="col-md-12 form-group ">
                                <label class="control-label">Email:</label>
                                <input id="user_email" class="form-control" type="email" placeholder="Email" name="user_email" style="
    width: 100%;
    border-radius: 3px;
    border: none;
    color: #333333;
    font-size: 16px;
    height: 46px;
    margin-bottom: 5px;
    padding: 13px 12px;
" required="">
</div>
                              
                                </div>
                                 <div class="col-md-12 form-group">
                <button type="submit" class="btn btn-login" name="btn-save" id="btn-submit">
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
                </button>
            </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Belum Punya Akun?
                                 <a href="javascript: showRegisterForm();">Daftar Disini</a>
                            </span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Sudah punya akun?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>        
    		      </div>
		      </div>
		  </div>

<script type="text/javascript">

        
var htmlobjek;
        $(document).ready(function(){
          //apabila terjadi event onchange terhadap object <select id=provinsi>
          $("#provinsi").change(function(){
            var provinsi = $("#provinsi").val();
            $.ajax({
                url: "adminpage/ambilkabupaten.php",
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
                url: "adminpage/ambilkecamatan.php",
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
        
           
      
        });
</script>