<?php
class DAOPedal
{
	function add($nome, $desc, $preco, $instrumento, $categoria)
	{
		include('conection.php');
		
		$stmt = $link->prepare("CALL sp_insert_pedal_estoque(?, ?, ?, ?, ?);");
		$stmt->bind_param("ssdss", $nome, $desc, $preco, $instrumento, $categoria);
		$stmt->execute();
			
		if($stmt->affected_rows > 0)
		{
			$select_max = $link -> query("SELECT MAX(cd_pedal) FROM tb_pedal;"); //aqui não rola pegar o ultimo id direto, pq o ultimo id gerado é o do estoque, não o do pedal
			$id = $select_max -> fetch_row();
			return $id[0];
		}
		$stmt -> close();
		mysqli_close($link);
	}
	
	function up($cd_pedal, $nome, $desc, $preco, $instrumento, $categoria, $status)
	{
		include('conection.php');
		
		$stmt = $link->prepare("UPDATE tb_pedal SET nm_pedal = ?, ds_pedal =?, vl_preco = ?, ic_guitar_bass = ?, nm_categoria = ?, ic_ativo_inativo = ? WHERE cd_pedal = ?;");
		$stmt->bind_param("ssdssii", $nome, $desc, $preco, $instrumento, $categoria, $status, $cd_pedal);
		$stmt->execute();
			
		if($stmt->affected_rows == 1)
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
	
	function atualizarTaxaPagSeguro($novataxa)
	{
		include('conection.php');
		
		$stmt = $link->prepare("UPDATE tb_pedal SET vl_taxa = ?;");
		$stmt->bind_param("d", $novataxa);
			
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			return "Não foi possivel concluir a atualização da taxa do PagSeguro.";
		}
		
		$stmt -> close();
		mysqli_close($link);
	}
}	

/*
	DELIMITER $$
	CREATE PROCEDURE sp_insert_pedal_estoque(IN nome VARCHAR(50), descricao TEXT, preco DECIMAL(9,2), instrumento CHAR(1), categoria VARCHAR(30))
		BEGIN
			INSERT INTO tb_pedal (nm_pedal, ds_pedal, vl_preco, ic_guitar_bass, nm_categoria, ic_ativo_inativo) VALUES (nome, descricao, preco, instrumento, categoria, TRUE);
			INSERT INTO tb_estoque (qt_estoque, dt_alteracao, cd_pedal)  VALUES (0, CURRENT_TIMESTAMP(), LAST_INSERT_ID());
		END $$
	DELIMITER;
*/
?>