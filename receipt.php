<?php
//收據表
//error_reporting(0);解決總計預設值
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
$pdf->setHeaderData($lc=array(255,255,255));
$pdf->setPrintFooter(false);
$i=1;
$countnumber=0;
$countid="SELECT roll_id FROM  roll_main";
$countresult=mysql_query($countid);
while($row1=mysql_fetch_array($countresult)){
	$countnumber=$countnumber+1;
}
$sql="SELECT roll_main.roll_id,roll_main.base_id,roll_main.area,roll_main.address,roll_main.rightuser,price_index.price FROM  roll_main,price_index where roll_main.roll_id=price_index.roll_id";$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
	$roll_id=$row['roll_id'];
	$base_id=$row['base_id'];
	$newbase=substr($base_id,0,3) ."區" . substr($base_id,4,2) ."號之". substr($base_id,7,2);
    //更換格式100-01-00-->100區01號之00
    $area=$row['area'];
	$address=$row['address'];
	$rightuser=$row['rightuser'];
	$price=$row['price'];
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(27.0, 20.0);
	$pdf->Write(5, $rightuser, '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(90.0, 20.0);
	$pdf->Write(5, '先生/小姐  啟', '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(166.0, 35.0);
	$pdf->Write(1, $roll_id ,'');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(27.0, 35.0);
	$pdf->Write(5, '508', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(27.0, 45.0);
	$pdf->Write(5, $address, '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(162.0, 45.0);
	$pdf->Write(1, $newbase, '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(20.0, 64.0);	
    $pdf->Cell(170, 1, '', 'T', 2, 'L', false);

    $pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 68.0);
	$pdf->Write(5, '存', '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 68.0);
	$pdf->Write(5, '墓籍編號：'. $roll_id, '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(105.0, 68.0);
	$pdf->Write(5, '墓基編號：' . $newbase, '');	
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(170.0, 68.0);
	$pdf->Write(5, '面積：' . $area, '');
    $pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 84.0);
	$pdf->Write(5, '根', '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 86.0);
	$pdf->Write(5, '使用權人：' . $rightuser, '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(105.0, 86.0);
	$pdf->Write(5, '費用：' . $price, '');
	$pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 100.0);
	$pdf->Write(5, '聯', '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 104.0);
	$pdf->Write(5, '起訖日期：', '');
	$pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(62.0, 103.0);
	$pdf->Write(5, '民國 105 年 4 月 5 日起', '');
    $pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(62.0, 108.0);
	$pdf->Write(5, '民國 106 年 4 月 4 日起', '');
	$pdf->SetXY(20.0, 119.0);	
    $pdf->Cell(170, 1, '', 'T', 2, 'L', false);

    $pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 134.0);
	$pdf->Write(5, '過', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 130.0);
	$pdf->Write(5, '過帳(   )', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(125.0, 130.0);
	$pdf->Write(5, '聯單編號：', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 139.0);
	$pdf->Write(5, '墓籍編號：' . $roll_id, '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(125.0, 139.0);
	$pdf->Write(5, '墓基編號：'. $newbase, '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 154.0);
	$pdf->Write(5, '起訖日期：', '');
	$pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(61.0, 153.0);
	$pdf->Write(5, '民國 105 年 4 月 5 日起', '');
    $pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(61.0, 158.0);
	$pdf->Write(5, '民國 106 年 4 月 4 日起', '');
	$pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 149.0);
	$pdf->Write(5, '帳', '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(125.0, 154.0);
	$pdf->Write(5, '使用權人：' . $rightuser, '');
	$pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(20.0, 164.0);
	$pdf->Write(5, '聯', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(35.0, 169.0);
	$pdf->Write(5, '面　　積：'.$area, '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(125.0, 169.0);
	$pdf->Write(5, '費　　用：' .$price, '');
    $pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(160.0, 189.0);
	$pdf->Write(5, '收　費　訖　章', '');
	$pdf->SetXY(160.0, 194.0);	 
    $pdf->Cell(27, 1, '', 'T', 2, 'L', false);	

    $pdf->SetFont('edukai3', '', 18, '', true);
	$pdf->SetXY(22.0, 200.0);
	$pdf->Write(5, '清水安樂公園化市範墓園服務處代辦各別環境美化費憑證', '');
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(23.0, 209.0);
	$pdf->Write(5, '服務電話: 0492551915 0903995568　郵政劃撥帳號 02485819戶名　楊得辛', '');
	$pdf->SetXY(23.0, 220.0);
	$pdf->Cell(160, 50, '', '1', 2, 'L', false);
    $pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(24.0, 222.0);
	$pdf->Write(5, '墓基編號：'. $newbase, '');
	$pdf->SetXY(77.0, 222.0);
	$pdf->Write(5, '使用權人：'.$rightuser,'');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(24.0, 228.0);
	$pdf->Write(5, '墓籍編號：'.$roll_id, '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(77.0, 228.0);
	$pdf->Write(5, '地址：'.$address, '');
	$pdf->SetFont('edukai3', '', 12, '', true);
	$pdf->SetXY(24.0, 234.0);
	$pdf->Write(5, '起訖日期：', '');
    $pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(46.0, 234.0);
	$pdf->Write(5, '民國 105 年 4 月 5 日起', '');
    $pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(90.0, 234.0);
	$pdf->Write(5, '民國 106 年 4 月 4 日止', '');	
    $pdf->SetXY(23.0, 240.0);	 
    $pdf->Cell(160, 1, '', 'T', 2, 'L', false);	
	$pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(30.0, 240.0);
	$pdf->Write(5, '名　稱', '');	
    $pdf->SetXY(23.0, 248.0);	 
    $pdf->Cell(160, 1, '', 'T', 2, 'L', false);	
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(59.0, 240.0);
	$pdf->Write(5, '坪　位', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(89.0, 240.0);
	$pdf->Write(5, '金　額', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
	$pdf->SetXY(119.0, 240.0);
	$pdf->Write(5, '備　註', '');
	$pdf->SetFont('edukai3', '', 13, '', true);
	$pdf->SetXY(25.0, 250.0);
	$pdf->Write(5, '環境美化費', '');
    $pdf->SetFont('edukai3', '', 14, '', true);
    $pdf->SetXY(63.0, 250.0);
	$pdf->Write(5, $area, '');
	$pdf->SetXY(90.0, 250.0);
	$pdf->Write(5, $price, '');
	$pdf->SetFont('edukai3', '', 8, '', true);
	$pdf->SetXY(114.0, 249.0);
	$pdf->Write(5, '資料校正，相關資料及地址若有異動或需更正者，請', '');
    $pdf->SetFont('edukai3', '', 8, '', true);
	$pdf->SetXY(114.0, 252.0);
	$pdf->Write(5, '至服務處填寫申請書辦理資料變更', '');
	$pdf->SetFont('edukai3', '', 10, '', true);
	$pdf->SetXY(24.0, 271.0);
	$pdf->Write(5, '(本憑單收費及塗改須另加簽章後生效)　　承　辦　人：楊　得　辛　　出　納：', '');

    $pdf->SetXY(53.0, 240.0);	 
    $pdf->Cell(1, 30, '', 'L', 2, 'T', false);	
    $pdf->SetXY(81.0, 240.0);	 
    $pdf->Cell(1, 30, '', 'L', 2, 'T', false);	
    $pdf->SetXY(112.0, 240.0);	 
    $pdf->Cell(1, 30, '', 'L', 2, 'T', false);
    $i++;
    if($i<=$countnumber)
    {
    	$pdf->AddPage();
    }
}
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('receipt.pdf', 'I');
?>