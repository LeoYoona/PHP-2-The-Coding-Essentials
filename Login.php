<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();
$error="";
//require "User_Service.php"
$users = new User_Service();    
$conn=$users->GetConnectionObject(); 

//using 'mysqli_real_escape_string()' to prevent sql injections
$email= mysqli_real_escape_string($conn, $_POST["email"]);
$password= mysqli_real_escape_string($conn, $_POST["password"]);


$ifExists = $users->IfUserExists($email, $password); //checks if the user with the entered username and password exists
if($ifExists==1)
{    
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
   // $_SESSION["welcomeMessage"]=$Message;
    header("location: homepage.php?Login=Successful"); //to go the user profile page
}
else
{
    $error = "Username or Password is invalid";
    $_SESSION["errorLogin"]=$error;   
    header("Location: index.php?Login=Unsuccessful");//to go back to the index page/login    
    
}

// ctrl+]/[ to indent code
?>