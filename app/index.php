<?php

require_once '../common/defineUtil.php';
require_once("../api/common/common.php");
session_start();

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

  <div class="jumbotron" id="top">
  <div class="bgImgEffect">
   <div class="container">
     <h1><img src="../assets/logo_white.png" alt="かごいっぱいのゆめ"></h1>
     <p>「かごいっぱいのゆめ」はあなたに最高のお買い物体験を提供します。</p>
     <p>『金銭取引が絶対に発生しない』、『いくらでも購入できる』全く新しいECサイトです。</p>
     <a class="btn btn-primary btn-lg scroll" href="#search" role="button">いますぐ始める »</a>
   </div>
 </div>
 </div>

<div class="about" id="about">
  <div class="container">
    <h2>特徴</h2>
    <div class="row">
        <div class="col-sm-6">
            <img src="../assets/about1.png" class="hvr-float" alt="お金に困らない">
            <h3>お金に困らない</h3>
            <p>「かごいっぱいのゆめ」を使えばあなたは一生お金に困ることは無いでしょう。すべての商品が無料で購入することができ、あなたは人生で最高の幸福を獲得することが出来ます。</p>
        </div>
        <div class="col-sm-6">
            <img src="../assets/about2.png" class="hvr-float" alt="誰でも使える">
            <h3>誰でも使える</h3>
            <p>「かごいっぱいのゆめ」は「老若男女、誰でも使いやすいECサイト」をテーマに作成されました。商品を購入するのに何十分も時間がかかってしまう、会員登録が煩わしい、と考える余地も無いでしょう。</p>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <img src="../assets/about3.png" class="hvr-float" alt="お金に困らない">
              <h3>完全無料</h3>
              <p>「かごいっぱいのゆめ」を使用するにあたってあなたに費用がかかることは一切ありません。会員登録は完全無料です。</p>
          </div>
          <div class="col-sm-6">
              <img src="../assets/about4.png" class="hvr-float" alt="誰でも使える">
              <h3>みんな幸せ</h3>
              <p>「かごいっぱいのゆめ」はすべての人々に幸福を与えます。最高の無料生活を手にしましょう。</p>
          </div>
      </div>
  </div>
</div>

<div class="searchContents" id="search">
<div class="bgImgEffect">
 <div class="container">
   <div class="search_title font_color_white">
     <h1>さっそく始めよう</h1>
     <p>欲しいものを検索してみましょう。</p>
   </div>
   <div class="search_api">

     <form action="<?php echo SEARCH; ?>" class="Search">
     <span class="font_color_white">表示順序：</span>
     <select name="sort">
     <?php foreach (YAHOO_API_DATA::$sortOrder as $key => $value) { ?>
     <option value="<?php echo h($key); ?>" <?php if($sort == $key) echo "selected=\"selected\""; ?>><?php echo h($value);?></option>
     <?php } ?>
   </select><br>
     <span class="font_color_white">キーワード検索：</span>
     <select name="category_id">
     <?php foreach (YAHOO_API_DATA::$categories as $id => $name) { ?>
     <option value="<?php echo h($id); ?>" <?php if($category_id == $id) echo "selected=\"selected\""; ?>><?php echo h($name);?></option>
     <?php } ?>
   </select><br>
     <input type="text" name="query" value="<?php echo h($query); ?>"/><br>
     <input type="submit" value="検索"/>
     </form>

   </div>
 </div>
</div>
</div>

  <footer class="footer">
    <div class="container">
      <p class="footer_font">Copyright © 2016 horita kouki All Rights Reserved.</p>
    </div>
  </footer>

  <script>
    //ページ内スクロール処理
      jQuery(function(){
       $('.scroll').click(function() {
          var speed = 400;
          var href= $(this).attr("href");
          var target = $(href == "#" || href == "" ? 'html' : href);
          var position = target.offset().top;
          $('body,html').animate({scrollTop:position}, speed, 'swing');
          return false;
       });
    });
    </script>

</body>
</html>
