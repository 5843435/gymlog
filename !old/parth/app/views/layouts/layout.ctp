<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="/parth/css/common.css" type="text/css" />
<script type="text/javascript" src="/parth/js/jquery.js"></script>
<script type="text/javascript" src="/parth/js/common.js"></script>
<title>スクレイピングプログラム</title>
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
<div id="top">
   <div id="header">
      <h1><a href="<?php echo $parth;?>">スクレイピングプログラム</a></h1>
      <div id="pr">
         <p>指定したURLから指定したタグの情報をWordPressに登録します。</p>
      <!-- /#pr --></div>
   <!-- /#header --></div>
   <div id="menu">
      <ul>
         <li><a href="<?php echo $parth;?>/items/url/" class="active">URL一括登録</a></li>
         <li><a href="<?php echo $parth;?>/items/items_add/">URL単発登録</a></li>
         <li><a href="<?php echo $parth;?>/items/submit_all/">一括スクレイピング</a></li>
         <li><a href="#" target="_blank">使い方</a></li>
      </ul>
   </div>
   <div id="topicPath">
      <a href="<?php echo $parth;?>">ホーム</a>
   <!-- /#topicPath --></div>
   <div id="contents">
      <div id="main">
         
         
         
         <?php echo $content_for_layout; ?>
      <!-- /#main --></div>
     <!-- <div id="sub">
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.html">サブメニュー1</a></li>
               <li><a href="index.html">サブメニュー2</a></li>
               <li><a href="index.html">サブメニュー3</a></li>
            </ul>
      </div>
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.html">サブメニュー4</a></li>
               <li><a href="index.html">サブメニュー5</a></li>
               <li><a href="index.html">サブメニュー6</a></li>
            </ul>
        </div>
      </div>-->
      <div id="pageTop">
         <a href="#">ページのトップへ戻る</a>
      <!-- /#pageTop --></div>
   <!-- /#contents --></div>
   <div id="footer">
      <div class="copyright">Copyright &copy; <?php echo date('Y');?> <a href="http://www.kaasan.info/" target="_blank">ITかあさん</a> All Rights Reserved.</div>
   <!-- /#footer --></div>
<!-- /#top --></div>
</body>
</html>