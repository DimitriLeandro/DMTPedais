<?php
class CryptMD5
{
	function criptografar($str)
	{
		for($i = 0; $i < 3; $i++)
		{
			$str = md5($str);
		}
		return $str;
	}
}
	
?>