<?php
session_start();

$url=$_SESSION["url"];
echo $url;

?>
<p> <br><br>copy the above url and paste it in your browser <p>
<!-- 
<form action="PasswordReset.php" method="post">
  
    <button type="submit" name="reset-request-submit">click here to reset your password
    </button> 
</form> -->