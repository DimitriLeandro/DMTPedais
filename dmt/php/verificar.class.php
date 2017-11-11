<?php
	class Verificar
	{
		function verificarPedalExiste($link, $cd_pedal)//link é a conexão inteira
		{
			//statement do select
			$select_pedal = $link->prepare("SELECT * FROM tb_pedal WHERE cd_pedal = ? AND ic_ativo_inativo = TRUE;");
			$select_pedal->bind_param("i", $cd_pedal);
			$select_pedal->execute();
			$select_pedal->store_result(); //armazenando o resultado, se não armazenar n da pra fazer o num_rows
			//vendo se a pesquisa tem exatamente uma linha
			if($select_pedal -> num_rows != 1)
			{
				header('Location: index.php');
			}
			$select_pedal->close();//fechando o statement
		}
		
		function verificarCarrinho()
		{
			//iniciando a conexão
			include("model/conexao.php");
			
			//pegando o cd_usuario do usuario logado
			session_start();
			$cd_usuario = $_SESSION['usuario'];
			
			//chamando a procedure para verificar se existe algum carrinho em aberto, caso não, criar um novo sem nenhum item
			$stmt = $link -> prepare("CALL sp_verificar_carrinho(?);");
			$stmt -> bind_param('i', $cd_usuario);
			$stmt -> execute();
			$stmt ->close();
			
			//iniciando a sessão que diz o código do carrinho atual do usuario logado
			$select_carrinho = $link -> query("SELECT cd_carrinho FROM tb_carrinho WHERE cd_usuario = '".$cd_usuario."' AND ic_ativo_inativo = TRUE ORDER BY cd_carrinho DESC LIMIT 1");
			$row = $select_carrinho -> fetch_row();
			$_SESSION['carrinho'] = $row[0];
			
			//encerrando a conexão 
			mysqli_close($link);
		}
		
		function verificar_permissao_carrinho() //essa função serve pra quando o cara entrar no carrinho ou no perfil, se ele não estiver logado então não tem permissão pra entrar na pagina carrinho.php
		{
			session_start();
			if(!isset($_SESSION['usuario']) || !isset($_SESSION['carrinho']))
			{
				header("Location: login.php");
			}
		}
		
		function verificar_permissao_login() //serve pra mandar o cara pro index se ele tentar entrar no login ou cadastro e estiver logado
		{
			session_start();
			if(isset($_SESSION['usuario']))
			{
				header("Location: index.php");
			}
		}
		
		function verificar_pedal_disponivel_carrinho()
		{
			header("Location: ../../");
		}
	}
?>