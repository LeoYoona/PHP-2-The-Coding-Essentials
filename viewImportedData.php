<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 } 

 //include database configuration file
include 'DB.php';

//get records from database
$DBobject = DB::getInstance();
$conn=$DBobject->ReturnConnectionObject();
// $query = $conn->query("SELECT * FROM Users ORDER BY id DESC");

?>

<!DOCTYPE html>
 <html> 
 <head>          
	<meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="myStylesheet.css">
	<title>
    Import Data || The Coding Essentials
    </title> 
    <script defer src="../js/isCSV.js"></script>
    <body style="color: white; background-color:transparent;">
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

            
            <div style="margin: auto; width: 50%; text-align:center;" >
                <?php

                    $obj = new User_Service(); 
                    $result = $obj->getTableData("test_imported_data");
                    // $sqlSelect = "SELECT * FROM `test_imported_data` ORDER BY id DESC";
                    // $result = mysqli_query($conn, $sqlSelect);
                                                   
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table id='userTable'>
                        <thead>
                            <tr>
                                <th>col 1</th>
                                <th>col 2</th>
                                <th>col 3</th>

                            </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <tbody>
                            <tr>
                                <td ><?php  echo $row['col1']; ?></td>
                                <td><?php  echo $row['col2']; ?></td>
                                <td><?php  echo $row['col3']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                <?php } ?>

                <a class="mt-4" href="searchUsers.php" style= "float: right; Text-align:center; color:#ffff70">Go back ?</a>
            </div>
        </body> 
 </html> <br><br>



