<?php
	session_start();
	//esse if verifica se ele já ta logado
	if(isset($_SESSION['login']) && isset ($_SESSION['senha']) && $_SESSION['login'] == "f60daed98da1243b41fb5188f1a1235d" && $_SESSION['senha'] == "c6efc94dc5a28dee5f1b030503ecf61d")
	{
		header('Location: adminDmt/');
	}
	else //se não estiver, ai disponibiliza o botão
	{
		if(isset($_POST['login']))
		{
			$user = md5($_POST['user']); 
			$password = md5($_POST['password']); 
			if($user == "f60daed98da1243b41fb5188f1a1235d" && $password == "c6efc94dc5a28dee5f1b030503ecf61d")
			{
				$_SESSION['login'] = $user;
				$_SESSION['senha'] = $password;
				header('Location: adminDmt/');
			}
		}
	}
?>
<html lang="en">
    <head>
    <title>Login DMT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8">
		<!--fonts-->
		<link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
		
		<!--fonts-->
		<!--bootstrap-->
			 <link href="../dmtFiles/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!--coustom css-->
			<link href="../dmtFiles/css/style.css" rel="stylesheet" type="text/css"/>
        <!--shop-kart-js-->
        <script src="../dmtFiles/js/simpleCart.min.js"></script>
		<!--default-js-->
			<script src="../dmtFiles/js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="../dmtFiles/js/bootstrap.min.js"></script>
		<!--script-->
         <!-- FlexSlider -->
            <script src="../dmtFiles/js/imagezoom.js"></script>
              <script defer src="../dmtFiles/js/jquery.flexslider.js"></script>
            <link rel="stylesheet" href="../dmtFiles/css/flexslider.css" type="text/css" media="screen" />

            <script>
            // Can also be used with $(document).ready()
            $(window).load(function() {
              $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
              });
            });
            </script>
        <!-- //FlexSlider-->
    </head>
    <body>
        
		
		<div class="header">
            <div class="container">
                <div class="header-top">
				<br><br>
                    <center>
                        <a href="index.php"><img src="../dmtFiles/images/logo.png" style="width: 220px; height: 110px;"></a>
                    </center>
				<div class="clearfix"></div>
                </div>
                <!---menu-----bar--->
                <div class="header-botom">
                    <div class="content white">
                    <nav class="navbar navbar-default nav-menu" role="navigation">
                        <div class="clearfix"></div>
                        <!--/.navbar-header-->
                        <!--/.navbar-collapse-->
                        <div class="clearfix"></div>
                    </nav>
                    <!--/.navbar-->   
                        <div class="clearfix"></div>
                    </div>
                    <!--/.content--->
                </div>
                    <!--header-bottom-->
            </div>
        </div>
		
		
		
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">HOME</a></li>
                    <li class="active">LOGIN</li>
                </ol>
            </div>
        </div>
        <!--signup-->
        <!-- login-page -->
        <div class="login">
            <div class="container">
                <div class="login-grids">
                    <div class="col-md-6 log">
                             <div class="strip"></div>
                             <form method="post">	
                                 <input type="text" name="user" placeholder="Login">
                                 <input type="password" name="password" placeholder="Senha"><br>					
                                 <input type="submit" value="Login" name="login">
                             </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
    </body>
</html>