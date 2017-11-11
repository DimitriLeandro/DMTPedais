<div class="footer-grid">
            <div class="container">
                <div class="col-md-2 re-ft-grd">
                    <h3>Guitar Pedals</h3>
                    <ul class="categories">
						<?php
							$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'g' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
							while($row = $select_categoria -> fetch_assoc())
							{
								$get = "g".$row['nm_categoria'];
								$get = preg_replace('/\s+/', '', $get);
								$redirect = "products.php?ic=".$get;
						?>
								<li><a href="<?php echo $redirect; ?>"><?php echo $row['nm_categoria']; ?></a></li>
						<?php
							}
						?>
                    </ul>
                </div>
                <div class="col-md-2 re-ft-grd">
                    <h3>Bass Pedals</h3>
                    <ul class="categories">
                       <?php
							$select_categoria = $link -> query("SELECT DISTINCT nm_categoria FROM tb_pedal WHERE ic_guitar_bass = 'b' AND ic_ativo_inativo = true ORDER BY nm_categoria;");
							while($row = $select_categoria -> fetch_assoc())
							{
								$get = "b".$row['nm_categoria'];
								$get = preg_replace('/\s+/', '', $get);
								$redirect = "products.php?ic=".$get;
						?>
								<li><a href="<?php echo $redirect; ?>"><?php echo $row['nm_categoria']; ?></a></li>
						<?php
							}
						?>
                    </ul>
                </div>
                <div class="col-md-6 re-ft-grd">
                    <h3>Social</h3>
                    <ul class="social">
                        <li><a href="https://www.facebook.com/fabio.leandrodasilva.37" class="fb">facebook</a></li>
                        <li><a href="https://twitter.com/dmtpedais" class="twt">twitter</a></li>
                        <li><a href="https://instagram.com/dmtpedais/" class="gpls">instragram</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="col-md-2 re-ft-grd">
                    <div class="bt-logo">
                            <a href="index.php" class="ft-log"><img src="dmtFiles/images/logo.png" style="width: 100%;"></a>
                    </div>
                </div>
        <div class="clearfix"></div>
            </div>
            <div class="copy-rt">
                <div class="container">
            <p>&copy; <?php echo date("Y"); ?> DMT Custom Shop. Design by <a href="http://www.w3layouts.com">w3layouts</a>. Desenvolvido por Dimitri Leandro </p>
                </div>
            </div>
        </div>
<?php
	if(isset($link))
	{
		mysqli_close($link);
	}
?>