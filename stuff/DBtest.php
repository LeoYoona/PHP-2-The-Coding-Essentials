<?php 

class DBtest
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
			self::$instance=new DBtest;
		}
		return self::$instance;
    }

    private function __construct()
	{
		$this->servername = "localhost";
		$this->username = "s636130_user"; 
		$this->password = "BT21Yoona";
        $this->dbase = "s636130_db"; 
        
        $this->_mysqliConnectionObject = new mysqli($this->servername, $this->username, $this->password,$this->dbase);
        
        // if($this->_mysqliConnectionObject->connect_error)
        // {
        //     die($this->_mysqliConnectionObject->connect_error);
        // }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->_mysqliConnectionObject->set_charset("utf8mb4");
    } 

    private function __destruct()
    {
      if ($this->_mysqliConnectionObject) $this->_mysqliConnectionObject->close();
      //autocommit(TRUE);
    }
    
    private function __clone() {}
    private function __wakeup() {}

    public function ReturnConnectionString()   //returns connection from Database to the model
    {
        return $this->_mysqliConnectionObject;
    }

    public function insertNewUser($name, $email, $password)  //signup
    { 
            $conn =  $this->_mysqliConnectionObject;
    
            $sql="INSERT INTO Users (id,name,email,password,userRole,registrationDate ) VALUES (?,?,?,?,?,?) ;" ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $id,$name,$email, $hashedPass,$userRole, $registrationDate );

            // set parameters and execute
             $id=131;
            // $Name = "Min Yoongi";
            // $email ="MinYoongiGenius@boomboom.kr";
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $userRole = "General";
            $registrationDate = date("Y-m-d");
            $stmt->execute();

           $Msg = "User Registered successfully";
           return $Msg;
        
    }

    public function insertInTemptable($userEmail, $selector, $token, $expires) //deletes record of the email address from the temp password reset table in the DB if the email alreasdy exists
    {
        $conn =  $this->_mysqliConnectionObject;
        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?) ;" ;
        $stmt = $conn->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $userEmail, $selector, $hashedToken, $expires);
        $stmt->execute();     
        $Msg = "User added successfully";
        return $Msg;

    }

    public function deleteEmailAdd($userEmail) //deletes record of the email address from the temp password reset table in the DB if the email alreasdy exists
    {
        $conn =  $this->_mysqliConnectionObject;        
        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
	    $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $Msg = "User deleted from pwdReset successfully";
        return $Msg;
    }

    public function TEST()
    {
        try 
        {
        $selector = bin2hex(openssl_random_pseudo_bytes(8));	//to authenticate the correct user
		$token = openssl_random_pseudo_bytes(32);//to look in DB for token for respective user, //2 tokens to prevent timing attacks
		
        $url = "www.636130.infhaarlem.nl/create-new-password.php?selector=".$selector."&&validator=".bin2hex($token) ;
        
        $message = '<p>We recieved your password reset request. The link to reset your password is given below.
        Kindly copy it and paste it in your web browser to proceed further. 
        If you did not make this request, you can ignore this email</p>';
        $message .='<p>Here is your password link: </br>'; 	
        $message .='<a href="' .$url.'">' .$url.'</a></p>'; 
        echo 'Current PHP version: ' . phpversion();
        return $message;
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function selecT() //to check if the reset link with the corresponding selector is already expired or notthe DB
    {
       try 
        {
            $conn =  $this->_mysqliConnectionObject;   
            $query = mysqli_query($conn,"select * from Users" );
            // while ($row = mysqli_fetch_assoc($query)) //use while loop to print multiple records, but if there is just one record use the if else below
            // {
            // echo "<br>".$row['id']."<br>".$row['name'];            
            // }       
            
            if (!$row = mysqli_fetch_assoc($query)) {
                //echo "An error occoured." ;
                return false;
                
            }
            else
            {
                echo "<br>".$row['id']."<br>".$row['name'];  
            }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function initialize($a, $b) 
    {
        $a=2;
        $b=4;        
    }
    

}

$DBobject = DBtest::getInstance();
$a=NULL;
$b=NULL;
$DBobject->initialize($a, $b);
echo $a."<br>".$b;
//$DBobject->selecT();
echo '<br>Current PHP version: ' . phpversion();

//echo $DBobject->selectSelectorandExpiry("0d213ee141474863");
//echo $DBobject->deleteID(131);
//echo $DBobject->TEST();
//echo $DBobject->insertInTemptable("1","2","3","4");
//echo $DBobject->insertNewUser("name", "email", "password");
?>
