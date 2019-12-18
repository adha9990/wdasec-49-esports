<?php
	require_once("db.php");
	
	if(isset($_POST["search"])){
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/jquery-ui-1.11.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/default.css" rel="stylesheet">		
	</head>
	<body>
		<div class="left">
			<br>
			<img src="img/logo.png" width="200">
			<ul class="nav nav-list" style="margin:10%;">
				<div class="nav-header" style="font-size:20px;">電子競技網站</div>
				<hr>
				<li class="active"><a href="">後台管理模組</a></li>
				<li class=""><a href="">活動報名系統</a></li>
			</ul>
		</div>
		<div class="right">
			<div style="margin:20% 40%;"  class="well center">
				<h3 style="color:red;">連續錯誤三次!!!</h3>
				<a href="index.php" class="btn">返回</a>
			</div>
		</div>
	</body>
</html>