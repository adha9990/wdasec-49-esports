<?php
	require_once("db.php");
	
	if(isset($_POST["del"])){
		del("activity",xxx($_POST,"name,description,date,about,img,join,start,end,max,template_id,hidden,top"));
		msg("刪除完成");
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
						<li class="active"><a href="control.php">電競活動管理</a></li>
						<li class=""><a href="template.php">新增版型</a></li>
						<li class=""><a href="join.php">報名查詢</a></li>
					</ul>
				</div>
			</div>				
			<div class="well" style="margin:5%;">
				<table class="table center">
					<tr>
						<th>電競名稱</th>
						<th>競賽日期</th>
						<th>更多</th>
						<th>匯出</th>
						<th>編輯</th>						
						<th>刪除</th>
					</tr>
					<?php foreach((array)sel("activity",1) as $i){ ?>
						<tr>
							<td><?=$i["name"]?></td>
							<td><?=$i["date"]?></td>
							<td>...</td>
							<td><a href="csv.php?id=<?=$i["id"]?>" download="test.csv" class="btn">匯出</a></td>
							<td><a class="btn" href="edit.php?id=<?=$i["id"]?>">編輯</a></td>
							<td><button type="submit" name="del" class="btn" value="<?=$i["id"]?>">刪除</button></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<script>
		</script>
	</body>
</html>