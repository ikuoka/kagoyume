<?php
session_start();
require_once '../common/defineUtil.php';
require_once("../api/common/common.php");

$query = !empty($_GET["query"]) ? $_GET["query"] : "";
$sort =  !empty($_GET["sort"]) && array_key_exists($_GET["sort"], YAHOO_API_DATA::$sortOrder) ? $_GET["sort"] : "-score";
$category_id = ctype_digit($_GET["category_id"]) && array_key_exists($_GET["category_id"], YAHOO_API_DATA::$categories) ? $_GET["category_id"] : 1;

$_SESSION['query'] = $query;
$_SESSION['sort'] = $sort;
$_SESSION['category_id'] = $category_id;

if ($query != "") {
  $hits = YAHOO_CONTROLLER::deliveryItemList($category_id, $query, $sort);
  $search_word = $_GET["query"];
  $search_num = YAHOO_CONTROLLER::deliveryItemNum($category_id, $query, $sort);
}elseif($query == ""){
  $search_word = "検索キーワードを入力してください。";
  $search_num = 0;
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
              <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php print htmlspecialchars($_SESSION['USERNAME'], ENT_QUOTES); ?>さん！</a></li>
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

  <div class="SearchResult">
  <div class="container">
  <p><?php echo '検索キーワード：' .$search_word; ?></p>
  <p><?php echo '検索結果数：' .$search_num; ?></p>
  <?php
  foreach ($hits as $hit) { ?>
  <div class="Item">
      <h2><a href="<?php echo ITEM. '?itemcode=' .h($hit->Code); ?>"><?php echo h($hit->Name); ?></a></h2>
      <p><a href="<?php echo ITEM. '?itemcode=' .h($hit->Code); ?>"><img src="<?php echo h($hit->Image->Medium); ?>" /></a><a href="<?php echo ITEM. '?itemcode=' .h($hit->Code); ?>">詳細を見る</a></p>
  </div>
  <?php } ?>
  </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
