<?php 
class sqlite extends SQLite3
{

	function __construct()
  	{	
    	$this->open('challenge.db');
  	}

  	public function createChallengeTable($db)
  	{
  		$sql ='
	      	CREATE TABLE COMPANY
	    	(ID INT PRIMARY KEY     NOT NULL,
	     	NAME           TEXT    NOT NULL,
		    AGE            INT     NOT NULL,
		    ADDRESS        CHAR(50),
		    SALARY         REAL)';

   		$return = $db->exec($sql);
   		if(!$return){
      		echo $db->lastErrorMsg();
   		} else {
      		echo "Table created successfully\n";
   		}
   		$db->close();
  	}
}