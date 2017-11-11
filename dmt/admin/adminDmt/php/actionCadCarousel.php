<?php
	require_once("imagem.class.php");
	require_once("model/DAOCarousel.php");
	
	
	//-----------------------------------------------------CADASTRO DE CAROUSEL --------------------------------------
	if(isset($_POST['btn_cadastrar']))
	{
		//pegando informações
		$titulo = $_POST['txt_titulo'];
		$subtitulo = $_POST['txt_subtitulo'];
		$link_http = $_POST['txt_link'];		
		
		//tratamento da imagenm
		if(isset($_FILES['im_carousel']['name']) && $_FILES['im_carousel']["error"] == 0)
		{					
			//instanciando objetos
			$obj_carousel = new DAOCarousel(); 
			$obj_img = new ControlImg();
			
			//cadastrando o carousel e depois tratando a imagem
			$cd_carousel = $obj_carousel -> addCarousel($titulo, $subtitulo, $link_http);		
			$obj_img -> saveImgCarousel($_FILES['im_carousel'], $cd_carousel);
			
			//destruindo os objetos
			unset($obj_img);
			unset($obj_carousel);
			
			//redirecionando
			header('Location: ../carousels.php');
		}
		else
		{
			echo "Houve algum erro com a imagem, por favor, tente novamente.";
		}	
	}
	
	
	//----------------------------------------------------- EXCLUIR CAROUSEL --------------------------------------
	else if(isset($_POST['btn_excluir_carousel']))
	{
		//pegando as informações
		$cd_carousel = $_POST['codigo_carousel'];
		$caminho = $_POST['caminho_img'];
		
		//----
		$obj_carousel = new DAOCarousel();
		$ok = $obj_carousel -> remove($cd_carousel);
		unset($obj_carousel);
		
		if($ok == true)
		{
			//se der certo a exclusão do banco, excluir a img do servidor
			$obj_img = new ControlImg();
			$ok = $obj_img -> deleteImgCarousel($caminho);
			unset($obj_img);
			
			if($ok == true)
			{
				header("Location: ../carousels.php");
			}
			else
			{
				echo $ok;
			}
		}
		else
		{
			echo "Algum erro ocorreu ao tentar excluir o carousel.";
		}
	}
	
	
	
	//----------------------------------------------------- EDITAR CAROUSEL --------------------------------------
	else if(isset($_POST['btn_salvar']))
	{
		//altera informações
		$cd_carousel = $_POST['codigo_carousel'];
		$caminho = $_POST['caminho_img'];
		$titulo = $_POST['txt_titulo'];
		$subtitulo = $_POST['txt_subtitulo'];
		$link_http = $_POST['txt_link'];
		$status = $_POST['cmb_status'];
		
		$obj_carousel = new DAOCarousel();
		$ok = $obj_carousel -> up($cd_carousel, $titulo, $subtitulo, $link_http, $status);
		
		if($ok == true)
		{
				//tratamento da imagem
				if(isset($_FILES['im_carousel']['name']) && $_FILES['im_carousel']["error"] == 0)
				{
					//se escolher uma imagem nova, primeiro exclui a que ja tem do servidor e depois coloca outra
					$obj_img = new ControlImg();
					$ok = $obj_img -> deleteImgCarousel($caminho);
					if($ok == true)
					{
						$obj_img -> saveImgCarousel($_FILES['im_carousel'], $cd_carousel);
						header("Location: ../carousels.php");
					}
					else
					{
						echo "Ocorreu um erro ao tentar alterar a imagem do carousel.";
					}
					unset($obj_img);
				}
				else
				{
					header("Location: ../carousels.php");
				}
		}
		else
		{
			echo "Ocorreu algum erro ao tentar alterar as informações do carousel";
		}
		
		unset($obj_carousel);
	}
	
	
	
	else
	{
		header("Location: ../");
	}
?>