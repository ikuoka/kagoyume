<?php

/** @mainpage
 * 共通関数
 */

/**
 * @file
 * @brief 共通関数
 *
 * 共通で使用する設定・関数を集めたファイルです。
 *
 * PHP version 5
 *
 */


/**
 * 使用した場所にトップページへのリンクを挿入する
 * @return トップページへのリンクのaタグ
 */
function return_top(){
    return "<a href='".ROOT_URL."'>トップへ戻る</a>";
}

/**
 * フォームの再入力時に、すでにセッションに対応した値があるときはその値を返却する
 * @param type $name formのname属性
 * @return type セッションに入力されていた値
 */
function form_value($name){
    if(isset($_POST['mode']) && $_POST['mode']=='REINPUT'){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}

/**
 * ポストからセッションに存在チェックしてから値を渡す。
 * 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
 * @param type $name
 * @return type
 */
function bind_p2s($value){
  if(!empty($_POST[$value])){
    $_SESSION[$value] = $_POST[$value];
    return $_POST[$value];
  }else{
    $_SESSION[$value] = null;
    return null;
  }
}
