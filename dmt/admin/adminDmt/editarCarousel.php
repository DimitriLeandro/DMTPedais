<?php
	if(isset($_GET['c']))
	{
		$cd_carousel = $_GET['c'];
		
		include("php/model/conection.php");
		$select_carousel = $link->prepare("SELECT * FROM tb_carousel WHERE cd_carousel = ?;");
		$select_carousel -> bind_param("i", $cd_carousel);
		$select_carousel -> execute();
		$select_carousel -> store_result();
		if($select_carousel -> num_rows != 1)
		{
			header('Location: index.php');
		}
		$select_carousel -> close();
		mysqli_close($link);
	}
	else
	{
		header("Location: index.php");
	}
?>
<html lang="pt">
    <head>
    <title>DMT - Editar Carousel</title>
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
                    <li class="active">Editar Carousel</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Editar Carousel</h3><br>
				
				<?php
					$select_carousel = $link -> query("SELECT nm_titulo, nm_subtitulo, nm_caminho, nm_link, ic_ativo_inativo FROM tb_carousel WHERE cd_carousel = '".$cd_carousel."';");
					$row_carousel = $select_carousel -> fetch_row();
					
					$caminho = "../../dmtFiles/images/carousels/".$row_carousel[2];
				?>
				
				 <form method="post" action="php/actionCadCarousel.php" enctype="multipart/form-data">
					<input type="hidden" name="codigo_carousel" value="<?php echo $cd_carousel; ?>">
					<input type="hidden" name="caminho_img" value="<?php echo $row_carousel[2]; ?>">
					<ul>
						<li class="text-info">Título: </li>
						<li><input type="text" name="txt_titulo" value="<?php echo $row_carousel[0]; ?>"></li>
					</ul>				 
					<ul>
						<li class="text-info">Subtitulo: </li>
						<li><input type="text" name="txt_subtitulo" value="<?php echo $row_carousel[1]; ?>"></li>
					</ul>
					<ul>
						<li class="text-info">Link (opcional): </li>
						<li><input type="text" name="txt_link" value="<?php echo $row_carousel[3]; ?>"></li>
					</ul>
					<ul>
						<li class="text-info">Status: </li>
						<li>
							<select name="cmb_status" class="form-control qnty-chrt" style="width: 16%;">
								<option value="1">Ativo</option>
								<option value="0" <?php if($row_carousel[4] == false){echo "selected";} ?>>Inativo</option>
							</select>
						</li>
					</ul>
					<ul>
						<li class="text-info">Foto:</li>
						<table class="table-hover" style="width: 100%">
							<tr>
								<th>
									<img src="<?php echo $caminho; ?>" width="300" />
								</th>
								<th style="text-align: center; width: 60%">
									<input type="file" name="im_carousel">
								</th>
							</tr>
						</table>
					</ul>
					<br><br>				
					<input name="btn_salvar" type="submit" value="Salvar">&nbsp;&nbsp;&nbsp;
					<input name="btn_excluir_carousel" type="submit" value="Excluir">
				</form>
				
				
				
				
			</div>
		</div>
	</div>
    <?php require_once('footer.php'); ?>
    </body>
</html>