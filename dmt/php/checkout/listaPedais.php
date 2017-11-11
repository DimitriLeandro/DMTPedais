	
					<div class="col-md-9 cart-items">
                        <h1>MEU CARRINHO</h1>			
						<?php
							$select_pedais = $link -> query("SELECT tb_pedal.cd_pedal as codigo, nm_pedal as nome, vl_preco+(vl_preco*(vl_taxa/100)) as preco, qt_pedal as qtd, (SELECT nm_caminho FROM tb_imagem WHERE tb_imagem.cd_pedal = codigo LIMIT 1) as caminho, qt_estoque as estoque FROM tb_pedal, tb_pedal_carrinho, tb_estoque WHERE tb_pedal_carrinho.cd_pedal = tb_pedal.cd_pedal AND tb_pedal.cd_pedal = tb_estoque.cd_pedal AND cd_carrinho = '".$_SESSION['carrinho']."';");
							
							if($select_pedais -> num_rows == 0)
							{
						?>
								<br/><br/><p align="center">Você não possui nenhum item no carrinho. Clique <a href="products.php">aqui</a> para ver todos os pedais.</p>
						<?php
							}
							else
							{
								$i = 0;
								while($row = $select_pedais -> fetch_assoc())
								{
									$form = "frm_".$i;
						?>
									<form id="<?php echo $form; ?>" action="php/action_pedal_carrinho.php" method="POST" style="display: none">
										<input type="text" name="cd_pedal_remover" value="<?php echo $row['codigo']; ?>"/>
									</form>
									
									<div class="cart-header">
									<hr style="border: 0; height: 1px; background: #ffffff; background-image: linear-gradient(to right, #fff, #ddd, #fff);" />
									<div class="close" style="text-align: right; width: 98%;">
										<span aria-hidden="true" style="cursor: pointer;" onclick="submeter(<?php echo $form; ?>);"><img src="dmtFiles/images/remover_item.png"></span>
									</div>
										<div class="cart-sec simpleCart_shelfItem">
												<div class="cart-item cyc">
													<a href="single.php?p=<?php echo $row['codigo']; ?>">
														<img src="<?php echo "dmtFiles/images/pedals/".$row['caminho']; ?>" class="img-responsive" alt=""/>
													</a>
												</div>
											   <div class="cart-item-info">
													<ul class="qty">
														<li><p><h4><strong><?php echo $row['nome']; ?></strong></h4></p></li>
														<li><p>Preço: <?php echo "R$ ".number_format($row['preco'], 2, ',', ''); ?></p></li>
														<li><p>Quantidade: <?php echo $row['qtd']; ?></p></li>
													</ul>
													<div class="delivery">
														<div class="clearfix"></div>
													</div>	
											   </div>
											   <div class="clearfix"></div>
										</div>
									</div>
						<?php
									$i ++;
								}
							}
						?>	
                    </div>
                    <div class="clearfix"> </div>