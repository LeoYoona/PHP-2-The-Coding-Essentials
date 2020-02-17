<?php
require_once "Admin_Service.php";

class SuperAdmin_Service extends Admin_Service
{
    public function DeleteUser($email) //to be used by superAdmin only
    { 
    }
    
    public function EditUserRole($email) //to be used by superAdmin only
    { 
    }
}

?>