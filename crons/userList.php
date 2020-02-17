<?php

    $servername = "localhost";
    $username = "s636130_user"; 
    $password = "BT21Yoona";
    $dbase = "s636130_db"; 
    
    $_mysqliConnectionObject = new mysqli($servername, $username, $password,$dbase);
    
    if($_mysqliConnectionObject->connect_error)
    {
        die($_mysqliConnectionObject->connect_error);
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $_mysqliConnectionObject->set_charset("utf8mb4");

    $sql = "SELECT * FROM Users"; 
    $query = mysqli_query($_mysqliConnectionObject,$sql);

    while ($row[] = mysqli_fetch_object($query)) 
    {
        $_userList = $row;
    }
    
    $_mysqliConnectionObject -> close();

    foreach($_userList as $data)   
    {				
        $abc .= "\r\n\r\nName : ".$data->name." "; 
        $abc .= "\r\nE Mail : ".$data->email."	"; 
        $abc .= "\r\nUser registration date : ".$data->registrationDate."	";
    }


$to = "636130@student.inholland.nl";
$subject = "Daily User list ";
$message = "Hello Muskan,\r\n\r\nHere is your Daily User list \r\n";
$message .=$abc."\r\n"; 
$message .="\r\n\r\nNext User list will be sent after 24 hours at 10:00 AM.\r\n\r\nRegards,\r\nThe Coding Essentials"; 

$headers = "From: The Coding Essentials <s636130@server.infhaarlem.nl>\r\n";

mail($to, $subject, $message, $headers); 
// echo $message;
?>
