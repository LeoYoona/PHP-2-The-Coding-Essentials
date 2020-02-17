<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 } 

?>

<!DOCTYPE html>
 <html> 
 <head>          
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="myStylesheet.css">
	<title>
		Profile || The Coding Essentials
        </title> 
        <script defer src="../js/signin-form-validation.js"></script>
	<body> 
         <form class="logoutLblPos" align="right" name="form1" method="post" action="logout.php">                         <!-- logout btn-->
        <button type="submit" name="post" value="Post" class="logoutbtn" style="height: 30px; width:62px" class="logoutLblPos" align="right">
         <b> Logout </b>
         </button>
        </form>

        <h1 class="H1-Settings">The Coding Essentials</h1>
        <br>
        <nav class="navigbar">
            <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="books.php">E-Books</a></li>
            <li><a href="searchUsers.php">Users</a></li>
            <li><a href="profile.php"><u>Profile</u></a></li>
            </ul>
        </nav>
        <br>
        <h2 style="text-align: center">PROFILE SETTINGS</h2>
        <br>
        <div class= "userSettings" >
        <br><br><br><br><br>
            <form action="script-settings.php" method="post" class="settingsForm">
            <p> Change general information </p>
            <br>
                <label for="text">Name</label>
                <input class="inputSettings" type="text" name="UserName" placeholder=" <?php echo $_SESSION['name']  ;?>">
                <br><br>
                <label for="email_address" >E-Mail Address</label>
                <input class="inputSettings" id="email_address" onkeyup="ValidateEmail();" type="email" name="UserEmail" placeholder=" <?php echo $_SESSION['email']  ;?>">
                <small>
                    <span id="lblError" style=" color: #D8000C; background-color: #FFD2D2;"> </span>
                </small>
                <br><br>
                <p> Change password </p>
                <br>
                <label for="password" >Password</label>
                <input class="inputSettings" id="password" onkeyup="ValidatePassword();" type="password" name="pass1" placeholder="type in new password">
                <small>
                    <span id="lblError2" style=" color: #D8000C; background-color: #FFD2D2;">  </span>
                </small>
                <br><br>
                <label for="password" >Repeat Password</label>
                <input class="inputSettings" id="passwordRe" onkeyup="retypePassword();" type="password" name="pass2" placeholder="re-type new password">
                <small>
                    <span id="lblError3" style=" color: #D8000C; background-color: #FFD2D2;">  </span>
                </small>
                <br>
                <p style="font-size: 10px;"> Your password must be atleast 6 charecters long </p>
                <br>
                <button type="submit" name="saveChanges">Save Changes
                </button> 
            </form>
            <br>
            <form action="settings.php" method="post" class="btnDiscardChanges" align="left">
                <button type="submit" name="discardChanges">Discard Changes
                </button> 
            </form>     
            <a href="profile.php" style= "float: right; Text-align:center; color:#ffff70">View Profile</a>      

            <?php
            if(isset($_GET["infoEditError"]))
            {
                if($_GET["infoEditError"]=="invalidEmail")
                {
                    echo '<p  style="color:red;"><br>Entered email is invalid</p> ';
                   
                }
                elseif($_GET["infoEditError"]=="typePwdTwice")
                {
                    echo '<p  style="color:red;"><br>Please type in your password twice</p> ';
                   
                }
                elseif($_GET["infoEditError"]=="pwdNotSame")
                {
                    echo '<p  style="color:red;"><br>Your passwords donot match</p> ';
                   
                }
                elseif($_GET["infoEditError"]=="pwdShort")
                {
                    echo '<p  style="color:red;"><br>Your password is shorter than 6 characters</p>';
                   
                }
                elseif($_GET["infoEditError"]=="emailExists")
                {
                    echo '<p  style="color:red;"><br>The entered email already exists in the database</p>';
                   
                }
            }
            ?>

        </div>
        <br><br>
            <form action="deleteCookies.php" method="post" align="right" class="btnDeleteCookies">
                <button type="submit" name="deleteCookies" style="height: 30px; ">Delete website Cookies from your browser
                </button> 
            </form>
    </body> 
 </html> 