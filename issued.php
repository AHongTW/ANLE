<?php
//發文明細
error_reporting(0);//解決總計預設值
include("connect.php");
header("Content-type: text/html; charset=utf-8");
require_once ('lib/tcpdf/tcpdf.php');
require_once('lib/tcpdf/config/lang/eng.php');
// create new PDF document
$pdf = new TCPDF('P','mm','A4', true, 'UTF-8', false);
// ---------------------------------------------------------
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('edukai3', '', 20, '', true);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->setHeaderData(false);
$pdf->setPrintFooter(false);
$i=1;
$countnumber=0;
$allcheck=$_POST['allcheck'];
$notpay=$_POST['notpay'];
$base_idA=$_POST['base_idA'];$base_idB=$_POST['base_idB'];$base_idC=$_POST['base_idC'];
$base_id=$base_idA ."-". $base_idB ."-".$base_idC;
$IN=$_POST['IN'];

if($allcheck!=null){
	$countid="SELECT roll_id FROM  roll_main";
	$countresult=mysql_query($countid);
	while($row1=mysql_fetch_array($countresult)){
		$countnumber=$countnumber+1;
	}
	$sql="SELECT * FROM  roll_main";
	$result=mysql_query($sql);
}else if($notpay!=null){
	$countid="SELECT roll_id FROM  roll_main";
	$countresult=mysql_query($countid);
	while($row1=mysql_fetch_array($countresult)){
		$countnumber=$countnumber+1;
	}
	$sql="SELECT roll_main.roll_id,roll_main.base_id,roll_main.area,roll_main.address,roll_main.rightuser,price_index.price FROM  roll_main,price_index where roll_main.roll_id=price_index.roll_id";
	$result=mysql_query($sql);
}else if($base_id!=null){
	$countid="SELECT roll_id FROM  roll_main where base_id='".$base_id."'";
	$countresult=mysql_query($countid);
	while($row1=mysql_fetch_array($countresult)){
		$countnumber=$countnumber+1;
	}
	$sql="SELECT * FROM  roll_main where base_id='".$base_id."'";
	$result=mysql_query($sql);
}

$htmlcss = '
<html>
<head>	<meta charset="utf-8">
	<script src="js/mainjs.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<script src="js/bootstrap.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="http://mybidrobot.allalla.com/jquery/jquery.ui.datepicker-zh-TW.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /><title></title><head>
	<body>
		<div><p class="text-justify">'.$IN.'</p></div>
	</body>
</html>';

while($row=mysql_fetch_array($result)){
	$roll_id=$row['roll_id'];
	$base_id=$row['base_id'];
	$newbase=substr($base_id,0,3) ."區" . substr($base_id,4,2) ."號之". substr($base_id,7,2);
    //更換格式100-01-00-->100區01號之00
	$address=$row['address'];
	$rightuser=$row['rightuser'];
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(27.0, 20.0);
	$pdf->Write(5, $rightuser, '');
	$pdf->SetXY(90.0, 20.0);
	$pdf->Write(5, '先生/小姐  啟', '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(166.0, 35.0);
	$pdf->Write(1, $roll_id ,'');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(27.0, 35.0);
	$pdf->Write(5, '508', '');
	$pdf->SetXY(27.0, 45.0);
	$pdf->Write(5, $address, '');
	$pdf->SetXY(162.0, 45.0);
	$pdf->Write(1, $newbase, '');

	$pdf->SetXY(10.0, 64.0);
	$pdf->Cell(190, 1, '', 'T', 2, 'L', false);
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->setxy(10.0,65.0);
//	$pdf->writeHTML($htmlcss, true, false, true, false, '');
	$pdf->write(1,$IN,12,'');
	$i++;
	if($i<=$countnumber)
	{
		$pdf->AddPage();
	}
}
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('issued.pdf', 'I');
?>