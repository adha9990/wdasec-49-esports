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
		<style>
			button{
				width:200px;
				height:200px;
			}
		</style>
	</head>
	<body>
		<div class="left">
			<br>
			<img src="img/logo.png" width="200">
			<ul class="nav nav-list" style="margin:10%;">
				<div class="nav-header" style="font-size:20px;">電子競技網站</div>
				<hr>
				<li class="active"><a href="index.php">後台管理模組</a></li>
				<li class=""><a href="">活動報名系統</a></li>
				<hr>
			</ul>
		</div>
		<div class="right">
			<form method="POST" class="" style="margin:10% 30%;">
				<table class="center">
					<tr>
						<td><button type="button" class="btn" id="1"></td>
						<td><button type="button" class="btn" id="2"></td>
						<td><button type="button" class="btn" id="3"></td>
					</tr>                         
					<tr>                          
						<td><button type="button" class="btn" id="4"></td>
						<td><button type="button" class="btn" id="5"></td>
						<td><button type="button" class="btn" id="6"></td>
					</tr>                         
					<tr>                          
						<td><button type="button" class="btn" id="7"></td>
						<td><button type="button" class="btn" id="8"></td>
						<td><button type="button" class="btn" id="9"></td>
					</tr>
				</table>
			</form>
		</div>
		<script>
			var t = [[1,2,3],[4,5,6],[7,8,9],[1,4,7],[2,5,8],[3,6,9],[1,5,9],[3,5,7]];
			$("button").click(function(){
				if($(this)[0].style.background){
					$(this)[0].style.background=""
				}else{
					$(this)[0].style.background="red"
				}
				for(let i of t){
					let n = 0;
					for(let j of i){
						if($("#"+j)[0].style.background){
							n++
						}
					}
					if(n==3){
						alert("登入成功");
						location.href="admin.php";
					}
				}
			})
		</script>
	</body>
</html>