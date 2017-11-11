<?php
class Correios
{
	function calcularFrete($servico, $cepOrigem, $cepDestino, $peso, $comprimento, $altura, $largura, $valor)
	{
		 $data['nCdEmpresa'] = '';
		 $data['sDsSenha'] = '';
		 $data['nCdServico'] = $servico; //sedex 40010 - pac 41106
		 $data['sCepOrigem'] = $cepOrigem;
		 $data['sCepDestino'] = $cepDestino;
		 $data['nVlPeso'] = $peso; //em Kg
		 $data['nCdFormato'] = "1"; //1 significa caixa retangular
		 $data['nVlComprimento'] = $comprimento; //em cm
		 $data['nVlAltura'] = $altura; //cm
		 $data['nVlLargura'] = $largura; //cm
		 $data['nVlDiametro'] = '0';
		 $data['sCdMaoPropria'] = "n";
		 $data['nVlValorDeclarado'] = $valor;
		 $data['sCdAvisoRecebimento'] = "s";
		 $data['StrRetorno'] = 'xml';
		 
		 $data = http_build_query($data);

		 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

		 $curl = curl_init($url . '?' . $data);
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		 $result = curl_exec($curl);
		 $result = simplexml_load_string($result);
		
		foreach($result -> cServico as $row) 
		{
			if($row -> Erro == 0) 
			{
				$retorno['valor'] = $row -> Valor;
				$retorno['prazo'] = $row -> PrazoEntrega;
				
				return $retorno;
			} 
			else 
			{
				return $row -> MsgErro;
			}
		}
	}
}
?>