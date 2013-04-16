<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: bootstrap.php
// Desc: My Lydia based framwork called Konrad.

// @KonradCore????

// Enable auto-load of class declarations==automatisk laddning av klassfiler
function autoload($aClassName){
	$classFile="/source/{$aClassName}/{$aClassName}.php";
	$file1=KONRAD_INSTALL_PATH . $classFile;
	$file2=KONRAD_SITE_PATH . $classFile;
	if(is_file($file1)){
		require_once($file1);
	} elseif(is_file($file2)){
		require_once($file2);
	}
}
spl_autoload_register('autoload');
?>