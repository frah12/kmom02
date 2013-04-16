<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: CKonrad.php
// Desc: Main Class for my lydia based framework

// @KonradCore!!!???
// Uses singleton pattern==Ser till att endast ett objekt instansieras

class CKonrad implements ISingleton{
	//public $data = array();
	//public $request;
	
	private static $instance=null;
	
		// Construct
	
	protected function __construct(){
		// use site specific config.php and create areference to $ko to be used by config.php
		$ko=&$this; // Makes $ko usable directly in config.php
		require(KONRAD_SITE_PATH . '/config.php');
	}
	
	// Destruct
	
	
	// Static function for singletonpattern
	
	public static function Instance(){
		if(self::$instance==null){
			self::$instance = new CKonrad();
		}
		return self::$instance;
	}
	

	
	// Methods
	
	public function FrontControllerRoute(){
		// 1 mush current url into controller, method, and parameters
		$this->request = new CRequest($this->config['url_type']);
		$this->request->Init($this->config['base_url']);
		
		$controller=$this->request->controller;
		$method=$this->request->method;
		$arguments=$this->request->arguments;
		
			// Controller enabled in config?
			$controllerExists=isset($this->config['controllers'][$controller]);
			$controllerEnabled=false;
			$className=false;
			$classExists=false;
			
			if($controllerExists){
				$controllerEnabled=($this->config['controllers'][$controller]['enabled'] == true);
				$className=$this->config['controllers'][$controller]['class'];
				$classExists = class_exists($className);
			}
		
		// 2 is there such methods in the controller class
		if($controllerExists && $controllerEnabled && $classExists){
			$rc = new ReflectionClass($className);
			
			if($rc->implementsInterface('IController')){
				if($rc->hasMethod($method)){
					$controllerObj = $rc->newInstance();
					$methodObj = $rc->getMethod($method);
					if($methodObj->isPublic()){
						$methodObj->invokeArgs($controllerObj, $arguments);
					} else {
						die('404. ' . get_class() . ' error: Controller method not public.');
					}
				} else {
					die('404. ' . get_class() . 'error, controller does not contain method.');
				}
			} else {
				die('404. ' . get_class() . 'error, controller does not implement IController.');
			}
		} else {
				die('404. Page was not found.');
		}
		
		
	
	//	$this->data['debug'] = "REQUEST_URI : {$_SERVER['REQUEST_URI']}\n";
	//	$this->data['debug'] .= "SCRIPTE_NAME : {$_SERVER['SCRIPT_NAME']}\n";
	}
	
		// renders using selected themes
	Public function ThemeEngineRender(){
		// Get path and setting for theme.
		$themeName=$this->config['theme']['name'];
		$themePath=KONRAD_INSTALL_PATH . "/themes/{$themeName}";
		
		//$themeUrl="themes/{$themeName}";
		$themeUrl = $this->request->base_url . "themes/{$themeName}";
		
		// Add stylesheet path to $ko->data array.
		$this->data['stylesheet'] = "{$themeUrl}/style.css";
		
		// Include the global functions.php and the functions.php that are part of the theme
		$ko = &$this;
		include(KONRAD_INSTALL_PATH . "/themes/functions.php");
		$functionsPath="{$themePath}/functions.php";
		if(is_file($functionsPath)){
			include($functionsPath);
		}
		
		// Extract $ko->data to each variable and hand over to template file.
		extract($this->data);
		//Include global functions first
		
		// Then theme's own functions
		include("{$themePath}/default.tpl.php");
	
	/*
		echo "<h1>This is CKonrad::ThemeEngineRender</h1>";
		echo "<p>Welcome, but nothing to render just yet.</p>";
		echo "<h3>Config array: </h3><pre>" . htmlentities(print_r($this->config, true)) . "</pre>";
		echo "<h3>Data array: </h3><pre>" . htmlentities(print_r($this->data, true)) . "</pre>";
		echo "<h3>Request array: </h3><pre>" . htmlentities(print_r($this->request, true)) . "</pre>";
	*/
	
	}
	
}
?>