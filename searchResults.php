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
            <li><a href="searchUsers.php">Users</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>
        <br>
        <h2 style="text-align: center"> USERS</h2>
        <div style="text-align: center" >

        <?php

            $users = new User_Service();   

            if(isset($_POST["searchName"]))
            {
                //search users by name
                if( isset( $_POST["queryName"] ) )  
                {
                    $nameQuery = $_POST["queryName"] ;  
                        
                    $nameQuery .= "%";
                    echo "Search Result for user name '".$_POST["queryName"]."' <br>";
                    $UserdataArray = $users->searchUserByName($nameQuery);
                    if(!empty($UserdataArray))
                    {
                        foreach($UserdataArray as $user)   
                        { 
                            echo "<br><br>Name : ".$user->name."		"; 
                            echo "<br>E Mail : ".$user->email."	"; 				
                            echo "<br>User registration date : ".$user->registrationDate."		";    
                        }
                        
                    }
                    else
                    {
                        header("Location: searchUsers.php?result=noResult");
                    }
                }
            }

            elseif(isset($_POST["searchEmail"]))
            {

                if( isset( $_POST["queryEmail"] ) )  
                {
                    $emailQuery = $_POST["queryEmail"] ;               
                    $emailQuery .= "%";
                    echo "Search Result for user email '".$_POST["queryEmail"]."' <br>";

                    $UserdataArray = $users->searchUserByEmail($emailQuery);
                    if(!empty($UserdataArray))
                    {
                        foreach($UserdataArray as $user)   
                        { 
                            echo "<br><br>E Mail : ".$user->email."	"; 	
                            echo "<br>Name : ".$user->name."		";                     			
                            echo "<br>User registration date : ".$user->registrationDate."		";    
                        }
                        
                    }
                    else
                    {
                        header("Location: searchUsers.php?result=noResult");
                    }
                }

            }
            ?>
            <br><br><br>
            <a href="searchUsers.php" style="color:#ffff70">
            Want to search again ? 
            </a>
            <br><br><br>
        </div>          
       
    </body> 
 </html> 






