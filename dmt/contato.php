<?php
	include("php/email.class.php");
	
	$enviou = "";
	
	if(isset($_POST['enviar']))
	{
		$obj_email = new SendEmail();
		
		$emaildestino = "dimitri.leandro@gmail.com";
		$nomeremetente = "Contato DMT";
		$emailremetente = "dimitri.leandro@projetocarolina.com.br";
		$assunto = $_POST['txt_assunto'];
		$msg = "<strong>Nome: </strong>".$_POST['txt_nome']."<br/><strong>Email: </strong>".$_POST['txt_email']."<br/><br/><strong>Mensagem: </strong><br/>".$_POST['txt_msg'];
		
		$enviou = $obj_email -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg);
		
		unset($obj_email);
		
		if($enviou == true)
		{
			$enviou = "Obrigado por enviar seu feedback. Entraremos em contato.";
		}
		else
		{
			$enviou = "Algum erro ocorreu ao tentar enviar a mensagem.";
		}
	}
?>
<html lang="pt">
    <head>
	<link rel="icon" href="dmtFiles/images/icon.png" />
    <title>DMT - Contato</title>
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
<section id="section_contato">
    <?php require_once('header.php'); ?>
        <div class="head-bread">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Contato</li>
                </ol>
            </div>
        </div>
		
		
        <!-- contact -->
        <div class="contact">
            <div class="container">
                <h3>Contato</h3>
				<p style="color: #aaaaaa">Envie suas dúvidas, sugestões ou reclamações. Lembre-se que você também pode nos encontrar no Facebook.</p>
                <div class="contact-content">
                    <form method="post">
                        <input name="txt_nome" type="text" class="textbox" placeholder="Seu Nome"/><br>
                        <input name="txt_email" type="email" class="textbox" placeholder="Seu E-Mail"/><br>
						<input name="txt_assunto" type="text" class="textbox" placeholder="Assunto"/><br>
                        <div class="clear"> </div>
                        <div>
                            <textarea name="txt_msg" placeholder="Mensagem"/></textarea><br>
                        </div>	
                       <div class="submit"> 
                            <input name="enviar" class="btn btn-default cont-btn" type="submit" value="Enviar"/>
                      </div>
                    </form>
                    <div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d467692.0488821707!2d-46.87549854083795!3d-23.681531445398782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce448183a461d1%3A0x9ba94b08ff335bae!2zU8OjbyBQYXVsbywgU1A!5e0!3m2!1spt-BR!2sbr!4v1449332501683" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
                </div>
            </div>
        </div>
	   <!--contact-->
<?php require_once('footer.php'); ?>
</section>

<!----------------- ALERT --------------->
	<div class="alert">
		<section style="padding: 5px;">
			<p><?php echo $enviou; ?></p>
			<p align="right"><button type="button" class="btn btn-info" onclick="normal();">OK</button></p>
		</section>
	</div>
	<style>
		.alert{
			position: absolute;
			width: 50%;
			top: 50%;
			margin-left: 25%;
			background: #ffffff;
			border-radius: 25px;
			border: 2px solid #cccccc;
		}
	</style>
	<script>
		$(".alert").fadeOut(0);
		
		function alertar()
		{
			$("#section_contato").fadeTo(0, 0.2);
			$(".alert").fadeIn(0);
		}
		
		function normal()
		{
			$("#section_contato").fadeTo(300, 1);
			$(".alert").fadeOut(300);
		}
	</script>
	<?php
		if($enviou != "")
		{
			echo "<script>alertar();</script>";
		}
	?>

</body>
</html>