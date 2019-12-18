<?php
	require_once("db.php");
	
	if(isset($_POST["join"])){
		$check = sel("people",["user_id"=>$_SESSION["data"]["id"],"activity_id"=>$_POST["join"]]);
		if(count($check)==0){
			$date = sel("activity",["id"=>$_POST["join"]]," = ",""," AND NOW() BETWEEN `start` AND `end`");
			if(count($date)==0){
				msg("未在報名期間內");
			}else{
				$date = $date[0];
				$p = count(sel("people",["activity_id"=>$_POST["join"]]));
				if($p<$date["max"]){
					$rand = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
					$rand = substr(str_shuffle($rand),0,10);
					ins("people",["user_id"=>$_SESSION["data"]["id"],"activity_id"=>$_POST["join"],"ESN"=>$rand]);
					msg("報名完成:".$rand);
				}else{
					msg("報名人數已滿");
				}
			}
		}else{
			msg("已報名:".$check[0]["ESN"]);
		}
		
	}
	
	$activity = sel("activity",["hidden"=>"0"]," = ",""," ORDER BY `top` DESC,`date`");
	if(isset($_POST["search"])){
	$activity = sel("activity",["hidden"=>"0",$_POST["sh_sel"]=>"%{$_POST["sh_txt"]}%"]," LIKE "," AND "," ORDER BY `top` DESC,`date`");
		if(!empty($_POST["a"]) && !empty($_POST["b"])){
			$activity = sel("activity",["hidden"=>"0",$_POST["sh_sel"]=>"%{$_POST["sh_txt"]}%"]," LIKE "," AND "," AND `date` BETWEEN '{$_POST["a"]}' AND '{$_POST["b"]}' ORDER BY `top` DESC,`date`");
		}
	}
	$now = strtotime(date("Y-m-d h:i:s"));
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
						<li class="active"><a href="game.php">電競活動首頁</a></li>
						<li class=""><a href="create.php">電競活動管理精靈</a></li>
						<li class=""><a href="control.php">電競活動管理</a></li>
						<li class=""><a href="template.php">新增版型</a></li>
						<li class=""><a href="join.php">報名查詢</a></li>
					</ul>
				</div>
			</div>				
			<div class="well" style="margin:5%;">
				<form method="POST" class="form-search center">
					<input type="date" name="a">
					<input type="date" name="b">
					<input type="text" name="sh_txt">
					<select name="sh_sel">
						<option value="name">電競名稱</option>
						<option value="description">電競活動簡介</option>
						<option value="about">活動新聞連結</option>
					</select>					
					<button type="submit" name="search" class="btn">查尋</button>
				</form>
				<?php foreach($activity as $i){ ?>
					<form method="POST" class="center" style="margin:2%;">
						<h3 class="time" data-sec="<?=strtotime($i["date"])-$now?>"></h3>
						<?= convert($i) ?>
					</form>
				<?php } ?>
			</div>
		</div>
		<script>
			setInterval(function(){
				$(".time").each(function(a,b){
					var time = $(b).data("sec")
					$(b).data("sec",time-1);
					if(time<0){
						$(b).text("已過期");
					}else{
						var d = parseInt(time/24/60/60);
						time -= d*24*60*60;
						var h = parseInt(time/60/60)
						time -= h*60*60;
						var m = parseInt(time/60)
						time -= m*60;
						var s = time
						$(b).text("距離活動:"+d+"日"+h+"時"+m+"分"+s+"秒");
					}
				})
			},1000)
		</script>
	</body>
</html>