<?php
/*
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: functions.php
// Desc: Global theme functions for my Lydia based framework called Konrad.
*/

// helpers for theming. Availability: all themes.

// create Url by prepending the base url.
function base_url($url){

	return CKonrad::Instance()->base_url . trim($url, '/');
	
}

// return current url
function current_url(){

	return CKonrad::Instance()->request->current_url;
	
}

// Print debugging info.
function get_debug(){
	$ko = CKonrad::Instance();
	$html = "<h2>Debug information</h2><hr>";
	$html .= "<p>Config array: </p><pre>" . htmlentities(print_r($ko->config, true)) . "</pre>";
	$html .= "<p>Data array: </p><pre>" . htmlentities(print_r($ko->data, true)) . "</pre>";
	$html .= "<p>Request array: </p><pre>" . htmlentities(print_r($ko->request, true)) . "</pre>";
	
	return $html;
}

?>