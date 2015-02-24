
<?php
	echo $params[0];
	$url = DEV.'?control=joueur&action=home';
	header("Refresh:2; ".$url."");
?>
