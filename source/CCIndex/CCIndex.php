<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: CCIndex.php
// Desc: Standard controller layout
// @package KonradCore???

class CCIndex implements IController{
	
	// Implement interface IController. Controllers must've an index action.
	public function Index(){
		$this->Menu();
	}
	
	private function Menu(){
		
		$ko = CKonrad::Instance();
		$menu = array('index', 'index/index', 'developer', 'developer/index', 'developer/links');
		$html = null;
		foreach($menu as $choice){
			$html .= "<li><a href='" . $ko->request->CreateUrl($choice) . "'>$choice</a></li>";
		}
		
		$ko->data['title'] = "The index controller";
$ko->data['main'] =<<<EOD
<h1>The Index controller</h1>
<p>What you can do now:</p>
<ul>
$html
</ul>
EOD;
	}	
	
	/*
	global $ko;
		$ko->data['title'] = 'The Index Controller';
		$ko->data['main'] = '<h1>The Index Controller</h1>';
	*/
	
	
	
}
?>