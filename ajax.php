<?php
	require_once("db.php");
	echo sel("template",["id"=>$_GET["id"]])[0]["css"];