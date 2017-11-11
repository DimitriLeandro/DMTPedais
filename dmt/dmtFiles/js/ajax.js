//CRIA A VARIÁVEL RETORNO
var retorno;
function CarregaArquivo(url, parametros)
{
    retorno = null;
	
    if (window.XMLHttpRequest) {
        retorno = new XMLHttpRequest();
        retorno.onreadystatechange = processReqChange;
        retorno.open("GET", url+"?"+parametros, true);
        retorno.send(null);
    } else if (window.ActiveXObject) {
        retorno = new ActiveXObject("Microsoft.XMLHTTP");
        if (retorno) {
            retorno.onreadystatechange = processReqChange;
            retorno.open("GET", url+"?"+parametros, true);
            retorno.send();
        }
    }
}

//FUNÇÃO QUE TRATA O RETORNO DO AJAX
function processReqChange()
{
    if (retorno.readyState == 4)
	{
		if(retorno.status == 200) 
			{
				document.getElementById("cepCorreios").innerHTML = retorno.responseText;
			} 
		else 
		{
			alert("Houve um problema ao obter os dados:\n" + retorno.statusText);
		}
   }
}