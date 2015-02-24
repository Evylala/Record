<?php
	echo $params[0];
	$url = DEV.'?control=partieMulti&action=home';
	header("Refresh:2; ".$url."");
?>
