var x_nome = false, x_celular = false, x_email = false, x_cemail = false, x_senha = false, x_csenha = false, x_cep = false, x_uf = false, x_cidade = false, x_bairro = false, x_rua = false, x_numero = false, x_comp = true;



function validarPessoal()
{
	if(x_nome == false)
		return "O nome deve conter no mínimo 8 caracteres e não pode conter números, acentos ou caracteres especiais.";
	else if (x_celular == false)
		return "Insira apenas números no celular. O DDD também é necessário.";
	else if(x_email == false)
		return "Insira o e-mail para contato.";
	else if(x_cemail == false)
		return "Confirme seu e-mail.";
	else if(x_senha == false)
		return "A senha deve conter no mínimo 4 caracteres.";
	else if(x_csenha == false)
		return "Confirme sua senha.";
	else
		return "Dados pessoais preenchidos corretamente.";
}

function validarEndereco()
{
	if(x_cep == false)
		return "Insira apenas números sem pontos ou traços no CEP";
	else if(x_uf == false)
		return "Insira apenas a sigla de seu estado. Ex: SP, MG, AL";
	else if(x_cidade == false)
		return "Cidade";
	else if(x_bairro == false)
		return "Bairro";
	else if(x_rua == false)
		return "Rua";
	else if(x_numero == false)
		return "Número. Complemento apenas se houver.";
	else if(x_comp == false)
		return "Complemento se houver.";
	else
		return "Endereço preenchido corretamente.";
}


//------------------------- V A L I D A Ç Õ E S ---------------------

function validarNome()
{
	var cadastro = document.forms.cadastro, nome = cadastro.nome.value;
	
	nome = nome.replace(/ /g,'');
	if(/^[a-zA-Z]+$/.test(nome) == false || nome.length < 8 || nome.length > 50) {
		document.getElementById("nome").style.outline = "solid 1px #FF0000";
		x_nome = false;		
	}
	else
	{
		document.getElementById("nome").style.outline = "solid 1px #00FF00";	
		x_nome = true;
	}
}

function validarCelular(){
	var 
	cadastro = document.forms.cadastro,
	telefone = cadastro.celular.value;
	telefone = telefone.replace(/[\.-]/g, "");
	telefone = telefone.replace(/[{()}]/g, "");
	telefone = telefone.replace(/ /g, "");
	if(/^\d+$/.test(telefone) == false || telefone.length != 11 || telefone == '1111111111' || telefone == '2222222222' || telefone == '3333333333'  || telefone == '44444444444'  || telefone == '5555555555' || telefone == '6666666666' || telefone == '7777777777' || telefone == '8888888888'  || telefone == '9999999999' || telefone == '0123456789') {
		document.getElementById("celular").style.outline = "solid 1px #FF0000";	
		x_celular = false;
	}
	else
	{
		document.getElementById("celular").style.outline = "solid 1px #00FF00";	
		x_celular = true;
	}
}

function validarEmail() {
	var 
	cadastro = document.forms.cadastro,
	email = cadastro.email.value,
	dominio = email.substring(email.indexOf("@")+ 1, email.length);
	if(dominio.search(".com") < 0) { //Se o domínio não contem o ".com"
		document.getElementById("email").style.outline = "solid 1px #FF0000";	
		x_email = false;
	}
	if(email.search("@") < 0) { //Se o domínio não contem o ".com"
		document.getElementById("email").style.outline = "solid 1px #FF0000";	
		x_email = false;
	}
	else if(email.length < 9){ //Se o email tiver menos de 9 caracteres
		document.getElementById("email").style.outline = "solid 1px #FF0000";	
		x_email = false;
	}
	else
	{
		document.getElementById("email").style.outline = "solid 1px #00FF00";	
		x_email = true;
	}
}

function validar_confirmar_email()
{
	var 
	cadastro = document.forms.cadastro,
	email = cadastro.confirmar_email.value,
	dominio = email.substring(email.indexOf("@")+ 1, email.length);
	if(dominio.search(".com") < 0) { //Se o domínio não contem o ".com"
		document.getElementById("confirmar_email").style.outline = "solid 1px #FF0000";	
		x_cemail = false;
	}
	if(email.search("@") < 0) { //Se o domínio não contem o ".com"
		document.getElementById("confirmar_email").style.outline = "solid 1px #FF0000";	
		x_cemail = false;
	}
	else if(email.length < 9){ //Se o email tiver menos de 9 caracteres
		document.getElementById("confirmar_email").style.outline = "solid 1px #FF0000";	
		x_cemail = false;
	}
	else if(email != cadastro.email.value)
	{
		document.getElementById("confirmar_email").style.outline = "solid 1px #FF0000";	
		x_cemail = false;
	}
	else
	{
		document.getElementById("confirmar_email").style.outline = "solid 1px #00FF00";	
		x_cemail = true;
	}
}

function validarSenha()
{
	var
	cadastro = document.forms.cadastro,
	senha = cadastro.senha.value;
	if(senha.length > 20 || senha.length < 4) {
		document.getElementById("senha").style.outline = "solid 1px #FF0000";	
		x_senha = false;
	}
	else
	{
		document.getElementById("senha").style.outline = "solid 1px #00FF00";	
		x_senha = true;
	}	
}

function validarConfirmaSenha()
{
	var	cadastro = document.forms.cadastro;
	if(cadastro.senha.value != cadastro.confirmar_senha.value || cadastro.confirmar_senha.value.length < 4)
	{
		document.getElementById("confirmar_senha").style.outline = "solid 1px #FF0000";	
		x_csenha = false;
	}
	else
	{
		document.getElementById("confirmar_senha").style.outline = "solid 1px #00FF00";	
		x_csenha = true;
	}
}

// -------- ENDEREÇO

function validarCEP() { 
	var 
	cadastro = document.forms.cadastro,
	cep = cadastro.cep.value;
	if(/^\d+$/.test(cep) == false || cep.length != 8) {
		document.getElementById('cep').style.outline = "solid 1px #FF0000";	
		x_cep = false;
	}
	else
	{
		document.getElementById('cep').style.outline = "solid 1px #00FF00";
		x_cep = true;
	}
}

function validarUF()
{
	var 
	cadastro = document.forms.cadastro,
	uf = cadastro.estado.value;
	if(/^[a-zA-Z]+$/.test(uf) == false || uf.length != 2) {
		document.getElementById('estado').style.outline = "solid 1px #FF0000";	
		x_uf = false;
	}
	else
	{
		document.getElementById('estado').style.outline = "solid 1px #00FF00";
		x_uf = true;
	}
}

function validarCidade()
{
	var 
	cadastro = document.forms.cadastro,
	cidade = cadastro.cidade.value;
	if(cidade.length < 3) {
		document.getElementById('cidade').style.outline = "solid 1px #FF0000";	
		x_cidade = false;
	}
	else
	{
		document.getElementById('cidade').style.outline = "solid 1px #00FF00";
		x_cidade = true;
	}
}

function validarBairro()
{
	var 
	cadastro = document.forms.cadastro,
	bairro = cadastro.bairro.value;
	if(bairro.length < 3) {
		document.getElementById('bairro').style.outline = "solid 1px #FF0000";	
		x_bairro = false;
	}
	else
	{
		document.getElementById('bairro').style.outline = "solid 1px #00FF00";
		x_bairro = true;
	}
}

function validarRua()
{
	var 
	cadastro = document.forms.cadastro,
	rua = cadastro.rua.value;
	if(rua.length < 3) {
		document.getElementById('rua').style.outline = "solid 1px #FF0000";	
		x_rua = false;
	}
	else
	{
		document.getElementById('rua').style.outline = "solid 1px #00FF00";
		x_rua = true;
	}
}

function validarNumero()
{
	var 
	cadastro = document.forms.cadastro,
	numero = cadastro.numero.value;
	if(/^\d+$/.test(numero) == false || numero.length < 1) {
		document.getElementById('numero').style.outline = "solid 1px #FF0000";	
		x_numero = false;
	}
	else if(numero.length > 10)
	{
		document.getElementById('numero').style.outline = "solid 1px #FF0000";	
		x_numero = false;
	}
	else
	{
		document.getElementById('numero').style.outline = "solid 1px #00FF00";
		x_numero = true;
	}
	
	validarComp();
}

function validarComp()
{
	var 
	cadastro = document.forms.cadastro,
	comp = cadastro.comp.value;

	if(comp.length != 0)
	{
		if(/^\d+$/.test(comp) == false) {
			document.getElementById('comp').style.outline = "solid 1px #FF0000";	
			x_comp = false;
		}
		else if(comp.length > 5)
		{
			document.getElementById('comp').style.outline = "solid 1px #FF0000";	
			x_comp = false;
		}
		else
		{
			document.getElementById('comp').style.outline = "solid 1px #00FF00";
			x_comp = true;
		}
	}
	else
	{
		document.getElementById('comp').style.outline = "solid 1px #00FF00";
		x_comp = true;
	}
}


// MASCARAS
function mascaraCel(telefone){ 
	if(telefone.value.length == 0)
		telefone.value = '(' + telefone.value; 
	if(telefone.value.length == 3)
		telefone.value = telefone.value + ') ';
  
}