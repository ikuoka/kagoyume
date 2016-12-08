<?php

require_once '../common/defineUtil.php';
require_once '../common/dbaccessUtil.php';
require_once '../common/scriptUtil.php';
session_start();

$username = $_SESSION['USERNAME'];
$userInfo = search_users($username);

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
              <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php echo htmlspecialchars($_SESSION['USERNAME'], ENT_QUOTES); ?>さん！</a></li>
              <li><a href="<?php echo LOGIN.'?mode=logout'; ?>" class="scroll">ログアウト</a></li>
              <li><a href="<?php echo CART ?>" class="scroll">カート <i class="glyphicon glyphicon-shopping-cart"></i></a></li>
            </ul>
          </div>

        </div>
      </nav>
  </header>

  <div class="container">
    <h1>マイデータ更新画面</h1>
    <form action="<?php echo MY_UP_RESULT; ?>" method="POST">
      <?php
      foreach ($userInfo as $stmt => $row) {
      ?>
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="username" class="form-control" value="<?php print $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" value="<?php print $row['password']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="mail" class="form-control" value="<?php print $row['mail']; ?>" required>
        </div>
        <div class="form-group">
            <label>住所</label>
            <input type="textarea" name="address" class="form-control" value="<?php print $row['address']; ?>" required>
        </div>
        <button type="submit" name="update">更新</button>
        <input type="hidden" name="mode" value="UPDATE">
      <?php } ?>
    </form>
    <p><a href="<?php echo MYDATE; ?>">戻る</a></p>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
