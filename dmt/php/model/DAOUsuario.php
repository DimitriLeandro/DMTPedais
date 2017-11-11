<?php
class DAOUsuario
{
	function add($nome, $celular, $email, $senha, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp)
	{
		include('conexao.php');
		
		$stmt = $link->prepare("CALL sp_insert_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$stmt->bind_param("sississssii", $nome, $celular, $email, $senha, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp);
		$stmt->execute();
			
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
	
	function alterarSenha($nova_senha, $cd_usuario)
	{
		include('conexao.php');
		$stmt = $link->prepare("UPDATE tb_usuario SET nm_senha = ? WHERE cd_usuario = ?;");
		$stmt->bind_param("si", $nova_senha, $cd_usuario);
		if($stmt->execute())
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
	
	function updateDadosPessoais($usuario, $celular, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp)
	{
		include('conexao.php');
		
		$stmt = $link->prepare("CALL sp_update_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$stmt->bind_param("iiissssii", $usuario, $celular, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp);
		
		if($stmt->execute())
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

/*  
PROCEDURE DE CADASTRO

DELIMITER $$
CREATE PROCEDURE sp_insert_usuario(in nome VARCHAR(60), celular BIGINT(11), email VARCHAR(60), senha VARCHAR(32), cep INT(8), uf CHAR(2), cidade VARCHAR(30), bairro VARCHAR(30), rua VARCHAR(60), numero INT(10), comp INT(5))
  BEGIN
    INSERT INTO tb_usuario (nm_usuario, cd_email, nm_senha, cd_celular) VALUES (nome, email, senha, celular);
    INSERT INTO tb_endereco (cd_cep, sg_uf, nm_cidade, nm_bairro, nm_rua, nm_numero, nm_comp, cd_usuario) VALUES (cep, uf, cidade, bairro, rua, numero, comp, LAST_INSERT_ID());
  END $$
DELIMITER;






PROCEDURE DE UPDATE

DELIMITER $$
CREATE PROCEDURE sp_update_usuario(in usuario INT(10), celular BIGINT(11), cep INT(8), uf CHAR(2), cidade VARCHAR(30), bairro VARCHAR(30), rua VARCHAR(60), numero INT(10), comp INT(5))
  BEGIN
    UPDATE tb_usuario SET cd_celular = celular WHERE cd_usuario = usuario;
	UPDATE tb_endereco SET cd_cep = cep, sg_uf = uf, nm_cidade = cidade, nm_bairro = bairro, nm_rua = rua, nm_numero = numero, nm_comp = comp WHERE cd_usuario = usuario;
  END $$
DELIMITER;
*/
?>