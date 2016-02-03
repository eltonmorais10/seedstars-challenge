<?php

class App 
{
	// default controller, method and params
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	public function __construct()
	{
		// get the params (Controller, Method and Params)
		$url = $this->parseUrl();

		// check if it was sent a controller name and require it
		if (file_exists('../app/controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once '../app/controllers/' . $this->controller . '.php';
		
		// build the controller object to check if the possible sent method exists
		$this->controller = new $this->controller;
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		// if was passed params than put them into an array
		$this->params = $url ? array_values($url) : [];
		// call the controller, method and send the params
		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	/*
	*	Get the url and divide it into an array
	*/
	public function parseUrl()
	{
		if (isset($_GET['url'])) {
			return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}