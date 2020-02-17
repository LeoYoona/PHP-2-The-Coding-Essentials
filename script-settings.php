<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(isset($_POST["saveChanges"]))
	{
        $count = 0;
        $emailMessage="";

        $users = new User_Service();    

        //update name
        if( isset( $_POST["UserName"] ) )  
        {
          $users->editUserName($_SESSION['id'], $_POST["UserName"]) ;
          $emailMessage.="User name changed to: ".$_POST["UserName"].". \r\n";
          $count = $count + 1;
        }

        // update password
        if( isset( $_POST["pass1"] ) || isset( $_POST["pass2"] ) )  
        {
            if( empty( $_POST["pass1"]) || empty( $_POST["pass2"]) )
            {
                header("Location: settings.php?infoEditError=typePwdTwice");//to go back to the settings page
            }
            elseif ($_POST["pass1"] != $_POST["pass2"]) 
            {
                header("Location: settings.php?infoEditError=pwdNotSame");//to go back to the settings page
            }
            elseif ((strlen($_POST["pass1"])) < 6) 
            {
                header("Location: settings.php?infoEditError=pwdShort");//to go back to the settings page
            }
            else
            {            
                $users->editUserPassword($_SESSION['id'], $_POST["pass1"]) ;
                $emailMessage.="User password changed. \r\n";
                $count = $count + 1;
            }
        }

        // update email address
        if( isset( $_POST["UserEmail"] ) )  
        {
            $ifExists = $users->check_EmailAdd_existence( $_POST["UserEmail"]); //checks if the user with the entered email already exists

            if (!filter_var($_POST["UserEmail"], FILTER_VALIDATE_EMAIL)) 
            {  
                header("Location: settings.php?infoEditError=invalidEmail");//to go back to the settings page
            }
            else if($ifExists==1)
            {
                $error = "A user with the entered email already exists, try again";
                $_SESSION["error"]=$error;   
                header("Location: settings.php?infoEditError=emailExists");//to go back to the settings page
            }
            else
            {   $oldEmail = $_POST["UserEmail"] ;
                $users->editUserEmailAddress($_SESSION['id'], $_POST["UserEmail"])  ;
                $emailMessage.="User name changed to: ".$_POST["UserEmail"].". \r\n";
                $count = $count + 1;
            }
        }

        $userInfoArray = $users->getLoggedUserInfoById($_SESSION['id']) ; //get all user information from the DB by ID
        $_SESSION['email'] =  $userInfoArray["email"];  //assing user data to the session variables 
        $_SESSION['name']= $userInfoArray['name'];

        if($count>0)
        {
            $emailAdd=$_SESSION['email'] ;
            $to = $emailAdd;
            $subject = "Confrimation reagrding updated User Information";
            $message = "Dear User, \r\n"; 
            $message .="Your information has been updated.Kindly review the changes below: \r\n";
            $message .=$emailMessage; 

            $headers = "From: The Coding Essentials <s636130@server.infhaarlem.nl>\r\n";
            $headers .= "Content type: text/html\r\n";
            $headers .= "MIME-Version: 1.0";
            $headers .= "Content-type: text/html; charset=iso-8859-1";
            
            mail($to, $subject, $message, $headers); 			
            
        }     
        
        header("Location: profile.php?InfoEdit=Success");//to go back to the settings page
    }
?>