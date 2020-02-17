<?php

// Multiple recipients

$to = '636130@student.inholland.nl'; // note the comma



// Subject

$subject = 'Birthday Reminders for August';



// Message

$message = '

<html>

<head>

  <title>Birthday Reminders for August</title>

</head>

<body>

  <p> hi

</body>

</html>

';



// To send HTML mail, the Content-type header must be set

$headers[] = 'MIME-Version: 1.0';

$headers[] = 'Content-type: text/html; charset=iso-8859-1';



// Additional headers

//$headers[] = 'To: Mary <636130@student.inhollland.nl>, Kelly <mbhat2442@gmail.com>';

//$headers[] = 'From: Birthday Reminder <birthday@example.com>';

//$headers[] = 'Cc: birthdayarchive@example.com';

//$headers[] = 'Bcc: birthdaycheck@example.com';



// Mail it

mail($to, $subject, $message, implode("\r\n", $headers));

?>