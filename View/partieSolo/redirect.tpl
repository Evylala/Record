<?php
	echo $params[0];
	$url = DEV.'?control=partieSolo&action=home';
	header("Refresh:2; ".$url."");
?>