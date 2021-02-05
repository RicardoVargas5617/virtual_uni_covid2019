<?php
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	#echo 'hola';
	header('Location: '.$uri.'/zetadmision/zet/index.php');
	exit;
?>