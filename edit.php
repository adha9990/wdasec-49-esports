<?php
	require_once("db.php");
	
	if(isset($_POST["edit"])){
		if($_FILES["img"]["error"]==0){
			$_POST["img"] = md5(time().$_FILES["img"]["name"]).".png";
			move_uploaded_file($_FILES["img"]["tmp_name"],"img/{$_POST["img"]}");
		}else{
			$_POST["img"] = sel("activity",["id"=>$_POST["edit"]])[0]["img"];
		}
		if($_POST["top"]){
			upd("activity",["top"=>"0"],1);
		}
		upd("activity",xxx($_POST,"name,description,date,about,img,join,start,end,max,template_id,hidden,top"),["id"=>$_POST['edit']]);
		msg("編輯成功","control.php");
	}
	$data = sel("activity",["id"=>$_GET["id"]])[0];
	//var_dump($data);
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
			<form enctype="multipart/form-data" method="POST" class="well" style="margin:10% 30%;">
				<table class="center">
					<tr>
						<td>選擇版型</td>
						<td>
							<select name="template_id" id="template_id">
								<?php foreach((array) sel("template",1) as $i){ ?>
									<option value="<?=$i["id"]?>"><?=$i["name"]?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>電競名稱</td>
						<td><input type="text" name="name" id="name" value="<?=$data["name"]?>"></td>
					</tr>
					<tr>
						<td>電競活動簡介</td>
						<td><input type="text" name="description" id="description" value="<?=$data["description"]?>"></td>
					</tr>
					<tr>
						<td>競賽日期</td>
						<td><input type="date" name="date" id="date" value="<?=$data["date"]?>"></td>
					</tr>
					<tr>
						<td>活動新聞連結</td>
						<td><input type="text" name="about" id="about" value="<?=$data["about"]?>"></td>
					</tr>
					<tr>
						<td>上傳圖片</td>
						<td><input type="file" name="img" id="img"></td>
					</tr>
					<tr>
						<td>報名</td>
						<td><input type="text" name="join" id="join" value="<?=$data["join"]?>"></td>
					</tr>
					<tr>
						<td>開放報名</td>
						<td><input type="date" name="start" value="<?=$data["start"]?>"></td>
					</tr>
					<tr>
						<td>截止報名</td>
						<td><input type="date" name="end" value="<?=$data["end"]?>"></td>
					</tr>
					<tr>
						<td>人數限制</td>
						<td><input type="number" name="max" value="<?=$data["max"]?>"></td>
					</tr>
					<tr>
						<td>隱藏</td>
						<td>
							<select name="hidden">
								<option value="0">否</option>
								<option value="1" <?=$data["hidden"]?"selected":""?>>是</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>置頂</td>
						<td>
							<select name="top">
								<option value="0">否</option>
								<option value="1" <?=$data["top"]?"selected":""?>>是</option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button type="submit" name="edit" value="<?=$data["id"]?>" class="btn">修改</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>