<?php

session_start();

$dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');

$select_sth = $dbh->prepare('select name, body, created_at, filename from bbs order by id desc');
$select_sth->execute();
$rows = $select_sth->fetchAll();

?>


<!doctype html>
<html lang="ja">
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>掲示板</h1>
	<?php if(empty($_SESSION['user_login_name'])): ?>
	ログインしないと投稿できません。ログイン<a href="./login_form.php">こちら</a>
	<?php else: ?>

	<a href="profile.php">プロフィールページへ</a>
	<a href="logout.php">ログアウト</a>
	<form action="add.php" method="post" enctype="multipart/form-data">
		<!-- 名　　前：<input type="text" name="name"><br> -->
		名　　前：<?php echo($_SESSION['user_login_name']) ?><br>
		コメント：<textarea name="body" rows="4" cols="40"></textarea><br>
		画　　像：<input type="file" name="upload_image"><br>
	<button type="submit" value="送信">送信</button>
</form>
<?php endif; ?>

<hr>

<?php foreach($rows as $row) : ?>

<div>
	<?php echo "投稿者名　".$row['name']."<br>"."投稿日時".$row['created_at']; ?><br>
	<?php echo "コメント　".$row['body']; ?><br>
<?php if(!empty($row['filename'])) { ?>
	<p>
		<img src="/static/images/<?php echo $row['filename']; ?>" width="200px">
	</p>
<?php } ?>
<hr>
</div>
<?php endforeach; ?>

</body>
</html>
