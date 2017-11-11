<?php
	session_start();
	unset($_SESSION['usuario']);
	unset($_SESSION['carrinho']);
	session_destroy(); 
	header('Location: ../');
?>