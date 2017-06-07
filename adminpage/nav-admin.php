 <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">DEMO</a></h1>         
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
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-motorcycle nav_icon"></i> <span class="nav-label">Data Motor</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							 <li><a href="admin.php?page=detail-motor" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Detail Motor</a></li>
                            <li><a href="admin.php?page=data-produk" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Data Motor</a></li>
                            
                            <li><a href="admin.php?page=data-kategori" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>Data Merk Motor</a></li>
			
						<li><a href="admin.php?page=data-type" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Data Type Motor</a></li>

					   </ul>
                    </li>
                        <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-desktop nav_icon"></i> <span class="nav-label">Data User</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
						<li><a href="admin.php?page=data-admin" class=" hvr-bounce-to-right"> <i class="fa fa-user nav_icon"></i>Data Admin</a></li>
						
                            <li><a href="admin.php?page=data-dealer" class=" hvr-bounce-to-right"> <i class="fa fa-user nav_icon"></i>Data Dealer</a></li>
                            
                            <li><a href="admin.php?page=data-finance" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Data Finance</a></li>
			
						<li><a href="admin.php?page=data-pelanggan" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Data Pelanggan</a></li>

					   </ul>
                    </li>
                </ul>
            </div>
			</div>
        </nav>