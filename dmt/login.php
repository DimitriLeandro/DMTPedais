<?php
	require_once("php/novaSenha.class.php");		
	require_once("php/verificar.class.php");		
	require_once('php/login.class.php');

	$obj_verificar = new Verificar();
	$obj_verificar -> verificar_permissao_login();
	unset($obj_verificar);
	
	$acesso = "";
	$trocarsenha = "";
	
	if(isset($_POST['btn_login']))
	{
		$obj_login = new Login();
		$acesso = $obj_login -> logar($_POST['txt_email'], $_POST['txt_senha']);
		unset($obj_login);
	}
	
	if(isset($_POST['btn_enviar']))
	{
		$obj_novasenha = new NovaSenha();
		$trocarsenha = $obj_novasenha -> mudarSenha($_POST['txt_email']);
		unset($obj_novasenha);
	}
?>
<html lang="pt">
    <head>
    <title>DMT - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8">
		<!--fonts-->
		<link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
		
		<!--fonts-->
		<!--bootstrap-->
			 <link href="dmtFiles/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!--coustom css-->
			<link href="dmtFiles/css/style.css" rel="stylesheet" type="text/css"/>
        <!--shop-kart-js-->
        <script src="dmtFiles/js/simpleCart.min.js"></script>
		<!--default-js-->
			<script src="dmtFiles/js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="dmtFiles/js/bootstrap.min.js"></script>
		<!--script-->
         <!-- FlexSlider -->
            <script src="dmtFiles/js/imagezoom.js"></script>
              <script defer src="dmtFiles/js/jquery.flexslider.js"></script>
            <link rel="stylesheet" href="dmtFiles/css/flexslider.css" type="text/css" media="screen" />

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
	<section id="section_login">
		<?php require_once('header.php'); ?>
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
                             <h3>Login</h3>
                             <div class="strip"></div>
                             <p>Bem vindo!<br/>Entre para comprar seus pedais e visualizar suas compras.</p>
                             <form method="post">
                                 <h5>E-Mail:</h5>	
                                 <input type="text" name="txt_email">
                                 <h5>Senha:</h5>
                                 <input type="password" name="txt_senha">
								 <?php echo $acesso; ?><br/>
                                 <input type="submit" value="Login" name="btn_login">
								 <span style="color: #0000ff; cursor: pointer;" onclick="show_senha();">&nbsp;&nbsp;&nbsp;Esqueceu sua senha?</span>
                             </form>
                    </div>
                    <div class="col-md-6 login-right">
                            <h3>Ainda não tem uma conta?</h3>
                            <div class="strip"></div>
                            <p>Para comprar nossos pedais, é necessário se cadastrar, você só precisa nos dizer seu nome e endereço para que possamos saber para onde enviar seus pedais.</p>
                            <a href="cadastro.php" class="button">Cadastro</a>
                    </div>
                    <div class="clearfix"></div>
					<section id="esqueceu_senha">
						<br/><br/>
						<div class="col-md-6 log">
							<h3>Esqueceu sua senha?</h3>
                             <div class="strip"></div>
                             <p>Por favor, insira seu endereço de email para que possamos enviar sua nova senha.</p>
                             <form method="post">
                                 <h5>E-Mail:</h5>	
                                 <input type="email" name="txt_email"><br>					
                                 <input name="btn_enviar" type="submit" value="Enviar">
                             </form>
						</div>
					</section>
                </div>
            </div>
        </div>
		
		<script>
			$('#esqueceu_senha').fadeOut(0);
		
			function show_senha()
			{
				$('#esqueceu_senha').fadeIn();
			}
		</script>
		<!-- //login-page -->
        <!--signup-->
    <?php require_once('footer.php'); ?>
	</section>
	
	
	<!----------------- ALERT --------------->
	<div class="alert">
		<section style="padding: 5px;">
			<p><?php echo $trocarsenha; ?></p>
			<p align="right"><button type="button" class="btn btn-info" onclick="normal();">OK</button></p>
		</section>
	</div>
	<style>
		.alert{
			position: absolute;
			width: 50%;
			top: 50%;
			margin-left: 25%;
			background: #ffffff;
			border-radius: 25px;
			border: 2px solid #cccccc;
		}
	</style>
	<script>
		$(".alert").fadeOut(0);
		
		function alertar()
		{
			$("#section_login").fadeTo(0, 0.1);
			$(".alert").fadeIn(0);
		}
		
		function normal()
		{
			$("#section_login").fadeTo(300, 1);
			$(".alert").fadeOut(300);
		}
	</script>
	<?php
		if($trocarsenha != "")
		{
			echo "<script>alertar();</script>";
		}
	?>
	
    </body>
</html>