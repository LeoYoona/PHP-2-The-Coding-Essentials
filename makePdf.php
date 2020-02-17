<?php
session_start();

if(!isset($_SESSION['email']))
 {
     header("Location: index.php"); //if user is not logged in, redirect to user index pg
 } 

?>

<?php
require('fpdf.php');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

   //get variables / data
   $_firstname = $_POST['firstname'];
   $_lastname = $_POST['lastname'];
   $_fullname= $_firstname." ".$_lastname;
   $_songSelect = $_POST['songSelect'];
   $_email= $_POST['email'];

//start making PDF
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


/* --- Set Title --- */
$pdf->SetFont('Arial', 'B', 20);
$pdf->Text(27, 24, 'The Coding Essentials Sample Ticket');

// /* --- Text --- */
// $pdf->SetFont('', 'B', 12);
// $pdf->Text(10, 50, 'Event Name:');
// /* --- Cell --- */
// $pdf->SetXY(60, 50);
// $pdf->SetFontSize(12);
// $pdf->Cell(0, 4, 'Historic Tour', 0, 1, 'C', false);


/* --- Text --- */
$pdf->SetFont('', 'B', 12);
$pdf->Text(10, 50, 'Name: ');
/* --- Cell --- */
$pdf->SetXY(60, 50);
$pdf->Cell(0, 4, $_firstname.' '.$_lastname, 0, 1, 'C', false);

/* --- Text --- */
$pdf->SetFont('', 'B', 12);
$pdf->Text(10, 60, 'Song name: ');
/* --- Cell --- */
$pdf->SetXY(60, 60);
$pdf->Cell(0, 4, $_songSelect, 0, 1, 'C', false);

/* --- Text --- */
$pdf->SetFont('', 'B', 12);
$pdf->Text(10, 70, 'Email: ');
/* --- Cell --- */
$pdf->SetXY(60, 70);
$pdf->Cell(0, 4, $_email, 0, 1, 'C', false);
/* --- Image  --- */
$pdf->SetXY(50, 80);
$pdf->Image('img/7.jpg',50,80,90,0,'JPG');


$QR_Data = 'STAN BANGTAN SONEYONDAN';
$QR_URL = 'http://www.qr-genereren.nl/qrcode.jpg?text='.$QR_Data.'&foreColor=000000&backgroundColor=ffffff&moduleSize=16&padding=0&download=1';
$Data = file_get_contents($QR_URL);

file_put_contents('./Uploads/QR_Code.jpg', $Data);

$pdf->Image('Uploads/QR_Code.jpg', 160,75,20,20);

$pdf->Output();
?>
