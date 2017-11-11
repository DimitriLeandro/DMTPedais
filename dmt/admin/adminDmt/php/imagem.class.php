<?php
class ControlImg
{	
	function saveImgArtista($imagem, $cd_artista)
	{					
					$arquivo_tmp = $imagem['tmp_name'];
					$nome = $imagem['name'];
					
					$extensao = strrchr($nome, '.');
					$extensao = strtolower($extensao);
					
					if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
					{
						$data = date("d").date("m").date("Y").date("H").date("i").date("s");
						
						$novoNome = $data.$extensao;
						$destino = "../../../dmtFiles/images/artists/".$novoNome;
						if(!@move_uploaded_file($arquivo_tmp, $destino))
						{
							echo "Erro ao salvar a imagem no servidor, por favor, tente novamente.<br />";
						}
						else
						{
							//salava o caminho no banco
							require_once("model/DAOArtista.php");
							$obj_daoartista = new DAOArtista();
							$obj_daoartista -> updateImagem($cd_artista, $novoNome);
							unset($obj_daoartista);
						}
					}
					else
					{
						echo "Você poderá enviar apenas arquivos .jpg;*.jpeg;*.gif;*.png<br />";
					}	
	}
	
	function saveImgCarousel($imagem, $cd_carousel)
	{					
					$arquivo_tmp = $imagem['tmp_name'];
					$nome = $imagem['name'];
					
					$extensao = strrchr($nome, '.');
					$extensao = strtolower($extensao);
					
					if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
					{
						$data = date("d").date("m").date("Y").date("H").date("i").date("s");
						
						$novoNome = $data.$extensao;
						$destino = "../../../dmtFiles/images/carousels/".$novoNome;
						if(!@move_uploaded_file($arquivo_tmp, $destino))
						{
							echo "Erro ao salvar a imagem no servidor, por favor, tente novamente.<br />";
						}
						else
						{
							//salva o caminho no banco
							require_once("model/DAOCarousel.php");
							$obj_daocarousel = new DAOCarousel();
							$obj_daocarousel -> updateImagem($cd_carousel, $novoNome);
							unset($obj_daocarousel);
						}
					}
					else
					{
						echo "Você poderá enviar apenas arquivos .jpg;*.jpeg;*.gif;*.png<br />";
					}	
	}
	
	function saveImgPedal($imagem, $cd_pedal) //imagem é o objeto inteiro
	{				
	
	//a primeira coisa aqui é ver qual é o ultimo cd_imagem pra nova imagem ter o nome do ultimo +1
				include("model/conection.php");
				$ultima_imagem = $link -> query("SELECT MAX(cd_imagem) FROM tb_imagem;");
				$row = $ultima_imagem -> fetch_row();
				$i = $row[0];
				
				if($i == "")
				{
					$i = 1;
				}
				else
				{
					$i ++;
				}
				
				
					$arquivo_tmp = $imagem['tmp_name'];
					$nome = $imagem['name'];
					 
					// Pega a extensao
					$extensao = strrchr($nome, '.');
				 
					// Converte a extensao para mimusculo
					$extensao = strtolower($extensao);
				 
					// Somente imagens, .jpg;.jpeg;.gif;.png
					// Aqui eu enfilero as extesões permitidas e separo por ';'
					// Isso server apenas para eu poder pesquisar dentro desta String
					if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
					{
						// Cria um nome único para esta imagem
						// Evita que duplique as imagens no servidor.
						$novoNome = $i.$extensao;
						
						//cria o diretório onde a imagem será salva
						$caminho = "../../../dmtFiles/images/pedals/".$cd_pedal;
						// Concatena a pasta com o nome
						$destino = $caminho."/".$novoNome;
						//vendo se ja é um diretório e se não for cria
						if(!is_dir($caminho))
						{
							if(!mkdir($caminho))
							{
								echo "Erro ao criar o diretório da imagem.<br />";
							}
						}
						//move o arquivo pro destino
						if(@move_uploaded_file( $arquivo_tmp, $destino))
						{
							$caminho_banco = $cd_pedal."/".$i.$extensao;
							
							require_once("model/DAOImagem.php");
							$obj_daoimagem = new DAOImagem();
							$obj_daoimagem -> add($caminho_banco, $cd_pedal);
							unset($obj_daoimagem);
							
						}
						else
						{
							echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
						}
					}
					else
					{
						echo "Você poderá enviar apenas arquivos .jpg;*.jpeg;*.gif;*.png<br />";
					}	
	}
	
	function deleteImg($cd_imagem, $caminho) //PEDAL
	{
		$caminho = "../../../dmtFiles/images/pedals/".$caminho;
		if(unlink($caminho)) //excluindo do servidor, se der certo, então exlcui do banco
		{
			require_once("model/DAOImagem.php");
			$obj_daoimagem = new DAOImagem();
			$ok = $obj_daoimagem -> remove($cd_imagem);
			unset($obj_daoimagem);
			
			return $ok;
		}
		else
		{
			return "Algum erro ocorreu ao tentar excluir a imagem do servidor";
		}
	}
	
	function deleteImgArtista($caminho) //ARTISTA
	{
		$caminho = "../../../dmtFiles/images/artists/".$caminho;
		if(unlink($caminho)) //excluindo do servidor
		{
			return true;
		}
		else
		{
			return "Algum erro ocorreu ao tentar excluir a imagem do servidor";
		}
	}
	
	function deleteImgCarousel($caminho) //CAROUSEL
	{
		$caminho = "../../../dmtFiles/images/carousels/".$caminho;
		if(unlink($caminho)) //excluindo do servidor
		{
			return true;
		}
		else
		{
			return "Algum erro ocorreu ao tentar excluir a imagem do servidor";
		}
	}
}	
?>