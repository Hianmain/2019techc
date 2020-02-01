<?php

session_start();
?>

<h1>プロフィールページ</h1>

<hr>

<?php if(empty($_SESSION['user_login_name'])): ?>
        ログインしてください。ログイン<a href="./login_form.php">こちら</a>
<?php else: ?>
<?php    
$user = $_SESSION['user_login_name'];
        $dbh = new PDO('mysql:host=manjibase-1.cbsgkdihfxre.us-east-1.rds.amazonaws.com;dbname=keijiban', 'admin', 'fCX0os1m6pV9sos3zlJC');
	$select_sth = $dbh->prepare("select usericon from users where loginid = '$user' ");
	$select_sth->execute();
        $rows = $select_sth->fetchAll();
?>
<?php foreach($rows as $row) : ?>
	<?php if(!empty($row['usericon'])) { ?>
        <p>
		<img src="/static/usericon/<?php echo $row['usericon']; ?>" width="20px">：<?php echo($_SESSION['user_login_name']) ?>
        </p>
<?php } ?>
<?php endforeach; ?>
<a href="keijiban.php">投稿ページはこちらから</a>
<a href="logout.php">ログアウト</a>
<?php endif; ?>
<hr>

<?php
	$select_sth = $dbh->prepare("select * from bbs where name = '$user' order by id desc");
	$select_sth->execute();
	$rows = $select_sth->fetchAll();
?>

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
