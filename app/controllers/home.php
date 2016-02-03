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
		$dataArray = [];
		// create new sqlite object that will open or create a new db called challenge
		$db = $this->model('sqlite');

		$sql = 'SELECT EMAIL, NAME FROM clients;';
		$return = $db->query($sql);
		while ($row = $return->fetchArray()) {
		    $dataArray[] = [$row["EMAIL"], $row["NAME"]];
		}
		$db->close();

		// specify the view
		$this->view('home/list', ['clients' => $dataArray]);
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
		// create new sqlite object that will open or create a new db called challenge
		$db = $this->model('sqlite');

		// escape values to prevent SQL injection
		$email = $db->escapeString($email);
		$username = $db->escapeString($username);
		
		// check if email already exists
		$sql = 'SELECT count(*) as total FROM clients WHERE EMAIL = "' . $email . '";';
		$result = $db->querySingle($sql);

		// if email exists than return error
		if ($result != 0) {
			// build error array
			$arrayToReturn = array('status' => 'error', 'message' => 'Email already exists.');
		} else {
			// if email doesn't exists than insert it
			$sql = 'INSERT INTO clients (EMAIL, NAME) VALUES ("' . $email . '","' . $username . '");';
			$db->exec($sql);
			
			// build success array
			$arrayToReturn = array('status' => 'success');
		}
		$db->close();
		echo json_encode($arrayToReturn);
	}
}