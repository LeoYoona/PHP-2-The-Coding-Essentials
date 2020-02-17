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
  <script>
    function deleteFile(filename) {
      if (confirm('Are you sure?')) {
        window.location.replace('delete.php?name=' + filename);
      }
    }
  </script>

  <title>File Manager || The Coding Essentials</title>
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
              <li><a href="fileManager.php"><u>File Manager</u></a></li>
              <li><a href="pdfGen.php">Create PDF</a></li>
              <li><a href="payment.php">Payment</a></li>
              </ul>
          </nav>
          <br>
      <h2 style="text-align: center"> File Manager</h2>

<div style="background-color:#eee; padding:1vw; margin:1vw 5vw 1vw 5vw; "> <!-- top, right, bottom, and left-->
  <table class="table table-hover" > 
    <thead class="thead-dark">
      <tr>
        <th scope="col">name</th>
        <th scope="col">type</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $dir = 'workdir';
      $files1 = scandir($dir);
      $files2 = scandir($dir, 1);

      foreach ($files1 as $filename) {
        ?>
        <tr>
          <td><?php
                echo $filename
                ?>
          </td>
          <td><?php
                echo is_dir($filename)
                  ? 'directory</td><td></td>'
                  : 'regular file</td><td><button class="btn btn-link" onclick="deleteFile(this.id)" id="'
                    . $filename
                    . '">delete</button></td>';
                  ?>
        </tr>

      <?php
      }
      ?>
    </tbody>
  </table>

  <form name="upload" method="post" action="upload.php" enctype="multipart/form-data" >
    <div class="form-row">
      <div class="col">
        <input style="color:#1e1e1e" type="file" class="form-control-file" name="fileToUpload"  id="fileToUpload">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
  </form>
</div>
</body>

</html>