<?php
	require_once("db.php");
	ins("user_log",["user_id"=>$_SESSION["data"]["id"],"log"=>"登出","try"=>"成功"]);
	header("location:index.php");