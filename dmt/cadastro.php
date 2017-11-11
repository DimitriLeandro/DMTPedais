<?php
	require_once("php/validacao.class.php");
	require_once("php/login.class.php");
	require_once("php/verificar.class.php");		

	$obj_verificar = new Verificar();
	$obj_verificar -> verificar_permissao_login();
	unset($obj_verificar);
	
	if(isset($_POST['btn_cadastrar']))
	{
		$obj_cadastro = new Validacao();
		$ok = $obj_cadastro -> validarCadastro($_POST['txt_nome'], $_POST['txt_celular'], $_POST['txt_email'], $_POST['txt_senha'], $_POST['txt_cep'], $_POST['txt_uf'], $_POST['txt_cidade'], $_POST['txt_bairro'], $_POST['txt_rua'], $_POST['txt_numero'], $_POST['txt_comp']);
		unset($obj_cadastro);
		
		$a = false; //variavel do alert
		
		if($ok == true)
		{
			$obj_login = new Login();
			$obj_login -> logar($_POST['txt_email'], $_POST['txt_senha']);
			unset($obj_login);
		}
		else
		{
			$a = true;
		}
	}
?>
<html lang="pt">
    <head>
    <title>Cadastro - DMT Custom Shop</title>
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
		<!--validações -->
			<script type='text/javascript' src='dmtFiles/js/validacao.js'></script>
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
<section id="section_geral">
        <?php require_once('header.php'); ?>
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Cadastro</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Cadastro</h3>
				<p style="width: 40%; text-align: justify;">Bem vindo ao site da DMT Custom Shop!<br/>Para comprar nossos pedais, é necessário se cadastrar, você só precisa nos dizer seu nome e endereço para que possamos saber para onde enviar seus pedais.</p>
				<form name="cadastro" id="frm_cadastro" method="post">
					<br/><br/><br/>
					<fieldset><legend>Dados Para Contato</legend>
						<ul>
							<li>
								<input type="text" name="txt_nome" id="nome" placeholder="Nome Completo" maxlength="60" style="width: 24.9%;" onblur="validarNome(); check_submit();"/>
								<input type="text" name="txt_celular" id="celular" placeholder="Celular" maxlength="14" style="width: 24.9%;" onkeypress="mascaraCel(this)" onblur="validarCelular(); check_submit();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="email" name="txt_email" id="email" placeholder="E-Mail" maxlength="60" style="width: 24.9%;" onblur="blurEmail();" />
								<input type="email" name="txt_confirmar_email" id="confirmar_email" placeholder="Confirmar E-Mail" maxlength="60" style="width: 24.9%;" onblur="validar_confirmar_email(); check_submit();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="password" name="txt_senha" id="senha" placeholder="Senha" maxlength="32" style="width: 24.9%;" onblur="validarSenha(); check_submit();"/>
								<input type="password" name="txt_confirmar_senha" id="confirmar_senha" placeholder="Confirmar Senha" maxlength="32" style="width: 24.9%;" onblur="validarConfirmaSenha(); check_submit();"/>
							</li>
						</ul>
						<br/>
						<p id="p1"></p>
					</fieldset>	
					<br/>
					<fieldset><legend>Endereço Para Entrega</legend>
						<ul>
							<li>
								<input type="text" name="txt_cep" id="cep" maxlength="8" placeholder="CEP"  style="width: 24.9%;" onblur="validarCEP(); check_submit();"/>
								<input type="text" name="txt_uf" id="estado" placeholder="Estado" style="width: 24.9%;" maxlength="2" onblur="validarUF(); check_submit();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="text" name="txt_cidade" id="cidade" placeholder="Cidade" maxlength="30" style="width: 24.9%;" onblur="validarCidade(); check_submit();"/>
								<input type="text" name="txt_bairro" id="bairro" placeholder="Bairro" maxlength="30" style="width: 24.9%;" onblur="validarBairro(); check_submit();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="text" name="txt_rua" id="rua" placeholder="Rua" maxlength="60" style="width: 24.9%;" onblur="validarRua(); check_submit();"/>
								<input type="text" name="txt_numero" id="numero" placeholder="Número" maxlength="10" style="width: 12.3%;" onblur="validarNumero(); check_submit();"/>
								<input type="text" name="txt_comp" id="comp" placeholder="Complemento" maxlength="5" style="width: 12.3%;" onblur="validarComp(); check_submit();"/>
							</li>
						</ul>
					</fieldset>	
					<br/>
					<p id="p2"></p>					
					<input type="submit" value="Cadastrar" name="btn_cadastrar" id="btn_cadastrar"/>
				</form>
			</div>
		</div>
	</div>
	<script>
		check_submit();
		
		
		//função que verifica se o email desejado já existe
		function blurEmail()
		{ 
			var emailDesejado = $("#email").val();
			$.get('php/cadastroEmail.php?email_desejado=' + emailDesejado, function(data){
				if(data != "ok") //se ja existir fala que não tem e deixa vermelho
				{
					//disabilitando o botão submit
					$(":submit").attr("disabled", true);
					$(":submit").fadeTo(0, 0.5);
					$(":submit").css("background", "#000000");
					
					//deixando o input vermelho e exibindo a mensagem
					$("#email").css("outline", "solid 1px #FF0000");
					$("#p1").text(data);
					
					x_email = false;
				}
				else // senão pode fazer o resto da validacao
				{
					validarEmail(); 
					check_submit();
				}
			});
		}
		
		
		//função responsável por liberar o botão submit
		function check_submit(){
			var okpessoal = validarPessoal();
			var okendereco = validarEndereco();
			
			$("#p1").text(okpessoal);
			$("#p2").text(okendereco);
			
			if(okpessoal == "Dados pessoais preenchidos corretamente." && okendereco == "Endereço preenchido corretamente.")
			{
				$(":submit").removeAttr("disabled");
				$(":submit").fadeTo(300, 1);
				$(":submit").css("background", "#00ff00");
				return true;
			}
			else
			{
				$(":submit").attr("disabled", true);
				$(":submit").fadeTo(0, 0.5);
				$(":submit").css("background", "#000000");
				return false;
			}
		}
	</script>
	<?php require_once('footer.php'); ?>
</section>
	
	
	<!----------------- ALERT --------------->
	<div class="alert">
		<section style="padding: 5px;">
			<p>Alguns dados não foram preenchidos corretamente.</p>
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
			$("#section_geral").fadeTo(0, 0.2);
			$(".alert").fadeIn(0);
		}
		
		function normal()
		{
			$("#section_geral").fadeTo(300, 1);
			$(".alert").fadeOut(300);
		}
	</script>
	<?php
		if($a == true)
		{
			echo "<script>alertar();</script>";
		}
	?>
    </body>
</html>