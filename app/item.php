<?php

require_once '../common/defineUtil.php';
require_once("../api/common/common.php");
session_start();

// フォームから受け取った値をセッションに保存
// 商品詳細ページから戻った時に検索画面を表示させるために使用
$sort = $_SESSION['sort'];
$query = $_SESSION['query'];
$category_id = $_SESSION['category_id'];

//GETしたitemcodeで商品のxmlを取得
$itemcode = $_GET['itemcode'];
$xml = YAHOO_CONTROLLER::getItemDetail($itemcode);
$hits = $xml->Result->Hit;

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
  if (!isset($_SESSION["USERNAME"])) {
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
  }else if(isset($_SESSION['USERNAME'])){
  ?>
          <!--/.nav-collapse -->
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php print h($_SESSION['USERNAME']); ?>さん！</a></li>
              <li><a href="<?php echo LOGIN .'?mode=logout'; ?>" class="scroll">ログアウト</a></li>
              <li><a href="<?php echo CART ?>" class="scroll">カート <i class="glyphicon glyphicon-shopping-cart"></i></a></li>
            </ul>
          </div>

        </div>
      </nav>
  <?php
  }
   ?>
  </header>

  <div class="itemDetail">
  <div class="container">
    <div class="row">
    <div class="itemDetailImg col-sm-4">
      <img src="<?php echo $hits->Image->Medium; ?>" alt="商品画像" />
    </div>
    <div class="itemDetailSentence col-sm-8">
    <h2>商品名：<?php echo $hits->Name; ?></h2>
    詳細：<?php echo htmlspecialchars_decode($hits->Description); ?>
    <p>
    価格：<?php echo $hits->Price; ?><br>
    評価：<?php echo $hits->Review->Rate; ?>
    </p>
    <form action="<? echo ADD; ?>" method="POST">
      <button name="add">カートに入れる</button>
      <input type="hidden" name="itemcode" value="<?php echo $itemcode; ?>">
    </form>
    <a href="<?php echo SEARCH. '?query=' .$query. '&sort=' .$sort. '&category_id=' .$category_id; ?>">検索結果に戻る</a>
    </div>
  </div>
  </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
