<?php
declare(strict_types=1);
include "showErrors.php";
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
mysqli_select_db($conn, 's636130_db');  

if($_GET["Col"]=="un")
{
    $sql = "SELECT id,name FROM Users ORDER BY id DESC";  
    $setRec = mysqli_query($conn, $sql);  
    $columnHeader = '';  
    $columnHeader = "id" . "\t" . "name" . "\t"; 
}

else if($_GET["Col"]=="un_ue")
{
    $sql = "SELECT id,name,email FROM Users ORDER BY id DESC";  
    $setRec = mysqli_query($conn, $sql);  
    $columnHeader = '';  
    $columnHeader = "id" . "\t" . "name" . "\t" . "email" . "\t"; 
}

else if($_GET["Col"]=="un_ue_ur")
{
    $sql = "SELECT id,name,email,registrationDate FROM Users ORDER BY id DESC";  
    $setRec = mysqli_query($conn, $sql);  
    $columnHeader = '';  
    $columnHeader = "id" . "\t" . "name" . "\t" . "email" . "\t". "registrationDate" . "\t"; 
}

$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  

$filename = "User_data_" . date('Y-m-d') . ".xls";
header("Content-type: application/octet-stream");  
header('Content-Disposition: attachment; filename="' . $filename . '";');
header("Pragma: no-cache");  
header("Expires: 0");  

echo ucwords($columnHeader) . "\n" . $setData . "\n"; 

?>