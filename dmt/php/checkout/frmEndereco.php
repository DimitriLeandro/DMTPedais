<div class="col-md-9 cart-items">
<h1>Endereço</h1>
		<p>Escolha o endereço onde você deseja receber seus pedais.</p>
		<p>Após definir o endereço, o frete será calculado e o preço será atualizado.</p>
		<span style="cursor: pointer; color: #0000ff;" onclick="trocar(enderecoEntrega);">Voltar</span>
		<div class="reg">
		<br/>
		<form name="cadastro" id="frm_cadastro" method="post">
		<table>
			<tr>
				<th style="width: 80%;">
							<ul>
								<li>
									<input type="text" name="txt_cep" id="cep" maxlength="8" placeholder="CEP"  style="width: 50%;" onblur="validarCEP(); check_submit();"/>
									<input type="text" name="txt_uf" id="estado" placeholder="Estado" style="width: 25%;" maxlength="2" onblur="validarUF(); check_submit();"/>
								</li>
							</ul>
							<ul>
								<li>
									<input type="text" name="txt_cidade" id="cidade" placeholder="Cidade" maxlength="30" style="width: 37.4%;" onblur="validarCidade(); check_submit();"/>
									<input type="text" name="txt_bairro" id="bairro" placeholder="Bairro" maxlength="30" style="width: 37.5%;" onblur="validarBairro(); check_submit();"/>
								</li>
							</ul>
							<ul>
								<li>
									<input type="text" name="txt_rua" id="rua" placeholder="Rua" maxlength="60" style="width: 37.4%;" onblur="validarRua(); check_submit();"/>
									<input type="text" name="txt_numero" id="numero" placeholder="Número" maxlength="10" style="width: 18.5%;" onblur="validarNumero(); check_submit();"/>
									<input type="text" name="txt_comp" id="comp" placeholder="Complemento" maxlength="5" style="width: 18.5%;" onblur="validarComp(); check_submit();"/>
								</li>
							</ul>
							<p id="p1"></p>	
				</th>
			</tr>
			<tr>
				<th>
					<br/>
					<table>
						<tr>
							<th>
								<input class="btn_endereco" type="submit" value="Usar Somente Essa Vez" name="btn_somente" id="btn_somente" style="background: #33cc33; cursor: pointer;" onclick='parAdc = "somente=true";' disabled />
							</th>
							<th>
								&nbsp;&nbsp;&nbsp;&nbsp;
							</th>
							<th>
								<input class="btn_endereco" type="submit" value="Salvar o Endereço" name="btn_salvar" id="btn_salvar" style="background: #0099cc; cursor: pointer;" onclick='parAdc = "salvar=true";' disabled />
							</th>
						</tr>
					</table>
				</th>
			</tr>
		</table>
		</form>
		</div>
</div>
<div class="clearfix"></div>