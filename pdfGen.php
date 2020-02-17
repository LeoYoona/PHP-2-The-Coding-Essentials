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
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="/css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="myStylesheet.css">
  

  <title>Create PDF || The Coding Essentials</title>
  <script defer src="../js/signin-form-validation.js"></script>
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
              <li><a href="canvas.php">Canvas</a></li>
              <li><a href="fileManager.php">File Manager</a></li>
              <li><a href="pdfGen.php"><u>Create PDF</u></a></li>
              <li><a href="payment.php">Payment</a></li>
              </ul>
          </nav>
          <br>
      <h2 style="text-align: center">Create PDF</h2>
      

<div class="container mt-1">
    <form action="makePdf.php" method="POST" class="offset-md-3 col-md-6">
    
    <p style="text-align: center"> Fill out the details below to Create you own PDF <br>Hit the Create PDF button below to get your personailzed PDF :) </p>
    
    <div class="row mb-2">
        <div class="col-md-6 mb-1"> <!--md stads for middle device length, bootstrap stuff-->
        <input type="text" name="firstname" autofocus placeholder="First name" class="form-control" required >
        </div>
        <div class="col-md-6 mb-1"> <!--md stads for middle device length, bootstrap stuff-->
        <input type="text" name="lastname" placeholder="Last name" class="form-control" required >
        </div>
    </div>

    <div class= "mb-2">
    Select a Song
    <select name="songSelect" class="form-control" required> 
        <option value="No song selected">No song selected</option>
        <option style="color:#1e1e1e;" value="Black Swan">Black Swan</option>
        <option style="color:#1e1e1e;" value="Baepsae">Baepsae</option>
        <option style="color:#1e1e1e;" value="Pied piper">Pied piper</option>
        <option style="color:#1e1e1e;" value="Mikrokosmos">Mikrokosmos</option>
        <option style="color:#1e1e1e;" value="Persona">Persona</option>
        <option style="color:#1e1e1e;" value="Dimple">Dimple</option>
        </select>
    </div>

    <div class= "mb-2">
        <input type="email" name="email" placeholder="Email" onkeyup="ValidateEmail();" class="form-control" required> 
    </div>
        <br><br>

    <button type="submit" class="mb-5 btn btn-success btn-lg btn-block">Create PDF</button>


</div>

</body>

</html>