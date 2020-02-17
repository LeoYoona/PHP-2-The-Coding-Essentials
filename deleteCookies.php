<?php

session_start();

    //destroy cookies
    $oneMonth = time() - 3600 * 24 * 30;
    setcookie('userEmail',  $_SESSION['email'], $oneMonth);
    setcookie('password',$_SESSION['pwd'], $oneMonth); 
clearstatcache();  //clear chache 

header("Location: homepage.php?cookie=deleted");//to go back to homepage   
?>