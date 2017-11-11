<?php
	$situação = "";
	if(isset($_POST['btn_salvar_taxa']))
	{
		require_once("php/model/DAOPedal.php");
		
		$taxa = $_POST['txt_taxa'];
		$taxa = str_replace(",",".", $taxa);
		
		$obj_daopedal = new DAOPedal();
		$situação = $obj_daopedal -> atualizarTaxaPagSeguro($taxa);
		unset($obj_daopedal);
		
		if($situação == true)
		{
			$situação = "Taxa atualizada com sucesso!";
		}
	}
?>
<html lang="pt">
    <head>
		<link rel="icon" href="../../dmtFiles/images/icon.png" />
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
    </head>
    <body>
        <?php require_once('header.php'); ?>
	<style>
		.th
		{
			text-align: center; 
			vertical-align: middle;
		}
	</style>
		<div class="container">
			<div class="col-md-6 log" style="width: 100%;">
				<center>
					<table class="table table-striped" style="width: 100%;"> 
						<thead style="background: #000066; color: #ffffff;">
							<tr>
								<th style="text-align: center;font-weight:bold;">Código</th>
								<th style="text-align: center;font-weight:bold;">Nome</th>
								<th style="text-align: center;font-weight:bold;">Categoria</th>
								<th style="text-align: center;font-weight:bold;">Preço</th>
								<th style="text-align: center;font-weight:bold;">Instrumento</th>
								<th style="text-align: center;font-weight:bold;">Status</th>
								<th style="text-align: center;font-weight:bold;">Mais</th>
							</tr>
						</thead>
						<?php 
							$select_pedais = $link -> query("SELECT * FROM tb_pedal;");
							while($row = $select_pedais -> fetch_assoc())
							{
						?>				
								<tr>
									<th class="th">
										<?php echo $row['cd_pedal']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_pedal']; ?>
									</th>
									<th class="th">
										<?php echo $row['nm_categoria']; ?>
									</th>
									<th class="th">
										<?php echo $row['vl_preco']; ?>
									</th>
									<th class="th">
										<?php 
											if($row['ic_guitar_bass'] == "g")
											{
												echo "Guitarra";
											}
											else
											{
												echo "Baixo";
											}
										?>
									</th>
									<th class="th">
										<?php 
											if($row['ic_ativo_inativo'] == true)
											{
												echo "Ativo";
											}
											else
											{
												echo "Inativo";
											}
										?>
									</th>
									<th class="th">
										<a href="editarPedal.php?p=<?php echo $row['cd_pedal']; ?>">Editar</a>
									</th>
								</tr>
						<?php
							}
						?>					
					</table>
				</center>
				<br/><br/><br/>
				<form method="post">
					<?php
						$select_taxa = $link -> query("SELECT MAX(vl_taxa) FROM tb_pedal;");
						$row_taxa = $select_taxa -> fetch_row();
					?>
						<fieldset><legend>Taxa do PagSeguro</legend>
							<?php echo $situação."<br/><br/>"; ?>
							<input type="text" name="txt_taxa" value="<?php echo str_replace(".",",", $row_taxa[0]); ?>" style="width: 20%"/>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Salvar" name="btn_salvar_taxa">
						</fieldset>
				</form>
			</div>
		</div>
        <?php require_once('footer.php'); ?>
    </body>
</html>