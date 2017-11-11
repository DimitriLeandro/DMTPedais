<html lang="pt">
    <head>
    <title>DMT Custom Shop - Novo Artista</title>
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
        <?php require_once('header.php'); ?>
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">+ Artista</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Novo Artista</h3><br>
				
				
				
				 <form method="post" action="php/actionCadArtista.php" enctype="multipart/form-data">
					<ul>
						<li class="text-info">Nome: </li>
						<li><input type="text" name="txt_nome"></li>
					</ul>				 
					<ul>
						<li class="text-info">Site: </li>
						<li><input type="text" name="txt_site"></li>
					</ul>
					<ul>
						<li class="text-info">Foto:</li>
						<li><input type="file" name="im_artista"></li>
					</ul>
					<ul>
						<li class="text-info">Pedais: </li>
						<input type="checkbox" name="chk_pedal[]" value="0" style="display: none;" checked> <!--esse checkbox é invisivel, é só pra ter algum msm, ai não da pau no foreach-->
						<?php
							$select_pedais = $link -> query("SELECT cd_pedal, nm_pedal FROM tb_pedal;");
							while($row = $select_pedais -> fetch_assoc())
							{
						?>
								<li><input name="chk_pedal[]" type="checkbox" value="<?php echo $row['cd_pedal']; ?>" /> <?php echo $row['nm_pedal']; ?> </li>
						<?php
							}
						?>
					</ul><br><br>				
					<input name="btn_cadastrar" type="submit" value="Cadastrar">
				</form>
				
				
				
				
			</div>
		</div>
	</div>
    <?php require_once('footer.php'); ?>
    </body>
</html>