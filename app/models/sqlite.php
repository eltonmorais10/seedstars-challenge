<?php
// sqlite model 
class sqlite extends SQLite3
{

  // the constructer open or builds a new SQLiteDB
	function __construct()
  	{	
    	$this->open('challenge.db');
  	}
}