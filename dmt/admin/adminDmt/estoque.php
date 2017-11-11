<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
		<title>DMT - Estoque</title>
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
    </head>
    <body>
        <?php require_once('header.php'); ?>
	<style>
		.th
		{
			vertical-align: middle;
			text-align: center; 			
		}
	</style>
	<center>
		<div class="container" style="width: 100%;">
			<div class="col-md-6 log" style="width: 100%;">
				<form method="post">
					<table class="table table-striped" style="width: 80%;"> 
						<thead style="background: #000066; color: #ffffff;">
							<tr>
								<th style="text-align: center;font-weight:bold;">Código</th>
								<th style="text-align: center;font-weight:bold;">Pedal</th>
								<th style="text-align: center;font-weight:bold;">Última Entrada</th>
								<th style="text-align: center;font-weight:bold;">Última Saída</th>
								<th style="text-align: center;font-weight:bold;">Quantidade em Estoque</th>
							</tr>
						</thead>
						<?php 
							$select_estoque = $link -> query("SELECT cod, nome, entrada, saida, qtd FROM vw_estoque;");
							while($row = $select_estoque -> fetch_assoc())
							{
								$entrada = "";
								$saida = "";
								if($row['entrada'] != null)
								{
									$entrada = explode("*", $row['entrada']);
									$date = date_create($entrada[0]);
									$entrada = date_format($date, 'd/m/Y')." - (".$entrada[1]." unidades)"; 
								}
								if($row['saida'] != null)
								{
									$saida = explode("*", $row['saida']);
									$date = date_create($saida[0]);
									$saida = date_format($date, 'd/m/Y')." - (".$saida[1]." unidades)"; 
								}
						?>				
								<tr>
									<th class="th">
										<?php echo $row['cod']; ?>
									</th>
									<th class="th">
										<?php echo $row['nome']; ?>
									</th>
									<th class="th">
										<?php echo $entrada; ?>
									</th>
									<th class="th">
										<?php echo $saida; ?>
									</th>
									<th class="th">
										<?php echo $row['qtd']; ?>
									</th>
								</tr>
						<?php
							}
						?>					
					</table>
				</form>
			</div>
		</div>
	</center>
        <?php require_once('footer.php'); ?>
    </body>
</html>