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
			Password Reset || The Coding Essentials
		</title>
</head>

<body>
<h1 class="H1-forgot-pass">Password Reset</h1>
<div class="pwd-reset-form">
    <p> An e-mail will be sent to you with instructions on how to reset your password
    </p>
    <br>

    <form action="PasswordReset.php" method="post" align="center">
        <input type="text" name="email" placeholder="your email address.." required>
        <button type="submit" name="reset-request-submit">Recieve password reset link
        </button> 
    </form>
    <br><br>
        <a href="index.php" class="btn btn-link">
            Go back to Login 
        </a>
    <?php


    if(isset($_GET["reset"]))
    {
        if($_GET["reset"]=="success"){
            echo '<p class "signupsuccess>Kindly check your e-mail for resetting your password</p>';
            echo "<br><br>". $_GET["url"];
        }
    }

    if(isset($_GET["newpwd"]))
    {
        if($_GET["newpwd"]=="PasswordsDonotMatch")
        {
            echo '<p  style="color:red;"><br>Entered passwords do not match</p> <br> <p> Try again by visiting the same password reset link </p>';
        
        }
        elseif($_GET["newpwd"]=="passwordShort")
        {
            echo '<p  style="color:red;"><br>Your password is shorter than 6 characters</p> <br> <p> Try again by visiting the same password reset link </p>';
        
        }
    }


    ?>
    <p style="color:red;"><?php echo $_SESSION["message"]; ?> </p>
    </div>
</body>
</html>