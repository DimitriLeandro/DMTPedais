<?php
	//verificar se todos o pedido tem estoque

	
	//atualizar ic_venda
	//fechar o carrinho
	//iniciar um novo carrinho
	//iniciar uma nova venda

	//email para o cliente
	//email para a DMT
	
	//redirecionar pro pagSeguro
	
	require_once("model/conexao.php");
	require_once("pagseguro.class.php");
	require_once("email.class.php");
	
	if(isset($_POST['cmb_frete']))
	{
		session_start();
		
		if(isset($_SESSION['usuario']) && isset($_SESSION['carrinho']))
		{
			//fazendo o select da venda e verificando se não falta nada
			$select_venda = $link -> query("SELECT cd_venda, nm_endereco, vl_pac, vl_sedex, qt_prazo_pac, qt_prazo_sedex, vl_total FROM tb_venda WHERE cd_carrinho = '".$_SESSION['carrinho']."';");
			$row_venda = $select_venda -> fetch_row();
			
			//esse if verifica se não falta nenhum dado na venda
			if($row_venda[0] != null && $row_venda[1] != null && $row_venda[2] != null && $row_venda[3] != null && $row_venda[4] != null && $row_venda[5] != null && $row_venda[6] != null)
			{
				//e também se o frete foi escolhido corretamente (o usuario pode mudar o value do combo...)
				if($_POST['cmb_frete'] === "Sedex" || $_POST['cmb_frete'] === "Pac")
				{
					//verificando se os pedais que estão no carrinho realmente podem ser comprados (qtd X estoque)
					$select_carrinho = $link -> query("SELECT tb_pedal.cd_pedal, nm_pedal, qt_pedal, qt_estoque FROM tb_pedal, tb_pedal_carrinho, tb_estoque WHERE tb_pedal.cd_pedal = tb_pedal_carrinho.cd_pedal AND tb_pedal.cd_pedal = tb_estoque.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
					
					$erro_qtd = false;
					while($row_carrinho = $select_carrinho -> fetch_assoc())
					{
						if($row_carrinho['qt_pedal'] > $row_carrinho['qt_estoque'])
						{
							$erro_qtd = true;
							if($row_carrinho['qt_estoque'] == 0)
							{
								//tira o pedal do carrinho
								$link -> query("DELETE FROM tb_pedal_carrinho WHERE cd_pedal = '".$row_carrinho['cd_pedal']."' AND cd_carrinho = '".$_SESSION['carrinho']."';");
							}
							else
							{
								//atualiza a quantidade
								$link -> query("UPDATE tb_pedal_carrinho SET qt_pedal = '".$row_carrinho['qt_estoque']."' WHERE cd_pedal = '".$row_carrinho['cd_pedal']."' AND cd_carrinho = '".$_SESSION['carrinho']."';");
							}
						}
					}
					
					if($erro_qtd == false)
					{
						//gerando a url do pagseguro
						$obj_pagseguro = new PagSeguro();
						$url = $obj_pagseguro -> gerarURL($_POST['cmb_frete']);
						unset($obj_pagseguro);
						
						if($url != false)
						{
							//atualiza a opção de frete escolhida e o estagio da venda para 1-------------------------------------------------------------------------------------------------------------------------------------------------------
							$link -> query("UPDATE tb_venda SET ic_pac_sedex = '".$_POST['cmb_frete']."', ic_estagio = 1 WHERE cd_venda = '".$row_venda[0]."';");
							
							
							
							//dando saida de estoque----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
							$tabela_carrinho = "";
							
							$select_carrinho = $link -> query("SELECT tb_pedal.cd_pedal, nm_pedal, qt_pedal FROM tb_pedal_carrinho, tb_pedal WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
							while($row_carrinho = $select_carrinho -> fetch_assoc())
							{
								$tabela_carrinho = $tabela_carrinho."<strong>Qtd: </strong>".$row_carrinho['qt_pedal']." <strong>&nbsp;&nbsp;Item: </strong>".$row_carrinho['nm_pedal']."<br/>";
								$link -> query("INSERT INTO tb_saida (cd_pedal, qt_saida, dt_saida) VALUES ('".$row_carrinho['cd_pedal']."', '".$row_carrinho['qt_pedal']."', CURRENT_TIMESTAMP());");
							}
							
							
							
							//enviando os emails -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg)----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
							$obj_email = new SendEmail();
							
							$select_usuario = $link -> query("SELECT nm_usuario, cd_email, cd_celular FROM tb_usuario WHERE cd_usuario = '".$_SESSION['usuario']."';");
							$row_user = $select_usuario -> fetch_row();
							
							$endereco = explode("-", $row_venda[1]);
							
							if($_POST['cmb_frete'] == "Sedex")
							{
								$soma = $row_venda[3]+$row_venda[6];
								$pagamento = "
									Subtotal: R$".number_format($row_venda[6], 2, ',', '')." <br/>
									Sedex: R$".number_format($row_venda[3], 2, ',', '')." <br/>
									<br/>
									<strong>Total:</strong> R$".number_format($soma, 2, ',', '')."
								";
							}
							else
							{
								$soma = $row_venda[2]+$row_venda[6];
								$pagamento = "
									Subtotal: R$".number_format($row_venda[6], 2, ',', '')."<br/>
									Pac: R$".number_format($row_venda[2], 2, ',', '')."<br/>
									<br/>
									<strong>Total:</strong> R$".number_format($soma, 2, ',', '')."
								";
							}
							
							$mensagem_comum = "
								<br/><br/>
								<h4><strong>Dados do Pedido: </strong></h4><br/>
								<fieldset><legend><strong>INFORMAÇÕES DE ENTREGA:</strong></legend>
									"
										.$row_user[0]."<br/>"
										.$row_user[1]."<br/>"
										.$row_user[2]."<br/><br/>"
										.$endereco[0]."<br/>"
										.$endereco[2]." - ".$endereco[1]."<br/>"
										.$endereco[3]."<br/>"
										.$endereco[4].", ".$endereco[5]."/".$endereco[6].
									"
								</fieldset>
								<br/>
								<fieldset><legend><strong>CARRINHO:</strong></legend>
									".$tabela_carrinho."
								</fieldset>
								<br/>
								<fieldset><legend><strong>PAGAMENTO:</strong></legend>
									".$pagamento."
								</fieldset>
							";
							
							//email para DMT
							$emaildestino = "dimitri.leandro@gmail.com";
							$nomeremetente = "Site DMT";
							$emailremetente = "dimitri.leandro@projetocarolina.com.br";
							$assunto = "Um novo cliente foi redirecionado para o PagSeguro";
							$msg = "
								O cliente ".$row_user[0]." efetuou um pedido pelo site e foi encaminhado para o PagSeguro.
								".$mensagem_comum."
							";
							$obj_email -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg);
						
							//email para o cliente
							$emaildestino = $row_user[1];
							$nomeremetente = "DMT Custom Shop";
							$emailremetente = "dimitri.leandro@projetocarolina.com.br";
							$assunto = "Novo Pedido";
							$msg = "
								Obrigado por fazer o pedido.
								".$mensagem_comum."
							";
							$obj_email -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg);							
							
							unset($obj_email);
							
							
							
							
							//fecha o carrinho e inicia um novo--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
							$link -> query("UPDATE tb_carrinho SET ic_ativo_inativo = 0, dt_modificacao = CURRENT_TIMESTAMP() WHERE cd_carrinho = '".$_SESSION['carrinho']."';");
							$link -> query("CALL sp_verificar_carrinho('".$_SESSION['usuario']."');");
							
							//definindo a sessão do novo carrinho
							$select_novo_carrinho = $link -> query("SELECT max(cd_carrinho) FROM tb_carrinho WHERE cd_usuario = '".$_SESSION['usuario']."';");
							$row_novo_carrinho = $select_novo_carrinho -> fetch_row();
							
							$_SESSION['carrinho'] = $row_novo_carrinho[0];
							
							
							
							//redirecionando pro pagseguro----------------------------------------------------------------------------------------------------------------------
							header("Location: ".$url);
							//echo $url;
						}
						else
						{
							header("Location: ../checkout.php?noUrl");
						}
					}
					else
					{
						header("Location: ../checkout.php?updated");
					}
				}
				else
				{
					header("Location: ../checkout.php?noData");
				}
			}
			else
			{
				header("Location: ../checkout.php?noData");
			}
		}
		else
		{
			header("Location: ../");
		}
	}
	else
	{
		header("Location: ../");
	}
?>