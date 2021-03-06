<?php
//墓籍編號名冊
//error_reporting(0);解決總計預設值
include("connect.php");
header("Content-type: text/html; charset=utf-8");
include_once ('lib/tcpdf/tcpdf.php');
require_once('lib/tcpdf/config/lang/eng.php');
class PDF_report1 extends TCPDF
{
    // Load table data from file
	public function LoadData() {
        // Read file lines
      //  $lines = file($file);
   /*     foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;*/
    }

    // Colored table
    public function ColoredTable($header) {
        // Colors, line width and bold font
    	$this->SetFillColor(255, 0, 0);
    	$this->SetTextColor(0);
    	$this->SetDrawColor(128, 0, 0);
    	$this->SetLineWidth(0.4);
    	$this->SetFont('', 'B');
        // Header
        $w = array(25,45,15,40,35,30);//表格欄數為6並設定欄位寬度
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
        	$this->Cell($w[$i], 7, $header[$i], 'B', 0, 'C', 0);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(225, 255, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data 列出墓籍編號及相關資料
        $fill = 0;//true為不透明 false為透明
        $sql="SELECT * FROM  roll_main ORDER BY roll_id ASC";
        $result=mysql_query($sql);
        while($row=mysql_fetch_array($result)){
        	$roll_id=$row['roll_id'];
        	$base_id=$row['base_id'];
        	$newbase=substr($base_id,0,3) ."區" . substr($base_id,4,2) ."號之". substr($base_id,7,2);//更換格式100-01-00-->100區01號之00
        	$area=$row['area'];
        	$rightuser=$row['rightuser'];
        	$username=$row['username'];
        	$this->Cell($w[0], 6, $roll_id, 0, 0, 'C', $fill);
        	$this->Cell($w[1], 6, $newbase, 0, 0, 'R', $fill);
        	$this->Cell($w[2], 6, $area, 0, 0, 'R', $fill);
        	$this->Cell($w[3], 6, $rightuser, 0, 0, 'L', $fill);
        	$this->Cell($w[4], 6, $username, 0, 0, 'L', $fill);
        	$this->Cell($w[5], 6, '', 0, 0, 'R', $fill);        	
        	$this->Ln();//換行
    	}
 	}
}

$pdf = new PDF_report1('P','mm','A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola');
$pdf->SetTitle('allroll_idview');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// set font 文字(繁體中文) UTF-8
$pdf->SetFont('msungstdlight', '', 16);
// set default header data 頁首文字設定
$pdf->setPrintHeader(false);
// set header and footer fonts 頁首.尾字型設定
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// add a page
$pdf->AddPage();
// column titles
$header = array('墓籍編號', '墓基編號','面積', '使用權人姓名', '使用者姓名','使用情況');
// data loading 
$data = $pdf->LoadData();
// print colored table
$pdf->ColoredTable($header);
$pdf->Output('allroll_idview.pdf', 'I');
?>