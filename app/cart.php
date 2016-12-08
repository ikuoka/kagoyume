<?php

require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../api/common/common.php';
session_start();

//合計金額の初期化
$totalPrice = 0;

//削除ボタンが押されたらセッションに格納された商品情報を消去。
//インデックスはPOSTで取得する
if (isset($_POST['delete'])) {
    $num = intval($_POST['deleteItem']);
    if (isset($_SESSION['USERNAME'])) {
        array_splice($_SESSION['userItemInfo'], $num, 1);
    } elseif (!isset($_SESSION['USERNAME'])) {
        array_splice($_SESSION['itemInfo'], $num, 1);
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

  <?php
  // ログインしていない状態
  if (!isset($_SESSION['USERNAME'])) {
      ?>
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

  <?php
  // ログインしている状態
  } elseif (isset($_SESSION['USERNAME'])) {
      ?>
          <!--/.nav-collapse -->
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php echo h($_SESSION['USERNAME']); ?>さん！</a></li>
              <li><a href="<?php echo LOGIN.'?mode=logout'; ?>" class="scroll">ログアウト</a></li>
              <li><a href="<?php echo CART ?>" class="scroll">カート <i class="glyphicon glyphicon-shopping-cart"></i></a></li>
            </ul>
          </div>

        </div>
      </nav>
  <?php

  }
   ?>
  </header>

  <div class="container">
    <h1>カート</h1>
  </div>

    <?php
    //ログインしていない場合
    if (!isset($_SESSION['USERNAME'])) {
        for ($i = 0; $i < count($_SESSION['itemInfo']); ++$i) {
            ?>
      <div class="container">
        <div class="itemDetailImg col-sm-4">
          <img src="<?php echo $_SESSION['itemInfo'][$i][0]; ?>" alt="商品画像" />
        </div>
        <div class="itemDetailSentence col-sm-8">
          <h3><a href="<?php echo ITEM. '?itemcode=' .$_SESSION['itemInfo'][$i][3]; ?>"><?php echo $_SESSION['itemInfo'][$i][1]; ?></a></h3>
          <p>価格：<?php echo $_SESSION['itemInfo'][$i][2]; ?>円</p>
          <form action="" method="POST">
            <input type="hidden" name="deleteItem" value="<?php echo $i; ?>">
            <button type="submit" name="delete">削除</button>
          </form>
        </div>
      </div>

    <?php
    $totalPrice += $_SESSION['itemInfo'][$i][2];
        }
    //ログインしている場合
    } elseif (isset($_SESSION['USERNAME'])) {
        for ($i = 0; $i < count($_SESSION['userItemInfo']); ++$i) {
            ?>
    <div class="container">
      <div class="itemDetailImg col-sm-4">
        <img src="<?php echo $_SESSION['userItemInfo'][$i][0]; ?>" alt="商品画像" />
      </div>
      <div class="itemDetailSentence col-sm-8">
        <h3><a href="<?php echo ITEM. '?itemcode=' .$_SESSION['userItemInfo'][$i][3]; ?>"><?php echo $_SESSION['userItemInfo'][$i][1]; ?></a></h3>
        <p>価格：<?php echo $_SESSION['userItemInfo'][$i][2]; ?>円</p>
        <form action="" method="POST">
          <input type="hidden" name="deleteItem" value="<?php echo $i; ?>">
          <button type="submit" name="delete">削除</button>
        </form>
      </div>
    </div>
  <?php
    $totalPrice += $_SESSION['userItemInfo'][$i][2];
        }
    }
  ?>

  <hr>
  <div class="container">
      <p>合計金額：<?php echo $totalPrice; ?>円</p>
      <?php if (isset($_SESSION['USERNAME']) && !empty($_SESSION['userItemInfo'])) {
      ?>
      <form action="<?php echo BUY_CONF; ?>" method="POST">
        <button type="submit" name="buy_conf" value="buy_conf">購入する</button>
      </form>
      <?php
  } elseif (!isset($_SESSION['USERNAME']) && isset($_SESSION['itemInfo'])) {
      ?>
        <p><a href="<?php echo LOGIN ?>">ログインして購入する</a></p>
      <?php
  } ?>
  <?php echo return_top(); ?>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
