<?php
	require_once("db.php");
	if(isset($_POST["add"])){
		$id = ins("user",xxx($_POST,"permission,name,account,password"));
		$id = str_pad($id,4,0,STR_PAD_LEFT);
		upd("user",["uid"=>"u$id"],["id"=>(int)$id]);
		msg("新增完成");
	}
	if(isset($_POST["edit"])){
		upd("user",xxx($_POST,"permission,name,account,password"),["id"=>$_POST["edit"]]);
		msg("修改完成");
	}
	if(isset($_POST["del"])){
		del("user",["id"=>$_POST["del"]]);
		msg("刪除完成");
	}
	$user = sel("user",1);
	if(isset($_POST["search"])){
		$user = sel("user",[$_POST["sh_sel"]=>"%{$_POST["sh_txt"]}%"]," LIKE ",""," ORDER BY `{$_POST["sh_sel"]}` {$_POST["sort"]}");
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
				<li class="active"><a href="<?=$_SESSION["data"]["permission"]=="管理者"?"admin.php":"user.php"?>">後台管理模組</a></li>
				<li class=""><a href="game.php">活動報名系統</a></li>
				<hr>
				倒數計時　<input class="span2" type="number" id="time"><br>
				調整計時　<input class="span2" type="number" id="setTime" value="60"><br>
				<button class="btn" onclick="num=$('#setTime').val()">重新計時</button>
				<hr>
				<a href="logout.php" class="btn">登出</a>
			</ul>			
		</div>
		<div class="right">
			<br><br>
			<h3 class="center" style="color:white;">管理者專區</h3>
			<div class="well" style="margin:2% 5%;">
				<button type="button" onclick="add_user()" class="btn">新增用戶</button>
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
							<form method="POST">
								<tr>
									<td><?=$i["uid"]?></td>
									<td><input type="text" name="name" value="<?=$i["name"]?>"></td>
									<td><input type="text" name="account" value="<?=$i["account"]?>"></td>
									<td><input type="text" name="password" value="<?=$i["password"]?>"></td>
									<td>
										<select name="permission">
											<option value="一般使用者">一般使用者</option>
											<option value="管理者" <?=$i["permission"]=="管理者"?"selected":""?>>管理者</option>
										</select>
									</td>
									<td><button type="submit" name="log" class="btn" value="<?=$i["id"]?>">紀錄</button></td>
									<?php if($i["id"]!="0001"){ ?>
										<td><button type="submit" name="edit" class="btn" value="<?=$i["id"]?>">修改</button></td>
										<td><button type="submit" name="del" class="btn" value="<?=$i["id"]?>">刪除</button></td>
									<?php }else{ ?>
										<td>無法修改</td>
										<td>無法刪除</td>
									<?php } ?>
								</tr>
							</form>
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
				
			</div>
		</div>
		<form method="POST" class="modal hide fade" id="add">
			<h3 class="modal-header">新增用戶</h3>
			<div class="modal-body">
				<table class="center">
					<tr>
						<td>權限</td>
						<td>
							<select name="permission">
								<option value="一般使用者">一般使用者</option>
								<option value="管理者">管理者</option>
							</select>
						</td>						
					</tr>
					<tr>
						<td>名稱</td>
						<td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td>帳號</td>
						<td><input type="text" name="account"></td>
					</tr>
					<tr>
						<td>密碼</td>
						<td><input type="text" name="password"></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn" name="add">新增</button>
				<button type="button" onclick="add_user()" class="btn">返回</button>				
			</div>
		</form>
		<div class="modal hide fade" id="msg">
			<h3 class="modal-body">是否繼續?<span id="last"></span></h3>
			<div class="modal-footer">
				<button type="button" class="btn" onclick="num=$('#setTime').val();$('#msg').modal('hide');">Yes</button>
				<button type="button" class="btn" onclick="location.href='logout.php'">否</button>
			</div>
		</div>
		<script>
			function add_user(){
				$("#add").modal("toggle");
				$("#add")[0].reset();
			}
			
			var num = 60;
			setInterval(function(){
				num--
				if(num<0){
					$("#msg").modal("show");
					$("#last").text(num+6)
					if(num<-5){
						location.href="logout.php"
					}
				}else{
					time.value=num;
				}
			},1000)
		</script>
	</body>
</html>