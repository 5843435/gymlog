<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php
//curlでwebページ取得
$conn = curl_init();

curl_setopt($conn, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($conn, CURLOPT_HEADER, true);

$url = 'http://information.konamisportsclub.jp/programSearch.php?programName=%A5%DC%A5%C7%A5%A3%A5%D1%A5%F3%A5%D7';
$params = array('facilityCd' => '004446');

curl_setopt($conn, CURLOPT_URL, $url);
curl_setopt($conn, CURLOPT_POST, true);
curl_setopt($conn, CURLOPT_POSTFIELDS, $params);

$response = curl_exec($conn);

curl_close($conn);
header('content-type: text/html; charset="utf-8"');
$response = mb_convert_encoding($response, 'utf-8', 'euc-jp');

//プラグイン読込
require_once 'simple_html_dom.php';

//取得元URL指定
$html = file_get_html('$respnse');

//取得条件指定して配列に格納
$club = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[1]');
$program = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[2]');
$schedule = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[3]');
$url = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[1]/a');
$tantou = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[4]');

//クラブ名の頭の「コナミスポーツクラブ」を削除 preg_replace は配列処理可能
foreach ($club as &$val) {
$val = preg_replace('/^コナミスポーツクラブ /', '', $val->plaintext);
}
unset($val);


//スケジュールは"金曜日　09:30 （30分）"といった形になっているので
//最初の1文字を取って曜日を取得（$week）、8文字目から5文字とって時間を取得（$time）
foreach ($schedule as $val) {
 $week[] = mb_substr($val->plaintext,0,1);
 $time[] = mb_substr($val->plaintext,4,5);
}


//曜日を数値に変換　日曜日->0…
foreach ($week as &$tmp) {
switch ($tmp){
case '日';
 $tmp = 0; break;
case '月';
 $tmp = 1; break;
case '火';
 $tmp = 2; break;
case '水';
 $tmp = 3; break;
case '木';
 $tmp = 4; break;
case '金';
 $tmp = 5; break;
case '土';
 $tmp = 6; break;
}
}

//デバッグ用の表示
for ($i = 1 ; $i < count($club) ; $i++) {
echo $club[$i];
//echo $program[$i]->plaintext;
//echo $schedule[$i]->plaintext;
//echo $week[$i];
//echo $time[$i];
//echo $url[$i]->href;
//echo $tantou[$i]->plaintext;
echo '<br>';
}

/*

//DB接続
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');

// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//DBへデータ挿入
//1行目はヘッダなのでカウント用変数iは1からスタート
for ($i = 1 ; $i < count($club) ; $i++) {
	$stmt = $dbh -> prepare("INSERT INTO program (id, shop_id, program, week, time, tantou) VALUE (null, :shop_id, :program, :week, :time, :tantou)");
	$stmt->bindValue('shop_id', $club[$i], PDO::PARAM_STR);
	$stmt->bindValue('program', $program[$i]->plaintext, PDO::PARAM_STR);
	$stmt->bindValue('week', $week[$i], PDO::PARAM_STR);
	$stmt->bindValue('time', $time[$i], PDO::PARAM_STR);
	$stmt->bindValue('tantou', $tantou[$i]->plaintext, PDO::PARAM_STR);
	$stmt->execute();
}

//メモリのクリーンアップ
//循環参照によるメモリリークを回避
$html->clear();

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
*/

?>

</body>
</html>