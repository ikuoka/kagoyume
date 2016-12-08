<?php

require_once '../common/defineUtil.php';
require_once '../api/common/common.php';
session_start();

//合計金額の初期化
$totalPrice = 0;

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
    <h1>購入確認</h1>
  </div>

    <?php
        for ($i = 0; $i < count($_SESSION['userItemInfo']); ++$i) {
            ?>
    <div class="container">
        <p><?php echo $_SESSION['userItemInfo'][$i][1]; ?></p>
        <p>価格：<?php echo $_SESSION['userItemInfo'][$i][2]; ?>円</p>
    </div>
  <?php
    $totalPrice += $_SESSION['userItemInfo'][$i][2];
        }
  ?>

  <hr>
  <div class="container">
    <div class="">
      <p>合計金額：<?php echo $totalPrice; ?>円</p>
      <form action="<?php echo BUY_COMP; ?>" method="POST">
        発送方法：
        <input type="radio" value="1" name="delivery" checked>メール便
        <input type="radio" value="2" name="delivery">通常便<br>
        <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>" />
        <button type="submit" name="buy_comp" value="buy_comp">上記の内容で購入する</button>
      </form>
      <p><a href="<?php echo CART; ?>">カートに戻る</a></p>
    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
