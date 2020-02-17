<?php
require_once "User_Service.php";
require_once "pwdResetDAL.php";

class pwdReset_Service extends User_Service
{
    private $pwdResetDAL_Object = NULL; 

	public function __construct()	
	{
		$this->pwdResetDAL_Object = new pwdResetDAL;
    }

    public function deleteEmailAdd($userEmail) //deletes record of the email if the email already exists
    {
        $this->pwdResetDAL_Object->deleteEmailAdd($userEmail);
    }

    public function insertTempPwdInfo($userEmail, $selector, $token, $expires) //to insert temporary password reset information in the DB
    {
        $this->pwdResetDAL_Object->insertTempPwdInfo($userEmail, $selector, $token, $expires);
    }

    public function CheckTokenExpiry($selector) //to check if the reset link with the corresponding selector is already expired or notthe DB
    {
       return $this->pwdResetDAL_Object->CheckTokenExpiry($selector);
    }

    public function selectTokenEmail($tokenEmail) 
    {
        return $this->pwdResetDAL_Object->selectTokenEmail($tokenEmail);
    }

    public function updatePassword($pwd, $tokenEmail) //update password in database
    {
        $this->pwdResetDAL_Object->updatePassword($pwd, $tokenEmail);
    }
    

    // public function TEST()
    // {
    //     $this->TEST() ;
    // }
}

// $users = new pwdReset_Service(); 
// $users->TEST(); 

?>