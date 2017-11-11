<?php
	require_once("imagem.class.php");
	require_once("model/DAOArtista.php");
	
	
	//-----------------------------------------------------CADASTRO DE ARTISTA --------------------------------------
	if(isset($_POST['btn_cadastrar']))
	{
		//pegando informações
		$nome = $_POST['txt_nome'];
		$site = $_POST['txt_site'];		
		
		//tratamento da imagenm
		if(isset($_FILES['im_artista']['name']) && $_FILES['im_artista']["error"] == 0)
		{					
			$obj_artista = new DAOArtista(); //o objeto só é fechado lá em baixo pq ainda tem mais métodos para serem usados
			$cd_artista = $obj_artista -> addArtista($nome, $site); //esse método retorna o ultimo id
			
			$obj_img = new ControlImg();
			$obj_img -> saveImgArtista($_FILES['im_artista'], $cd_artista);
			unset($obj_img);
			
			//Pedais usados -- check = 0 é só pra ter algum e não dar pau, mas ele não pode ser contado pq não existe pedal 0
			foreach($_POST['chk_pedal'] as $value)
			{
				if($value != 0)
				{
					$obj_artista -> addPedalArtista($value, $cd_artista); //primeiro o pedal que ele usa, depois ele
				}
			}
			unset($obj_artista); //fecha o objeto e manda pra página de artistas
			
			header('Location: ../artistas.php');

		}
		else
		{
			echo "Houve algum erro com a imagem, por favor, tente novamente.";
		}	
	}
	
	
	
	//----------------------------------------------------- EXCLUIR ARTISTA --------------------------------------
	else if(isset($_POST['btn_excluir_artista']))
	{
		//pegando as informações
		$cd_artista = $_POST['codigo_artista'];
		$caminho = $_POST['caminho_img'];
		
		//obj daoartista que exclui tudo sobre o artista do banco usando uma procedure
		$obj_artista = new DAOArtista();
		$ok = $obj_artista -> remove($cd_artista);
		unset($obj_artista);
		
		if($ok == true)
		{
			//se der certo a exclusão do banco, excluir a img do servidor
			$obj_img = new ControlImg();
			$ok = $obj_img -> deleteImgArtista($caminho);
			unset($obj_img);
			
			if($ok == true)
			{
				header("Location: ../artistas.php");
			}
			else
			{
				echo $ok;
			}
		}
		else
		{
			echo "Algum erro ocorreu ao tentar excluir o artista.";
		}
	}
	
	
	//----------------------------------------------------- EDITAR ARTISTA --------------------------------------
	else if(isset($_POST['btn_salvar']))
	{
		//altera informações
		$cd_artista = $_POST['codigo_artista'];
		$caminho = $_POST['caminho_img'];
		$nome = $_POST['txt_nome'];
		$site = $_POST['txt_site'];	
		
		$obj_artista = new DAOArtista();
		$ok = $obj_artista -> up($cd_artista, $nome, $site);
		
		if($ok == true)
		{
			//excluir tudo da tb_pedal_artista e colocar de novo
			$ok2 = $obj_artista -> removePedalArtista($cd_artista);
			if($ok2 == true)
			{
				//colocando os pedais selecionados
				foreach($_POST['chk_pedal'] as $value)
				{
					if($value != 0)
					{
						$obj_artista -> addPedalArtista($value, $cd_artista); //primeiro o pedal que ele usa, depois ele
					}
				}
				
				//tratamento da imagem
				if(isset($_FILES['im_artista']['name']) && $_FILES['im_artista']["error"] == 0)
				{
					//se escolher uma imagem nova, primeiro exclui a que ja tem do servidor e depois coloca outra
					$obj_img = new ControlImg();
					$ok = $obj_img -> deleteImgArtista($caminho);
					if($ok == true)
					{
						$obj_img -> saveImgArtista($_FILES['im_artista'], $cd_artista);
						header("Location: ../artistas.php");
					}
					else
					{
						echo "Ocorreu um erro ao tentar alterar a imagem do artista.";
					}
					unset($obj_img);
				}
				else
				{
					header("Location: ../artistas.php");
				}
			}
			else
			{
				echo "Ocorreu algum erro ao tentar alterar os pedais do artista";
			}
		}
		else
		{
			echo "Ocorreu algum erro ao tentar alterar as informações do artista";
		}
		
		unset($obj_artista);
	}
	
	
	
	else
	{
		header("Location: ../");
	}
?>