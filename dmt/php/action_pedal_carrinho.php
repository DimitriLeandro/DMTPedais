<?php 
			require_once("model/DAOCarrinho.php");
			
			
			
			//------------------ ADD NO CARRINHO E COMPRAR AGR
			if(isset($_POST['agr']))
			{
				session_start();
				
				$redirect = "../checkout.php?itemAdc";
				
				if(isset($_SESSION['usuario']) && isset($_SESSION['carrinho']))
				{
					$obj_daocarrinho = new DAOCarrinho();
					$obj_daocarrinho -> add($_POST["txt_pedal"], $_SESSION['carrinho'], 1);
					unset($obj_daocarrinho);
					
					header("Location: ".$redirect."");
				}
				else
				{
					header("Location: ../login.php");
				}		
			}
			
			
			
			
			//--------------------- REMOVER PEDAL DO CARRINHO
			else if(isset($_POST['cd_pedal_remover']))
			{
				session_start();
				$obj_daocarrinho = new DAOCarrinho();
				$obj_daocarrinho -> remove($_POST['cd_pedal_remover'], $_SESSION['carrinho']);
				unset($obj_daocarrinho);
				
				header("Location: ../checkout.php?itemRmv");
			}
			
			
			
			
			
			//Redireciona
			else
			{
				header("Location: ../index.php");
			}
?>