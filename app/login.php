<?php

require_once '../common/defineUtil.php';
require_once '../common/dbaccessUtil.php';
require_once '../common/scriptUtil.php';

//ログアウト処理
if ($_GET['mode'] == 'logout') {
    $_SESSION = array();
    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 1800, '/');
    }
    session_destroy();
}

session_start();

//エラーメッセージの初期化
$errorMessage = '';

//ログインボタンが押されたとき
if (isset($_POST['login'])) {

  //ユーザー名、パスワードチェック
  if (empty($_POST['username']) && empty($_POST['password'])) {
      $errorMessage = 'ユーザー名、パスワードが未入力です。';
  } elseif (empty($_POST['username'])) {
      $errorMessage = 'ユーザー名が未入力です。';
  } elseif (empty($_POST['password'])) {
      $errorMessage = 'パスワードが未入力です。';
  }

  //ユーザー名、パスワードともに入力されている場合
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
      $userdata = search_users($_POST['username']);
    //ユーザー情報が見つからなかった場合
    if ($userdata == array()) {
        $errorMessage = 'ユーザーが存在しません。';
    }
      foreach ($userdata as $stmt => $row) {
      //ユーザーが削除済みだった場合
      if ($row['deleteFlg'] == 1) {
          $errorMessage = 'ユーザーは削除されています。';
      //ユーザーが見つかった場合
      } else {
          $pass = $row['password'];
          if ($_POST['password'] === $pass) {
              session_regenerate_id(true);
              $_SESSION['USERNAME'] = $_POST['username'];
              if (isset($_SESSION['itemInfo'])) {
                  $_SESSION['userItemInfo'] = array();
                  $_SESSION['userItemInfo'] = $_SESSION['itemInfo'];
              }
              // echo '<meta http-equiv="refresh" content="0;URL='.$previous_url.'">';
              //遷移してきたページを格納
              $previous_url = $_SERVER['HTTP_REFERER'];
              header("Location: ".$previous_url, true, 303);
              exit;
          } else {
              // 認証失敗
        $errorMessage = 'ユーザIDあるいはパスワードに誤りがあります。';
          }
      }
      }
  } else {
      // 未入力なら何もしない
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>かごいっぱいのゆめ</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link href="../common/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">メニュー</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand scroll" href="<?php echo ROOT_URL; ?>"></a>
          </div>

          <!--/.nav-collapse -->
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo LOGIN; ?>" class="scroll">ログイン</a></li>
              <li><a href="<?php echo REGIST; ?>" class="scroll">会員登録</a></li>
              <li><a href="<?php echo CART ?>" class="scroll">カート <i class="glyphicon glyphicon-shopping-cart"></i></a></li>
            </ul>
          </div>

        </div>
      </nav>
  </header>

  <div class="container">
    <h1>ログイン画面</h1>
    <?php echo $errorMessage.'<br>'; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" value="LOGIN">ログイン</button>
    </form>
  </div>

  <div class="container">
    <p><a href="<?php echo REGIST; ?>">未登録の方は新規登録へ</a></p>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
