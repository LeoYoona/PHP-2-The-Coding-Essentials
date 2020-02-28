<?php
declare(strict_types=1);
include 'DB.php';
include "showErrors.php";
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
  <meta http-equiv="Cache-control" content="no-cache" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<title>Payment Confirmation || The Coding Essentials</title>
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
              <li><a href="pdfGen.php">Create PDF</a></li>
              <li><a href="payment.php"><u>Payment</u></a></li>
              </ul>
          </nav>
          <br>
      <h2 style="text-align: center">Payment Confirmation</h2>

    <p style="text-align: center"> This is just a mollie payment demonstration<br>Thank you for shopping with us. Have a nice day! </p>


 <table style="border-style: solid; text-align: center; margin: auto; width: 50%;" class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">status</th>
        <th scope="col">timestamp</th>
      </tr>
    </thead>
    <tbody>

<?php 

    $query = ("select * from payments");
    $DBobject = DB::getInstance();
    $conn=$DBobject->ReturnConnectionObject();
    $result = $conn->query($query);

    // CloseCon($conn);
    if ($result->num_rows > 0) {

        while($row = mysqli_fetch_assoc($result)) {

         ?>
            <tr style="color:white">
                <td>
                <?php echo $row['id']; ?>
                </td>
                <td>
                <?php echo $row['status']; ?>
                </td>
                <td>
                <?php echo $row['payment_date']; ?>
                </td>
            </tr>
        <?php 
            } 
        }
        ?>

   </tbody>
   </table>
</body>

</html>