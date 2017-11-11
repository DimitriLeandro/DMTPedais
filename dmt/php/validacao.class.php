<?php
class Validacao
{
	function validarCadastro($nome, $celular, $email, $senha, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp)
	{
		$celular = preg_replace("/[^0-9]/", "", $celular);
		$cep = preg_replace("/[^0-9]/", "", $cep);
		$numero = preg_replace("/[^0-9]/", "", $numero);
		$comp = preg_replace("/[^0-9]/", "", $comp);
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			if($nome != "") 
			{
				if(strlen($nome) <= 60 && strlen($email) <= 60 && strlen($senha) <= 32 && strlen($celular) <= 11 && strlen($cep) == 8 && strlen($uf) == 2 && strlen($cidade) <= 30 && strlen($bairro) <= 30 && strlen($rua) <= 60 && strlen($numero) <= 10 && strlen($comp) <= 5)
				{
					require_once("model/DAOUsuario.php");
					require_once("MD5.class.php");
					
					$obj_md5 = new CryptMD5();
					$senha = $obj_md5 -> criptografar($senha);
					
					$obj_daousuario = new DAOUsuario();
					$ok = $obj_daousuario -> add($nome, $celular, $email, $senha, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp);
					
					unset($obj_daousuario);
					unset($obj_md5);
					
					return $ok;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function validarUpdateSenha($senha)
	{
		if(strlen($senha) <= 32)
		{			
			$cd_usuario = $_SESSION['usuario'];
			
			require_once("model/DAOUsuario.php");
			require_once("MD5.class.php");
					
			$obj_md5 = new CryptMD5();
			$senha = $obj_md5 -> criptografar($senha);
					
			$obj_daousuario = new DAOUsuario();
			$ok = $obj_daousuario -> alterarSenha($senha, $cd_usuario);
					
			unset($obj_daousuario);
			unset($obj_md5);
				
			return $ok;
		}
		else
		{
			return false;
		}
	}
	
	
	function validarUpdateDadosPessoais($celular, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp)
	{
		$cd_usuario = $_SESSION['usuario'];
		
		$celular = preg_replace("/[^0-9]/", "", $celular);
		$cep = preg_replace("/[^0-9]/", "", $cep);
		$numero = preg_replace("/[^0-9]/", "", $numero);
		$comp = preg_replace("/[^0-9]/", "", $comp);
				
		if(strlen($celular) <= 11 && strlen($cep) == 8 && strlen($uf) == 2 && strlen($cidade) <= 30 && strlen($bairro) <= 30 && strlen($rua) <= 60 && strlen($numero) <= 10 && strlen($comp) <= 5)
		{
			require_once("model/DAOUsuario.php");			
			$obj_daousuario = new DAOUsuario();
			$ok = $obj_daousuario -> updateDadosPessoais($cd_usuario, $celular, $cep, $uf, $cidade, $bairro, $rua, $numero, $comp);					
			unset($obj_daousuario);
					
			return $ok;
		}
		else
		{
			return false;
		}
	}
	
	function validarEndereco($cep, $uf, $cidade, $bairro, $rua, $numero, $comp)
	{		
		$cep2 = preg_replace("/[^0-9]/", "", $cep);
		$numero2 = preg_replace("/[^0-9]/", "", $numero);
		$comp2 = preg_replace("/[^0-9]/", "", $comp);
		
		if(strlen($cep) == strlen($cep2) && strlen($numero) == strlen($numero2) && strlen($comp) == strlen($comp2))
		{
			if(strlen($cep) == 8 && strlen($uf) == 2 && strlen($cidade) < 31 && strlen($bairro) < 31 && strlen($rua) < 61 && strlen($numero) < 11 && strlen($comp) < 6)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>