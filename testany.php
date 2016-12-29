<!doctype html>
<!--主頁面及測試用頁面-->
<html>
<head>
	<meta charset="utf-8">
	<script src="js/mainjs.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<script  src="js/bootstrap.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="http://mybidrobot.allalla.com/jquery/jquery.ui.datepicker-zh-TW.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<title>ANLE管理</title>
</head>
<body>
	<table class="table table-bordered">
		<tr><td>查詢與建立</td><td>帳務資料</td><td>列印資料</td></tr>
		<tr><td><a href="selectid.php" class="btn btn-primary" role="button">墓籍編號</a></td><td>帳務查詢系統</td><td>年度收費清冊</td></tr>
		<tr><td><a href="selectbase.php" class="btn btn-primary" role="button">墓基編號</a></td><td>消帳作業系統</td><td>年度使用情況清冊</td></tr>
		<tr><td><a href="insertnew.php" class="btn btn-primary" role="button">新增資料建立</a></td><td>年度未繳費名冊</td><td>年度墓籍編號清冊</td></tr>
		<tr><td>遷出資料建立</td><td>年度已繳費名冊</td><td><a href="" class="btn btn-primary" role="button">收據表</a></td></tr>
	</table>
<?php
include("connect.php");
header("Content-type: text/html; charset=utf-8");
$sql="SELECT roll_id FROM  roll_main";
$result=mysql_query($sql);
echo count($result);
echo "<br/>";
echo count($row=mysql_fetch_array($result));
echo "<br/>";
while($row=mysql_fetch_array($result)){
echo $row['roll_id'];
}
?>
</body>
</html>