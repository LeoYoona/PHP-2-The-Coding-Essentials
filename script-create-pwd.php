<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if (isset($_POST["reset-password-submit"])) 
{
    $pwdResetObject = new pwdReset_Service();    

    $selector=$_SESSION["selectorURL"];
    //echo $selector;
    $validator=$_SESSION["validatorURL"];
    //echo $validator;

    $pwd=$_POST["pwd"];
    $pwdRepeat=$_POST["pwdRepeat"];

    if($pwd!= $pwdRepeat) 
    {
       header("location: index.pwdreset.php?newpwd=PasswordsDonotMatch");
    }

    elseif((strlen($pwd)) < 6)//to check if the password entered is atleast 6 characters long
    {
        $passwordLengtherror = "You password is less than 6 characters";
        $_SESSION["error"]=$passwordLengtherror;   
        header("Location: index.pwdreset.php?newpwd=passwordShort");
    }

    else
    {
    
        $resultArray= $pwdResetObject->CheckTokenExpiry($selector);     

        if(empty( $resultArray))      //to check if token is already expired or not in DB
        {
            // echo "token invalid";    
            $Message= "Request Timed out. You need to re-submit your password reset request";
            $_SESSION["message"]=$Message;
            header("location: index.pwdreset.php?tokenError=RequestTimedOut");         
        }
        else
        {
            // "token valid";   
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $resultArray["pwdResetToken"]);

            if ($tokenCheck == false) 
            {
                $Message= "Request Timed out. You need to re-submit your password reset request" ;

                $_SESSION["message"]=$Message;
                header("location: index.pwdreset.php?tokenError=RequestTimedOut2"); 
            }

            elseif ($tokenCheck == true) 
            {
                $tokenEmail = $resultArray["pwdResetEmail"];
                $resultArray2 = $pwdResetObject->selectTokenEmail($tokenEmail);
                
                if(!isset( $resultArray2))     
                {
                    $Message= "There was an error. Kindly re-submit your password reset request" ;

                    $_SESSION["message"]=$Message;
                    header("location: index.pwdreset.php?tokenError=RequestTimedOut");
                }
                else
                {
                    $pwdResetObject->updatePassword($pwd, $tokenEmail);   //updating the password in the database
                    header("location: index.php?newpwd=PasswordUpdated");
                }
            }
        }
    }

    
}
 else
{
    header("Location: index.php");
    exit();
}

?>