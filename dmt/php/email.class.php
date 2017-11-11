<?php
class SendEmail
{
	function send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg)
	{
		if (filter_var($emailremetente, FILTER_VALIDATE_EMAIL) && filter_var($emaildestino, FILTER_VALIDATE_EMAIL)) 
		{			
			$header = "From: ".$nomeremetente." <".$emailremetente.">\r\n"; 
			$header.= "MIME-Version: 1.0\r\n"; 
			$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
			$header.= "X-Priority: 1\r\n"; 
			
			if(mail($emaildestino, $assunto, $msg, $header))
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