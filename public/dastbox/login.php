<?php
session_start();
require_once('./database.php'); // データベースアクセスファイル読み込み
require_once('./auth.php'); // ログイン認証ファイル読み込み
$errorMessage = ""; // エラーメッセージ初期化
// ログイン処理
if ($_POST['mode']=="login") {
  if(!empty($_POST['form']['userid']) && !empty($_POST['form']['pass'])){
    if ($account=login($_POST['form']['userid'], $_POST['form']['pass'])){
      $_SESSION['account'] = $account;
      header("Location: ./login.php");
    // ログイン失敗時の表示
    } else {
      $errorMessage = "ログインに失敗しました。";
    }
  } else {
    $errorMessage = "メールアドレスとパスワードを入力してください。";
  }
}
?>
<?php if($login){ ?>
  echo "ログインしました。";
<?php } else { ?>
  <?php echo $errorMessage; ?>
　<h1>ログイン画面</h1>
  ユーザーID：<input type="text" name="form[userid]" value="" placeholder=ユーザーID入力して下さい。"><br>
  パスワード：<input type="password" name="form[pass]" value="" placeholder="パスワードを入力して下さい。"><br>
  <input type="hidden" name="mode" value="login">
  <input type="submit" name="login" value="ログイン">
<?php } ?>
