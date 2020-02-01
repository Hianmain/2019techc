<!doctype html>
<html lange="ja">
<head>
	<meta charset="utf8">
	<title>会員登録フォーム</title>
</head>
<body>

<?php
	if($_GET['error'] === "1"){
		print("既に同じログイン名のユーザーが存在します。別のログイン名を入力してください");
	}
?>

<form method="POST" action="./register.php" enctype="multipart/form-data">
	<div>
		ログインID：<input type="text" name="loginid" minlength="3" maxlength="20">

	</div>
	<div>
		パスワード：<input type="psssword" name="pass" minlength="6" maxlength="100">
	</div>
	<div>
		アイコン：<input type="file" name="usericon">
	</div>
	<input type="submit" value="登録">
</body>
</html>
