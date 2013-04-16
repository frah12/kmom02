<?php
/*
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: default.tpl.php
// Desc: Default template file for my Lydia based framework called Konrad.
*/
?>
<!DOCTYPE html>
<html lang='sv'>
<head>
	<meta charset='UTF-8'>
	
	<title><?php echo $title; ?></title>
	<link rel='stylesheet' href="<?php echo $stylesheet?>">
</head>
<body>
	<div id='header'>
		<?php echo $header; ?>
	</div>
	<div id='main' role='main'>
		<?php echo $main; ?>
		<?php echo get_debug(); ?>
	</div>
	<div>
		<?php echo $footer; ?>
	</div>
</body>
</html>