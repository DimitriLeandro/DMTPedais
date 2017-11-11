<?php  
	if(isset($_GET['email_desejado']))
	{
		include("model/conexao.php");

		$email = filter_input(INPUT_GET, 'email_desejado');
		
		$stmt = $link -> prepare("SELECT cd_email FROM tb_usuario WHERE cd_email = ?");
		$stmt -> bind_param('s', $email);
		$stmt -> execute();
		$stmt -> store_result();
		
		if($stmt -> num_rows > 0)
		{
			echo "Esse e-mail já foi cadastrado, por favor, insira outro endereço de e-mail.";
		}
		else
		{
			echo "ok";
		}
		
		$stmt -> close();
		mysqli_close($link);
	}
	else
	{
		header("Location: ../");
	}
?>