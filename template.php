<?php
	require_once("db.php");
	
	if(isset($_POST["add"])){
		ins("template",xxx($_POST,"name,css"));
		msg("新增成功");
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
				<li class=""><a href="<?=$_SESSION["data"]["permission"]=="管理者"?"admin.php":"user.php"?>">後台管理模組</a></li>
				<li class="active"><a href="">活動報名系統</a></li>
				<hr>
				<a href="logout.php" class="btn">登出</a>
			</ul>
		</div>
		<div class="right">
			<div class="navbar">
				<div class="navbar-inner" style="border-radius:0;">
					<div class="brand">電競活動</div>
					<ul class="nav">
						<li class=""><a href="game.php">電競活動首頁</a></li>
						<li class=""><a href="create.php">電競活動管理精靈</a></li>
						<li class=""><a href="control.php">電競活動管理</a></li>
						<li class="active"><a href="template.php">新增版型</a></li>
						<li class=""><a href="join.php">報名查詢</a></li>
					</ul>
				</div>
			</div>
			<form enctype="multipart/form-data" method="POST" class="well center" style="margin:10% 10%;">
				版型名稱<input type="text" name="name"><br>
				<textarea rows="20" style="width:600px;" name="css">
					<?= sel("template",1)[0]["css"] ?>
				</textarea><br>
				<button type="submit" name="add" class="btn">新增</button>
			</form>
		</div>
	</body>
</html>