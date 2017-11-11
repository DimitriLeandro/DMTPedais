<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
		<title>DMT  - Novo Pedal</title>
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
                    <li><a href="register.html">LOGIN</a></li>
                    <li class="active">REGISTER</li>
                </ol>
            </div>
        </div>
        <!-- reg-form -->
	<div class="reg-form">
		<div class="container">
			<div class="reg">
				<h3>Novo Pedal</h3><br>
				
				
				
				<form enctype="multipart/form-data" method="post" action="php/actionCadPedal.php">
					<ul>
						<li class="text-info">Nome do Pedal: </li>
						<li><input name="txt_nome" type="text" value=""></li>
					</ul>
					<ul>
						<li class="text-info">Descrição: </li>
						<li><textarea name="txt_desc" style="width: 50%; height: 25%;"></textarea></li>
					</ul>				 
					<ul>
						<li class="text-info">Preço: </li>
						<li><input name="txt_preco" type="text" value=""></li>
					</ul>
					<ul>
						<li class="text-info">Instrumento: </li>
						<li>
							<select name="cmb_instrumento" class="form-control qnty-chrt" style="width: 15%;">
								<option value="g">Guitarra</option>
								<option value="b">Baixo</option>
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
										<?php
											$select_categorias = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal ORDER BY nm_categoria;");
											while($row = $select_categorias -> fetch_assoc())
											{
										?>
												<option value="<?php echo $row['nm_categoria']; ?>"><?php echo $row['nm_categoria']; ?></option>
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
						<li class="text-info">Fotos:</li>
						<?php
							for($i=1; $i<=4; $i++)
							{
						?>
								<li><input name="img<?php echo $i ?>" type="file"></li><br>
						<?php
							}
						?>
					</ul>
					<ul>
						<li class="text-info">Embed Youtube: </li>
						<?php
							for($i=1; $i<=4; $i++)
							{
						?>
								<li><input type="text" name="video<?php echo $i; ?>"></li><br>
						<?php
							}
						?>
					</ul>					
					<input name="btn_cadastrar" type="submit" value="Cadastrar" style="background: #000066; color: #ffffff;">
				</form>
				
				
				
			</div>
		</div>
	</div>
    <?php require_once('footer.php'); ?>
    </body>
</html>