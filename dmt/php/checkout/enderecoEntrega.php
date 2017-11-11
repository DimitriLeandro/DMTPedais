<div class="col-md-9 cart-items">
    <h1>Endereço</h1>
	<?php
		$select_endereco = $link -> query("SELECT cd_cep, sg_uf, nm_cidade, nm_bairro, nm_rua, nm_numero, nm_comp FROM tb_endereco WHERE cd_usuario = '".$_SESSION['usuario']."';");
		if($select_endereco -> num_rows == 0)
		{
			echo "<p>Não conseguimos encontrar nenhum endereço em seu cadastro.</p><p>Por favor, atualize seu cadastro na sessão perfil no topo do site.</p>";
		}
		else
		{
			$row_endereco = $select_endereco -> fetch_row();
	?>
			<p>Escolha o endereço onde você deseja receber seus pedais.</p>
			<p>Após definir o endereço, o frete será calculado e o preço será atualizado.</p>
			<span style="cursor: pointer; color: #0000ff;" onclick="trocar(listaPedais);">Voltar</span>
			
			<br/><br/>
			<table id="table_endereco" style="width: 70%;">
				<tr>
					<th style="width: 60%;">
						<table style="width: 80%; font-size: 18px;">
							<tr>
								<th style="width: 40%;">CEP: </th><th><?php echo $row_endereco[0]; ?></th>
							</tr>
							<tr>
								<th style="width: 40%;">ESTADO: </th><th><?php echo $row_endereco[1]; ?></th>
							</tr>
							<tr>
								<th style="width: 40%;">CIDADE: </th><th><?php echo $row_endereco[2]; ?></th>
							</tr>
							<tr>
								<th style="width: 40%;">BAIRRO: </th><th><?php echo $row_endereco[3]; ?></th>
							</tr>
							<tr>
								<th style="width: 40%;">RUA: </th><th><?php echo $row_endereco[4]; ?></th>
							</tr>
							<tr>
								<th style="width: 40%;">NÚMERO: </th><th><?php echo $row_endereco[5]." / ".$row_endereco[6]; ?></th>
							</tr>
						</table>
					</th>
					<th>
						<a id="btn_escolher_esse" class="order" style="background: #33cc33; cursor: pointer;" onclick="definirEndereco('esse=true');">Escolher Esse</a>
						<a id="btn_escolher_outro" class="order" style="background: #0099cc; cursor: pointer;" onclick="trocar(frmEndereco);">Escolher Outro</a>
					</th>
				</tr>
			</table>
			<script>
				var ycep = "<?php echo $row_endereco[0]; ?>";
				var yuf = "<?php echo $row_endereco[1]; ?>";
				var ycidade = "<?php echo $row_endereco[2]; ?>";
				var ybairro = "<?php echo $row_endereco[3]; ?>";
				var yrua = "<?php echo $row_endereco[4]; ?>";
				var ynumero = "<?php echo $row_endereco[5]; ?>";
				var ycomp = "<?php echo $row_endereco[6]; ?>";
				
			</script>
	<?php
		}
	?>
</div>
<div class="clearfix"></div>