<?php
    $sel = mysql_query("select tb_login.id_login, tb_finance.id_finance from tb_login inner join tb_finance on tb_login.id_login=tb_finance.id_login  where username='$_SESSION[user]'");
    $br=mysql_fetch_assoc($sel);
    $_SESSION['finance']=$br['id_finance'];
    //echo "".$_SESSION['finance'];
    
?>
 <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="admin.php">Finance</a></h1> 
				
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1" style="margin: 20px;">
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo "Hello " .$_SESSION['user'];?><i class="caret"></i></span></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="logout.php"><i class="fa fa-envelope"></i>Sign Out</a></li>
		              </ul>
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix"></div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="admin.php" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>
                   
                    <li>
                        <a href="admin.php?page=suku-bunga" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i> <span class="nav-label">Suku Bunga</span></a>
                    </li>

                    <li>
                        <a href="admin.php?page=data-surveyor" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i> <span class="nav-label">Data Surveyor</span></a>
                    </li>

                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-money nav_icon"></i><span class="nav-label">Data Kredit</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="admin.php?page=penjualan-kredit&pg=1" class=" hvr-bounce-to-right"> <i class="fa fa-motorcycle nav_icon"></i>Laporan Kredit</a></li>

                            <li><a href="admin.php?page=penjualan-kredit&pg=2" class=" hvr-bounce-to-right"> <i class="fa fa-motorcycle nav_icon"></i>Laporan Kredit Berjalan</a></li>
                            
                            <li><a href="admin.php?page=penjualan-kredit&pg=3" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i>Laporan Kredit Ditolak</a></li>

                            <li><a href="admin.php?page=penjualan-kredit&pg=4" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i>Laporan Kredit Lunas</a></li>
                       </ul>
                    </li>
                    
                    <li>
                        <a href="admin.php?page=data-bpkb" class=" hvr-bounce-to-right"><i class="fa fa-file nav_icon"></i> <span class="nav-label">Penyerahan BPKB</span></a>
                    </li>

                </ul>
            </div>
			</div>
        </nav>