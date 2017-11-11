<div class="login-bars" style="padding-top: 10px;">
<?php
	if($_SERVER['PHP_SELF'] != "/sites/dmt/checkout.php" && $_SERVER['PHP_SELF'] != "/sites/dmt/login.php" && $_SERVER['PHP_SELF'] != "/sites/dmt/cadastro.php" && $_SERVER['PHP_SELF'] != "/sites/dmt/perfil.php")
	{
		session_start();
	}
	if(isset($_SESSION['usuario']))
	{
		//pegando o cd_usuario e cd_carrinho do usuario logado
		$cd_usuario = $_SESSION['usuario'];
		$cd_carrinho = $_SESSION['carrinho'];
		
		//select do nome do usuario e tratamento
		$select_usuario = $link -> query("SELECT nm_usuario FROM tb_usuario WHERE cd_usuario = '".$cd_usuario."';");
		$row_usuario = $select_usuario -> fetch_row();
		$nome = explode(" ", $row_usuario[0]);
		
		//select dados do carrinho
		$select_carrinho = $link -> query("SELECT SUM((vl_preco+(vl_preco*(vl_taxa/100)))*qt_pedal), SUM(qt_pedal) FROM tb_pedal, tb_pedal_carrinho WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND cd_carrinho = '".$cd_carrinho."';");
		$row_carrinho = $select_carrinho -> fetch_row();
?>
		<p>
			<span>Bem Vindo(a) <?php echo $nome[0]; ?></span>&nbsp;&nbsp;&nbsp;
			<span style="cursor: pointer; color: #0000ff;" onclick="perfil();">Perfil</span>&nbsp;&nbsp;&nbsp;
			<span style="cursor: pointer; color: #0000ff;" onclick="sair();">Sair</span>
		</p>
		<div class="cart box_1">
			<a href="checkout.php">
				<h3>
					<div class="total">
						<table>
							<tr>
								<th>
									<span style="padding: 10px;"><img src="dmtFiles/images/carrinho.png" style="width: 25px;"></span>
								</th>
								<th style="text-align: center;">
									<?php
										if($row_carrinho[0] == null)
										{
											$row_carrinho[0] = "0.00";
											$row_carrinho[1] = "0";
										}
									?>
									<p><span>R$ <?php echo number_format($row_carrinho[0], 2, ',', ''); ?></span></p>
									<p><span><?php echo $row_carrinho[1]; ?> Itens</span></p>
								</th>
							</tr>
						</table>
					</div>
				</h3>
			</a>
		<div class="clearfix"></div>
		</div>
		
<script>
	function sair()
	{
		window.location.href='php/sair.php';
	}
	function perfil()
	{
		window.location.href='perfil.php';
	}
</script>
<?php
	}
	else
	{
?>
		<a class="btn btn-default log-bar" href="cadastro.php" role="button">Cadastro</a>
        <a class="btn btn-default log-bar" href="login.php" role="button">Login</a>
<?php
	}
?>
</div>
