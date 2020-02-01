<?php
/*
var_dump($_POST['loginid']);
var_dump($_POST['pass']);
        exit;
 */
// ログイン名とパスワードが期待したものでない場合はフォームに戻す
if( empty($_POST['loginid']) || empty($_POST['pass'])
    || strlen($_POST['loginid']) < 3 || strlen($_POST['loginid']) > 20
    || strlen($_POST['pass']) < 6 || strlen($_POST['pass']) > 100
) { 
  header("HTTP/1.1 302 Found");
  header("Location: ./login_form.php?error=1");
  return;
}

/*
var_dump($_POST['loginid']);
var_dump($_POST['pass']);
exit;
 */
//接続

$dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');

$select_sth = $dbh->prepare('SELECT id, loginid, pass FROM users WHERE loginid = :loginid');
$select_sth->execute(['loginid' => $_POST['loginid']]);
$rows = $select_sth->fetchAll();
if (empty($rows)) {
  // ログイン名が正しくない場合
  header("HTTP/1.1 302 Found");
  header("Location: ./login_form.php?error=1");
  return;
}


$user = $rows[0];


if(!password_verify($_POST['pass'], $user['pass'])){
	header("HTTP/1.1 302 Found");
  	header("Location: ./login_form.php?error=1");
  	return;
}


//セッション開始
session_start();
$_SESSION['user_login_name'] = $user["loginid"];

header("HTTP/1.1 303 See Other");
header("Location: ./login_finish.php");

?>
