<?php
class Login
{
	function logar($email, $senha)
	{
		require_once("MD5.class.php");
		require_once("verificar.class.php");
		
		$obj_md5 = new CryptMD5();
		$senha = $obj_md5 -> criptografar($senha);
		unset($obj_md5);
		
		include("model/conexao.php");
		$stmt = $link -> prepare("SELECT cd_usuario, cd_email, nm_senha FROM tb_usuario WHERE cd_email = ? AND nm_senha = ?");
		$stmt -> bind_param("ss", $email, $senha);
		$stmt -> execute();
		$stmt -> store_result();
		
		if($stmt -> num_rows == 1)
		{
			$stmt->bind_result($cd_usuario, $cd_email, $nm_senha);
			$stmt->fetch();
		  
			if($email === $cd_email && $senha === $nm_senha)
			{
				session_start();
				$_SESSION['usuario'] = $cd_usuario;
				
				$obj_verificar = new Verificar();
				$obj_verificar -> verificarCarrinho();
				unset($obj_verificar);
		
				header('Location: products.php');
			}
			else
			{
				return "<p>E-Mail ou Senha Incorretos.<br/></p>";
			}
		}
		else
		{
			return "<p>E-Mail ou Senha Incorretos.<br/></p>";
		}
		
		$stmt -> close();
		mysqli_close($link);
	}
}
?>