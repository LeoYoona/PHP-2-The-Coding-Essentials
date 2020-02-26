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
		Users || The Coding Essentials
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
            <li><a href="searchUsers.php"><u>Users</u></a></li>
            <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
        <br>
        <h2 style="text-align: center"> USERS</h2>
        <div class="rowUsers">
            <div class= "columnUsers" >
                <?php
                echo "All users<br>";
                $users = new User_Service(); 
                $a = $users->showAllUsers();
                echo $a;
                ?>
            </div>
            <div class= "columnUsers" >
                <form action="searchResults.php" method="post" class="searchForm">
                <p> <br><b>Search Users</b> </p>
                <br>
                    <label for="text">Search by User name</label>
                    <input class="inputSettings" type="text" name="queryName" placeholder=" user name...">
                    <br><br>
                    <button type="submit" name="searchName"  style="width:62px" >GO
                    <!-- <button type="submit" name="searchName"  style="float: right; width:62px" >GO -->
                    </button> 
                </form>
                <br><br><br><br>
                <form action="searchResults.php" method="post" class="searchForm">
                    <label for="text">Search by User email</label>
                    <input class="inputSettings" type="text" name="queryEmail" placeholder=" user email...">
                    <br><br>
                    <button type="submit" name="searchEmail"  style=" width:62px">GO
                    </button> 
                </form> 
                <br><br><Br>
                <a href="exportData.php" style= "color:#ccc">Export the Users List to csv/Exel file</a>          
                <br><br><Br>
                <a href="importData.php" style= "color:#ccc">Import data in the Databse via csv/Exel file</a>          
                <?php
                if(isset($_GET["result"]))
                {
                    if($_GET["result"]=="noResult")
                    {
                        echo '<p  style="color:red;"><br>No results matching your search </p> ';

                    }
                }
                    
                ?> 
            </div>
        </div>
           
       
    </body> 
 </html> 