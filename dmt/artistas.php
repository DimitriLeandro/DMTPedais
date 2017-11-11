<?php
	include('php/model/conexao.php');
?>
<html lang="pt">
    <head>
		<link rel="icon" href="dmtFiles/images/icon.png" />
		<title>DMT Custom Shop - Artistas</title>
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
    </head>
    <body>
	
	<style>
		.img-circle {
			border-radius: 100%;
			overflow: hidden;
            width: 100%;
			height: 55%;
		}
	</style>
	
        <?php require_once('header.php'); ?>
		<div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">HOME</a></li>
                    <li class="active">ARTISTAS</li>
                </ol>
            </div>
        </div>
        
        <div class="shop-grid">
            <div class="container">
			
			<?php
				$select_artistas = $link -> query('SELECT cd_artista, nm_artista, nm_caminho,nm_site FROM tb_artista;');
				$cont = 0;
				while($row = $select_artistas -> fetch_assoc())
				{
						$caminho = "dmtFiles/images/artists/".$row['nm_caminho'];
			?>
						<div class="col-md-4 grid-stn simpleCart_shelfItem">
							 <!-- normal -->
								<div class="ih-item square effect3 bottom_to_top">
									<div class="bottom-2-top" style="text-align: center;">
										<div class="img">
											<a href="<?php echo $row['nm_site']; ?>"  target="_blank">
												<img class="img-circle" src="<?php echo $caminho; ?>">
											</a>
										</div>
										<div class="clearfix"></div><br/>
										<h3><?php echo $row['nm_artista']; ?></h3></br>
									</div>
								</div>
						</div>
			<?php
					$cont ++;
					if($cont % 3 == 0)
					{
			?>
						<div class="clearfix"></div>
			<?php
					}
				}
			?>
				
			<div class="clearfix"></div>
            </div>
        </div>
        
        <?php require_once('footer.php'); ?>
    </body>
</html>