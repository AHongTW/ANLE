<?php
require_once('lib/tcpdf/tcpdf.php');
require_once('lib/tcpdf/config/lang/eng.php');
$pdf = new TCPDF_FONTS();
$fontname=$pdf->addTTFfont('lib/tcpdf/fonts/bkai00mp.ttf','TrueTypeUnicode','',32);
var_dump($fontname);
?>