<?php
class DAOVideo
{
	function add($embed, $pedal) //pedal é o código do pedal INT
	{
		include('conection.php');
		//preparando o statement
		$stmt = $link->prepare("INSERT INTO tb_video (nm_link, cd_pedal) VALUES (?,?)") or die(mysqli_error($link));
		//passando os parametros
		$stmt->bind_param("si", $nm_link, $cd_pedal) or die(mysqli_error($link));
		//dizendo quais são os parametros
		$nm_link = $embed;
		$cd_pedal = $pedal;
		
		$stmt->execute() or die(mysqli_error($link));
			
		if($stmt->affected_rows != 1)
		{
			echo "Ocorreu algum erro ao tentar inserir o video no banco";
		}		
		
		$stmt->close();
		mysqli_close($link);
	}
	
	function deleteAll($cd_pedal)
	{
		include('conection.php');
		$stmt = $link->prepare("DELETE FROM tb_video WHERE cd_pedal = ?;");
		$stmt->bind_param("i", $cd_pedal);		
		$stmt->execute();		
		$stmt->close();
		mysqli_close($link);
	}
}	
?>