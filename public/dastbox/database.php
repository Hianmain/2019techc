<?php

//ログイン処理

function login($userid, $pass){
	$dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');
	$dbh->query('set names utf8');
	$sql = "select * from users where userid = :userid and pass = :pass";
	$stt = $db->prepare($sql);
	$stt->bindParam(':userid', $userid);
	$stt->bindParam(':pass', $pass);
	$stt->execute();
	while($row  = $stt->fetc()){
		$result['id'] = $row['id'];
		$result['userid'] = $row['userid'];
		$result['pass'] = $row['pass'];
	}
	if(isset($result)){
		return $result;
	}
}

//ログイン認証
function authCheck($userid, $pass){
	$dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');
	$db->query('set names utf8');
	$sql = "select * from users where userid = :userid and pass = :pass";
	$stt = $db->prepare($sql);
	$stt->bindParam(':userid' , $userid);
	$stt->bindParam(':pass' , $pass);
	$stt->execute();
	while($row = $stt-> fetch()){
		$result['id'] = $row['id'];
                $result['userid'] = $row['userid'];
                $result['pass'] = $row['pass'];
	}
	if(isset($result)){
		return $result;
	}
}
