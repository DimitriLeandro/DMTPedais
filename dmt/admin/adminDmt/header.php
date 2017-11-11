<?php //Verificando Acesso
	require_once('php/acesso.php');
	include('php/model/conection.php');
?>

<style>
.collapse-pdng {
    width: 34%;
}
</style>

<div class="header">
            <div class="container">
			<br/><br/>
                <div class="header-top">
                    <center>
                        <a href="index.php"><img src="../../dmtFiles/images/logo.png" style="width: 20%;"></a>
                    </center>
				<div class="clearfix"></div>
                </div>
                <!---menu-----bar--->
                <div class="header-botom">
                    <div class="content white">
                    <nav class="navbar navbar-default nav-menu" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <!--/.navbar-header-->

                        <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav nav-font">
								<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cadastroPedal.php">Cadastrar Pedal</a></li>
										<li><a href="cadastroArtista.php">Cadastrar Artista</a></li>
										<li><a href="cadastroCarousel.php">Cadastrar Carousel</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Visualizar<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="pedais.php">Pedais</a></li>
										<li><a href="artistas.php">Artistas</a></li>
										<li><a href="carousels.php">Carousels</a></li>
                                    </ul>
                                </li>
								<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estoque<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="entrada.php">Entrada</a></li>
										<li><a href="saida.php">Saida</a></li>
										<li><a href="estoque.php">Estoque</a></li>
                                    </ul>
                                </li>
								<li><a href="php/sair.php">Sair</a></li>
                                <div class="clearfix"></div>
                            </ul>							
                            <div class="clearfix"></div>
                        </div>
                        <!--/.navbar-collapse-->
                        <div class="clearfix"></div>
                    </nav>
                    <!--/.navbar-->   
                        <div class="clearfix"></div>
                    </div>
                    <!--/.content--->
                </div>
                    <!--header-bottom-->
            </div>
        </div>