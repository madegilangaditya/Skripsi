
 <head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="styles2.css">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="js/bootstrap.js"/>
	
	
    
   
   
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Login Admin</h1>
            <div class="account-wall">
                <img class="profile-img" src="images/user_login-512.png"
                    alt="">
                <form class="form-signin" name="login" class="login" action="proses_login.php" method="post">
                <input type="text" class="form-control" placeholder="Username" class="input_login" input name="username" required autofocus>
                <input type="password" class="form-control" placeholder="Password" class="input_login" input name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" action="proses_login.php">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="#" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
