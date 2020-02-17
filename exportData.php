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
    Export User Data || The Coding Essentials
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
        <form action="exportDataPath.php" method="POST" >
            <div style="margin: auto; width: 50%;" >
                <h2 style="text-align: center"> Export User Data</h2><br>
                <p style="text-align: center"> Select data columns you want to export to csv or Excel file </p>
                <br><br>
                Select column combination <small>(Id selected by Default)  </small>
                <select name="colSelect" class="form-control" required> 
                    <option value="un">User Name</option>
                    <option style="color:#1e1e1e;" value="un_ue">User Name - User Email</option>
                    <option style="color:#1e1e1e;" value="un_ue_ur">User Name - User Email - User Registration date</option>
                </select>
                <br><br>
                Select file format  
                <select name="typeSelect" class="form-control" required> 
                    <option value="csv">csv file (.csv)</option>
                    <option style="color:#1e1e1e;" value="Excel">Excel file (.xls)</option>
                </select>
                <br><br>
                <button type="submit" style="background-color: green; width: 10vw; height: 3vw; padding: 2px; cursor: pointer;">Export Data</button>
            <br><br><br>
            <a href="searchUsers.php" style= "float: right; Text-align:center; color:#ffff70">Go back ?</a>
            </div>

        </form>     
        </body> 
 </html> <br><br>