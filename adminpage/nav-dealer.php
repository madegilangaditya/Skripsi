<?php
    $user = $_SESSION['user'];
    $sel = mysql_query("select id_login from tb_login where username = '$user'");
    $br = mysql_fetch_array($sel);
    $sql = mysql_query("select id_dealer from tb_dealer where id_login = $br[id_login]");
    $br1 = mysql_fetch_array($sql);
    $_SESSION['idd']=$br1['id_dealer'];
 ?>
 <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">Dealer</a></h1>         
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
                      <li><a href="admin.php?page=edit-dealer&id=<?php echo "$br1[id_dealer]"; ?>"><i class="fa fa-user"></i>Edit Dealer</a></li>
		              <li><a href="logout.php"><i class="fa fa-sign-in"></i>Sign Out</a></li>
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
                        <a href="admin.php?page=data-harga" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i> <span class="nav-label">Data Motor</span></a>
                    </li>
                        <li>
                        <a href="admin.php?page=penjualan-cash" class=" hvr-bounce-to-right"><i class="fa fa-desktop nav_icon"></i> <span class="nav-label">Data Penjualan</span></a>
                        
					   
                    </li>
                </ul>
            </div>
			</div>
        </nav>