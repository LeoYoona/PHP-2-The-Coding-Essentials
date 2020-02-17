<?php 
declare(strict_types=1);
include "AutoLoaderIncl.php";
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="myStylesheet.css">
            <title>
                Create new password || The Coding Essentials
            </title>
    </head>
    <body>
    <?php
        $selector = $_GET["selector"];        
        $validator = $_GET["validator"];
        $userEmail = $_GET["userEmail"];
        

        if (empty($selector) || empty($validator)) 
        {
            echo "Could not validate your request !";
        }
        else
        {
            $_SESSION["selectorURL"] = $selector;
            $_SESSION["validatorURL"] = $validator;
            //echo $_SESSION["selectorURL"] ."<br>".$_SESSION["validatorURL"];

            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) 
            {
     ?>
    <h1 class="H1-CreateNewPass"> The Coding Essentials</h1>
        <div class="CreateNewPass-header">Create New Password</div>
        <br>
        <p><?php echo "Reset password for '".$userEmail."' <br>Your password must be atleast 6 characters long!!"; ?></p>
        <br>
        <form action="script-create-pwd.php" method="post">
        
            <input type="password" name="pwd" placeholder="Enter a new password..." required>
            <input type="password" name="pwdRepeat" placeholder="Repeat new password..." required>
            <button type="submit" name="reset-password-submit">Reset password</button> 
        </form>

    <?php

                //the script here closes {} for the php script above
                    
            }       
     }
    ?>
    </body>
</html>