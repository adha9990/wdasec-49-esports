<?php
	require_once("db.php");
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
				<li class="active"><a href="<?=$_SESSION["data"]["permission"]=="管理者"?"admin.php":"user.php"?>">後台管理模組</a></li>
				<li class=""><a href="game.php">活動報名系統</a></li>
				<hr>
				<a href="logout.php" class="btn">登出</a>
			</ul>			
		</div>
		<div class="right">
			<br><br>
			<h3 class="center" style="color:white;">會員專區</h3>
			<div class="well" style="margin:2% 5%;">
				<form method="POST" class="form-search center">
					<select name="sh_sel">
						<option value="uid">使用者編號</option>
						<option value="name">名稱</option>
						<option value="account">帳號</option>
						<option value="password">密碼</option>
						<option value="permission">權限</option>
					</select>
					<select name="sort">
						<option value="ASC">升冪</option>
						<option value="DESC">降冪</option>
					</select>
					<input type="text" name="sh_txt">
					<button type="submit" name="search" class="btn">查詢</button>
				</form>
				<br>
				<form method="POST">
					<table class="table center">
						<tr>
							<th>使用者編號</th>
							<th>名稱</th>
							<th>帳號</th>
							<th>密碼</th>
							<th>權限</th>
							<th>紀錄</th>
							<th>編輯</th>
							<th>刪除</th>												
						</tr>
						<?php foreach((array)$user as $i){ ?>
							<tr>
								<td><?=$i["uid"]?></td>
								<td><input type="text" name="name" value="<?=$i["name"]?>"></td>
								<td><input type="text" name="account" value="<?=$i["account"]?>"></td>
								<td>****</td>
								<td>
									<select name="permission">
										<option value="一般使用者">一般使用者</option>
										<option value="管理者" <?=$i["permission"]=="管理者"?"selected":""?>>管理者</option>
									</select>
								</td>
								<td><button type="submit" name="log" class="btn" value="<?=$i["id"]?>">紀錄</button></td>
								<td>無法修改</td>
								<td>無法刪除</td>
							</tr>
						<?php } ?>
					</table>
					<?php if(isset($_POST["log"])){ ?>
						<br><br>
						<table class="table">
							<th>使用者</th>
							<th>時間</th>
							<th>登入/登出</th>
							<th>成功/失敗</th>
							<?php foreach((array) sel("user_log",["user_id"=>$_POST["log"]]) as $i){ ?>
								<tr>
									<td><?=sel("user",["id"=>$i["user_id"]])[0]["name"]?></td>
									<td><?=$i["time"]?></td>
									<td><?=$i["log"]?></td>
									<td><?=$i["try"]?></td>
								</tr>
							<?php } ?>
						</table>
					<?php } ?>
				</form>
			</div>
		</div>
	</body>
</html>