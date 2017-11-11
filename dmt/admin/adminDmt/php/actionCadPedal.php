<?php
	
	require_once("model/DAOPedal.php");
	require_once("model/DAOVideo.php");
	require_once("imagem.class.php");

	
	//---------------------------------------------- CADASTRAR PEDAL IMAGEM E VIDEO----------------------------------------
	if(isset($_POST['btn_cadastrar']))
	{
		//-------POST DADOS DO FORM--------//
		$nome = $_POST['txt_nome'];
		$desc = $_POST['txt_desc'];
		$preco = $_POST['txt_preco'];
		$instrumento = $_POST['cmb_instrumento'];
		$categoria = $_POST['txt_categoria'];
		if($categoria == "")
		{
			$categoria = $_POST['cmb_categoria'];
		}
		
		//--------Chamando a classe de insert pedal---------------//
		$obj_pedal = new DAOPedal();
		$cd_pedal = $obj_pedal -> add($nome, $desc, $preco, $instrumento, $categoria);
		unset($obj_pedal);
		
		//tratamento das imagens
		$obj_img = new ControlImg();
		for($i=1; $i<=4; $i++)
		{
			$img = "img".$i;
			if(isset($_FILES[$img]['name']) && $_FILES[$img]["error"] == 0)
			{
				$obj_img -> saveImgPedal($_FILES[$img], $cd_pedal);
			}
		}
		unset($obj_img);
		
		//videos
		$obj_video = new DAOVideo();
		for($i=1; $i<=4; $i++)
		{
			$txt_video = "video".$i;
			$link = $_POST[$txt_video];
			if($link != "")
			{
				$obj_video -> add($link, $cd_pedal);
			}
		}
		unset($obj_video);
		
		header('Location: ../pedais.php');
	}
	
	
	//---------------------------------------------- EDITAR PEDAL ----------------------------------------
	else if(isset($_POST['btn_editar_pedal']))
	{
		//-------POST DADOS DO FORM--------//
		$cd_pedal = $_POST['cd_pedal'];
		$nome = $_POST['txt_nome'];
		$desc = $_POST['txt_desc'];
		$preco = $_POST['txt_preco'];
		$instrumento = $_POST['cmb_instrumento'];
		$status = $_POST['cmb_status'];
		$categoria = $_POST['txt_categoria'];
		if($categoria == "")
		{
			$categoria = $_POST['cmb_categoria'];
		}
		
		$obj_pedal = new DAOPedal();
		$ok = $obj_pedal -> up($cd_pedal, $nome, $desc, $preco, $instrumento, $categoria, $status);
		unset($obj_pedal);
		
		if($ok == true)
		{
			header("Location: ../pedais.php");
		}
		else
		{
			echo "Ocorreu algum erro ao tentar editar as informações do pedal";
		}
	}
	
	//---------------------------------------------- EDITAR VIDEOS ----------------------------------------
	else if(isset($_POST['btn_editar_video']))
	{
		$cd_pedal = $_POST['cd_pedal'];
		$obj_video = new DAOVideo();
		$obj_video -> deleteAll($cd_pedal);		
		for($i=1; $i<=4; $i++)
		{
			$txt_video = "video".$i;
			$link = $_POST[$txt_video];
			if($link != "")
			{
				$obj_video -> add($link, $cd_pedal);
			}
		}
		unset($obj_video);
		header('Location: ../editarPedal.php?p='.$cd_pedal[0].'');
	}
	
	
	
	//---------------------------------------------- EXCLUIR IMAGEM ----------------------------------------
	else if(isset($_POST['btn_excluir_img']))
	{
		$cd_imagem = $_POST['codigo'];
		$caminho = $_POST['caminho'];
		
		$cd_pedal = explode("/", $caminho);
		
		$obj_img = new ControlImg();
		$ok = $obj_img -> deleteImg($cd_imagem, $caminho);
		unset($obj_img);
		
		if($ok == true)
		{
			header('Location: ../editarPedal.php?p='.$cd_pedal[0].'');
		}
		else
		{
			echo $ok;
		}
	}
	
	
	
	//---------------------------------------------- ADICIONAR IMAGEM ----------------------------------------
	else if(isset($_POST['btn_adc_img']))
	{
		$cd_pedal = $_POST['pedal'];
		//tratamento das imagens
		$obj_img = new ControlImg();
		for($i=1; $i<=4; $i++)
		{
			$img = "file_adc".$i;
			if(isset($_FILES[$img]['name']) && $_FILES[$img]["error"] == 0)
			{
				$obj_img -> saveImgPedal($_FILES[$img], $cd_pedal);
			}
		}
		unset($obj_img);
		
		header('Location: ../editarPedal.php?p='.$cd_pedal.'');
	}
	
	
	//caso não tenha clicado em nada
	else
	{
		header("Location: ../");
	}
?>