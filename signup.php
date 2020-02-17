<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

$users = new User_Service();    
$conn=$users->GetConnectionObject(); 

//using 'mysqli_real_escape_string()' to prevent sql injections
$name= mysqli_real_escape_string($conn, $_POST["name"]);
$email= mysqli_real_escape_string($conn, $_POST["email"]);
$password= mysqli_real_escape_string($conn, $_POST["password"]);

$passwordlength= strlen($password); //to check the length of the password

$ifExists = $users->check_EmailAdd_existence($email); //checks if the user with the entered email already exists

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
       header("Location: index.signup.php?SignUp=Unsuccessful");//to go back to the sign up page
    }
    else if( $passwordlength < 6 || $passwordlength > 20 || $password == "password" || $password == "Password" )//to check if the password entered is atleast 6 characters long
    {
        header("Location: index.signup.php?SignUp=Unsuccessful");//to go back to the sign up page
    }
    else if($ifExists==1)
    {
        header("Location: index.signup.php?SignUp=userExists");//to go back to the sign up page
    }
    else
    {
        $users->insertNewUser($name, $email, $password);
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        header("location: homepage.php?Login=Successful"); //to go the user profile page
    }


// ctrl+]/[ to indent code
?>