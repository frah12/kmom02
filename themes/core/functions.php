<?php
/*
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: functions.php
// Desc: Core functions for my Lydia based framework called Konrad.
*/

// helpers for template file

$ko->data['header'] = '<h1>Header: Konrad</h1>';
//$ko->data['main'] = '<p>Main: Now with a theme engine.</p>';
$ko->data['footer'] =<<<EOD
<p>Footer: &copy; Konrad by Fredrik &aring;hman based on &copy; Lydia by Mikael Roos (mos@dbwebb.se) for course @ BTH.</p>
<p>Tools: 
<a href="http://validator.w3.org/check/referer">html5</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">css3</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css21">css21</a>
<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">unicorn</a>
<a href="http://validator.w3.org/checklink?uri={$ko->request->current_url}">links</a>
<a href="http://qa-dev.w3.org/i18n-checker/index?async=false&amp;docAddr={$ko->request->current_url}">i18n</a>
</p>
EOD;
?>