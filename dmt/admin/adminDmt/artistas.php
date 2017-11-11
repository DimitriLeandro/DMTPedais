<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
		<title>DMT Custom Shop</title>
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
			text-align: center; 
			vertical-align: middle;
		}
	</style>
	<center>
		<div class="container" style="width: 100%;">
			<div class="col-md-6 log" style="width: 100%;">
					<table class="table table-striped" style="width: 80%;"> 
						<thead style="background: #000066; color: #ffffff;">
							<tr>
								<th style="text-align: center;font-weight:bold;">Código</th>
								<th style="text-align: center;font-weight:bold;">Nome</th>
								<th style="text-align: center;font-weight:bold;">Site</th>
								<th style="text-align: center;font-weight:bold;">Qtd Pedais</th>
								<th style="text-align: center;font-weight:bold;">Mais</th>
							</tr>
						</thead>
						<?php 
							$select_artistas = $link -> query("SELECT cd_artista as cod, nm_artista, nm_site, (SELECT count(*) FROM tb_pedal_artista WHERE cd_artista = cod) as qtd FROM tb_artista;");
							while($row = $select_artistas -> fetch_assoc())
							{
						?>				
								<tr>
									<th class="th">
										<?php echo $row['cod']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_artista']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_site']; ?>
									</th>
									<th class="th">
										<?php echo $row['qtd']; ?>
									</th>
									<th class="th">
										<a href="editarArtista.php?a=<?php echo $row['cod']; ?>">Editar</a>
									</th>
								</tr>
						<?php
							}
						?>					
					</table>
			</div>
		</div>
	</center>
        <?php require_once('footer.php'); ?>
    </body>
</html>