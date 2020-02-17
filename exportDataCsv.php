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
$query = $conn->query("SELECT * FROM Users ORDER BY id DESC");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "User_data_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    if($_GET["Col"]=="un")
    {
        //set column headers
        $fields = array('id', 'name');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($row = $query->fetch_assoc()){
            $lineData = array($row['id'], $row['name']);
            fputcsv($f, $lineData, $delimiter);
        }
    }
    
    else if($_GET["Col"]=="un_ue")
    {
        //set column headers
        $fields = array('id', 'name', 'email');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($row = $query->fetch_assoc()){
            $lineData = array($row['id'], $row['name'], $row['email']);
            fputcsv($f, $lineData, $delimiter);
        }
    }

    else if($_GET["Col"]=="un_ue_ur")
    {
        //set column headers
        $fields = array('id', 'name', 'email', 'registrationDate');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($row = $query->fetch_assoc()){
            $lineData = array($row['id'], $row['name'], $row['email'], $row['registrationDate']);
            fputcsv($f, $lineData, $delimiter);
        }
    }

    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>