<?php 

require_once("fpdf/fpdf.php");
 require_once("require/database_settings.php");
 require_once("require/database.php");
    
 $database = new Database(HOSTNAME,USERNAME,PASSWORD,DATABASE);

 $pdf = new FPDF();

 $query = "SELECT * FROM user WHERE first_name='".$_REQUEST['user_name']."'";

 $result = $database->query_excute($query);
 $user = mysqli_fetch_assoc($result);

 // echo $result->num_rows;

$pdf->AddPage();
$pdf->SetTextColor(2,2,200);
$pdf->SetFont("courier","B",24);

$pdf->SetXY(80,5);
$pdf->Cell(60,10,"Login Pdf",0,0,"C");
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("courier","",16);
$pdf->Ln(20);
$pdf->Cell(50,10,"First Name",0,0);
$pdf->Cell(100,10,$user['first_name'],0,1,'C');
$pdf->Cell(50,10,"Last Name",0,0);
$pdf->Cell(100,10,$user['last_name'],0,1,'C');
$pdf->Cell(50,10,"Email",0,0);
$pdf->Cell(100,10,$user['email'],0,1,'C');
$pdf->Cell(50,10,"Password",0,0);
$pdf->Cell(100,10,$user['password'],0,1,'C');
$pdf->Cell(50,10,"Gender",0,0);
$pdf->Cell(100,10,$user['gender'],0,1,'C');
$pdf->Cell(50,10,"Date of Birth",0,0);
$pdf->Cell(100,10,$user['date_of_birth'],0,1,'C');
$pdf->Cell(50,10,"Address",0,0);
$pdf->Cell(100,10,$user['address'],0,1,'C');

$pdf->Output("I","user.pdf");


?>