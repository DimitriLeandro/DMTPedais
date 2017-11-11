<?php
class PagSeguro
{
	function gerarURL($tipodefrete)
	{
		include("model/conexao.php");
		
		//chamando a classe
		require_once('PagSeguroLibrary/PagSeguroLibrary.php');
		
		//criando o objeto
		$paymentRequest = new PagSeguroPaymentRequest();  
		
		//definindo a moeda
		$paymentRequest->setCurrency("BRL");  
		
		//definindo os dados do comprador
		$select_usuario = $link -> query("SELECT nm_usuario, cd_email, cd_celular FROM tb_usuario WHERE cd_usuario = '".$_SESSION['usuario']."';");
		$row_user = $select_usuario -> fetch_row();
		
		$ddd = substr($row_user[2], 0, 2);
		$celular = substr($row_user[2], 2);
		
		$paymentRequest->setSender(  
			$row_user[0],   
			$row_user[1],   
			$ddd,   
			$celular  
		);
		
		//adicionando itens
		$select_carrinho = $link -> query("SELECT tb_pedal.cd_pedal, nm_pedal, qt_pedal, vl_preco+(vl_preco*(vl_taxa/100)) as 'vl_preco' FROM tb_pedal, tb_pedal_carrinho WHERE tb_pedal.cd_pedal = tb_pedal_carrinho.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
		while($row_carrinho = $select_carrinho -> fetch_assoc())
		{
			$paymentRequest->addItem($row_carrinho['cd_pedal'], $row_carrinho['nm_pedal'], $row_carrinho['qt_pedal'], $row_carrinho['vl_preco']);  
		}  
		
		//chamando a classe que define o frete
		$shipping = new PagSeguroShipping();  
		
		//informando o tipo de frete 
		$select_frete = $link -> query("SELECT vl_pac, vl_sedex FROM tb_venda WHERE cd_carrinho = '".$_SESSION['carrinho']."';");
		$row_frete = $select_frete -> fetch_row();
		if($tipodefrete == "Pac")
		{
			$tipodefrete = 1;
			$precofrete = $row_frete[0];
		}
		else
		{
			$tipodefrete = 2;
			$precofrete = $row_frete[1];
		}
			
		$type = new PagSeguroShippingType($tipodefrete); // objeto PagSeguroShippingType  1 = pac 2 = sedex
		$shipping->setType($type);  

		//preço
		$shipping->setCost($precofrete);  
		
		//definindo endereço de entrega
		$select_endereco = $link -> query("SELECT nm_endereco FROM tb_venda WHERE cd_carrinho = '".$_SESSION['carrinho']."';");
		$row_endereco = $select_endereco -> fetch_row();
		
		$endereco = explode('-', $row_endereco[0]);
		
		$data = Array(  
			'postalCode' => $endereco[0],  
			'street' => $endereco[4],  
			'number' => $endereco[5],  
			'complement' => $endereco[6],  
			'district' => $endereco[3],  
			'city' => $endereco[2],  
			'state' => $endereco[1],  
			'country' => 'BRA'  
		);  
		$address = new PagSeguroAddress($data); // objeto PagSeguroAddress  
		$shipping->setAddress($address);  

		
		//passando os dados do frete pro obj principal
		$paymentRequest->setShipping($shipping);  
		
		//pagina de redirecionamento apos o pagamento
		$paymentRequest->setRedirectURL("http://projetocarolina.com.br/teste/dmt");
		
		//definindo 5% de desconto para debito 
		$paymentRequest->addPaymentMethodConfig('EFT', 5.00, 'DISCOUNT_PERCENT');    

		
		//criando o link para redirecionamento	
		try 
		{  
			$credentials = PagSeguroConfig::getAccountCredentials();  
			$checkoutUrl = $paymentRequest->register($credentials); 
			
			return $checkoutUrl;
		} 
		catch(PagSeguroServiceException $e) 
		{  
			return false;
		} 
	}
}
?>