<?php
class DAOEstoque
{
	function insertEntrada($pedal, $qtd)
	{
		include('conection.php');
		
		//só números
		$pedal = preg_replace("/[^0-9]/","", $pedal); 
		$qtd = preg_replace("/[^0-9]/","", $qtd);
		
		//verificando a existência do Pedal
		$select_pedal = $link -> query("SELECT * FROM tb_pedal WHERE cd_pedal = '".$pedal."';");
		if($select_pedal -> num_rows == 1)
		{
			$insert = $link -> query("INSERT INTO tb_entrada (qt_entrada, dt_entrada, cd_pedal) VALUES ('".$qtd."', CURRENT_TIMESTAMP(), '".$pedal."')");
			if($insert -> affected_rows == 0)
			{
				echo "Ocorreu algum erro ao dar entrada no estoque";
			}
		}
		
		mysqli_close($link);
	}
	
	function insertSaida($pedal, $qtd)
	{
		include('conection.php');
		
		$pedal = preg_replace("/[^0-9]/","", $pedal); 
		$qtd = preg_replace("/[^0-9]/","", $qtd);
		
		$select_pedal = $link -> query("SELECT * FROM tb_pedal WHERE cd_pedal = '".$pedal."';");
		if($select_pedal -> num_rows == 1)
		{
			$insert = $link -> query("INSERT INTO tb_saida (qt_saida, dt_saida, cd_pedal) VALUES ('".$qtd."', CURRENT_TIMESTAMP(), '".$pedal."')");
			if($insert -> affected_rows == 0)
			{
				echo "Ocorreu algum erro ao dar saída no estoque";
			}
		}
		
		mysqli_close($link);
	}
}
?>