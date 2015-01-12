<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php

//東京時間に設定
date_default_timezone_set('Asia/Tokyo');
//処理開始時刻を表示（デバッグ用）
//echo date("Y-m-d H:i:s").'<BR>'; 



//タイムアウトが初期値30秒なのを無制限に変更
set_time_limit(0);

//domのプラグイン読込
require_once '../simple_html_dom.php';

//shopテーブルからshopidを全件抽出し、配列に格納（多次元配列になっている）
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');
 $sql ="SELECT shop_id FROM `shop` ORDER BY `shop_id` ASC";
 $stmt = $dbh->query($sql);
 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//いったんprogramテーブルを削除
 $truncate = 'TRUNCATE program';
 $stmt = $dbh->query($truncate);

//ループ文
for ($i = 0, $size = count($result); $i < $size; ++$i) {

//取得元URL指定
$url = 'http://information.konamisportsclub.jp/programSearch.php?programName=%A5%DC%A5%C7%A5%A3%A5%D1%A5%F3%A5%D7';

//shopidが3-4桁なので、頭に0を補完する
$params = array('facilityCd' => substr('000'.$result[$i]["shop_id"],-6));



//url取得の初期化
$conn = curl_init();
curl_setopt($conn, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($conn, CURLOPT_HEADER, true);
curl_setopt($conn, CURLOPT_URL, $url);
curl_setopt($conn, CURLOPT_POST, true);
curl_setopt($conn, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($conn);
curl_close($conn);

// UTF-8で取得する場合は指定。元のページがeuc-jpなのでutf-8に無理やり変換するとブラウザで見た時文字化ける。
// header('content-type: text/html; charset="utf-8"');
// $response = mb_convert_encoding($response, 'utf-8', 'euc-jp');

// デバッグ用。画面に表示する
// print_r($response);

//ファイル保存。ファイル名は施設IDで設定
file_put_contents($params['facilityCd'].".html", "$response");

//1処理ごとに10秒待つ。10アクセスごとに1分待つ。
 if ($i % 10 != 0) {
  sleep(10);
 } else {
  sleep(60);
}


//取得元URL指定
$html = file_get_html($params['facilityCd'].".html");

//取得条件指定して配列に格納
$program = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[2]');
$schedule = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[3]');
$tantou = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[4]');



//スケジュールは"金曜日　09:30 （30分）"といった形になっているので
//最初の1文字を取って曜日を取得（$week）、8文字目から5文字とって時間を取得（$time）
for ($k = 0; $k < count($schedule); ++$k) {
 $time[$k] = mb_substr($schedule[$k]->plaintext,4,5,"utf-8");
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


//デバッグ用
/*
echo $params['facilityCd'];
echo '<br>';
for ($j = 1, $end = count($program); $j < $end ; ++$j) {
echo $program[$j].'<BR>';
echo $week[$j].'<BR>';
echo $time[$j].'<BR>';
echo $tantou[$j].'<BR>';
echo '<br>';
}
*/


//DBへデータ挿入
for ($l = 1 ; $l < count($program) ; $l++) {
	$stmt = $dbh -> prepare("INSERT INTO program (shop_id, program, week, time, tantou) VALUE (:shop_id, :program, :week, :time, :tantou)");
	$stmt->bindValue('shop_id', $params['facilityCd'], PDO::PARAM_STR);
	$stmt->bindValue('program', $program[$l]->plaintext, PDO::PARAM_STR);
	$stmt->bindValue('week', $week[$l], PDO::PARAM_STR);
	$stmt->bindValue('time', $time[$l], PDO::PARAM_STR);
	$stmt->bindValue('tantou', $tantou[$l]->plaintext, PDO::PARAM_STR);
	$stmt->execute();
}

//メモリのクリーンアップ
//循環参照によるメモリリークを回避
$html->clear();
}

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

//処理終了時刻を表示（デバッグ用）
//echo date("Y-m-d H:i:s"); 

?>

</body>
</html>