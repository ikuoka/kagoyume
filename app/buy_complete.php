<?php

require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccessUtil.php';
require_once '../api/common/common.php';
session_start();

//直リン禁止
if(!isset($_SESSION['USERNAME']) || !isset($_POST['buy_comp'])){
   echo '<meta http-equiv="refresh" content="0;URL='.REDIRECT.'">';
   exit;
}else{

//buy_tに挿入するデータを変数に格納
$totalPrice = intval($_POST['total_price']);
$type = $_POST['delivery'];
$username = $_SESSION['USERNAME'];
$userID = return_userID($username);

//商品コードを配列として格納
//複数の商品がカートにある場合は複数分DBに挿入するため
$itemCodeArray = array();
for ($i = 0; $i < count($_SESSION['userItemInfo']); ++$i) {
    $itemCodeArray[] = $_SESSION['userItemInfo'][$i][3];
}

//user_tの合計金額(total)にカートの金額を足す。
total_price_add($userID, $totalPrice);

//buy_tに購入情報を挿入
//複数の商品がある場合はその数に応じて挿入が繰り返される
foreach ($itemCodeArray as $itemCode) {
  insert_items($userID, $itemCode, $type);
}

//カートを空にする
$_SESSION['userItemInfo'] = array();

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
              <li><a href="<?php echo MYDATE; ?>" class="scroll">ようこそ<?php echo h($_SESSION['USERNAME']); ?>さん！</a></li>
              <li><a href="<?php echo LOGIN.'?mode=logout'; ?>" class="scroll">ログアウト</a></li>
              <li><a href="<?php echo CART ?>" class="scroll">カート <i class="glyphicon glyphicon-shopping-cart"></i></a></li>
            </ul>
          </div>

        </div>
      </nav>

  </header>

  <div class="container">
    <h1>購入が完了しました。</h1>
    <?php echo return_top(); ?>
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
<?php } ?>
