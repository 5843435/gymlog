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
$html = file_get_html('http://www.jexer.jp/fitness/index.html');

//取得条件指定して配列に格納
$shopname = $html->find('//*[@id="network"]/div[1]/dl/dd[1]/ol/li/a/span/text()');

for ($j = 1, $end = count($shopname); $j < $end ; ++$j) {
//先頭10文字を削除
// $shop_id[$j] = mb_substr($shopname[$j], 10);
//先頭10文字削除した上で "/" 以降を削除
// $shop_id[$j] = mb_substr($shop_id[$j], 0, strpos($shop_id[$j],'/'));
// echo $shop_id[$j].'<BR>';
 echo $shopname[$j]->plaintext.'<BR>';
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