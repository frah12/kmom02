<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: CRequest.php
// Desc: Parse an url into controller, method, and parameters, for Konrad

class CRequest{

	// Member variables
	public $cleanUrl;
	public $querystringUrl;
	
	// Construct
	
	// defualt = 0				=> index.php/controller/method/arg1/arg2/...
	// clean = 1				=> controller/method/arg1/arg2/...
	// querystring = 2		=> index.php?q=controller/method/arg1/arg2/...
	
	public function __construct($urlType=0){
		$this->cleanUrl = $urlType = 1 ? true : false;
		$this->querystringUrl = $urlType = 2 ? true : false;
	}
	
	// Methods

	// Init by parsing current url request
	public function Init($baseUrl = null){
		
		$requestUri = $_SERVER['REQUEST_URI'];
		$scriptPart = $scriptName = $_SERVER['SCRIPT_NAME'];
		
		// format of url
		//if(substr_compare($requestUri, $scriptName, 0, strlen($scriptName))){
		if(substr_compare($requestUri, $scriptName, 0)){
			$scriptPart = dirname($scriptName);
		}
		
		$query = trim(substr($requestUri, strlen(rtrim($scriptPart, '/'))), '/');
		
		// for querystring was used. === instead of ==
		if(substr($query, 0, 1) === '?' && isset($_GET['q'])){
			$query = trim($_GET['q']);
		}
		
		$splits = explode('/', $query);
		
		// Set controller, method, and argument
		$controller=!empty($splits[0]) ? $splits[0] : 'index';
		$method=!empty($splits[1]) ? $splits[1] : 'index';
		$arguments=$splits;
		// unset because they've been used and contain controller and method parts
		unset($arguments[0], $arguments[1]);
		
		// Prepare to create current_url and base_url
		$currentUrl = $this->GetCurrentUrl();
		$parts = parse_url($currentUrl);
		$baseUrl = !empty($baseUrl) ? $baseUrl : "{$parts['scheme']}://{$parts['host']}" . (isset($parts['port']) ? ":{$parts['port']}" : '') . rtrim(dirname($scriptName), '/');
				
		// Store it
		$this->base_url = rtrim($baseUrl, '/') . '/';
		$this->current_url = $currentUrl;
		$this->request_uri = $requestUri;
		$this->script_name = $scriptName;
		//$this->request = $request;
		$this->splits = $splits;
		$this->controller = $controller;
		$this->method = $method;
		$this->arguments = $arguments;
		$this->query = $query;
		
		// compare REQUEST URI and SCRIPT NAME, if match then leave the rest as current request
	/*
		$i=0;
		$len=min(strlen($requestUri), strlen($scriptName));
		while($i<$len && $requestUri[$i] == $scriptName[$i]){
			$i++;
		}
		$request = trim(substr($requestUri, $i), '/');
		
		// Remove ?-part from the query when analysing controller/method/arg1/arg2/...
		$queryPos = strpos($request, '?');
		if(empty($request) && isset($_GET['q'])){
			$request = trim($_GET['q']);
		}
		$splits = explode('/', $request);
	*/	
	/*
		$query=substr($_SERVER['REQUEST_URI'], strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']), '/')));
		$splits=explode('/', trim($query, '/'));
	*/	
		// Old one $this->request_uri=$_SERVER['REQUEST_URI'];
	}
	
	// Gets the url to current page. This is a common method of doing it, so remember.
	public function GetCurrentUrl(){
		$url = "http";
		$url .= (@$_SERVER["HTTPS"] == "on") ? 's' : ''; // checks if https is on if so adds an s to http
		$url .= "://";
		$serverPort = ($_SERVER['SERVER_PORT'] == '80') ? '' : (($_SERVER['SERVER_PORT'] == 443 && @$_SERVER['HTTPS'] == 'on') ? '' : ":{$_SERVER['SERVER_PORT']}");
		$url .= $_SERVER['SERVER_NAME'] . $serverPort . htmlspecialchars($_SERVER['REQUEST_URI']); // converts special character to html specific
		
		return $url;
		
	}
	
	// Create the prefered url type
	public function CreateUrl($url=null){
		$prepend = $this->base_url;
		if($this->cleanUrl){
			;
		} elseif($this->querystringUrl){
			$prepend .= "index.php?q=";
		} else {
			$prepend .= "index.php/";
		}
		
		return $prepend . rtrim($url, '/');
	}
		
}
?>