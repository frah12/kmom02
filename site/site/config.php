<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: config.php
// Desc: Users config file for Konrad framwork site

// Display errors. If not on, turn it on. Default is off locally.
if (!ini_get('display_errors')) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}
else {
		error_reporting(-1);
}

// Define SESSION name
$ko->config['session_name'] = preg_replace("/[:\.\/-_]/", '', $_SERVER['SERVER_NAME']); // don't forget to escape assumed delimeters / or use alternate #

// Define server timezone
$ko->config['timezone'] = 'Europe/Stockholm';

// Define internal character encoding
$ko->config['language'] = 'en';

// define and enable/disable the controllers and their respective classname.
/*
	Array-key is matched against the URL, like so: the url 'developer/dump' would instantiate the controller with the key 'developer'…CCDeveloper and call method 'dump' in that class. This processessing is done in $ko->FrontControllerRoute();--which is called from within index.php
*/
// CCX==Class Controller X
$ko->config['controllers'] = array('index'=>array('enabled'=>true, 'class'=>'CCIndex'), 'developer' => array('enabled'=>true, 'class'=>'CCDeveloper'));

// Settings for theme
$ko->config['theme'] = array(
	// the name of the theme in the theme directory!
	'name' => 'core');

// Set base url incase one wants to use the default calculated.
$ko->config['base_url'] = null;

// What Urls to be used?
// defualt = 0				=> index.php/controller/method/arg1/arg2/...
// clean = 1				=> controller/method/arg1/arg2/...
// querystring = 2		=> index.php?q=controller/method/arg1/arg2/...
$ko->config['url_type'] = 1;
?>