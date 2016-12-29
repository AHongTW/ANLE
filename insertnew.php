<?php include("connect.php");header("Content-type: text/html; charset=utf-8"); ?>
<!doctype html>
<!--新增墓籍資料頁面-->
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
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
	<title>新增墓籍資料</title>
</head>
<body>
	<form action="insertdata.php" method="post">
		<table border="0" style="width:80%" class="table table-striped" align="center">
			<colgroup>
      			<col style="width:20%">
      			<col style="width:30%">
      			<col style="width:20%">
      			<col style="width:30%">
	  		</colgroup>
			<tr><td>墓籍編號</tb><td><input type="text" name="roll_id" size="10"></td><td></td><td></td></tr>
			<tr><td>墓基編號</tb><td><input type="text" name="base_idA" size="4">區<input type="text" name="base_idB" size="3">號之<input type="text" name="base_idC" size="3"></td><td></td><td></td></tr>
			<tr><td>區碼</tb><td><input type="text" name="zone_number" size="10"></td><td>面積</td><td><input type="text" name="area" size="10"></td></tr>
			<tr><td>使用權人姓名</tb><td><input type="text" name="rightuser" size="10"></td><td></td><td></td></tr>
			<tr><td>使用人姓名</tb><td><input type="text" name="username" size="10"></td><td></td><td></td></tr>
			<tr><td>關係</tb><td><input type="text" name="relationship" size="10"></td><td>收費標準</td><td><input type="text" name="price" size="10"></td></tr>
			<tr><td>電話</tb><td><input type="text" name="phone" size="10"></td><td></td><td></td></tr>
			<tr><td>地址</tb><td><input type="text" name="address" size="25"></td><td></td><td></td></tr>
			<tr><td>啟用日期</tb><td><input type="text" name="startday" size="25"></td><td></td><td></td></tr>
			<tr><td>宗教信仰</tb><td><input type="text" name="faith" size="10"></td><td>存放方式</td><td><select name="usetype"><option value="大體">大體<option value="骨骸">骨骸<option value="骨灰">骨灰<option value="其他">其他</select></td></tr>
		</table>
		<a href="index.html" class="btn btn-primary" role="button">回前頁</a>
		<button type="submit" class="btn btn-success">新增資料</button>
	</form>
</body>
</html>