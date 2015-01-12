<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php


//domのプラグイン読込
require_once '../simple_html_dom.php';

//取得元URL指定
$html = file_get_html('http://www.tipness.co.jp/schedule/SHP036/');

//取得条件指定して配列に格納
$program = $html->find('//*[@id="contents"]/table/tbody/tr/td');

/*
//スケジュールは"月曜日：20:10〜21:00"といった形になっているので
//最初の1文字を取って曜日を取得（$week）、8文字目から5文字とって時間を取得（$time）
for ($k = 0; $k < count($schedule); ++$k) {
 $time[$k] = mb_substr($schedule[$k],4,5,"utf-8");
 $week[$k] = mb_substr($schedule[$k]->plaintext,0,1,"utf-8");
 switch ($week[$k]){
 case '日';
  $week[$k] = 0; break;
 case '月';
  $week[$k] = 1; break;
 case '火';
  $week[$k] = 2; break;
 case '水';
  $week[$k] = 3; break;
 case '木';
  $week[$k] = 4; break;
 case '金';
  $week[$k] = 5; break;
 case '土';
  $week[$k] = 6; break;
}
}
*/

//デバッグ用
for ($j = 1, $end = count($program); $j < $end ; ++$j) {
 echo $program[$j]->plaintext.'<BR>';
// echo $schedule[$j].'<BR>';

// $tag[$j] = mb_substr($tag[$j], 15);
// $shop_id[$j] = mb_substr($tag[$j], 0, strpos($tag[$j],'/'));
// echo $shop_id[$j].'<BR>';
// echo $time[$j].'<BR>';
// echo $week[$j].'<BR>';
// echo '<a href="http://www.central.co.jp/club/' . $shop_id[$j] . '/">リンク</a><br>' ;
 echo '<br>';
}


/*
//DB接続
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');

//DBをいったん削除
	$stmt = $dbh -> prepare("TRUNCATE shop");
	$stmt->execute();

//DBへデータ挿入
foreach ($entries as $entry)  {
	$stmt = $dbh -> query("SET NAMES utf8;");
	$stmt = $dbh -> prepare("INSERT INTO shop (shop_id, category, shopname, url, address) VALUE (:shop_id, :category, :shopname, :url, :address)");
	$stmt->bindValue('shop_id',substr($entry["url"], 41, 4), PDO::PARAM_INT);
	$stmt->bindValue('category', $entry["category"], PDO::PARAM_STR);
	$stmt->bindValue('shopname', $entry["shopname"], PDO::PARAM_STR);
	$stmt->bindValue('url', $entry["url"], PDO::PARAM_STR);
	$stmt->bindValue('address', $entry["address"], PDO::PARAM_STR);
	$stmt->execute();
}

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

*/
?>

</body>
</html>