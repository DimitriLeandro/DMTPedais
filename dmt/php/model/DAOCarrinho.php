<?php
class DAOCarrinho
{
	function add($pedal, $carrinho, $qtd)
	{
		include("conexao.php");
		
		$stmt = $link -> prepare("CALL sp_add_pedal_carrinho(?, ?, ?)");
		$stmt -> bind_param("iii", $pedal, $carrinho, $qtd);
		$stmt -> execute();
		$stmt -> close();
		
		mysqli_close($link);
	}
	
	function remove($pedal, $carrinho)
	{
		include("conexao.php");
		
		$stmt = $link -> prepare("DELETE FROM tb_pedal_carrinho WHERE cd_pedal = ? AND cd_carrinho = ?");
		$stmt -> bind_param("ii", $pedal, $carrinho);
		$stmt -> execute();
		$stmt -> close();
		
		mysqli_close($link);
	}
	
	function updateVenda($venda, $endereco, $fretePac, $freteSedex, $prazoPac, $prazoSedex, $valor) //função para atualizar informações sobre a tabela tb_venda
	{
		include("conexao.php");
		
		$stmt = $link -> prepare("UPDATE tb_venda SET dt_venda = CURRENT_TIMESTAMP(), nm_endereco = ?, vl_pac = ?, vl_sedex = ?, qt_prazo_pac = ?, qt_prazo_sedex = ?, vl_total = ? WHERE cd_venda = ?");
		$stmt -> bind_param("sddiidi", $endereco, $fretePac, $freteSedex, $prazoPac, $prazoSedex, $valor, $venda);
		$stmt -> execute();
		$stmt -> close();
		
		mysqli_close($link);
	}
}
/*
DELIMITER $$
CREATE PROCEDURE sp_add_pedal_carrinho(IN pedal INT, carrinho INT, qtd INT)
    BEGIN
    	DECLARE oldqtd INT;
        DECLARE newqtd INT;
    	IF EXISTS(SELECT * FROM tb_pedal_carrinho WHERE cd_pedal = pedal AND cd_carrinho = carrinho) THEN
        	SET oldqtd = (SELECT qt_pedal FROM tb_pedal_carrinho WHERE cd_pedal = pedal AND cd_carrinho = carrinho);
            SET newqtd = oldqtd + qtd;
            UPDATE tb_pedal_carrinho SET qt_pedal = newqtd WHERE cd_pedal = pedal AND cd_carrinho = carrinho;
        ELSE
        	INSERT INTO tb_pedal_carrinho (cd_pedal, cd_carrinho, qt_pedal) VALUES (pedal, carrinho, qtd);
        END IF;
	END $$
DELIMITER;
*/
?>