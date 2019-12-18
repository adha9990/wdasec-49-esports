<?php
	require_once("db.php");
	
	if(isset($_POST["del"])){
		del("people",["id"=>$_POST["del"]]);
		msg("以取消報名");
	}
	
	$activity=[];
	if(isset($_POST["search"])){
		if(!empty($_POST["sh_txt"])){
			$activity = sel("people",["ESN"=>$_POST["sh_txt"]]);
		}
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
						<li class=""><a href="template.php">新增版型</a></li>
						<li class="active"><a href="join.php">報名查詢</a></li>
					</ul>
				</div>
			</div>
			<div style="margin:10% 20%;"  class="well center">
				<form method="POST" >
					<input type="text" name="sh_txt" class="form-search">				
					<button type="submit" name="search" class="btn">查尋</button>
				</form>
				<table class="table">
					<tr>
						<th>活動名稱</th>
						<th>日期</th>
						<th>會員名稱</th>
						<th>序號</th>
						<th>取消報名</th>
					</tr>
					<?php foreach((array) $activity as $i){ ?>
					<form method="POST">
						<tr>
							<td><?=sel("activity",["id"=>$i["activity_id"]])[0]["name"]?></td>
							<td><?=sel("activity",["id"=>$i["activity_id"]])[0]["date"]?></td>
							<td><?=sel("user",["id"=>$i["user_id"]])[0]["name"]?></td>
							<td><?=$i["ESN"]?></td>
							<td><button type="submit" name="del" value="<?=$i["id"]?>" class="btn">取消報名</button></td>
						</tr>
					</form>
					<?php } ?>
				</table>
			</div>
		</div>
	</body>
</html>