<?php
require_once "DB.php";
require_once "AdminDAL.php";

class SuperAdminDAL extends AdminDAL
{
    public function DeleteUser($email) //to be used by superAdmin only
    { 
    }
    
    public function EditUserRole($email) //to be used by superAdmin only
    { 
    }
}

?>