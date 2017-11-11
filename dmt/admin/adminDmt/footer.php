		<div class="footer-grid">
            <div class="container">
			<center>
                <img src="../../dmtFiles/images/logo.png" style="width: 10%;">
			</center>
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