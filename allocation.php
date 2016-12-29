<?php
//劃撥單
//error_reporting(0);解決總計預設值
include("connect.php");
header("Content-type: text/html; charset=utf-8");
require_once ('lib/tcpdf/tcpdf.php');
require_once('lib/tcpdf/config/lang/eng.php');
$i=1;//紀錄頁數
$y=0;//紀錄收費標準
$c=0;
$IN=$_POST['IN'];
// create new PDF document
$pdf = new TCPDF('P','mm','A3', true, 'UTF-8', false);
// ---------------------------------------------------------
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('edukai3', '', 20, '', true);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$htmlcss = '
<style>
	html,body {
	margin:0;
	padding:0;
	height:200%;}

	#footer {
	box-sizing:border-box;
	heigth:550px;
	width:100%;
	position:absolute;
	bottom:0;}

	#wrapper {
    min-height:100%;
    position:relative;}

	#id_header{
	height:200px;
	box-sizing:border-box;
	padding:10px;}

	#id_content{
	padding-tio:10px;
	padding-bottom:60px;}
</style>
<html>
<head><title></title><head>
	<body>
		<div id="wrapper">
			<div id="id_header">
				<p></p>
			</div>
			<div id="id_content">
				<p></p>
			</div>
			<div id="footer">
				
				<img src="allocation.jpg"  width="840px" height="440px" align="bottom">
			</div>
		</div>
</body></html>';
//$pdf->writeHTML($htmlcss, true, false, true, false, '');
$countnumber=0;
$countid="SELECT roll_id FROM  roll_main";
$countresult=mysql_query($countid);
while($row1=mysql_fetch_array($countresult)){
	$countnumber=$countnumber+1;
}
//$countnumber=count(mysql_fetch_array($countresult));
$sql="SELECT roll_main.roll_id,roll_main.base_id,roll_main.address,roll_main.rightuser,price_index.price FROM  roll_main,price_index where roll_main.roll_id=price_index.roll_id";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	$roll_id=$row['roll_id'];
	$base_id=$row['base_id'];
	$newbase=substr($base_id,0,3) ."區" . substr($base_id,4,2) ."號之". substr($base_id,7,2);
    //更換格式100-01-00-->100區01號之00
	$address=$row['address'];
	$rightuser=$row['rightuser'];
	$price=$row['price'];
	$pdf->SetFont('edukai3', '', 16, '', true);
	$pdf->SetXY(55.0, 60.0);
	$pdf->Write(5, $rightuser, '');
	$pdf->SetXY(90.0,60.0);
	$pdf->Write(5, '先生/小姐 啟', '');
	$pdf->SetXY(210.0,80.0);
	$pdf->Write(5, $roll_id, '');
	$pdf->SetXY(55.0, 90.0);
	$pdf->Write(5, $address, '');
	$pdf->SetXY(185.0,95.0);
	$pdf->Write(5, $newbase, '');
	$pdf->SetXY(45.0, 115.0);
	$pdf->Cell(210, 1, '', 'T', 2, 'L', false);
	$pdf->SetXY(55.0, 120.0);
	$pdf->Write(5, $IN, '');
	//匯款單
	$pdf->Image($file='allocation1.png',35.0,255.5,227,110,'PNG');

	//匯款單內容
	$pdf->SetFont('edukai3', '', 21, '', true);
	$pdf->SetXY(42.0,265.0);$pdf->Write(3,'0 2 4', '');
	$pdf->SetXY(66.0,265.0);$pdf->Write(3,'8 5', '');
	$pdf->SetXY(83.0,265.0);$pdf->Write(3,'8 9 1', '');
	$y=strlen($price);
	$v=182.5;
	for($c=1;$c<=$y;$c++){
		$u=substr($price,$y-$c,1);
		$pdf->SetXY($v, 266.0);
		$pdf->Write(5, $u , '');
		$v=$v-7.5;
	}
	$pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(111.0, 277.0);
	$pdf->Write(5, ' 楊 得 辛', '');
	$pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(40.0, 285.0);
	$pdf->Write(1, '繳款人代號請依序', '');
	$pdf->SetXY(40.0, 290.0);
	$pdf->Write(1, '取下六碼數字', '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(139.0, 286.0);
	$pdf->Write(1, 'V', '');
	$pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(40.0, 295.0);
	$pdf->Write(1, $newbase, '');
	$pdf->SetXY(103.0, 292.0);
	$pdf->Write(1, $rightuser, '');
	$pdf->SetFont('edukai3', '', 13, '', true);
	$counteraddress=mb_strlen($address,'utf-8');
//	$pdf->SetXY(100.0, 250.0);$pdf->Write(1, $counteraddress, '');
	if($counteraddress>11 and $counteraddress<=20){
		$pdf->SetXY(100.0, 310.0);$aa=mb_substr($address,0,10,"utf-8");
		$pdf->Write(1, $aa, '');
		$pdf->SetXY(100.0, 315.0);$aa=mb_substr($address,10,$length=null,"utf-8");
		$pdf->Write(1, $aa , '');
	}else if($counteraddress>20){
		$pdf->SetXY(100.0, 310.0);$aa=mb_substr($address,0,10,"utf-8");
		$pdf->Write(1, $aa, '');
		$pdf->SetXY(100.0, 315.0);$aa=mb_substr($address,10,10,"utf-8");
		$pdf->Write(1, $aa, '');
		$pdf->SetXY(100.0, 320.0);$aa=mb_substr($address,20,$length=null,"utf-8");
		$pdf->Write(1, $aa , '');
	}else{
		$pdf->SetXY(100.0, 310.0);
		$pdf->Write(1, $address, '');
	}
	
	$i++;
	if($i<=$countnumber){
		$pdf->AddPage();//判斷是否為最後一頁 若為是則跳出
	}
}
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('allocation.pdf', 'I');
?>