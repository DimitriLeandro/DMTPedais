<?php 
	require_once("../model/conexao.php"); 
	require_once("../validacao.class.php"); 
	require_once("../verificar.class.php"); 
	require_once("../correios.class.php"); 
	require_once("../model/DAOCarrinho.php");
	require_once("../model/DAOUsuario.php");	
?>
		
			<?php
				if(isset($_GET['pcep']) && isset($_GET['puf']) && isset($_GET['pcidade']) && isset($_GET['pbairro']) && isset($_GET['prua']) && isset($_GET['pnumero']) && isset($_GET['pcomp']))
				{
					$obj_validacao = new Validacao();
					$ok = $obj_validacao -> validarEndereco($_GET['pcep'], $_GET['puf'], $_GET['pcidade'], $_GET['pbairro'], $_GET['prua'], $_GET['pnumero'], $_GET['pcomp']);
					unset($obj_validacao);
					
					if($ok == true)
					{
						//------------------------------------------salvando dados-----------------------------------------------------------------
						//somente -> usar somente essa vez, não salvar por cima do endereço do cadastro
						//salvar -> o usuario provavelmente se mudou, fazer update
						//esse -> mesmo do somente
						session_start();
						
						$endereco = $_GET['pcep']."-".$_GET['puf']."-".$_GET['pcidade']."-".$_GET['pbairro']."-".$_GET['prua']."-".$_GET['pnumero']."-".$_GET['pcomp'];
						
						$select_venda = $link -> query("SELECT cd_venda FROM tb_venda WHERE cd_carrinho = '".$_SESSION['carrinho']."';");
						$row_venda = $select_venda -> fetch_row();
						
						if(isset($_GET['salvar']))//salvando o endereço 
						{
							$select_usuario = $link -> query("SELECT cd_celular FROM tb_usuario WHERE cd_usuario = '".$_SESSION['usuario']."';");
							$row_usuario = $select_usuario -> fetch_row();//pegando o celular, pq o método de update tem o celular
							
							$obj_daousuario = new DAOUsuario();
							$ok = $obj_daousuario -> updateDadosPessoais($_SESSION['usuario'], $row_usuario[0], $_GET['pcep'], $_GET['puf'], $_GET['pcidade'], $_GET['pbairro'], $_GET['prua'], $_GET['pnumero'], $_GET['pcomp']);
							unset($obj_daousuario);
							
							if($ok == false)
							{
								echo "<br/><br/>Não foi possível salvar o endereço.<br/>Se ainda deseja atualizar seu cadastro com o novo endereço, vá até a aba 'perfil' no topo do site.<br/><br/>";
							}
						}
						
						//------------------------------------------CALCULO DO PREÇO-----------------------------------------------------------------
						
						//Cria o objeto dos correios
						$obj_correios = new Correios(); 
						
						//select dados do carrinho
						$select_carrinho = $link -> query("SELECT SUM((vl_preco+(vl_preco*(vl_taxa/100)))*qt_pedal), SUM(qt_pedal) FROM tb_pedal, tb_pedal_carrinho WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
						$row_carrinho = $select_carrinho -> fetch_row();
						
						//define as variaveis
						$comprimento = 16.00;
						$largura = 11.00;
						$valor = $row_carrinho[0] / $row_carrinho[1]; //esse valor é uma média de cada pedal
						$fretePac = 0.00;
						$freteSedex = 0.00;
						$prazoPac = 0;
						$prazoSedex = 0;
						
						//definido os fretes cheios e o ultimo frete
						$inteiro = intval($row_carrinho[1] / 10); //essa define quantos fretes cheios vão ter
						$mod = fmod($row_carrinho[1], 10); // define quantos pedais tem no ultimo frete
						
						if($inteiro > 0) //se realmente tiver mais de 10 pedais, calcula o frete cheio e multiplica por essa qtd
						{
							$valor = $valor * 10; //ja que aqui são 10 pedais, então pega a média, que é o preço de um só, e multiplica por 10
							
							$dadosFreteSedex = $obj_correios -> calcularFrete("40010", "02230090", $_GET['pcep'], 5, $comprimento, 100, $largura, $valor);
							$dadosFretePac = $obj_correios -> calcularFrete("41106", "02230090", $_GET['pcep'], 5, $comprimento, 100, $largura, $valor);
							
							$freteSedex = $dadosFreteSedex['valor'] * $inteiro;
							$fretePac = $dadosFretePac['valor'] * $inteiro;
							
							$prazoSedex = $dadosFreteSedex['prazo'];
							$prazoPac = $dadosFretePac['prazo'];
						}
						if($mod > 0)
						{
							//calcuando o ultimo frete
							$valor = $row_carrinho[0] / $row_carrinho[1];
							$valor = $valor * $mod; //aqui é o preço unitário vezes a qtd
							
							$peso = 0.5 * $mod;
							$altura = 10.00 * $mod;
							$dadosFreteSedex = $obj_correios -> calcularFrete("40010", "02230090", $_GET['pcep'], $peso, $comprimento, $altura, $largura, $valor);
							$dadosFretePac = $obj_correios -> calcularFrete("41106", "02230090", $_GET['pcep'], $peso, $comprimento, $altura, $largura, $valor);

							//somando todos os fretes
							$fretePac = $fretePac + $dadosFretePac['valor'];
							$freteSedex = $freteSedex + $dadosFreteSedex['valor'];
							
							$prazoSedex = $prazoSedex + $dadosFreteSedex['prazo'];
							$prazoPac = $prazoPac + $dadosFretePac['prazo'];
						}
						
						//destruindo o objeto
						unset($obj_correios);

						//definindo o valor novamente e as casas decimais
						$valor = $row_carrinho[0];		
						
						$fretePac = number_format($fretePac, 2, ',', '');
						$freteSedex = number_format($freteSedex, 2, ',', '');
						
						//salvando dados na table de VENDAS 
						$obj_daocarrinho = new DAOCarrinho();
						$obj_daocarrinho -> updateVenda($row_venda[0], $endereco, $fretePac, $freteSedex, $prazoPac, $prazoSedex, $valor);
						unset($obj_daocarrinho);
			?>
						<h4>
							<strong>Endereço para entrega:</strong> 
							<br/> 
							<?php echo $_GET['pcep']."<br/>".$_GET['pcidade']." - ".$_GET['puf']."<br/>".$_GET['pbairro']."<br/>".$_GET['prua'].", ".$_GET['pnumero']."/".$_GET['pcomp']; ?> 
							<br/><br/><br/>
							
							
							<strong>Frete:</strong> 
							&nbsp;&nbsp;  
							<span id="sPrecoFrete">
								R$ <?php echo $freteSedex; ?> 
							</span>
							<br/><br/><br/>
							
							
							<strong>Prazo:</strong> 
							&nbsp;&nbsp;  
							<span id="sPrazo">
								<?php
									echo $prazoSedex; 
									if($prazoSedex == 1)
									{
										echo " dia útil após a data da postagem.";
									}
									else
									{
										echo " dias úteis após a data da postagem.";
									}
								?>	
							</span>
							<br/><br/><br/>
							
							
							<h3><strong>Total da Compra:</strong> 
							&nbsp;&nbsp; 
							<span id="sPrecoTotal"> 
								R$ <?php echo number_format($freteSedex + $valor, 2, ',', ''); ?> 
							</span></h3>
						</h4>
						
						
						<section style="display: none;">
							<p id="pFreteSedex">R$ <?php echo $freteSedex; ?></p>
							<p id="pFretePac">R$ <?php echo $fretePac; ?></p>
							<p id="pPrazoSedex">
								<?php 
									echo $prazoSedex; 
									if($prazoSedex == 1)
									{
										echo " dia útil após a data da postagem.";
									}
									else
									{
										echo " dias úteis após a data da postagem.";
									}
								?>
							</p>
							<p id="pPrazoPac">
								<?php 
									echo $prazoPac; 
									if($prazoPac == 1)
									{
										echo " dia útil após a data da postagem.";
									}
									else
									{
										echo " dias úteis após a data da postagem.";
									}
								?>
							</p>
							<p id="pTotalSedex">R$ <?php echo number_format($freteSedex + $valor, 2, ',', ''); ?></p>
							<p id="pTotalPac">R$ <?php echo number_format($fretePac + $valor, 2, ',', ''); ?></p>
						</section>
			<?php
					}
					else
					{
						echo "<br/><br/>O endereço escolhido está apresentando algum erro, por favor, atualize seu cadastro e tente novamente.";
					}
				}
				else
				{
					echo "<br/><br/>Não encontramos o endereço desejado, atualize seu cadastro e tente novamente.";
				}	
			?>