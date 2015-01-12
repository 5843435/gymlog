<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php

//①shopテーブルからshopidを全件抽出し、配列に格納（多次元配列になっている）
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');
 $sql ="SELECT shop_id FROM `shop` ORDER BY `shop_id` ASC";
 $stmt = $dbh->query($sql);
 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

//②curlの抽出文作成。その際、shopidが3-4桁なので、頭に0を補完する

$conn = curl_init();

curl_setopt($conn, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($conn, CURLOPT_HEADER, true);

$url = 'http://information.konamisportsclub.jp/programSearch.php?programName=%A5%DC%A5%C7%A5%A3%A5%D1%A5%F3%A5%D7';
$params = array('facilityCd' => '004446');

var_dump($params);
/*
foreach ($results as $result) {
 $params = array('facilityCd' => substr('000'.$result["shop_id"],-6));
*/
 curl_setopt($conn, CURLOPT_URL, $url);
 curl_setopt($conn, CURLOPT_POST, true);
 curl_setopt($conn, CURLOPT_POSTFIELDS, $params);

 $response = curl_exec($conn);

 curl_close($conn);
// header('content-type: text/html; charset="utf-8"');
// $response = mb_convert_encoding($response, 'utf-8', 'euc-jp');
// print_r($response);
 file_put_contents($params['facilityCd'].".html", "$response");

?>
</body>
</html>