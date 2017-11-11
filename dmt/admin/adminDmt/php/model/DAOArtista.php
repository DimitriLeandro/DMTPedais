<?php
class DAOArtista
{
	function addArtista($nome, $site)
	{
		include('conection.php');
		$stmt = $link -> prepare("INSERT INTO tb_artista (nm_artista, nm_site) VALUES (?,?);");
		$stmt -> bind_param("ss", $nome, $site);
		$stmt -> execute();
		if($stmt->affected_rows == 1)
		{
			return mysqli_insert_id($link);
		}		
		mysqli_close($link);
	}
	
	function updateImagem($cd_artista, $caminho)
	{
		include('conection.php');
		$stmt = $link -> prepare("UPDATE tb_artista SET nm_caminho = ? WHERE cd_artista = ?;");
		$stmt -> bind_param("si", $caminho, $cd_artista);
		if(!$stmt -> execute())
		{
			echo "Houve algum erro ao salvar o caminho da imagem no banco de dados.";
		}		
		mysqli_close($link);
	}
	
	function addPedalArtista($cd_pedal, $cd_artista)
	{
		include('conection.php');
		
		$stmt = $link -> prepare("INSERT INTO tb_pedal_artista (cd_pedal, cd_artista) VALUES (?,?);");
		$stmt -> bind_param("ii", $cd_pedal, $cd_artista);
		$stmt -> execute();
		if($stmt->affected_rows != 1)
		{
			echo "Ocorreu algum erro ao tentar relacionar os pedais com o artista.";
		}		
		mysqli_close($link);
	}
	
	function remove($cd_artista)
	{
		include('conection.php');
		$stmt = $link -> prepare("CALL sp_delete_artista(?);"); //essa procedure só serve pra excluir da tb_pedal_artista e depois da tb_artista
		$stmt -> bind_param("i", $cd_artista);
		$stmt -> execute();
		if($stmt->affected_rows > 0)
		{
			return true;
		}		
		else
		{
			return false;
		}
		mysqli_close($link);
	}
	
	function up($cd_artista, $nome, $site)
	{
		include('conection.php');
		$stmt = $link -> prepare("UPDATE tb_artista SET nm_artista = ?, nm_site = ? WHERE cd_artista = ?;");
		$stmt -> bind_param("ssi", $nome, $site, $cd_artista);
		if($stmt -> execute())
		{
			return true;
		}		
		else
		{
			return false;
		}
		mysqli_close($link);
	}
	
	function removePedalArtista($cd_artista)
	{
		include('conection.php');
		$stmt = $link -> prepare("DELETE FROM tb_pedal_artista WHERE cd_artista = ?;");
		$stmt -> bind_param("i", $cd_artista);
		if($stmt -> execute())
		{
			return true;
		}		
		else
		{
			return false;
		}
		mysqli_close($link);
	}
}
?>