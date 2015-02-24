<?php
	echo $params[0];
	$url = DEV.'?control=partieSolo&action=commentaires';
	header("Refresh:2; ".$url."");
?>