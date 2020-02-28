<?php
//view  
 declare(strict_types=1);
 include "AutoLoaderIncl.php";
 //session_destroy();

session_start();

//echo $_SESSION["error"];
 if(isset($_SESSION['email']))
 {
     header("Location: homepage.php"); //if user is logged in, redirect to homepage
 }

    setcookie("cookie_name", "cookieValue", time()+ 3600,'/'); // expires after 60 seconds
    //echo 'the cookie has been set for 60 seconds';

 //-------------------------------------------------------------reCaptcha configurations--------------------------------------------------------
  if(isset($_POST['post']))
  {
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

    // if (!$res['success']) {
    //     // What happens when the reCAPTCHA is not properly set up
    //     echo 'reCAPTCHA error !!';
    //  }
    //   else {
    //     // If CAPTCHA is successful...

    //     // Paste mail function or whatever else you want to happen here!
    //     echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    //     }
 //-------------------------------------------------------------reCaptcha configurations END------------------------------------------------------
} 

?> 
<!DOCTYPE html>
 <html> 
 <head> 
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="myStylesheet.css">
		<title>
			Login || The Coding Essentials
        </title> 
        <script src="https://www.google.com/recaptcha/api.js?render=6LeAY78UAAAAAG1m6XmKyIBWx9oIanfkAVm0f3Oi"></script>  
        <script defer src="../js/signin-form-validation.js"></script>
    <body> 
        <h1 class="H1-Login"> The Coding Essentials </h1>
        
	<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="Login-header">Login</div>
                    <br><br>
            
                    <div class="card-body">
                         
                        <!-------------------------------------------form action-------------------------------------------------------------->
                        <form action="Login.php" method="POST">
                        <div class="form-group row">  <!--Email-->
                            <label for="email_address" >E-Mail Address</label>
                            <div class="label">
                                    <input type="text" id="email_address" onkeyup="ValidateEmail();" class="form-control" name="email" required autofocus>
                                    <small><span id="lblError" style=" color: #D8000C; background-color: #FFD2D2;">  </span></small>
                            
                            </div>
                        </div>
                         <div class="form-group row"> <!--password-->
                            <label for="password" class="lbl">Password</label>
                            <div class="label">
                                 <input type="password" id="password" class="form-control" name="password" required>
                            </div>
                        </div>
                            <br>
                            <input type="checkbox" name="remember_me" id="remember_me">
                                 Remember me 
                                 <br>
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" name="login" class="btn btn-primary">
                                Login
                            </button>
                            <!-- extra options -->
                            <br><br>     
                            
                            <!-- <a href="index.pwdreset.php" class="btn btn-link">
                                Forgot Your Password?
                            </a>
                            <br><br> -->
                            <a href="index.signup.php" class="btn btn-link">
                                Not a user? Sign Up now !!
                            </a>

                            <?php
                                if(isset($_GET["newpwd"]))
                                {
                                    if($_GET["reset"]=="PasswordsDonotMatch"){
                                        echo '<p style="color:red;"> Passwords Do not Match!!, Try again </p>';
                                    }
                                }
                                else if(isset($_GET["newpwd"]))
                                {
                                    if($_GET["reset"]=="PasswordUpdated"){
                                        echo '<p style="color:green;"> Success!! Your password is updated</p>';
                                    }
                                }                               

                            ?>

                        </div>
                    </div>
                    <input type = "hidden" id="token" name="token">  <!--for reCaptcha--->
                    </form> <br>
                    <p style="color:red;"><?php echo $_SESSION["errorLogin"]; ?> </p>
                <!---------------------------------------------------form ends-------------------------------------------------------------->
                    
	
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


