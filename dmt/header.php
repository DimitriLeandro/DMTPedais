<?php
	header('Content-Type: text/html; charset=utf-8');
	if(!isset($link))
	{
		include('php/model/conexao.php');
	}
?>
<div class="header">
            <div class="container">
                <div class="header-top">
				<br><br>
                    <center>
                        <a href="index.php"><img src="dmtFiles/images/logo.png" style="width: 20%;"></a>
                    </center>
                    <?php require_once("php/areaUsuario.php"); ?>
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Guitar Pedals<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php
											$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'g' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
											while($row = $select_categoria -> fetch_assoc())
											{
												$get = "g".$row['nm_categoria'];
												$get = preg_replace('/\s+/', '', $get);
												$redirect = "products.php?id=".$get;
										?>
												<li><a href="<?php echo $redirect; ?>"><?php echo $row['nm_categoria']; ?></a></li>
										<?php
											}
										?>
                                        <li class="divider"></li>
                                        <li><a href="products.php">Todos</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bass Pedals<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php
											$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'b' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
											while($row = $select_categoria -> fetch_assoc())
											{
												$get = "b".$row['nm_categoria'];
												$get = preg_replace('/\s+/', '', $get);
												$redirect = "products.php?id=".$get;
										?>
												<li><a href="<?php echo $redirect; ?>"><?php echo $row['nm_categoria']; ?></a></li>
										<?php
											}
										?>
                                        <li class="divider"></li>
                                        <li><a href="products.php">Todos</a></li>
                                    </ul>
                                </li>
                                <li><a href="artistas.php">Artistas</a></li>
                                <li><a href="contato.php">Contato</a></li>
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