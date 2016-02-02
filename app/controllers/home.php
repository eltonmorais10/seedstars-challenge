<?php

class Home extends Controller
{
	public function index($name = '')
	{
		$this->view('home/index', ['name' => $name]);	
	}

	public function listAll()
	{
		$this->view('home/list');
	}

	public function add()
	{
		$db = $this->model('sqlite');

	   	if(!$db){
	    	echo $db->lastErrorMsg();
	   	} else {
	      	echo "Opened database successfully\n";
	   	}

		$this->view('home/add');
	}
}