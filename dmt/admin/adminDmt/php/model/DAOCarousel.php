<?php
class DAOCarousel
{
	function addCarousel($titulo, $subtitulo, $link_http)
	{
		include('conection.php');
		$stmt = $link -> prepare("INSERT INTO tb_carousel (nm_titulo, nm_subtitulo, nm_link, ic_ativo_inativo) VALUES (?,?,?, true);");
		$stmt -> bind_param("sss", $titulo, $subtitulo, $link_http);
		$stmt -> execute();
		if($stmt->affected_rows == 1)
		{
			return mysqli_insert_id($link);
		}
		$stmt -> close();
		mysqli_close($link);
	}
	
	function updateImagem($cd_carousel, $caminho)
	{
		include('conection.php');
		$stmt = $link -> prepare("UPDATE tb_carousel SET nm_caminho = ? WHERE cd_carousel = ?;");
		$stmt -> bind_param("si", $caminho, $cd_carousel);
		if(!$stmt -> execute())
		{
			echo "Houve algum erro ao salvar o caminho da imagem no banco de dados.";
		}
		$stmt -> close();
		mysqli_close($link);
	}
	
	function remove($cd_carousel)
	{
		include('conection.php');
		$stmt = $link -> prepare("DELETE FROM tb_carousel WHERE cd_carousel = ?;");
		$stmt -> bind_param("i", $cd_carousel);
		$stmt -> execute();
		if($stmt->affected_rows > 0)
		{
			return true;
		}		
		else
		{
			return false;
		}
		$stmt -> close();
		mysqli_close($link);
	}
	
	function up($cd_carousel, $titulo, $subtitulo, $link_http, $status)
	{
		include('conection.php');
		$stmt = $link -> prepare("UPDATE tb_carousel SET nm_titulo = ?, nm_subtitulo = ?, nm_link = ?, ic_ativo_inativo = ? WHERE cd_carousel = ?;");
		$stmt -> bind_param("sssii", $titulo, $subtitulo, $link_http, $status, $cd_carousel);
		if($stmt -> execute())
		{
			return true;
		}		
		else
		{
			return false;
		}
		$stmt -> close();
		mysqli_close($link);
	}
}
?>