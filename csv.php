<?php
	require_once("db.php");
	$data = sel("people",["activity_id"=>$_GET["id"]]);
	$row = ["活動名稱,報名成員"];
	foreach($data as $i){
		$row[] = sel("activity",["id"=>$i["activity_id"]])[0]["name"].",".sel("user",["id"=>$i["user_id"]])[0]["name"];
	}
	echo implode("\n",$row);