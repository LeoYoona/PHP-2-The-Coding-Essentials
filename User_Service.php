<?php
//Controller or Service layer
//include "AutoLoaderIncl.php";  //(undoing this bc it gives the error-> Fatal error: Cannot redeclare myAutoLoader() (previously declared in C:\xampp\htdocs\AutoLoaderIncl.php:5) in C:\xampp\htdocs\AutoLoaderIncl.php on line 20)
require_once "UserDAL.php";

class User_Service { 

	private $UserDALobject = NULL; 

	public function __construct()	
	{
		$this->UserDALobject = new UserDAL();
	}

	public function GetConnectionObject()
    {
        $conn=$this->UserDALobject->GetConnObject();	 //gets connection from Model Layer/DAL
        return $conn;
	}

	public function arrayAllUsers()
    {
		return $UserdataArray = $this->UserDALobject->getAllUsers();
	}

	public function getTableData($tableName)  //get table data based on table name
    {
		return $this->UserDALobject->getTableData($tableName); 
	}
	
	public function showAllUsers()
    { 
		$UserdataArray = $this->UserDALobject->getAllUsers();
		foreach($UserdataArray as $user)   
            {				
				echo "<br><br>Name : ".$user->name.""; 
				echo "<br>E Mail : ".$user->email."	"; 
				//echo "<br>User Role : ".$user->userRole."	"; 
				echo "<br>User registration date : ".$user->registrationDate."	";   
            }
	}

	public function searchUserByEmail($email)   //search user information by Email
    { 
		return $this->UserDALobject->searchUserByEmail($email);
	}

	public function searchUserByName($name)   //search user information by Email
    { 
		return $this->UserDALobject->searchUserByName($name);
	}

	public function IfUserExists($email, $password) //used while logging in, to check if the user with these credentials exists
	{
		return $this->UserDALobject->checkUserExistence($email, $password) ;
	}

	public function check_EmailAdd_existence($email) //used while signing in, to check if the same email belongs to an existing user
    { 
		return $this->UserDALobject->verifyUserEmail($email) ;
	}

	public function insertNewUser($name, $email, $password)  //signup
    { 
		$this->UserDALobject->insertNewUser($name, $email, $password);
	}

	public function getLoggedUserInfo($Email) 
    { 
		return $this->UserDALobject->getLoggedUserInfo($Email) ;
	}

	public function getLoggedUserInfoById($id)  //get user information by id
    {
		return $this->UserDALobject->getLoggedUserInfoById($id);
	}

	public function editUserPassword($id, $password) 
    { 
		$this->UserDALobject->editUserPassword($id, $password) ;
	}

	public function editUserName($id, $name) 
    { 
		 $this->UserDALobject->editUserName($id, $name)  ;
	}
	
	public function editUserEmailAddress($id, $newEmail) 
    {
		 $this->UserDALobject->editUserEmailAddress($id, $newEmail)  ;
	}



	public function TEST()
    {
		echo 'Current PHP version: ' . phpversion();
		$this->UserDALobject->test();		
	}
	
	public function closeConnection()
    {
        $this->UserDALobject->closeConnection();
    }
	
}
// $users = new User_Service(); 
// $users->searchUserByEmail("636");  
// $users->searchUserByName("mus")  ; 
//$users->TEST();  //only for testing purposes, REMEMBER to comment this for loin.php script to work
//  echo date("Y-m-d");

?>
