<?php

//ログイン名とパスワード
if( empty($_POST['loginid']) || empty($_POST['pass']) || strlen($_POST['loginid']) < 3 || strlen($_POST['loginid']) > 20 || strlen($_POST['pass']) < 6 || strlen($_POST['pass']) > 100 ){
	header("http/1.1 302 found");
	header("Location: ./register_form.php/error=1");
	return;
}

// ファイルのアップロード処理
$filename = null;
// ファイルの存在確認
if ($_FILES['usericon']['size'] > 0) {
    // 画像かどうかのチェック
    if (exif_imagetype($_FILES['usericon']['tmp_name'])) {
        // アップロードされたファイルの元々のファイル名から拡張子を取得
        $ext = pathinfo($_FILES['usericon']['name'], PATHINFO_EXTENSION);
        // ランダムな値でファイル名を生成
        $filename = uniqid() . "." . $ext;
        $filepath = "/src/2019techc/public/static/usericon/" . $filename;
        // ファイルを保存
        move_uploaded_file($_FILES['usericon']['tmp_name'], $filepath);
    }
}

//var_dump($_POST['loginid']);

//接続
$dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');

$select_sth = $dbh->prepare('select count(id) from users where loginid = :loginid');
$select_sth->execute(['loginid' => $_POST['loginid']]);
$rows = $select_sth->fetchAll();
if($rows[0][0] !== "0"){
	header("http/1.1 302 found");
	header("Location: ./register_from.php?erroe=2");
	return;
}

//パスワードのハッシュ化
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

//insertします
$insert_sth = $dbh->prepare("insert into users (loginid, pass, usericon) values (:loginid, :pass, :usericon)");
$insert_sth->execute(array(
	':loginid' => $_POST['loginid'],
	':pass' => $pass,
	':usericon' => $filename,
));

//投稿が完了したので閲覧画面に飛ばす
header("http/1,1 303 see other");
header("Location: ./register_finish.php");
