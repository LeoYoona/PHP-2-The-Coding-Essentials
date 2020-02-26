<?php
declare(strict_types=1);
include "showErrors.php";
mb_internal_encoding("8bit");
session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 }
//page only accesible if user logged in

//include database configuration file
include 'DB.php';

//get records from database
$DBobject = DB::getInstance();
$conn=$DBobject->ReturnConnectionObject();

require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
       
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType))
  {

    $targetPath = 'Uploads/'.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
    
    $Reader = new SpreadsheetReader($targetPath);
    
    $sheetCount = count($Reader->sheets());
    
    for($i=0;$i<$sheetCount;$i++)
    {
        $Reader->ChangeSheet($i);
        
        foreach ($Reader as $column)
        {
            $col1=$column[0];
            $col2=$column[1];
            $col3=$column[2];
            // echo $col1.$col2;
            break;
            // $insertObj->insertCol1Col2Col3($column);          
        }
    }
  }
    else
    { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
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
        
    <form class="logoutLblPos" align="right" name="form1" method="post" action="logout.php">                <!-- logout btn-->
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
        <form action="importColSelExcel.php" method="post">
            <input type="hidden" name="filePath" value="<?php echo $targetPath; ?>">
            <p>Select column combination <small>(columns acc. to the selected file, MAX 3 columns)  </small></p>
            <div class="input-row">
                <select name="colSelect" class="form-control" required> 
                    <option value="col1"> <?php echo $col1; ?> </option>
                    <option style="color:#1e1e1e;" value="col1col2"><?php echo $col1." - ".$col2; ?></option>
                    <option style="color:#1e1e1e;" value="col1col2col3"><?php echo $col1." - ".$col2." - ".$col3; ?></option>
                </select>
                <button type="submit" id="submit" name="import" style="float: right"
                        class="mt-4 btn-submit">Import</button>
            </div>
        </form>
        </div>
    </body> 
 </html> 

