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

    <form style="z-index: 2;" class="logoutLblPos" align="right" name="form1" method="post" action="homepage.php"> 
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
    
        <div class="row">
        <div class="col mb-1" >
            <h2 style="text-align: center"> Canvas</h2>
            <div style="text-align:center; margin: auto">
                <canvas id="canvas" style="border: 1.5vw solid #ccc; background-color:#FFF;"></canvas>
                <script src="../js/canvasJS.js"></script>
                <div id="buttons">
                    <a  class="btn btn-outline-primary" id="download" download="image.jpg" href="" onclick="download_img(this);" >Download </a>
                    <button type="submit" class="btn btn-outline-secondary" onClick="reset()" style="background-color:#1e1e1e;">Reset</button>
                <small><p>Signature Pad by <a style="color:#fff;"href="https://github.com/szimek/signature_pad">szimek</a></p></small>
            </div></div>
        </div>

        <div class="col mb-1" style="text-align: center; ">
            <a href="https://twitter.com/BTS_twt?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-show-count="false">Follow @BTS_twt</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            <br>
            <a class="twitter-timeline" data-width="400" data-height="700" data-theme="dark" href="https://twitter.com/BTS_twt?ref_src=twsrc%5Etfw">Tweets by BTS_twt</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            
        </div>
    </div>
    </body>
</html>
<!-- w 300 h 800 -->
