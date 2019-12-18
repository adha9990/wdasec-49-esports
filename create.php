<?php
	require_once("db.php");
	
	if(isset($_POST["add"])){
		if($_FILES["img"]["error"]==0){
			$_POST["img"] = md5(time().$_FILES["img"]["name"]).".png";
			move_uploaded_file($_FILES["img"]["tmp_name"],"img/{$_POST["img"]}");
		}else{
			$_POST["img"] = "";
		}
		ins("activity",xxx($_POST,"name,description,date,about,img,join,start,end,max,template_id,hidden,top"));
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
						<li class="active"><a href="create.php">電競活動管理精靈</a></li>
						<li class=""><a href="control.php">電競活動管理</a></li>
						<li class=""><a href="template.php">新增版型</a></li>
						<li class=""><a href="join.php">報名查詢</a></li>
					</ul>
				</div>
			</div>				
			<form class="well center" style="margin:8% 30%;height:600px;" method="POST" enctype="multipart/form-data">
				<div class="sel">
					<h3>選擇版型</h3>
					<div style="height:500px;">
						<select name="template_id" id="template_id" onchange="lok()">
							<?php foreach((array) sel("template",1) as $i){ ?>
								<option value="<?=$i["id"]?>"><?=$i["name"]?></option>
							<?php } ?>
						</select>
						<div id="tmp"></div>
					</div>
					<button type="button" class="btn pull-right">下一步</button>
				</div>
				<div class="sel">
					<h3>填寫資料</h3>
					<div style="height:500px;">
						<table class="center">
							<tr>
								<td>電競名稱</td>
								<td><input type="text" name="name" id="name"></td>
							</tr>
							<tr>
								<td>電競活動簡介</td>
								<td><input type="text" name="description" id="description"></td>
							</tr>
							<tr>
								<td>競賽日期</td>
								<td><input type="date" name="date" id="date"></td>
							</tr>
							<tr>
								<td>活動新聞連結</td>
								<td><input type="text" name="about" id="about"></td>
							</tr>
							<tr>
								<td>上傳圖片</td>
								<td><input type="file" name="img" id="img"></td>
							</tr>
							<tr>
								<td>報名</td>
								<td><input type="text" name="join" id="join"></td>
							</tr>
							<tr>
								<td>開放報名</td>
								<td><input type="date" name="start"></td>
							</tr>
							<tr>
								<td>截止報名</td>
								<td><input type="date" name="end"></td>
							</tr>
							<tr>
								<td>人數限制</td>
								<td><input type="number" name="max"></td>
							</tr>
						</table>
					</div>
					<button type="button" class="btn pull-left">上一步</button>
					<button type="button" class="btn pull-right">下一步</button>
				</div>
				<div class="sel">
					<h3>預覽</h3>
					<div style="height:500px;" id="see">
						
					</div>
					<button type="button" class="btn pull-left">上一步</button>
					<button type="button" class="btn pull-right">下一步</button>
				</div>
				<div class="sel">
					<h3>確認送出</h3>
					<div style="height:500px;">
						隱藏
						<select name="hidden">
							<option value="0">否</option>
							<option value="1">是</option>
						</select><br>
						置頂
						<select name="top">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div>
					<button type="button" class="btn pull-left">上一步</button>
					<button type="submit" name="add" class="btn pull-right">完成</button>
				</div>
			</form>
		</div>
		<script>
			$(".sel:not(:first-child)").hide()
			$(".pull-left").click(function(){
				$(this).parent().hide().prev().show()
			})
			$(".pull-right").click(function(){
				$(this).parents("div.sel").hide().next().show()
				preview()
			})
			function lok(){
				fetch("ajax.php?id="+$("#template_id").val())
				.then(res=>res.text())
				.then(res=>{
					$("#tmp").html(res)
				})
			}
			lok();
			function preview(){
				fetch("ajax.php?id="+$("#template_id").val())
				.then(res=>res.text())
				.then(res=>{
					res = res.replace("{{電競名稱}}",$("#name").val())
					res = res.replace("{{電競活動簡介}}",$("#description").val())
					res = res.replace("{{活動新聞連結}}",$("#about").val())
					res = res.replace("{{競賽日期}}",$("#date").val())
					res = res.replace("{{報名}}",$("#join").val())
					//console.log($("#img")[0].files)
					if($("#img")[0].files.length!=0){
						var image = URL.createObjectURL($("#img")[0].files[0])
						res = res.replace("{{圖片}}","<img src='"+image+"' width='200'>")
					}else{
						res = res.replace("{{圖片}}","未選擇圖片")
					}
					$("#see").html(res)
				})
			}
			preview()
		</script>
	</body>
</html>