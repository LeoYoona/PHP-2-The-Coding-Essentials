<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 }

 $users = new User_Service();
 $userInfoArray = $users->getLoggedUserInfo($_SESSION['email']) ; //get all user information from the DB

 //$_SESSION['userEmail'] =  $userInfoArray["email"];  //assing user data to the session variables
 $_SESSION['pwd'] = $userInfoArray["password"];
 $_SESSION['name']= $userInfoArray['name'];
 $_SESSION['id'] = $userInfoArray['id'];

if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')  //storing email and password of the user as cookies
{
    $oneMonth = time() + 3600 * 24 * 30;
    setcookie('userEmail',  $_SESSION['email'], $oneMonth);
    setcookie('password',$_SESSION['pwd'], $oneMonth);
}

?>


<!DOCTYPE html>
 <html> 
 <head>          
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="myStylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>
		Home || The Coding Essentials
        </title> 
       
	<body style="color: white; background-color:transparent;"> 
    <script defer src="../js/fbAPI.js"></script>
         <form class="logoutLblPos" align="right" name="form1" method="post" action="logout.php">                         <!-- logout btn-->
        <button type="submit" name="post" value="Post" class="logoutbtn" style="height: 30px; width:62px" class="logoutLblPos" align="right">
         <b> Logout </b>
         </button>
        </form>

        <h1 class="H1-homepage">The Coding Essentials</h1>
        <br>
        <nav class="navigbar">
            <ul>
            <li><a href="homepage.php"><u>Home</u></a></li>
            <li><a href="books.php">E-Books</a></li>
            <li><a href="searchUsers.php">Users</a></li>
            <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
        <br>
        <h2 style="text-align: center"> HOME</h2>
        <br>  
        <?php      
        if(isset($_GET["Login"]))
            {
                if($_GET["Login"]=="Successful")
                {
                    echo '<p style="color:green">Hi !! Welcome to The Coding Essentials<br>Happy Coding :)</p>';
                }
            }
        if(isset($_GET["cookie"]))
            {
                if($_GET["cookie"]=="deleted")
                {
                    echo '<p style="color:green">Cookies deleted successfully</p>';
                }
            }
        ?>
       
            <p  style="text-align: center; font-size: 25px;">
            The Coding Essentials is an E-book platform for exclusive and extremely helpful programming books.        
            In our E-books section you will find an overview of all the ebooks we offer. 
            You can download and read it on your ereader, tablet, smartphone or PC.<br><br>
            <a href="canvas.php" style="color:#90ee90; ">Head to creative zone :) </a>
            </p>
    <!-- Creative contains all image uploading imgs, canvas , and pdf stuff-->
    </body> 
 </html> 



