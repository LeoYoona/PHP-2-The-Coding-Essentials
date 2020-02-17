<?php
//view  
 declare(strict_types=1);
 include "AutoLoaderIncl.php";

 session_start();

 if(isset($_SESSION['email']))
 {
     header("Location: homepage.php"); //if user is logged in, redirect to user profile pg
 }


  if(isset($_POST['post']))
  {
    //print_r($_POST);
    $URL ="https://www.google.com/recaptcha/api/siteverify";
    $DATA=[
        'secret' => "6LeAY78UAAAAAApzj4AnvdeUBJtJSJVkryOHVA2r",
        'response' => $_POST['token'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = array(
        'http' => array(
            'header' => "Contecnt-type: application/
            x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($DATA)
        )
    ); 
    $context= stream_context_create($options);
    $reponse = file_get_contents($URL, false, $context);
    $res = (json_decode($reponse, true));

    if (!$res['success']) {
        // What happens when the reCAPTCHA is not properly set up
        echo 'reCAPTCHA error !!';
     }
 } 
  
?> 
<!DOCTYPE html>
 <html> 
 <head> 
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="myStylesheet.css">
		<title>
        Sign Up || The Coding Essentials
        </title> 
        <script src="https://www.google.com/recaptcha/api.js?render=6LeAY78UAAAAAG1m6XmKyIBWx9oIanfkAVm0f3Oi"></script>        
        <script defer src="../js/signin-form-validation.js"></script>
    </head> 
	<body> 
        <h1 class="H1-SignUp"> The Coding Essentials </h1>
        
	<main class="SignUp-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="SignUp-header">Sign Up</div>
                    <br><br>
            
                    <div class="card-body">
                        <form action="signup.php" method="POST" id="form"> 
                        <!-------------------------------------------form action-------------------------------------------------------------->
						<div class="form-group row"> <!--Name-->
                                <label for="text" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="label">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter your name" required autofocus>
                                </div>
                        </div>	

                        <div class="form-group row">  <!--Email-->
                            <label for="email_address" class="lbl">E-Mail Address</label>
                            <div class="label">
                                    <input type="text" id="email_address" onkeyup="ValidateEmail();" class="form-control" name="email" placeholder="Enter your email address" required >
                                    <small>
                                        <span id="lblError" style=" color: #D8000C; background-color: #FFD2D2;"> </span>
                                    </small>
                            </div>
                        </div>

                            <div class="form-group row"> <!--password-->
                                <label for="password" class="lbl">Password</label>
                                <div class="label">
                                    <input type="password" id="password" onkeyup="ValidatePassword();" class="form-control" name="password" placeholder="Enter atleast 6 characters"required>
                                    <small>
                                        <span id="lblError2" style=" color: #D8000C; background-color: #FFD2D2;">  </span>
                                    </small>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="post" value="Post" class="btn btn-primary">
                                    SignUp
                                </button>
                                <br><br>
                                <a href="index.php" class="btn btn-link">
                                    Already a user? Go back to Login !!
                                </a>
                            </div>
                    </div>
                    <input type = "hidden" id="token" name="token">
					</form>
                    <!-------------------------------------------form ends-------------------------------------------------------------->
                    <?php
                   if($_GET["SignUp"]=="userExists"){
                    ?>
                        <script type="text/javascript">
                            function userExists() {
                            alert("A user with the entered email already exists, try again");
                            }
                            userExists(); 
                        </script>
                     <?php
                    } 
                    
                   else if($_GET["SignUp"]=="Unsuccessful"){
                    ?>
                        <script type="text/javascript">
                        function signupUnsuccessful() {
                            alert("Problems with signing up, invalid email or password");
                        }
                            signupUnsuccessful(); 
                        </script>   
                <?php
                    } 
                    ?>
                     
	
    </body> 
    <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6LeAY78UAAAAAG1m6XmKyIBWx9oIanfkAVm0f3Oi', {action: 'homepage'}).then(function(token) {
                    console.log(token);
                    document.getElementById("token").value = token;
                });
            });
    </script>
 </html> 



