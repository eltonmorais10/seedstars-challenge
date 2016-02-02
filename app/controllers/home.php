<?php

class Home extends Controller
{
	public function index($name = '')
	{
		// specify the view
		$this->view('home/index', ['name' => $name]);
	}

	public function listAll()
	{
		// create new sqlite object that will open or create a new db called challenge
		$db = $this->model('sqlite');

		$sql = 'SELECT * FROM clients;';
		$return = $db->exec($sql);

		print_r($return);

		// specify the view
		$this->view('home/list');
	}

	public function add()
	{
		// create new sqlite object that will open or create a new db called challenge
		$db = $this->model('sqlite');
		
		// if table clients doesn't exist than create it 
		$sql = 'CREATE TABLE IF NOT EXISTS clients
  				(EMAIL VARCHAR PRIMARY KEY     NOT NULL,
	     		NAME           VARCHAR    NOT NULL);';
		$return = $db->exec($sql);
		$db->close();

		// specify the view
		$this->view('home/add');
	}

	public function addRecord($email = '', $username = '')
	{
		echo $email;
		echo $username;
	}
}