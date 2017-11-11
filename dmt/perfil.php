<?php
	require_once("php/verificar.class.php");
	require_once("php/validacao.class.php");	

	$obj_verificar = new Verificar();
	$obj_verificar -> verificar_permissao_carrinho();
	unset($obj_verificar);
	
	$a = ""; //variavel do alert
	
	if(isset($_POST['btn_alterar_senha']))
	{
		$obj_update = new Validacao();
		$ok = $obj_update -> validarUpdateSenha($_POST['txt_senha']);
		unset($obj_update);
		
		if($ok == true)
		{
			$a = "Senha alterada com sucesso!";
		}
		else
		{
			$a = "Ocorreu um erro ao tentar alterar a senha.";
		}
	}
	
	if(isset($_POST['btn_salvar']))
	{
		$obj_update = new Validacao();
		$ok = $obj_update -> validarUpdateDadosPessoais($_POST['txt_celular'], $_POST['txt_cep'], $_POST['txt_uf'], $_POST['txt_cidade'], $_POST['txt_bairro'], $_POST['txt_rua'], $_POST['txt_numero'], $_POST['txt_comp']);
		unset($obj_update);
		
		if($ok == true)
		{
			$a = "Dados alterados com sucesso!";
		}
		else
		{
			$a = "Alguns dados não foram preenchidos corretamente.";
		}
	}
?>
<html lang="pt">
    <head>
    <title>Perfil - DMT Custom Shop</title>
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
		<!-- cep e validações -->
			<script type='text/javascript' src='dmtFiles/js/validacao.js'></script>
        <!--shop-kart-js-->
        <script src="dmtFiles/js/simpleCart.min.js"></script>
		<!--default-js-->
			<script src="dmtFiles/js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="dmtFiles/js/bootstrap.min.js"></script>
		<!--script validação-->
		<script type='text/javascript' src='dmtFiles/js/validacaoUpdate.js'></script>
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
                    <li class="active">Perfil</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
			<h3>Perfil</h3>
				
				<div id="hidden"></div>
				<span onclick="show_senha();" style="cursor: pointer;"><h4>Alterar Senha +</h4></span><br/><br/>
				<span onclick="show_dados_pessoais();" style="cursor: pointer;"><h4>Alterar Dados Pessoais +</h4></span>
				
				
				
				<!------------------------------------------ ALTERAR SENHA ------------------------------------------->
				<form name="frm_senha" id="frm_senha" method="post">
					<br/><br/><br/>
					<fieldset><legend>Alterar Senha</legend>
						<ul>
							<li>
								<input type="password" name="txt_senha" id="senha" placeholder="Nova Senha" maxlength="32" style="width: 24.9%;" onblur="validarSenha(); check_btn();"/>
								<input type="password" name="txt_confirmar_senha" id="confirmar_senha" placeholder="Confirmar Nova Senha" maxlength="32" style="width: 24.9%;" onblur="validarConfirmaSenha(); check_btn();"/>
							</li>
						</ul>
						<br/>
						<input type="submit" value="Alterar" name="btn_alterar_senha" id="btn_alterar_senha" disabled />
						<p id="p1"></p>
					</fieldset>
				</form>
					
								
				<!------------------------------------------ ALTERAR DADOS ------------------------------------------->	
				<form name="frm_pessoal" id="frm_pessoal" method="post">
				<br/><br/><br/>
					<fieldset><legend>Alterar Dados Pessoais</legend>
						<ul>
							<li>
								<input type="text" name="txt_celular" id="celular" placeholder="Celular" maxlength="14" style="width: 24.9%;" onkeypress="mascaraCel(this)" onblur="validarCelular(); check_btn();"/>
								<input type="text" name="txt_cep" id="cep" placeholder="CEP" maxlength="8" style="width: 18.9%;" onblur="validarCEP(); check_btn();"/>
								<input type="text" name="txt_uf" id="estado" placeholder="Estado" style="width: 5.8%;" maxlength="2" onblur="validarUF(); check_btn();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="text" name="txt_cidade" id="cidade" placeholder="Cidade" maxlength="30" style="width: 24.9%;" onblur="validarCidade(); check_btn();"/>
								<input type="text" name="txt_bairro" id="bairro" placeholder="Bairro" maxlength="30" style="width: 24.9%;" onblur="validarBairro(); check_btn();"/>
							</li>
						</ul>
						<ul>
							<li>
								<input type="text" name="txt_rua" id="rua" placeholder="Rua" maxlength="60" style="width: 24.9%;" onblur="validarRua(); check_btn();"/>
								<input type="text" name="txt_numero" id="numero" placeholder="Número" maxlength="10" style="width: 12.3%;" onblur="validarNumero(); check_btn();"/>
								<input type="text" name="txt_comp" id="comp" placeholder="Complemento" maxlength="5" style="width: 12.3%;" onblur="validarComp(); check_btn();"/>
							</li>
						</ul>
					</fieldset>	
					<br/>				
					<input type="submit" value="Salvar" name="btn_salvar" id="btn_salvar" disabled />
				</form>
				
				
				
				
			</div>
		</div>
	</div>
	<script>
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#frm_pessoal").fadeOut(0);
		$("#frm_senha").fadeOut(0);
		//SHOW dos formulários
		function show_dados_pessoais()
		{
			$('#frm_senha').fadeOut(function(){
				$('#frm_pessoal').fadeIn();
			});
		}		
		function show_senha()
		{
			$('#frm_pessoal').fadeOut(function(){
				$('#frm_senha').fadeIn();
			});
		}
		
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		check_btn();
		
		function check_btn()
		{			
			//validando
			var oksenha = validarSenhaGeral()
			var okdadospessoais = validarPessoal();
			
			//o que estiver válido habilita o botão
			if(oksenha == true)
			{
				$("#btn_alterar_senha").removeAttr("disabled");
				$("#btn_alterar_senha").fadeTo(300, 1);
				$("#btn_alterar_senha").css("background", "#00ff00");
				return true;
			}
			else if(okdadospessoais == true)
			{
				$("#btn_salvar").removeAttr("disabled");
				$("#btn_salvar").fadeTo(300, 1);
				$("#btn_salvar").css("background", "#00ff00");
				return true;
			}
			else
			{
				//disabilitando os botões
				$("#btn_salvar").attr("disabled", true);
				$("#btn_salvar").fadeTo(0, 0.5);
				$("#btn_salvar").css("background", "#000000");
				
				$("#btn_alterar_senha").attr("disabled", true);
				$("#btn_alterar_senha").fadeTo(0, 0.5);
				$("#btn_alterar_senha").css("background", "#000000");
			}
		}
	</script>
    <?php require_once('footer.php'); ?>
</section>
	
	
	<!----------------- ALERT --------------->
	<div class="alert">
		<section style="padding: 5px;">
			<p><?php echo $a; ?></p>
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
		if($a != "")
		{
			echo "<script>alertar();</script>";
		}
	?>
    </body>
</html>