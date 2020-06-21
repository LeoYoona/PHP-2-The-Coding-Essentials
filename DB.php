<?php 

class DB
{
    private $_mysqliConnectionObject,
            $_query,
            $_results = array(),
            $_count=0; 

    public static $instance;

    private $servername; 
	private $username; 
	private $password; 
	private $dbase;

    public static function getInstance()  //to get only one instance of the DB connection, singleton pattern applied
    {
        if(!isset(self::$instance))
		{
			self::$instance=new DB;
		}
		return self::$instance;
    }

    private function __construct()
	{
		$this->servername = "localhost";
		$this->username = " "; 
		$this->password = " ";
        $this->dbase = " "; 
        
        $this->_mysqliConnectionObject = new mysqli($this->servername, $this->username, $this->password,$this->dbase);
        
        if($this->_mysqliConnectionObject->connect_error)
        {
            die($this->_mysqliConnectionObject->connect_error);
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->_mysqliConnectionObject->set_charset("utf8mb4");
    } 

    function __destruct()
    {
      if ($this->_mysqliConnectionObject) $this->_mysqliConnectionObject->close();
      //autocommit(TRUE);
    }
    
    private function __clone() {}
    private function __wakeup() {}

    public function ReturnConnectionObject()   //returns connection from Database to the model
    {
        return $this->_mysqliConnectionObject;
    }

    public function querySELECT($sql) //to select reords from the Database
    {
        try 
        {
            if(isset($this->_results))
            {
                unset($this->_results); // $_results is gone
                $this->_results = array(); // $_results is here again
            }
    
            if($this->_query = mysqli_query($this->_mysqliConnectionObject ,$sql)) 
            {
                while($row = $this->_query->fetch_object())
                {
                  $this->_results[]=$row;  
                }
                $this->_count = $this->_query->num_rows;
            }
            return $this;
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function results()
    {
        return $this->_results;
    }

    public function count()
    {
        return $this->_count;
    }
}
?>
