<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: CCDeveloper.php
// Desc: Controller for developmen and testing.

class CCDeveloper implements IController {

// implement interface IController
	public function Index(){
		$this->Menu();
	}

// Create links in the supported way

public function Links(){
	$this->Menu();
	
	$ko= CKonrad::Instance();
	
	$url="developer/links";
	
	$current = $ko->request->CreateUrl($url);
	
	$ko->request->cleanUrl = false;
	$ko->request->querystringUrl = false;
	
	$default = $ko->request->CreateUrl($url);
	
	$ko->request->cleanUrl = true;
	$clean = $ko->request->CreateUrl($url);
	
	$ko->request->cleanUrl = false;
	$ko->request->querystringUrl = true;
	$querystring = $ko->request->CreateUrl($url);
	
$ko->data['main'] .=<<<EOD
<h2>CRequest::CreateUrl()</h2>
<p>Here is a list of urls using the above method with different settings. Every link leadning to the same page.</p>
<ul>
<li><a href='$current'>Current setting</a></li>
<li><a href='$default'>Default url</a></li>
<li><a href='$clean'>Defined as Clean url</a></li>
<li><a href='$querystring'>Querystring Url</a></li>
</ul>
<p>Enables various and flexible url-strategies.</p>
EOD;
}

// Create method that shows the menu, the same for all methods.

public function Menu(){
	$ko = CKonrad::Instance();
	$menu = array('developer','developer/index','developer/links');
	
	$html = null;
	
	foreach($menu as $choice){
		$html .="<li><a href='" . $ko->request->CreateUrl($choice) . "'>" . $choice . "</a></li>";
	}
	
	$ko->data['title'] = "The developer controller";
$ko->data['main'] =<<<EOD
<h1>The developer controller</h1>
<p>This is what you can do now:</p>
<ul>
$html
</ul>
EOD;
}

}
?>