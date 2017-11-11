<?php 
	header('Content-Type: text/html; charset=utf-8');
?>
<html lang="pt">
    <head>
		<link rel="icon" href="dmtFiles/images/icon.png" />
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
        <?php require_once('header.php'); ?>
		
		
		<!----------------------------------------------- CAROUSEL ------------------------------------------->
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
									$caminho = "dmtFiles/images/carousels/".$row['nm_caminho'];
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
		
		
		
		<!----------------------------------------------- PEDAIS ------------------------------------------->
        <div class="shop-grid">
            <div class="container">
			
			<span onclick="todos();" style="cursor: pointer; font-size: 16.5px;" id="span_all">ALL PEDALS</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span onclick="trocar(g);" style="cursor: pointer; font-size: 16.5px;" id="span_g">GUITAR PEDALS</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span onclick="trocar(b);" style="cursor: pointer; font-size: 16.5px;" id="span_b">BASS PEDALS</span>
			<br/><br/><br/>
			
			<div class="clearfix" id="hidden0"></div>
			<div class="clearfix" id="ultimo_hidden"></div>
			<?php
				$select_pedal = $link->query("SELECT codigo, nome, caminho, instrumento FROM vw_pedal;");
				while($row = $select_pedal->fetch_assoc())
				{
					$caminho = "dmtFiles/images/pedals/".$row['caminho'];
			?>
					<section class="classe-pedais" id="<?php echo $row['instrumento']; ?>">
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
			<div class="clearfix"></div>
            </div>
        </div>
		
		
		<!----------------------------------------------- SEÇÃO ESCONDIDA ------------------------------------------->
		<section style="display: none;">
			<div class="clearfix" id="hidden_clearfix"></div>
		</section>
		
		
		<!----------------------------------------------- SCRIPT ------------------------------------------->
<script>
 /*
	Breathing slowly, mechanical heartbeat
	Losing contact with the living
	Almighty tv plugged, hybrid empty brain
	Don't see anything real in the game
	The tension is building constantly
	No reason just a reflex I have, driven by clockwork
	I try to keep an eye open
	And I realize I haven't closed my eyes in a long time
*/
</script>
<script>
	todos();
				
	function todos()
	{
		$("#span_all").css({"font-weight": "bold"});
		$("#span_g").css({"font-weight": "normal"});
		$("#span_b").css({"font-weight": "normal"});
		
		var cont = 0;
		var id_hidden = "hidden"+cont;
		
		$(".classe-pedais").fadeOut(400, function(){ 	
			$(".classe-pedais").each(function(index, element){
				if(cont % 3 == 0 && cont != 0)
				{
					id_hidden = "hidden"+cont;
					if($("#"+id_hidden).length == 0)
					{
						var div = $("<div>");
						div.addClass("clearfix");
						div.attr("id", id_hidden);
						div.appendTo("body");
						div.insertBefore("#ultimo_hidden");
					}
				}
				$(this).insertAfter("#"+id_hidden);
				cont ++;
			});
			$(".classe-pedais").fadeIn(400);
		});
	}
	
	function trocar(id)
	{	
		$("span").css({"font-weight": "normal"});
		$("#span_"+$(id).attr("id")).css({"font-weight": "bold"});
		
		$(".classe-pedais").fadeOut(400, function(){ 	
			var cont = 0;
			var id_hidden = "hidden"+cont;
			$(".classe-pedais").each(function(index, element){
				if($(this).attr("id") != id)
				{
					$(this).insertAfter("#hidden_clearfix");
				}
			});			
			var id_hidden = "hidden"+cont;
			$(id).each(function(index, element){
				if(cont % 3 == 0 && cont != 0)
				{
					id_hidden = "hidden"+cont;
				}
				$(this).insertAfter("#"+id_hidden);
				cont ++;
			});	
			$(".classe-pedais").fadeIn(400);
		});		
	}
</script>
		
        <?php
			require_once('footer.php'); 
		?>
    </body>
</html>