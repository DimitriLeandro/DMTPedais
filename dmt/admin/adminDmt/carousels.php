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
		
		<?php 
			$select_carousels_ativos = $link -> query("SELECT cd_carousel, nm_titulo, nm_subtitulo, nm_caminho FROM tb_carousel WHERE ic_ativo_inativo = true;");
			
			if($select_carousels_ativos -> num_rows > 0)
			{
		?>
				<div class="header-end">
					<div class="container">
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						  <?php
							$cont = 0;
							while($row = $select_carousels_ativos -> fetch_assoc())
							{
						  ?>
								<li data-target="#myCarousel" data-slide-to="<?php echo $cont; ?>" <?php if($cont == 0){ ?> class="active" <?php } ?> ></li>
						  <?php
								$cont ++;
							}
						  ?>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							  <?php
								$cont = 0;
								$select_carousels_ativos = $link -> query("SELECT cd_carousel, nm_titulo, nm_subtitulo, nm_caminho, nm_link FROM tb_carousel WHERE ic_ativo_inativo = true;");
								while($row = $select_carousels_ativos -> fetch_assoc())
								{
									$caminho = "../../dmtFiles/images/carousels/".$row['nm_caminho'];
									if($row['nm_link'] == "")
									{
							  ?>
										<div class="<?php if($cont == 0){ echo 'item active'; }else{echo "item";} ?>">
											<img src="<?php echo $caminho; ?>" alt="...">
											<div class="carousel-caption car-re-posn">
												<h3><?php echo $row['nm_titulo']; ?></h3>
												<h4><?php echo $row['nm_subtitulo']; ?></h4>
												<span class="color-bar"></span>
											</div>
										</div>
							  <?php
									}
									else
									{
							  ?>
										<div class="<?php if($cont == 0){ echo 'item active'; }else{echo "item";} ?>">
											<a href="<?php echo $row['nm_link']; ?>">
												<img src="<?php echo $caminho; ?>" alt="...">
												<div class="carousel-caption car-re-posn">
													<h3><?php echo $row['nm_titulo']; ?></h3>
													<h4><?php echo $row['nm_subtitulo']; ?></h4>
													<span class="color-bar"></span>
												</div>
											</a>
										</div>
							  <?php
									}
									$cont ++;
								}
							  ?>
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left car-icn" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right car-icn" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						  </a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div><br/><br/>
		<?php
			}
		?>
		
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
								<th style="text-align: center;font-weight:bold;">Título</th>
								<th style="text-align: center;font-weight:bold;">Subtitulo</th>
								<th style="text-align: center;font-weight:bold;">Link</th>
								<th style="text-align: center;font-weight:bold;">Status</th>
								<th style="text-align: center;font-weight:bold;">Mais</th>
							</tr>
						</thead>
						<?php 
							$select_all_carousels = $link -> query("SELECT cd_carousel, nm_titulo, nm_subtitulo, nm_link, ic_ativo_inativo FROM tb_carousel;");
							while($row = $select_all_carousels -> fetch_assoc())
							{
						?>				
								<tr>
									<th class="th">
										<?php echo $row['nm_titulo']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_subtitulo']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_link']; ?>
									</th>
									<th class="th">
										<?php if($row['ic_ativo_inativo'] == true){echo "Ativo";}else{echo "Inativo";} ?>
									</th>
									<th class="th">
										<a href="editarCarousel.php?c=<?php echo $row['cd_carousel']; ?>">Editar</a>
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