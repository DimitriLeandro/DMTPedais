<?php
	if(isset($_GET['p']))
	{
		$cd_pedal = $_GET['p'];
		
		include("php/model/conection.php");
		$select_pedal = $link->prepare("SELECT * FROM tb_pedal WHERE cd_pedal = ?;");
		$select_pedal->bind_param("i", $cd_pedal);
		$select_pedal->execute();
		$select_pedal->store_result();
		if($select_pedal -> num_rows != 1)
		{
			header('Location: index.php');
		}
		$select_pedal->close();
		mysqli_close($link);
	}
	else
	{
		header("Location: index.php");
	}
?>
<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
		<title>DMT  - Editar Pedal</title>
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
                    <li class="active">Editar</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Editar Pedal</h3><br>
				
				
			<p id="span_pedal" style="cursor: pointer">
				<label>Pedal</label>
				<span><img src="../../dmtFiles/images/b-arrow.png"></span>
			</p>
			<p id="span_imagem" style="cursor: pointer">
				<label>Imagem</label>
				<span><img src="../../dmtFiles/images/b-arrow.png"></span>
			</p>
			<p id="span_video" style="cursor: pointer">
				<label>Video</label>
				<span><img src="../../dmtFiles/images/b-arrow.png"></span>
			</p>
			
			
			
			
			<section id="sec_pedal">
				<?php
					$select_pedal = $link -> query("SELECT nm_pedal, ds_pedal, vl_preco, ic_guitar_bass, nm_categoria, ic_ativo_inativo FROM tb_pedal WHERE cd_pedal = '".$cd_pedal."';");
					$row_pedal = $select_pedal -> fetch_row();
				?>		
				<form method="post" action="php/actionCadPedal.php">
					<input type="hidden" value="<?php echo $cd_pedal; ?>" name="cd_pedal">
					<ul>
						<li class="text-info">Nome do Pedal: </li>
						<li><input name="txt_nome" type="text" value="<?php echo $row_pedal[0]; ?>"></li>
					</ul>
					<ul>
						<li class="text-info">Descrição: </li>
						<li><textarea name="txt_desc" style="width: 50%; height: 25%;"><?php echo $row_pedal[1]; ?></textarea></li>
					</ul>				 
					<ul>
						<li class="text-info">Preço: </li>
						<li><input name="txt_preco" type="text" value="<?php echo $row_pedal[2]; ?>"></li>
					</ul>
					<ul>
						<li class="text-info">Instrumento: </li>
						<li>
							<select name="cmb_instrumento" class="form-control qnty-chrt" style="width: 16%;">
								<option value="g">Guitarra</option>
								<option value="b" <?php if($row_pedal[3] == "b"){echo "selected";} ?>>Baixo</option>
							</select>
						</li>
					</ul>
					<ul>
						<li class="text-info">Categoria: </li>
						<li>
							<table style="width: 35%;">
							<tr>
								<th style="width: 15%;">
									<select name="cmb_categoria" class="form-control qnty-chrt" style="width: 100%;">
										<option value="<?php echo $row_pedal[4]; ?>" selected><?php echo $row_pedal[4]; ?></option>
										<?php
											$select_categorias = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE nm_categoria <> '".$row_pedal[4]."' ORDER BY nm_categoria;");
											while($row_categoria = $select_categorias -> fetch_assoc())
											{
										?>
												<option value="<?php echo $row_categoria['nm_categoria']; ?>"><?php echo $row_categoria['nm_categoria']; ?></option>
										<?php
											}
										?>
									</select>
								</th>
								<th style="width: 3%;"></th>
								<th style="width: 15%;">
									<input name="txt_categoria" type="text" placeholder="Nova categoria" style="width: 100%;">
								</th>
							</tr>
							</table>
						</li>
					</ul>
					<ul>
						<li class="text-info">Status: </li>
						<li>
							<select name="cmb_status" class="form-control qnty-chrt" style="width: 16%;">
								<option value="1">Ativo</option>
								<option value="0" <?php if($row_pedal[5] == false){echo "selected";} ?>>Inativo</option>
							</select>
						</li>
					</ul>
					<ul>
						<li>
							<input type="submit" name="btn_editar_pedal" value="Salvar">
						</li>
					</ul>
				</form>
			</section>


			
			
			
			
			<section id="sec_imagem">	
				<?php
					$select_imagens = $link -> query("SELECT cd_imagem, nm_caminho FROM tb_imagem WHERE cd_pedal = '".$cd_pedal."';");
				?>	
					<table class="table table-hover">
						<?php
							$cont = 0;
							while($row_imagem = $select_imagens -> fetch_assoc())
							{
								$cont ++;
						?>
								<tr>
									<th style="vertical-align: middle;">
										<br/>
										<figure>
											<img src="../../dmtFiles/images/pedals/<?php echo $row_imagem['nm_caminho']; ?>" width="200">
										</figure>
										<br/>
									</th>
									<th style="vertical-align: middle;">
										<form method="post" name="frm_excluir_imagem" action="php/actionCadPedal.php">
											<input type="hidden" name="codigo" value="<?php echo $row_imagem['cd_imagem']; ?>">
											<input type="hidden" name="caminho" value="<?php echo $row_imagem['nm_caminho']; ?>">
											<input type="submit" name="btn_excluir_img" value="Excluir">
										</form>
									</th>
								</tr>
					</table>
				<form enctype="multipart/form-data" method="post" name="fmr_adc_imagem" action="php/actionCadPedal.php">
				<input type="hidden" name="pedal" value="<?php echo $cd_pedal; ?>">
					<table class="table table-hover">
							<?php
								}
								while($cont < 4)
								{
									$cont ++;
							?>
									<tr style="height: 200px">
										<th style="vertical-align: middle;">
											<input type="file" name="file_adc<?php echo $cont; ?>">
										</th>
										<th style="vertical-align: middle;">
										</th>
									</tr>
							<?php
								}
							?>
					</table>
					<?php
						if($select_imagens -> num_rows < 4)
						{
					?>
							<input type="submit" name="btn_adc_img" value="Adicionar As Novas Imagens">
					<?php
						}
					?>
				</form>
			</section>	
			
			
			
			
			
			
			<section id="sec_video">
				<?php
					$select_videos = $link -> query("SELECT cd_video, nm_link FROM tb_video WHERE cd_pedal = '".$cd_pedal."';");
				?>			
				<form method="post" name="frm_video" action="php/actionCadPedal.php">
				<input type="hidden" value="<?php echo $cd_pedal; ?>" name="cd_pedal">
					<table class="table table-hover">
						<?php
							$cont = 0;
							while($row_video = $select_videos -> fetch_assoc())
							{
								$cont ++;
								$embed = explode("=", $row_video['nm_link']);
						?>
								<tr>
									<th style="width: 40%">
										<br/>
										<iframe width="100%" height="245" src="https://www.youtube.com/embed/<?php echo $embed[1]; ?>" frameborder="0" allowfullscreen></iframe>
										<br/>
										<br/>
									</th>
									<th style="vertical-align: middle;">
										<ul style="padding-left: 150px">
											<li class="text-info">Link Youtube:</li>
											<li><input type="text" name="video<?php echo $cont; ?>" value="<?php echo $row_video['nm_link']; ?>" style="width: 70%;"></li>
										</ul>
									</th>
								</tr>								
						<?php
							}
						?>
					</table>
					<ul>
						<?php
							while($cont < 4)
							{
								$cont ++;
						?>
								<li class="text-info">Link Youtube:</li>
								<li><input type="text" name="video<?php echo $cont; ?>" value=""></li><br>
						<?php
							}
						?>
					</ul>
					<ul>
						<li>
							<input type="submit" value="Salvar" name="btn_editar_video">
						</li>
					</ul>
				</form>
			</section>
				
				
			</div>
		</div>
	</div>
	
	
	<script>
		/*
			When I heard the learn’d astronomer,
			When the proofs, the figures, were ranged in columns before me,
			When I was shown the charts and diagrams, to add, divide, and measure them,
			When I sitting heard the astronomer where he lectured with much applause in the lecture-room,
			How soon unaccountable I became tired and sick,
			Till rising and gliding out I wander’d off by myself,
			In the mystical moist night-air, and from time to time,
			Look’d up in perfect silence at the stars.
			
			
																		W. W
		*/
	</script>
	<script>
		$("#sec_pedal").hide();
		$("#sec_imagem").hide();
		$("#sec_video").hide();
		
		$("#span_pedal").on("click", function(){
			$("#sec_imagem").fadeOut();
			$("#sec_video").fadeOut();
			$("#sec_pedal").fadeIn();
		});
		
		$("#span_imagem").on("click", function(){
			$("#sec_pedal").fadeOut();
			$("#sec_video").fadeOut();
			$("#sec_imagem").fadeIn();
		});
		
		$("#span_video").on("click", function(){
			$("#sec_imagem").fadeOut();
			$("#sec_pedal").fadeOut();
			$("#sec_video").fadeIn();
		});
	</script>
	
	
    <?php require_once('footer.php'); ?>
    </body>
</html>