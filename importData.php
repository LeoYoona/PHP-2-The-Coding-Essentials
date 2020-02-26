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


            <div style="margin: auto; width: 50%;" >
                <h2 style="text-align: center"> Import Data</h2><br>
                <p style="text-align: center">Select a CSV or Excel file to import data from  </p>
                <br><br>

                <form class="form-horizontal CSV" action="importDataCSV.php" method="post" name="uploadCSV"
                    enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose CSV File</label> <input
                            type="file" name="file" id="file" accept=".csv">
                        <button type="submit" id="submit" name="import"
                            class="btn-submit">Done</button>
                        <br>
                    </div>
                    <div id="labelError"></div>
                </form>
                <br><br>
                <p style="text-align: center">OR</p>
                <br><br>
                <form action="importDataExcel.php" method="post"
                    name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose Excel
                            File</label> <input type="file" name="file"
                            id="file" accept=".xls,.xlsx">
                        <button type="submit" id="submit" name="import"
                            class="btn-submit">Done</button>
                    </div>
                </form>
                <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
                <a class="mt-4" href="searchUsers.php" style= "float: right; Text-align:center; color:#ffff70">Go back ?</a>
            </div>
        </body> 
 </html> 