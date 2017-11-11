<?php
class DAOImagem
{
	function add($caminho, $pedal) //pedal é o código do pedal INT
	{
		include('conection.php');
		
		//preparando o statement
		$stmt = $link->prepare("INSERT INTO tb_imagem (nm_caminho, cd_pedal) VALUES (?,?)") or die(mysqli_error($link));
		//passando os parametros
		$stmt->bind_param("si", $nm_caminho, $cd_pedal) or die(mysqli_error($link));
		//dizendo quais são os parametros
		$nm_caminho = $caminho;
		$cd_pedal = $pedal;
		
		$stmt->execute() or die(mysqli_error($link));
			
		if($stmt->affected_rows != 1)
		{
			echo "Ocorreu algum erro ao tentar inserir o caminho da imagem no banco";
		}	

		$stmt->close();		
		mysqli_close($link);
	}
	
	function remove($cd_imagem)
	{
		include('conection.php');
		$stmt = $link->prepare("DELETE FROM tb_imagem WHERE cd_imagem = ?;");
		$stmt->bind_param("i", $cd_imagem);
		$stmt->execute();
		if($stmt->affected_rows == 1)
		{
			return true;
		}
		else
		{
			return "Ocorreu algum erro ao tentar excluir o caminho da imagem no banco";
		}

		$stmt->close();		
		mysqli_close($link);
	}
}	
?>