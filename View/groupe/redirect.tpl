<?php
	echo $params[0];
	$url = DEV."?control=groupe&action=home";
	header("Refresh:2; ".$url."");
?>
