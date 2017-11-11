<?php
class NovaSenha
{
	function mudarSenha($email)
	{
		require_once("MD5.class.php");
		require_once("model/DAOUsuario.php");
		require_once("email.class.php");
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			include("model/conexao.php");
			$stmt = $link -> prepare("SELECT cd_usuario, cd_email FROM tb_usuario WHERE cd_email = ?;");
			$stmt -> bind_param("s", $email);
			$stmt -> execute();
			$stmt -> store_result();
			if($stmt -> num_rows == 1)
			{
				$stmt->bind_result($usuario, $cd_email);
				$stmt->fetch();
			  
				if($email === $cd_email)
				{
					$obj_md5 = new CryptMD5();
					
					//criando a nova senha -> a nova senha é um rand 0 - 100 + email tudo criptografado e depois só numeros
					$novasenha = rand(0,100);
					$novasenha = $novasenha.$cd_email;
					$novasenha = $obj_md5 -> criptografar($novasenha);
					$novasenha = preg_replace("/[^0-9]/", "", $novasenha);
					
					//criptografando pra mandar pro banco
					$senhacripto = $obj_md5 -> criptografar($novasenha);
					unset($obj_md5);

					$obj_daousuario = new DAOUsuario();
					$ok = $obj_daousuario -> alterarSenha($senhacripto, $usuario);
					unset($obj_daousuario);
					
					if($ok == true)
					{
						$msg = "Sua nova senha é: ".$novasenha;					
						
						$obj_email = new SendEmail();
						$enviou = $obj_email -> send($email, "DMT Pedais", "dimitri.leandro@projetocarolina.com.br", "Nova Senha", $msg);
						unset($obj_email);
						
						if($enviou == true)
						{
							mysqli_close($link);
							return "Senha alterada com sucesso, verifique seu email.";
						}
						else
						{
							mysqli_close($link);
							return "Houve algum problema ao tentar enviar um email com a nova senha, por favor, faça a operaçao novamente.";
						}
					}
					else
					{
						mysqli_close($link);
						return "Houve algum problema ao tentar alterar a senha.";
					}
				}
				else
				{
					mysqli_close($link);
					return "Não encontramos nenhum cadastro com esse email. Tente novamente.";
				}
			}
			else
			{
				mysqli_close($link);
				return "Não encontramos nenhum cadastro com esse email. Tente novamente.";
			}
		}
		else
		{
			return "Email incorreto. Tente novamente.";
		}
	}
}
?>