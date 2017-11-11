<?php
	include("php/model/DAOEstoque.php");

	if(isset($_POST['btn_inserir']))
	{
		$obj_estoque = new DAOEstoque();
		$obj_estoque -> insertSaida($_POST['cmb_pedal'], $_POST['txt_qtd']); //código, qtd, motivo
		unset($obj_estoque);
		
		header("Location: estoque.php");
	}
?>
<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
		<title>DMT - Saída</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8">
		<!--fonts-->
		<link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
		
		<!--fonts-->
		<!--bootstrap-->
			 <link href="../../dmtFiles/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!--coustom css-->
			<link href="../../dmtFiles/css/style.css" rel="stylesheet" type="text/css"/>
        <!--shop-kart-js-->
        <script src="../../dmtFiles/js/simpleCart.min.js"></script>
		<!--default-js-->
			<script src="../../dmtFiles/js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="../../dmtFiles/js/bootstrap.min.js"></script>
		<!--script-->
         <!-- FlexSlider -->
            <script src="../../dmtFiles/js/imagezoom.js"></script>
              <script defer src="../../dmtFiles/js/jquery.flexslider.js"></script>
            <link rel="stylesheet" href="../../dmtFiles/css/flexslider.css" type="text/css" media="screen" />

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
	
<style>
	.inputform{
		padding: 8px;
		font-size: 14px;
		font-weight: 400;
		border: 1px solid #e6e6e6;
		outline: none;
		color: #000;
	}
</style>
	
        <?php require_once('header.php'); ?>
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">SAÍDA</li>
                </ol>
            </div>
        </div>		
    <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Saída do Estoque</h3><br>
				
				
				
				<form method="post">
					<ul>
						<li class="text-info">Pedal: </li>
						<li>
							<select name="cmb_pedal" class="inputform" onchange="ascender('#'+this.value)">
								<?php 
									$select_pedais = $link -> query("SELECT tb_pedal.cd_pedal, nm_pedal, qt_estoque FROM tb_pedal, tb_estoque WHERE tb_pedal.cd_pedal = tb_estoque.cd_pedal;");
									while($row = $select_pedais -> fetch_assoc())
									{
								?>
										<option value="<?php echo $row['cd_pedal']; ?>"><?php echo $row['nm_pedal']; ?></option>
								<?php
									}
								?>
							</select>
							<input type="hidden" id="hidden"/>
						</li>
					</ul>
					<ul>
						<li class="text-info">Quantidade de Saída: </li>
						<li><input name="txt_qtd" type="number" class="inputform" min="1"></li>
					</ul>	
					<input name="btn_inserir" type="submit" value="Retirar do Estoque" style="background: #000066; color: #ffffff;">
				</form>
				
				
				
			</div>
		</div>
	</div>
	
	
<?php 
	//criando os paragrafos que exibirão a qtd do estoque de cada um
	$select_pedais = $link -> query("SELECT tb_pedal.cd_pedal, nm_pedal, qt_estoque FROM tb_pedal, tb_estoque WHERE tb_pedal.cd_pedal = tb_estoque.cd_pedal;");
	while($row = $select_pedais -> fetch_assoc())
	{
?>
		<span class="phidden" id="<?php echo $row['cd_pedal']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $row['qt_estoque']." unidades"; ?></span>
<?php
	}
?>	

		
	<script>
		$(".phidden").fadeOut(0);
		
		function ascender(id)
		{
			$(".phidden").fadeOut(0);
			$(id).insertAfter("#hidden");
			$(id).fadeIn(500);
		}
	</script>
	
    <?php require_once('footer.php'); ?>
    </body>
</html>