<?php
	require_once("email.class.php");
	$obj_email = new SendEmail();
	

		if(isset($_POST['notificationCode']) && isset($_POST['notificationType']))
		{
				//$email = 'fabio.leandro@gmail.com';
				//$token = '350BF616711147208EA1294D7F1A5F9C';

				$url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/".$_POST['notificationCode']."?email=fabio.leandro@gmail.com&token=2AAE58503D3C4957A7044C77DF99D80B";

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);

				$transaction = trim(curl_exec($curl));
				curl_close($curl);	
									
						$transaction = simplexml_load_string($transaction);
					
						
						
						//guardando no banco
						//include("model/conexao.php");
						//$link -> query("INSERT INTO tb_notificacao (nm_comprador, nm_referencia, ic_status, vl_preco, dt_transacao) VALUES ('".$nome."', 'REFERENCE', '".$status."', '".$preco."', CURRENT_TIMESTAMP());");
						
						
						//enviando email sobre a  compra
											$emaildestino = "dimitri.leandro@gmail.com";
											$nomeremetente = "Site DMT";
											$emailremetente = "dimitri.leandro@projetocarolina.com.br";
											$assunto = "Nova Notificação";
											$msg = "
												Código da Transação: ".$_POST['notificationCode']."<br/>
											
												Nome: ". $transaction -> sender -> name ."<br/>
												Referencia: ". $transaction -> reference ." <br/>
												Status: ". $transaction -> status ."<br/>
												Preco: ". $transaction -> netAmount ."<br/>
											";
											$obj_email -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg);
				
		}
		else
		{
									$emaildestino = "dimitri.leandro@gmail.com";
									$nomeremetente = "Site DMT";
									$emailremetente = "dimitri.leandro@projetocarolina.com.br";
									$assunto = "Erro de Notificação";
									$msg = "A pagina foi carregada sem o código da transação.";
									$obj_email -> send($emaildestino, $nomeremetente, $emailremetente, $assunto, $msg);
		}
	unset($obj_email);
?>