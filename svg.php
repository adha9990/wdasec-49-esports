<?php header("Content-Type:image/svg+xml"); ?>
<svg xmlns="http://www.w3.org/2000/svg" width="<?=strlen($_GET["n"])*20?>" height="20">
	<text x="5" y="15">
		<?= $_GET["n"] ?>
	</text>
</svg>