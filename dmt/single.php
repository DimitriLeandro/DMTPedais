<?php 
	header('Content-Type: text/html; charset=utf-8');
	include('php/model/conexao.php');
	include('php/verificar.class.php');
	
	//-------------------------------VALIDAÇÕES
	$cd_pedal = $_GET['p'];
	$obj_verificar = new Verificar();
	$obj_verificar -> verificarPedalExiste($link, $cd_pedal);
	unset($obj_verificar);
?>

<?php //--------------------------SELECT DO PEDAL
	$select_pedal = $link->query("SELECT nm_pedal, ds_pedal, vl_preco+(vl_preco*(vl_taxa/100)) as 'vl_preco', nm_categoria, ic_guitar_bass FROM tb_pedal WHERE cd_pedal = '".$cd_pedal."';");
	$row_pedal = $select_pedal->fetch_row();
?>
<html lang="en">
    <head>
    <title>DMT - <?php echo $row_pedal[0]; ?></title>
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
         <!-- FlexSlider -->
            <script src="dmtFiles/js/imagezoom.js"></script>
              <script defer src="dmtFiles/js/jquery.flexslider.js"></script>
            <link rel="stylesheet" href="dmtFiles/css/flexslider.css" type="text/css" media="screen" />

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
                    <li class="active"><?php echo $row_pedal[0]; ?></a></li>
                </ol>
            </div>
        </div>
    
<div class="showcase-grid">
    <div class="container">
			
                <div class="col-md-8 showcase">
                    <div class="flexslider">
                        <ul class="slides">
						<?php
							$select_imagens = $link -> query("SELECT * FROM tb_imagem WHERE cd_pedal = '".$cd_pedal."' ORDER BY cd_imagem DESC LIMIT 4;");
							while($row_imagem = $select_imagens -> fetch_assoc())
							{
								$caminho = "dmtFiles/images/pedals/".$row_imagem['nm_caminho'];
						?>
								<li data-thumb="<?php echo $caminho; ?>">
									<div class="thumb-image"> <img src="<?php echo $caminho; ?>" data-imagezoom="true" class="img-responsive"> </div>
								</li>
						<?php
							}
						?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 showcase">
                    <div class="showcase-rt-top">
                        <div class="pull-left shoe-name">
                            <h3><?php echo $row_pedal[0]; ?></h3>
                            <p><?php echo $row_pedal[3]; ?></p>
                            <h4><?php echo "R$ ".number_format($row_pedal[2], 2, ',', ''); ?></h4>
                        </div>
					<div class="clearfix"></div>
                    </div>
                    <hr class="featurette-divider">
                    <div class="shocase-rt-bot">
                        <div class="float-qty-chart">
							<form method="post" action="php/action_pedal_carrinho.php">
								<input name="txt_pedal" type="hidden" value="<?php echo $cd_pedal; ?>">
								<div class="clearfix"></div>
								</div>
								<div class="reg">
									<ul>
										<li class="ad-2-crt simpleCart_shelfItem">
											<ul>
												<li>
													<?php 
														//SCRIPT PRA DEFINIR QUAL BOTÃO DEVE APARECER
														
														$disponivel = false;
														
														$select_qtd_estoque = $link -> query("SELECT qt_estoque FROM tb_estoque WHERE cd_pedal = '".$cd_pedal."'");
														$qtd_estoque = $select_qtd_estoque -> fetch_row();
														if($qtd_estoque[0] > 0)
														{
															$disponivel = true;
															if(isset($_SESSION['usuario']) && isset($_SESSION['carrinho']))
															{
																$select_qtd_carrinho = $link -> query("SELECT qt_pedal FROM tb_pedal_carrinho WHERE cd_pedal = '".$cd_pedal."' AND cd_carrinho = '".$_SESSION['carrinho']."';");
																$qtd_carrinho = $select_qtd_carrinho -> fetch_row();
																if($qtd_carrinho[0] >= $qtd_estoque[0])
																{
																	$disponivel = false;
																}
															}
														}
													?>
													<?php
														if($disponivel == false)
														{
													?>
															<input type="submit" value="Produto Indisponível" style="background: #cc3333; width: 100%; height: 7%; color: white; font-size: 20px; font-family: tahoma; font-weight: bold;" class="btn" disabled />
													<?php
														}
														else
													{
													?>
															<input name="agr" type="submit" value="Comprar" style="background: #33cc33; width: 100%; height: 7%; color: white; font-size: 20px; font-family: tahoma; font-weight: bold;" class="btn" />
													<?php
														}
													?>	
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</form>
                    </div>
					<br/>
					<hr class="featurette-divider">
                    <div class="showcase-last">
                        <h3>Descrição</h3>
                        <ul>
                            <li><?php echo $row_pedal[1]; ?></li>
                        </ul>
                    </div>
                </div>
				<div class="clearfix"></div>
    </div>	
</div>
        
        <div class="specifications">
            <div class="container">
              <h3>MAIS SOBRE O PRODUTO:</h3> 
                <div class="detai-tabs">
                    <!---------------------------------------------- Nav tabs --------------------------->
                    <ul class="nav nav-pills tab-nike" role="tablist">
                    <?php
						$select_videos = $link -> query("SELECT * FROM tb_video WHERE cd_pedal = '".$cd_pedal."';");
						if($select_videos -> num_rows > 0)
						{
					?>
							<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">VIDEOS</a></li>
                    <?php
						}
					?>
					<li role="presentation"><a id="li_desc" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">DESCRIÇÃO</a></li>
					<?php
						$select_artistas_que_usam = $link -> query("SELECT DISTINCT nm_artista, nm_caminho FROM tb_artista, tb_pedal_artista WHERE tb_artista.cd_artista = tb_pedal_artista.cd_artista AND tb_pedal_artista.cd_pedal = '".$cd_pedal."';");
						if($select_artistas_que_usam -> num_rows > 0)
						{
					?>
							<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">ARTISTAS QUE USAM ESTE PEDAL</a></li>
                    <?php
						}
					?>
					</ul>

                    <!------------------------------------------ Tab panes ----------------------------------------------->
                    <div class="tab-content">
						<!----------------------------------------LISTA DE VIDEOS--------------------------------------->
						<div role="tabpanel" class="tab-pane active" id="home">
						<?php
							$cont = 1;
							while($row_video = $select_videos -> fetch_assoc())
							{
								$video = explode("=", $row_video['nm_link']);
								if($cont % 2 == 0) //DIREITA
								{
						?>
									<iframe width="48%" height="300" src="https://www.youtube.com/embed/<?php echo $video[1]; ?>" frameborder="0" allowfullscreen></iframe><br><br>
						<?php
								}
								else //ESQUERDA
								{
						?>
									<iframe width="48%" height="300" src="https://www.youtube.com/embed/<?php echo $video[1]; ?>" frameborder="0" allowfullscreen></iframe>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
								}
								$cont ++;
							}
						?>	
						</div>
						<!----------------------------------------DESCRIÇÃO-------------------------------------------->
						<div role="tabpanel" class="tab-pane" id="profile">
							<p><?php echo $row_pedal[1]; ?></p>    
						</div>
						<!----------------------------------------ARTISTAS QUE USAM--------------------------------------->
						<div role="tabpanel" class="tab-pane" id="messages">
							<div class="shop-grid">
								<div class="container">
									<?php
										while($row = $select_artistas_que_usam -> fetch_assoc())
										{
												$caminho = "dmtFiles/images/artists/".$row['nm_caminho'];
									?>
											<div class="col-md-4 grid-stn simpleCart_shelfItem">
												 <!-- normal -->
													<div class="ih-item square effect3 bottom_to_top">
														<div class="bottom-2-top">
															<div class="img"><img src="<?php echo $caminho; ?>" alt="/"  class="img-responsive gri-wid"></div>
															<div class="info">
																<div class="pull-left styl-hdn">
																	<h3><?php echo $row['nm_artista']; ?></h3>
																</div>										
																<div class="clearfix"></div>
															</div>
														</div>
													</div>
											</div>
									<?php
										}
									?>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<div class="you-might-like">
            <div class="container">
                <h3 class="you-might">PEDAIS RELACIONADOS</h3>
			</div>
		</div>
		
		
		<div class="shop-grid">
            <div class="container">
			
			<?php
				$select_similares = $link->query("
														(SELECT codigo, nome, caminho, categoria FROM vw_pedal WHERE codigo <> '".$cd_pedal."' AND instrumento = '".$row_pedal[4]."' AND categoria = '".$row_pedal[3]."' ORDER BY categoria)
														UNION (SELECT codigo, nome, caminho, categoria FROM vw_pedal WHERE instrumento = '".$row_pedal[4]."' AND categoria <> '".$row_pedal[3]."' ORDER BY categoria)
														UNION (SELECT codigo, nome, caminho, categoria FROM vw_pedal WHERE instrumento <> '".$row_pedal[4]."' ORDER BY categoria)
														LIMIT 3;"
												);
				while($row_similares = $select_similares -> fetch_assoc())
				{
					$caminho = "dmtFiles/images/pedals/".$row_similares['caminho'];
			?>
					<div class="col-md-4 grid-stn simpleCart_shelfItem">
						 <!-- normal -->
							<div class="ih-item square effect3 bottom_to_top">
								<div class="bottom-2-top">
									<div class="img"><img src="<?php echo $caminho; ?>" alt="/"  class="img-responsive gri-wid"></div>
									<div class="info">
										<div class="pull-left styl-hdn">
											<h3><?php echo $row_similares['nome']; ?></h3>
										</div>										
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						<!-- end normal -->
						<div class="quick-view">
							<a href="single.php?p=<?php echo $row_similares['codigo']; ?>">VER MAIS</a>
						</div>
					</div>
			<?php
				}
			?>
				
        <div class="clearfix"></div>
            </div>
        </div>
		<?php if($select_videos -> num_rows == 0){ ?> <script>$("#li_desc").click();</script> <?php } ?>
        <?php
			require_once('footer.php'); 
		?>
    </body>
</html>
    