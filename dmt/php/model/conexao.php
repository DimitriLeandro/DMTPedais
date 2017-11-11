<?php
	$link = new mysqli("db-dmt.mysql.uhserver.com","admin_dmt","@SenhaDMT01","db_dmt");

	if ($link->connect_errno)
	{
		echo "<script>window.location.href='erro.html';</script>"; 
	}
	
	if(!mysqli_ping($link))
	{
		echo "<script>window.location.href='erro.html';</script>"; 
	}
	
	mysqli_set_charset($link,"utf8");
?>