<?php
	require_once("php/verificar.class.php");
	
	$obj_verificar = new Verificar();
	$obj_verificar -> verificar_permissao_carrinho();
	unset($obj_verificar);
?>
<html lang="pt">
    <head>
    <title>DMT - Meu Carrinho</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset="UTF-8">
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
		<script type='text/javascript' src='dmtFiles/js/validacao.js'></script>
			<script src="dmtFiles/js/jquery-2.1.4.min.js"></script>
			<script src="dmtFiles/js/ajax.js"></script>
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
<section id="sec_alert">	
        <?php require_once('header.php'); ?>
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">CARRINHO</li>
                </ol>
            </div>
        </div>
        <!-- check-out -->
    <div class="check">
        <div class="container">	 
                    
					<!-------------------------------------- DETALHES DO PEDIDO ----------------------------------------->
					<div class="col-md-3 cart-total">
                        <div class="price-details">
                            <p><h3>DETALHES DO PEDIDO</h3></p>
							<table>
								<?php
									$select_itens = $link -> query("SELECT nm_pedal, vl_preco+(vl_preco*(vl_taxa/100)) as 'vl_preco', qt_pedal FROM tb_pedal, tb_pedal_carrinho WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
									while($row = $select_itens -> fetch_assoc())
									{
								?>
										
											<tr style="color: #aaaaaa;">
												<th style="width: 64%;">
													<?php echo $row['nm_pedal']; ?>
												</th>
												<th style="width: 34%;">
													<?php echo "R$ ".number_format($row['vl_preco'], 2, ',', ''); ?>
												</th>
												<th>
													<?php echo "(".$row['qt_pedal'].")"; ?>
												</th>
											</tr>
										
								<?php
									}
								?>
							</table>
							<div class="clearfix"></div>				 
                        </div>
						<hr class="featurette-divider">
							
							<?php
								$select_carrinho = $link -> query("SELECT SUM((vl_preco+(vl_preco*(vl_taxa/100)))*qt_pedal), SUM(qt_pedal) FROM tb_pedal, tb_pedal_carrinho WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND cd_carrinho = '".$cd_carrinho."';");
								$row_carrinho = $select_carrinho -> fetch_row();
								
								if($row_carrinho[0] == 0 || $row_carrinho[0] == null)
								{
									$row_carrinho[0] = "0.00";
								}
							?>
							<table style="width: 100%">
								<tr>
									<th style="width: 40%">
										<h4>TOTAL: </h4>
									</th>
									<th style="width: 10%">
										+
									</th>
									<th style="width: 60%">
										<p><span><h4><?php echo "R$ ".number_format($row_carrinho[0], 2, ',', ''); ?></h4></span></p>
										<p style="padding-top: 7px"><span><h4>R$ &nbsp;Frete</h4></span></p>
									</th>
								</tr>
							</table>						
							<div class="clearfix"></div>
						<?php
							if($row_carrinho[0] != "0.00")
							{
						?>
								<a id="btn_continuar" class="order" style="cursor: pointer;" onclick="trocar(enderecoEntrega);">Finalizar Compra</a>
								Clique em Finalizar Compra para definir o endereço e calcular o frete.
						<?php
							}
						?>
                    </div>
                    
					
					<!-------------------------------------- SECTION PRINCIPAL ----------------------------------------->
				<section id="sec1">
					<div id="hidden"></div>
					<div id="listaPedais" class="divisao"><?php require_once("php/checkout/listaPedais.php"); ?></div>
				</section>
				<section style="display: none;">
					<div id="hidden2"></div>
					<div id="enderecoEntrega" class="divisao"><?php require_once("php/checkout/enderecoEntrega.php"); ?></div>
					<div id="frmEndereco" class="divisao"><?php require_once("php/checkout/frmEndereco.php"); ?></div>
					<div id="mostrarFrete" class="divisao">
						<div class="col-md-9 cart-items">
							
							<h1>Calcular Frete</h1>
							<p id="abcd">Escolha a melhor opção de envio para você. Sedex ou Pac.<br/>Em seguida clique em pagar com PagSeguro.</p>
							<p>Você será redirecionado para o ambiente do PagSeguro para realizar sua compra com segurança.</p>
							<span style="cursor: pointer; color: #0000ff;" onclick='window.location.href = "checkout.php";'>Voltar</span>
							
							<br/><br/><br/>
							<div class="reg" id="divReg">
								<form method="post" id="form1" action="php/action_pagseguro.php">
									<h4>
										<select id="select1" name="cmb_frete" style="width: 23%; height: 35px;">
											<option value="Sedex">Sedex</option>
											<option value="Pac">Pac</option>
										</select>
									</h4>
								</form>
							</div>
							
							<br/>
							<div id="cepCorreios">
								<br/><br/>
								<center>
									<h3>CARREGANDO...</h3>
								</center>
							</div>
							<br/><br/>
							<img src="dmtFiles/images/botaopagseguro.jpg" style="cursor: pointer; width: 39%;" onclick='$("#form1").submit();'>
						</div>
					</div>
				</section>
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</section>

<!---------------------------------- FIM DA PÁGINA - SCRIPTS E ALERT ---------------------->

<script>
		check_submit();
	
		function submeter(form) //excluir pedal do carrinho
		{
			$(form).submit();
		}
		
		function trocar(id) //trocar a section principal
		{
			$(".divisao").insertAfter("#hidden2");
			$(id).insertAfter("#hidden");
		}
		
		function check_submit(){ //checar o formulario de novo endereço
			var okendereco = validarEndereco();
			$("#p1").text(okendereco);
			if(okendereco == "Endereço preenchido corretamente.")
			{
				$(".btn_endereco").removeAttr("disabled");
				$(".btn_endereco").fadeTo(300, 1);
				
				return true;
			}
			else
			{
				$(".btn_endereco").attr("disabled", true);
				$(".btn_endereco").fadeTo(0, 0.5);
				
				return false;
			}
		}
		
		
		var parAdc = ""; //variavel que vai conter os parametros adicionais dos botões submit do formulario de endereço. Os valores são "somente=true", "salvar=true". O link "usar esse" da section anterior ja tem o onclick configurado para não passar por essa função 
		//usar somente essa vez -> parAdc = "somente=true";
		//salvar endereço -> parAdc = "salvar=true";
		//escolher esse -> não passa por essa função, vai direto para definirEndereco("esse=true");
		$("#frm_cadastro").on("submit", function(){
			event.preventDefault();
			
			ycep = $("#cep").val();
			yuf = $("#estado").val();
			ycidade = $("#cidade").val();
			ybairro = $("#bairro").val();
			yrua = $("#rua").val();
			ynumero = $("#numero").val();
			ycomp = $("#comp").val();
			
			definirEndereco(parAdc);
		});
		
		function definirEndereco(parametrosAdicionais) //passa os parametros pro arquivo de php e faz o ajax
		{
			var parametragem = "pcep="+ycep+"&puf="+yuf+"&pcidade="+ycidade+"&pbairro="+ybairro+"&prua="+yrua+"&pnumero="+ynumero+"&pcomp="+ycomp+"&"+parametrosAdicionais;
			trocar("#mostrarFrete");			
			CarregaArquivo("php/checkout/cepCorreios.php", parametragem);
		}
		
		$("#select1").on("change", function(){
			if($(this).val() == 1)
			{
				$("#sPrecoFrete").text($("#pFreteSedex").text());
				$("#sPrazo").text($("#pPrazoSedex").text());
				$("#sPrecoTotal").text($("#pTotalSedex").text());
			}
			else
			{
				$("#sPrecoFrete").text($("#pFretePac").text());
				$("#sPrazo").text($("#pPrazoPac").text());
				$("#sPrecoTotal").text($("#pTotalPac").text());
			}
		});
	</script>
	
<!----------------- ALERT --------------->
	<div class="alert">
		<section style="padding: 5px;">
			<h4><p id="p_alert"></p></h4><br/>
			<p align="right">
				<button type="button" class="btn btn-info" onclick="redirect_products();">Continuar Comprando</button>&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-info" onclick="normal();">OK</button>
			</p>
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
		
		function alertar(texto)
		{
			$("#sec_alert").fadeTo(0, 0.1);
			$("#p_alert").text(texto);
			$(".alert").fadeIn(0);
		}
		
		function normal()
		{
			$("#sec_alert").fadeTo(300, 1);
			$(".alert").fadeOut(300);
		}
		
		function redirect_products()
		{
			window.location.href = "products.php";
		}
	</script>
	<?php
		if(isset($_GET['itemAdc']))
		{
			echo "<script>alertar('O pedal foi adicionado com sucesso ao carrinho.');</script>";
		}
		if(isset($_GET['itemRmv']))
		{
			echo "<script>alertar('O pedal foi removido com sucesso do carrinho.');</script>";
		}
		if(isset($_GET['noData']))
		{
			echo "<script>alertar('Não conseguimos encontrar alguns dados. Por favor, repita o processo novamente e espere a página carregar completamente.');</script>";
		}
		if(isset($_GET['updated']))
		{
			echo "<script>alertar('Não pudemos finalizar o pedido pois seu carrinho possivelmente continha pedais indisponiveis. Isso pode ter acontecido porque algum pedal em seu carrinho foi comprado por outra pessoa antes de você finalizar seu pedido. Seu carrinho foi atualizado, apenas os pedais indisponíveis foram removidos ou tiveram suas quantidades alteradas. Se ainda deseja continuar sua compra mesmo sem alguns pedais, por favor, repita a operação.');</script>";
		}
		if(isset($_GET['noUrl']))
		{
			echo "<script>alertar('Desculpe, não conseguimos te redirecionar para o PagSeguro, tente novamente.');</script>";
		}
	?>	
</body>
</html>