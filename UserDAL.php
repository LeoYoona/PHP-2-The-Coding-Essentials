<?php
require_once "DB.php";

class UserDAL
{
    //echo '<pre>', print_r(DB::getInstance()->query("SELECT * FROM Users")->results()), '</pre>';

    protected $DBobject = NULL; 

    public function __construct()	
    {
        $this->DBobject = DB::getInstance();
    }

    protected function executeSelectQuery($sql)
    {
        $users= $this->DBobject->querySELECT($sql);
        return $users;
    }

    public function GetConnObject()
    {
        $conn=$this->DBobject->ReturnConnectionObject(); //gets connection from Database
        return $conn;
    }     

 //----------------------------------------------------------functions for general users----------------------------------------------------------

    public function checkUserExistence($email, $password) //used to check user existence and cross-checks passwords while password reset
    { 
        //$users = $this->executeSelectQuery("SELECT * FROM Users WHERE email = '".$email."' && password = '".$password."' ;");
        
        if($this->verifyUserPassword($email,$password)==1 && $this->verifyUserEmail($email)==1)
        {            
            return true;
        }
        else
        {
            return false;
        }
    }
        public function verifyUserPassword($email,$password)
        {
            try 
            {
                $users = $this->executeSelectQuery("SELECT password FROM `Users` WHERE email = '".$email."' ;");
                $result = $users->results();
                    if ($users->count() > 0) 
                    {
                        $DBencryptedPass;
                        foreach($result as $user)   
                        {
                            $DBencryptedPass= $user->password;
                        }
                        //echo $DBencryptedPass;
                        return $verifypass = password_verify($password,$DBencryptedPass);
                    }
            } 
            catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }

        public function verifyUserEmail($email)
        {
            try 
           {
                $users = $this->executeSelectQuery("SELECT * FROM Users WHERE email = '".$email."' ;");
                
                if($users->count() > 0)
                {            
                    return true;
                }
                else
                {
                    return false;
                }
            } 
            catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }            
        }
        
    public function insertNewUser($name, $email, $password)  //signup
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();

            $stmt = $conn->prepare("INSERT INTO Users (name,email,password,userRole,registrationDate ) VALUES (?,?,?,?,?) ;");
            $stmt->bind_param("sssss",$name,$email, $hashedPass,$userRole, $registrationDate );

            // set parameters and execute
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $userRole = "General";
            $registrationDate = date("Y-m-d");
            $stmt->execute();
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getLoggedUserInfo($Email)   //get user information by Email
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $email = mysqli_real_escape_string($conn, $Email);

            $sql = "SELECT * FROM Users WHERE email = '".$email."'; " ;          
            $query = mysqli_query($conn,$sql);
            
            if ($row = mysqli_fetch_assoc($query)) 
            {
                return $row;
            }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getLoggedUserInfoById($id)  //get user information by id
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "SELECT * FROM Users WHERE id = ".$id."; " ;          
            $query = mysqli_query($conn,$sql);
            
            if ($row = mysqli_fetch_assoc($query)) 
            {
                return $row;
            }
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function editUserName($id, $name) 
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "UPDATE Users SET name=? WHERE id=?" ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $name, $id);
            $stmt->execute();        
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function editUserEmailAddress($id, $newEmail) 
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "UPDATE Users SET email=? WHERE id=?" ;
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newEmail, $id);
            $stmt->execute();  
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
    public function editUserPassword($id, $password) 
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql = "UPDATE Users SET password=? WHERE id=?" ;
            $stmt = $conn->prepare($sql);
            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("si", $newPwdHash, $id);
            $stmt->execute();  
        } 
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function searchUserByEmail($email)   //search user information by Email
    { 
        try 
        {  
            $conn=$this->DBobject->ReturnConnectionObject();
            $email = mysqli_escape_string($conn, $email);
            $users = $this->executeSelectQuery("SELECT * FROM Users WHERE email LIKE '".$email."' ");
            $result = $users->results();
            if($users->count() > 0)
            {            
                return $result;
            }
        }        
        
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function searchUserByName($name)   //search user information by Name
    { 
        try 
        {  
            $conn=$this->DBobject->ReturnConnectionObject();
            $name = mysqli_escape_string($conn, $name);
            $users = $this->executeSelectQuery("SELECT * FROM Users WHERE name LIKE '".$name."' ");
            $result = $users->results();
            if($users->count() > 0)
            {            
                return $result;
            }
        }        
        
        catch (mysqli_sql_exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getAllUsers() 
    { 
        try 
        {
            $users = $this->executeSelectQuery("SELECT * FROM Users");
            $result = $users->results();
            if($users->count() > 0)
            {            
                return $result;
            }
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getTableData($tableName)  //get table data based on table name
    { 
        try 
        {
            $conn=$this->DBobject->ReturnConnectionObject();
            $sql= "SELECT * FROM `".$tableName."` ORDER BY id DESC;";
            $result = mysqli_query($conn, $sql);
            return $result;
    
            // $numRows = $result->num_rows; 
            //     if ($numRows > 0) 
            //     {
            //         while ($row = $result->fetch_array()) 
            //         { 
            //             $data[] = $row; 
            //         } 
            //         return $data;
            //     } 

        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

//-------------------------------------------------------------------------------END--------------------------------------------------------------
   




    // public function test()    
    // {
    //     echo "<strong> 방탄소년단 </strong>";
      
    // }

    public function closeConnection()
    {
        $this->GetConnObject()->close();
    }
}

// $o = new UserDAL;
// print_r($o->searchUserByEmail("636%") );

//sdcsdfc '".$var."' wedfwefc   

?>
