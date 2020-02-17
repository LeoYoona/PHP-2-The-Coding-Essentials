<?php
declare(strict_types=1);
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
		E-Books || The Coding Essentials
        </title> 
       
	<body> 
         <form class="logoutLblPos" align="right" name="form1" method="post" action="logout.php">                         <!-- logout btn-->
        <button type="submit" name="post" value="Post" class="logoutbtn" style="height: 30px; width:62px" class="logoutLblPos" align="right">
         <b> Logout </b>
         </button>
        </form>

        <h1 class="H1-homepage">The Coding Essentials</h1>
        <br>
        <nav class="navigbar">
            <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="books.php"><u>E-Books</u></a></li>
            <li><a href="searchUsers.php">Users</a></li>
            <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
        <br>
        <h2 style="text-align: center"> E-BOOKS</h2>
        <!-- <p style="color:green; padding-left: 11px"><?php echo "<br>".$_SESSION["message"]; ?> </p> -->
        <br>        
            <div class="imgRow">
            <div class="imgColumn">
                <img src="img/i1.jpg" alt="Pretending to know about stuff" style="width:100%">
            </div>
            <div class="imgColumn">
                <img src="img/i2.jpg" alt="Compile and pray to work" style="width:100%">
            </div>
            <div class="imgColumn">
                <img src="img/i3.jpg" alt="Nodding along" style="width:100%">
            </div>
            </div> 

            <div class="imgRow">
            <div class="imgColumn">
                
                <img src="img/i4.jpg" alt="Remembering what to google" style="width:100%">
            </div>
            <div class="imgColumn">
               
                <img src="img/i5.jpg" alt="Such data" style="width:100%">
            </div>
            <div class="imgColumn">
                
                <img src="img/i6.jpg" alt="WTF is security" style="width:100%">
            </div>
            
            </div>
    </body> 
 </html> 



