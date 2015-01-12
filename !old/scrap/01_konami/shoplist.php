<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php

//ネイティブDOMでデータ抽出
$entries = [];
$dom = new DOMDocument;
@$dom->loadHTMLFile('http://www.konamisportsclub.jp/shisetsu/category.php?category=all');
$xpath = new DOMXpath($dom);
foreach ($xpath->query('//tr') as $i => $node) {
if (!$i) { continue; }
$entries[] = [
 'category' => $xpath->evaluate('substring(td[1]/img/@alt, 6)', $node),
 'shopname' => $xpath->evaluate('string(td[2]/a)', $node),
 'url' => $xpath->evaluate('string(td[2]/a/@href)', $node),
 'address' => $xpath->evaluate('string(td[3])', $node),
];
}

// デバッグ用
foreach ($entries as $entry)  {
print_r($entry["category"]);
print_r($entry["shopname"]);
print_r($entry["url"]);
print_r($entry["address"]);
}


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


?>

</body>
</html>