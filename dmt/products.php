<?php 
	header('Content-Type: text/html; charset=utf-8');
?>
<html lang="pt">
    <head>
    <title>DMT - Pedais</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="N-Air Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8">
		<!--fonts-->
		<link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
		
		<!--fonts-->
        <!--form-css-->
        <link href="dmtFiles/css/form.css" rel="stylesheet" type="text/css" media="all" />
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
                    <li class="active">PEDAIS</li>
                </ol>
            </div>
        </div>
		
		
		
<div class="products-gallery">
<div class="container">

			<section id="sec1">
			<div class="col-md-9 grid-gallery">
				<div class="clearfix" id="hidden_cima0"></div>
					<?php
						$select_pedal = $link->query("SELECT codigo, nome, caminho, instrumento, categoria FROM vw_pedal ORDER BY instrumento DESC, categoria;");
						while($row = $select_pedal->fetch_assoc())
						{
							$caminho = "dmtFiles/images/pedals/".$row['caminho'];
							$id = $row['instrumento'].$row['categoria'];
							$id = preg_replace('/\s+/', '', $id);
					?>
							<section class="classe-pedais" id="<?php echo $id; ?>">
								<div class="col-md-4 grid-stn simpleCart_shelfItem">
									 <!-- normal -->
										<div class="ih-item square effect3 bottom_to_top">
											<div class="bottom-2-top">
												<div class="img"><img src="<?php echo $caminho; ?>" alt="/"  class="img-responsive gri-wid"></div>
												<div class="info">
													<div class="pull-left styl-hdn">
														<h3><?php echo $row['nome']; ?></h3>
													</div>										
													<div class="clearfix"></div>
												</div>
											</div>
										</div>
									<!-- end normal -->
									<div class="quick-view">
										<a href="single.php?p=<?php echo $row['codigo']; ?>">VER MAIS</a>
									</div>
								</div>
							</section>
					<?php
						}
					?>
				<div class="clearfix" id="primeiro_hidden"></div>
				<section id="sec2" style="text-align: center;">
					<p align="center"><h3>RELACIONADOS</h3></p>
					<br/><br/><br/>
					<div class="clearfix" id="hidden_baixo0"></div>
					<div class="clearfix" id="ultimo_hidden"></div>
				</section>
			</div>
			</section>
			
	
            <div class="col-md-3 grid-details">
                <div class="grid-addon">
					<div class="product_right">
								<section  class="sky-form">
									 <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Guitar Pedals</h4>
									 <div class="row row1 scroll-pane">
										 <div class="col col-4">
												<div class="single-bottom">						
													<?php
														$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'g' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
														while($row = $select_categoria -> fetch_assoc())
														{
															$id = "g".$row['nm_categoria'];
															$id = preg_replace('/\s+/', '', $id);
													?>
															<p>
																<span style="cursor:pointer" onclick="trocar(<?php echo $id; ?>);">
																	<?php echo $row['nm_categoria']; ?>
																</span>
															</p>
													<?php
														}
													?>
												</div>
										 </div>
									 </div>
								</section> 									
								<section  class="sky-form">
									 <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Bass Pedals</h4>
									 <div class="row row1 scroll-pane">
										 <div class="col col-4">
												<div class="single-bottom">						
													<?php
														$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'b' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
														while($row = $select_categoria -> fetch_assoc())
														{
															$id = "b".$row['nm_categoria'];
															$id = preg_replace('/\s+/', '', $id);
													?>
															<p>
																<span style="cursor:pointer" onclick="trocar(<?php echo $id; ?>);">
																	<?php echo $row['nm_categoria']; ?>
																</span>
															</p>
													<?php
														}
													?>
												 </div>
										 </div>
									 </div>
								</section> 
                    </div>
				</div>
				<div class="clearfix"></div>
            </div>
</div>
</div>
<div class="clearfix"></div>

			<script>
			/*
				 Smashing through the boundaries
				 Lunacy has found me
				 Cannot stop the B A T T E R Y ! ! !
			*/
			</script>
			<script>
				$("#sec2").fadeOut(0);
				organizarTodos();
				
				function organizarTodos()
				{
					cont = 0;
					var id_hidden_cima = "hidden_cima"+cont;
					$(".classe-pedais").each(function(index, element){
						if(cont % 3 == 0 && cont != 0)
						{
							id_hidden_cima = "hidden_cima"+cont;
							if($("#"+id_hidden_cima).length == 0)
							{
								var div = $("<div>");
								div.addClass("clearfix");
								div.attr("id", id_hidden_cima);
								div.appendTo("body");
								div.insertBefore("#primeiro_hidden");
							}
						}
						$(this).insertAfter("#"+id_hidden_cima);
						cont ++;
					});
				}
			
				function trocar(id)
				{
					var identidade = $(id).attr("id"); //id que eu quero
					
					$("#sec1").fadeOut(500, function(){ //apagando toda a section 1 que contém tudo
						
						var cont = 0;
						var id_hidden_baixo = "hidden_baixo"+cont;
						$(".classe-pedais").each(function(index, element){ //mandando os pedais que eu não quero pra baixo
							if($(this).attr("id") != identidade)
							{
								if(cont % 3 == 0 && cont != 0) //se o cont for mod 3 é pq ja tem 3 pedais em uma mesma linha
								{
									id_hidden_baixo = "hidden_baixo"+cont; //ai muda o id do clearfix que eu vou usar pra colocar o pedal
									if($("#"+id_hidden_baixo).length == 0) //mas antes de criar esse clearfix, eu tenho que saber se ele ja existe
									{
										var div = $("<div>"); //se não existir eu crio o clearfix com o novo id
										div.addClass("clearfix");
										div.attr("id", id_hidden_baixo);
										div.appendTo("body");
										div.insertBefore("#ultimo_hidden");
									}
								}
								$(this).insertAfter("#"+id_hidden_baixo); //sempre colocando os pedais que eu não quero depois do ultimo id
								cont ++; //cont ++ pra eu ver se ja tem 3 na linha, la em cima ^^^^
							}
						});
						
						cont = 0; //aqui é a mesma coisa, só que agora com os pedais com id que eu QUERO
						var id_hidden_cima = "hidden_cima"+cont;
						$(id).each(function(index, element){ //pra cada id...
							if(cont % 3 == 0 && cont != 0) //se ja tem 3 na linha
							{
								id_hidden_cima = "hidden_cima"+cont; //novo id
								if($("#"+id_hidden_cima).length == 0) //se esse id não existir...
								{
									var div = $("<div>"); //criando o id
									div.addClass("clearfix");
									div.attr("id", id_hidden_cima);
									div.appendTo("body");
									div.insertBefore("#primeiro_hidden");
								}
							}
							$(this).insertAfter("#"+id_hidden_cima); //colocando os pedais que eu quero depois do id
							cont ++;
						});	
						
						
						$("#sec2").fadeIn(0); //exibindo a parte de baixo
						$("#sec1").fadeIn(500); //exibindo tudo
					});	//fim da função			
				}
			</script>	

			
	<?php
		if(isset($_GET['id']))
		{
			$id = preg_replace('/\s+/', '', $_GET['id']);
			$id = trim($id,"'!@#$%¨&*()\|<>;: ");
	?>	
			<script>
				trocar(<?php echo $id; ?>);
			</script>
	<?php
		}
	?>
			
			
<?php require_once('footer.php'); ?>
</body>
</html>