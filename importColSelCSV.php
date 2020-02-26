<?php
declare(strict_types=1);
include "showErrors.php";
include 'insertDataCsvXls.php';
session_start();

if(!isset($_SESSION['email']))
{
    header("Location: index.php"); //if user is not logged in, redirect to user index pg
} 

$colSelect= $_POST["colSelect"];
$insertObj = new insertDataCsvXls(); //creating obj of class insertDataCsvXls that insertts data in the DB from the xls/csv file
$targetPath = $_POST["filePath"];

$file = fopen($targetPath, "r");
        
    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) 
    {

        if($colSelect == 'col1')
        {    
            $insertObj->insertCol1($column);
        }
        elseif($colSelect == 'col1col2')
        {    
            $insertObj->insertCol1Col2($column);
        }
        else
        {   
            $insertObj->insertCol1Col2Col3($column);
        }
        
    }    
                  
unlink($targetPath); //deleting file from server after data import
header("Location: viewImportedData.php");

?>