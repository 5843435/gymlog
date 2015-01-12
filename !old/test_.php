<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>DB接続結果</title>
</head>
<body>

<?php

try {
 $dbh = new PDO('mysql:host=localhost;dbname=lesmills','root','Jpn12008');
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

$place = $_POST['place'];
/*　曜日定義(あとで使う）

$date = $_POST['date'];
$youbi = date("l", strtotime(date));

*/

echo $dbh->query("select count(*) from lesmills where club like '%$place%'")->fetchColumn() . " 件がヒットしました";
$sql ="select * from lesmills where club like '%$place%'";
$stmt = $dbh->query($sql);
?>

<table>
<tr><th>番号</th><th>都市名</th></tr>

<?php 
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $club) {
	print '<tr><td>' . $club['club'] . '</td><td>' . $club['program'] . '</td></tr>' . "\n";
}
?>

</table>
</body>
</html>