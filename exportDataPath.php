<?php
declare(strict_types=1);
include "showErrors.php";
session_start();
if(!isset($_SESSION['email']))
{
    header("Location: index.php"); //if user is not logged in, redirect to user index pg
} 

$colSelect= $_POST["colSelect"];
$typeSelect= $_POST["typeSelect"];

if($typeSelect == 'csv')
{    
    header("location: exportDataCsv.php?Col=".$colSelect.""); 
}
else
{   
    header("location: exportDataExcel.php?Col=".$colSelect.""); 
}


?>