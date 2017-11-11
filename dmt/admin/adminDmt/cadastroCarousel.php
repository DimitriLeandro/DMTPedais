<html lang="pt">
    <head>
    <title>DMT Custom Shop - Novo Carousel</title>
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
                    <li class="active">+ Carousel</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Novo Carousel</h3><br>
				
				
				
				 <form method="post" action="php/actionCadCarousel.php" enctype="multipart/form-data">
					<ul>
						<li class="text-info">Título: </li>
						<li><input type="text" name="txt_titulo"></li>
					</ul>				 
					<ul>
						<li class="text-info">Subtitulo: </li>
						<li><input type="text" name="txt_subtitulo"></li>
					</ul>
					<ul>
						<li class="text-info">Link (opcional): </li>
						<li><input type="text" name="txt_link"></li>
					</ul>
					<ul>
						<li class="text-info">Foto:</li>
						<li><input type="file" name="im_carousel"></li>
					</ul>
					<br><br>				
					<input name="btn_cadastrar" type="submit" value="Cadastrar">
				</form>				
				
				
			</div>
		</div>
	</div>
    <?php require_once('footer.php'); ?>
    </body>
</html>