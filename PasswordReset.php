<?php
declare(strict_types=1);
include "AutoLoaderIncl.php";

session_start();

if(isset($_POST["reset-request-submit"]))
	{
		$selector = bin2hex(openssl_random_pseudo_bytes(8));	//to authenticate the correct user
		$token = openssl_random_pseudo_bytes(32);//to look in DB for token for respective user, //2 tokens to prevent timing attacks
		$userEmail = $_POST["email"];
		
		$url = "www.636130.infhaarlem.nl/create-new-password.php?selector=".$selector."&&validator=".bin2hex($token)."&&userEmail=".$userEmail ;
		
		$expires = date("U") + 1800; //token expires in 30mins

		//echo $selector."<br>".$token."<br>".$url."<br>".$expires;

		$pwdResetObject = new pwdReset_Service();		

		$pwdResetObject->deleteEmailAdd($userEmail); //deletes record of the email if the email alreasdy exists

		$pwdResetObject->insertTempPwdInfo($userEmail, $selector, $token, $expires);	//to insert temporary password reset information in the DB


	$to = $userEmail;
	$subject = "Reset your password for The Coding Essentials";
	$message = "We recieved your password reset request. The link to reset your password is given below.\r\n";
	$message .= "Note that this link is valid for 30 minutes only.\r\n";
	$message .="If you did not make this request, you can ignore this email.\r\n";
	$message .="Here is your password link: " .$url; 

	$headers = "From: The Coding Essentials <s636130@server.infhaarlem.nl>\r\n";
	$headers .= "Content type: text/html\r\n";
	$headers .= "MIME-Version: 1.0";
	$headers .= "Content-type: text/html; charset=iso-8859-1";
	
	mail($to, $subject, $message, $headers); 			

	$_SESSION["url"]=$url; //temporary, delete this later

	header("Location: index.pwdreset.php?reset=success");

}

else{
	header("Location: index.php");
}

	?>