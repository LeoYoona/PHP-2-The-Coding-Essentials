<?php
require_once "DB.php";
require_once "UserDAL.php";

class AdminDAL extends UserDAL
{
    public function EditUserPassword($email) //to be used by all type of admins 
    { 
    }

    public function LoginAsUser($email) //to be used by all type of admins 
    {

    }
}

?>