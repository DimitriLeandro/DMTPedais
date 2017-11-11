<?php
	session_start();
	if(!isset($_SESSION['login']) || !isset ($_SESSION['senha']) || $_SESSION['login'] != "f60daed98da1243b41fb5188f1a1235d" || $_SESSION['senha'] != "c6efc94dc5a28dee5f1b030503ecf61d")
	{
		header('Location: ../');
	}
?>