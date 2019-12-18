<?php
	session_start();
	if(!isset($_SESSION["error"])){
		$_SESSION["error"]=0;
	}
	$db=new mysqli("127.0.0.1","admin","1234","ans1_01");
	$db->query("set names utf8");
	
	function exarray($data,$o=" = ",$s=" , "){
		global $db;
		if(is_array($data)){
			$row = [];
			foreach($data as $k => $v){
				$row[]= "`$k` $o '{$db->real_escape_string($v)}'";
				
			}
			return implode($s,$row);
		}else{
			return $data;
		}
	}
	function sel($table,$data,$o=" LIKE ",$s=" AND ",$other=""){
		global $db;
		$sql = "SELECT * FROM `$table` WHERE ".exarray($data,$o,$s).$other;
		$result = $db->query($sql);
		if($result){
			$row = [];
			while($i=$result->fetch_assoc()){
				$row[]= $i;
			}
			return $row;
		}else{
			var_dump($sql);exit;
		}
	}
	function ins($table,$data,$o=" = ",$s=" , ",$other=""){
		global $db;
		$sql = "INSERT INTO `$table` SET ".exarray($data,$o,$s).$other;
		$result = $db->query($sql);
		if($result){
			return $db->insert_id;
		}else{
			var_dump($sql);exit;
		}
	}
	function upd($table,$data,$where,$o=" = ",$s=" , ",$other=""){
		global $db;
		$sql = "UPDATE `$table` SET ".exarray($data)." WHERE ".exarray($where,$o,$s).$other;
		$result = $db->query($sql);
		if($result){
			return true;
		}else{
			var_dump($sql);exit;
		}
	}
	function del($table,$where,$o=" = ",$s=" , ",$other=""){
		global $db;
		$sql = "DELETE FROM `$table` WHERE ".exarray($where,$o,$s).$other;
		$result = $db->query($sql);
		if($result){
			return true;
		}else{
			var_dump($sql);exit;
		}
	}
	function xxx($ar,$str){
		$row = [];
		foreach(explode(",",$str) as $i){
			$row[$i]=$ar[$i];
		}
		return $row;
	}
	function check_login($account,$password,$captcha){
		$data = sel("user",["account"=>$account]);
		if(count($data)>0){
			$data=$data[0];
			if($data["password"]===$password){
				if($_SESSION["captcha"]==$captcha){
					$_SESSION["data"]=$data;
					ins("user_log",["user_id"=>$data["id"],"log"=>"登入","try"=>"成功"]);
					return true;
				}else{
					ins("user_log",["user_id"=>$data["id"],"log"=>"登入","try"=>"失敗/驗證碼錯誤"]);
					return "驗證碼錯誤";
				}
			}else{
				ins("user_log",["user_id"=>$data["id"],"log"=>"登入","try"=>"失敗/密碼錯誤"]);
				return "密碼錯誤";
			}
		}else{
			return "帳號錯誤";
		}		
	}
	function convert($table){
		$table["css"]=sel("template",["id"=>$table["template_id"]])[0]["css"];
		$table["css"]=str_replace("{{電競名稱}}",$table["name"],$table["css"]);
		$table["css"]=str_replace("{{電競活動簡介}}",$table["description"],$table["css"]);
		$table["css"]=str_replace("{{活動新聞連結}}",$table["about"],$table["css"]);
		$table["css"]=str_replace("{{競賽日期}}",$table["date"],$table["css"]);
		$table["css"]=str_replace("{{報名}}","<button class='btn' type='submit' value='{$table["id"]}' name='join'>{$table["join"]}</button>",$table["css"]);
		$table["css"]=str_replace("{{圖片}}","<img src='img/{$table["img"]}' width='200'>",$table["css"]);
		return $table["css"];
	}
	function msg($str,$url=""){
		echo "<script>alert('$str');location.href='$url'</script>";
	}