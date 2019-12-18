<?php
	require_once("db.php");
	if(isset($_POST["submit"])){
		$f = check_login($_POST["account"],$_POST["password"],$_POST["captcha"]);
		if($f===true){
			$_SESSION["error"]=0;
			if($_SESSION["data"]["permission"]=="管理者"){
				header("location:login.php");
			}else{
				msg("登入成功","user.php");
			}
		}else{
			$_SESSION["error"]+=1;
			if($_SESSION["error"]>2){
				$_SESSION["error"]=0;
				msg("$f","error.php");
			}else{
				msg("$f","index.php");
			}
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
				<li class="active"><a href="">後台管理模組</a></li>
				<li class=""><a href="">活動報名系統</a></li>
				<hr>
			</ul>
		</div>
		<div class="right">
			<form method="POST" class="well" style="margin:15% 30%;">
				<table class="center">
					<tr>
						<td>帳號</td>
						<td><input type="text" name="account"></td>
					</tr>
					<tr>
						<td>密碼</td>
						<td><input type="text" name="password"></td>
					</tr>
					<tr>
						<td>圖片驗證碼</td>
						<td><input type="text" id="captcha" name="captcha"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php for($i=0;$i<10;$i++){ ?>
								<img class="img" src="svg.php?n=<?=$i?>" data-value="<?=$i?>">
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<img id="img">
						</td>
					</tr>					
					<tr>
						<td></td>
						<td>
							<button type="submit" name="submit" class="btn">送出</button>
							<button type="reset" class="btn">重設</button>
							<button type="button" onclick="reset_captcha()" class="btn">驗證碼重新產生</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<script>
			function reset_captcha(){
				fetch("captcha.php")
				.then(res=>res.text())
				.then(res=>{
					console.log((res[0]+res[1])*1+(res[5]+res[6])*1)
					$("#img").attr("src","svg.php?n="+res)
				})
			}
			reset_captcha()
			
			$(".img").draggable({helper:"clone"})
			$("#captcha").droppable({
				drop:function(a,b){
					this.value+=$(b.helper).data("value")
				}
			})
		</script>
	</body>
</html>