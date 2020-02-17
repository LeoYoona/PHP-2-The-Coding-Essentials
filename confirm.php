<?php
declare(strict_types=1);
include "showErrors.php";
include 'DB.php';
$payment_id = $_POST['id'];

$file = fopen('confirm.log', 'a');

$url = 'https://api.mollie.com/v2/payments/' . $payment_id ;

fwrite($file, $url . PHP_EOL);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer test_MD7V4hGrJAJmtF3ykQTVPhG2NTHvfd"
));

$result = curl_exec($ch);

curl_close($ch);

$json = json_decode($result, true);
fwrite($file, $json . PHP_EOL);
fclose($file);

$status = $json['status'];
    
    $DBobject = DB::getInstance();
    $conn=$DBobject->ReturnConnectionObject();
    $stmt = $conn->prepare("insert into payments (id, status) values (?, ?)");
    $stmt->bind_param('ss', $payment_id, $status );
    $stmt->execute();
    CloseCon($conn);


?>