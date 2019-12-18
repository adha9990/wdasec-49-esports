<?php
	session_start();
	$a = rand(0,9).rand(0,9);
	$b = rand(0,9).rand(0,9);
	$_SESSION["captcha"]=$a+$b;
	echo "$a%2b$b";