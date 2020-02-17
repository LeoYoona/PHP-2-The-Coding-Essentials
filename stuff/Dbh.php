<?php 

class Dbh 
{
	private $servername; 
	private $username; 
	private $password; 
	private $dbase; 
	protected function connect() { 
		$this->servername = "localhost";
		$this->username = "s636130_user"; 
		$this->password = "BT21Yoona";
		$this->dbase = "s636130_db";

		$conn = new mysqli($this->servername, $this->username, $this->password,$this->dbase);
		return $conn;
	}
}
?>