<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>
</head>

<body>

<?php

/*///////////////////////
以下のプログラミングは指定したURLから指定した要素のデータを
このファイルへアクセスすることによって実行される
お手軽スクレイピングのサンプルスクリプトです。
このスクレイピングの元ファイルは

ダウンロード
http://simplehtmldom.sourceforge.net/manual.htm

要素の指定の仕方はこちらが参考になります
PHP Simple HTML DOM Parserの使用方法
http://www.crystal-creation.com/web-appli/technical-information/programming/php/library/simplehtmldom/manual.htm

必ずスクレイピングしたURLの記述、登録したいデータベースの情報(DNSを設定)

仮にこのスクリプトがhttp://kaasan.biz/dom.php　に設置されていたとしたら、
http://kaasan.biz/dom.phpにアクセスされるたびにDBへの登録が実行されます。
///////////////////////*/



//スクレイピングしたいURL
$url = 'http://flixs-system.com/poison/newface.php';




//エラー出力処理。PHPの設定で、エラーが出力されない設定なら、以下を書いておく
echo ini_get('display_errors');

 if (!ini_get('display_errors')) {
     ini_set('display_errors', 1);
 }

//ライブラリのロード
/*ここからMysqlへの接続処理*/
require_once 'MDB2.php';

//DSN
$db = "mysql://kaasan:sena1105@localhost/kaasan_biz?charset=utf8";

//接続
$mdb2 =& MDB2::factory($db);

//フェッチモード設定
$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);
/*ここまでがMysqlへの接続処理*/


/*スクレイピングのプログラム　ここから*/
include_once('simple_html_dom.php');// simple_html_dom.php読み込み
  
//　ごめんなさい、これいらなかった

define("CHAR_SET","UTF-8");

  
// 文字化け対策のおまじない的（？）なもの。
mb_language("Japanese");

//スクレイピングしたいURL  
$html = file_get_html($url);

//試しに出力しているだけなので、以下２行は必要なければ書かなくてよいです
foreach($html->find('#girls_list_area  ul') as $ul)
foreach( $ul->find( 'li' ) as $li )
echo $li . '<br>';


?>



</body>
</html>