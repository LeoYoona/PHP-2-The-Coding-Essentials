<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 }
//page only accesible if user logged in
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Canvas || The Coding Essentials</title>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="myStylesheet.css">
    </head>
    <body style="color: white; background-color:transparent;">

    <form class="logoutLblPos" align="right" name="form1" method="post" action="homepage.php"> 
    <button type="submit" name="post" value="Post" class="logoutbtn" style="padding:0.4vw; border-radius:10px" class="logoutLblPos" align="right">
      <b> Back to Homepage </b>
      </button>
    </form>

    <h1 class="H1-SignUp" > The Coding Essentials </h1>
    <h3 style="color:#90ee90; text-align: center">Creative zone </h3>
    <br>
        <nav class="navigbar">
            <ul>
            <li><a href="canvas.php"><u>Canvas</u></a></li>
            <li><a href="fileManager.php">File Manager</a></li>
            <li><a href="pdfGen.php">Create PDF</a></li>
            <li><a href="payment.php">Payment</a></li>
            </ul>
        </nav>
        <br>
    <h2 style="text-align: center"> Canvas</h2>
    <div style="text-align:center; margin: auto; width: 50%;">
        <canvas id="canvas" style="border: 1.5vw solid #ccc; background-color:#FFF;"></canvas>
        <script src="../js/canvasJS.js"></script>
        <div id="buttons">
            <a  class="btn btn-outline-primary" id="download" download="image.jpg" href="" onclick="download_img(this);" >Download </a>
            <button type="submit" class="btn btn-outline-secondary" onClick="reset()" style="background-color:#1e1e1e;">Reset</button>
        <small><p>Signature Pad by <a style="color:#fff;"href="https://github.com/szimek/signature_pad">szimek</a></p></small>
    </div>
    </body>
</html>
