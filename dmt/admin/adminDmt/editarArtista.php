<?php
	if(isset($_GET['a']))
	{
		$cd_artista = $_GET['a'];
		
		include("php/model/conection.php");
		$select_artista = $link->prepare("SELECT * FROM tb_artista WHERE cd_artista = ?;");
		$select_artista -> bind_param("i", $cd_artista);
		$select_artista -> execute();
		$select_artista -> store_result();
		if($select_artista -> num_rows != 1)
		{
			header('Location: index.php');
		}
		$select_artista -> close();
		mysqli_close($link);
	}
	else
	{
		header("Location: index.php");
	}
?>
<html lang="pt">
    <head>
    <title>DMT - Editar Artista</title>
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
                    <li class="active">Editar Artista</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Editar Artista</h3><br>
				
				<?php
					$select_artista = $link -> query("SELECT nm_artista, nm_site, nm_caminho FROM tb_artista WHERE cd_artista = '".$cd_artista."';");
					$row_artista = $select_artista -> fetch_row();
					
					$caminho = "../../dmtFiles/images/artists/".$row_artista[2];
				?>
				
				 <form method="post" action="php/actionCadArtista.php" enctype="multipart/form-data">
					<input type="hidden" name="codigo_artista" value="<?php echo $cd_artista; ?>">
					<input type="hidden" name="caminho_img" value="<?php echo $row_artista[2]; ?>">
					<ul>
						<li class="text-info">Nome: </li>
						<li><input type="text" name="txt_nome" value="<?php echo $row_artista[0]; ?>"></li>
					</ul>				 
					<ul>
						<li class="text-info">Site: </li>
						<li><input type="text" name="txt_site" value="<?php echo $row_artista[1]; ?>"></li>
					</ul>
					<ul>
						<li class="text-info">Foto:</li>
						<table class="table-hover" style="width: 100%">
							<tr>
								<th>
									<img src="<?php echo $caminho; ?>" width="300" />
								</th>
								<th style="text-align: center; width: 60%">
									<input type="file" name="im_artista">
								</th>
							</tr>
						</table>
					</ul>
					<ul>
						<li class="text-info">Pedais: </li>
						<input type="checkbox" name="chk_pedal[]" value="0" style="display: none;" checked> <!--esse checkbox é invisivel, é só pra ter algum msm, ai não da pau no foreach-->
						<?php
							$select_pedais_usa = $link -> query("SELECT cd_pedal FROM tb_pedal_artista WHERE cd_artista = '".$cd_artista."';");
						
							$select_todos_pedais = $link -> query("SELECT cd_pedal, nm_pedal FROM tb_pedal;");
							while($row = $select_todos_pedais -> fetch_assoc())
							{
								$select_pedais_usa = $link -> query("SELECT * FROM tb_pedal_artista WHERE cd_artista = '".$cd_artista."' AND cd_pedal = '".$row['cd_pedal']."';");
								if($select_pedais_usa -> num_rows > 0)
								{
						?>
									<li><input name="chk_pedal[]" type="checkbox" value="<?php echo $row['cd_pedal']; ?>" checked /> <?php echo $row['nm_pedal']; ?> </li>
						<?php
								}
								else
								{
						?>
									<li><input name="chk_pedal[]" type="checkbox" value="<?php echo $row['cd_pedal']; ?>" /> <?php echo $row['nm_pedal']; ?> </li>
						<?php
								}
							}
						?>
					</ul><br><br>				
					<input name="btn_salvar" type="submit" value="Salvar">&nbsp;&nbsp;&nbsp;
					<input name="btn_excluir_artista" type="submit" value="Excluir">
				</form>
				
				
				
				
			</div>
		</div>
	</div>
    <?php require_once('footer.php'); ?>
    </body>
</html>