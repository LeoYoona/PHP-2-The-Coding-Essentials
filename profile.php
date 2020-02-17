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
       
	<body> 
         <form class="logoutLblPos" align="right" name="form1" method="post" action="logout.php">                         <!-- logout btn-->
        <button type="submit" name="post" value="Post" class="logoutbtn" style="height: 30px; width:62px" class="logoutLblPos" align="right">
         <b> Logout </b>
         </button>
        </form>

        <h1 class="H1-Profile">The Coding Essentials</h1>
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
        <h2 style="text-align: center"> PROFILE</h2>
        <div class= "profileContent" >
            <p style="color:blueviolet"><?php echo "<br>User Profile"; ?> </p>
            <br>   
            <img src="img/avatar-icon.png" style="width:100px; Height:100px">     
            <p>
                User name: <?php echo $_SESSION["name"]; ?> 
                <br>
                User email: <?php echo $_SESSION["email"]; ?> 
            </p>
            <br>
            <a href="settings.php" style="color:#ffff70">
            Want to change profile Information? Go to Settings 
            </a>
            <br>
            <?php
            if(isset($_GET["InfoEdit"]))
            {
                if($_GET["InfoEdit"]=="Success")
                {
                    echo '<p  style="color:green;"><br>User Information Updated Successfully</p> ';
                }
            }
                 
            ?>
        </div>
    </body> 
 </html> 