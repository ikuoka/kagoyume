<?php

require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';

if(!$_POST['mode']=="CONFIRM"){
      echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
      echo return_top();
}else{

session_start();

//ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
$confirm_values = array(
  'username' => bind_p2s('username'),
  'password' => bind_p2s('password'),
  'mail' => bind_p2s('mail'),
  'address' => bind_p2s('address'),
);

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

    <?php
    //1つでも未入力項目があったら表示しない
    if (!in_array(null, $confirm_values, true)) {
        ?>
    <div class="container">
    <h1>登録確認画面</h1>

    ユーザー名:<?php echo $confirm_values['username']; ?><br>
    パスワード:<?php echo $confirm_values['password']; ?><br>
    Email:<?php echo $confirm_values['mail']; ?><br>
    住所:<?php echo $confirm_values['address']; ?><br><br>

    <p>上記の内容で登録します。よろしいですか？</p>
    <form action="<?php echo REGIST_COMP; ?>" method="POST">
      <button type="submit" name="regist">登録する</button>
      <input type="hidden" name="mode" value="RESULT">
    </form>
    </div>

    <?php

    } else {
        ?>
    <div class="container">
     <h1>入力項目が不完全です</h1>
     <p>再度入力を行ってください</p>
           <h2>不完全な項目</h2>
           <?php
           //連想配列内の未入力項目を検出して表示
           foreach ($confirm_values as $key => $value) {
               if ($value == null) {
                   if ($key == 'username') {
                       echo 'ユーザー名';
                   }
                   if ($key == 'password') {
                       echo 'パスワード';
                   }
                   if ($key == 'mail') {
                       echo 'Eメール';
                   }
                   if ($key == 'address') {
                       echo '住所';
                   }
                   echo 'が未記入です<br>';
               }
           }
    } ?>
    </div>

    <div class="container">
    <form action="<?php echo REGIST; ?>" method="POST">
      <button type="submit" name="back">戻る</button>
      <input type="hidden" name="mode" value="REINPUT">
    </form>
    </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
<?php } ?>
