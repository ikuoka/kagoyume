<?php

require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
require_once '../api/common/common.php';
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
    <h1>ユーザー情報</h1>
    <?php
    foreach ($userInfo as $stmt => $row) {
    ?>
    <p>
    名前：<?php echo $row['name']; ?><br>
    パスワード：<?php echo $row['password']; ?><br>
    Email：<?php echo $row['mail']; ?><br>
    住所：<?php echo $row['address']; ?><br>
    購入金額：<?php $row['total'] == null ? print 0 : print $row['total']; ?>円
    </p>
    <?php
    }
    ?>
    <p>
      <a href="<?php echo MY_HISTORY ?>">購入履歴</a><br>
      <a href="<?php echo MY_UPDATE; ?>">更新</a><br>
      <a href="<?php echo MY_DELETE; ?>">削除</a>
    </p>
    <?php echo return_top(); ?>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
