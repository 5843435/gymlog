<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php

//shopテーブルからshopidを全件抽出し、配列に格納（多次元配列になっている）
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');
 $sql ="SELECT shop_id FROM `shop` ORDER BY `shop_id` ASC";
 $stmt = $dbh->query($sql);
 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

//ループ文
for ($i = 0, $size = count($result); $i < $size; ++$i) {
//shopidが3-4桁なので、頭に0を補完する
$params = array('facilityCd' => substr('000'.$result[$i]["shop_id"],-6));
//ファイル保存。ファイル名は施設IDで設定
file_put_contents($params['facilityCd'].".html", "test");
}

/*

//タイムアウトが初期値30秒なのを無制限に変更
set_time_limit(0);

//domのプラグイン読込
require_once 'simple_html_dom.php';

define("CHAR_SET","UTF-8");
mb_language("Japanese");

//取得元URL指定
$html = file_get_html("000361.html");

//取得条件指定して配列に格納
$program = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[2]');
$schedule = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[3]');
$tantou = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[4]');

//デバッグ用
echo 
for ($i = 1, $end = count($program); $i < $end ; $i++) {
echo $program[$i];
echo $schedule[$i]->plaintext;
echo $tantou[$i]->plaintext;
echo '<br>';
}
*/
?>

</body>
</html>