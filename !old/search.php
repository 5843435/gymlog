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

/*

$stmt = $dbh->prepare('SELECT * FROM lesmills WHERE club LIKE ?');
$stmt->bindValue(1, $place);
$stmt->execute();

foreach ($stmt as $row) {
    printf($row['club'], $row['program']);
}
*/


foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $club) {
 var_dump($club['club']);
}

while ($data = mysql_fetch_assoc($sql)) {
    print('<p>');
    print('id='.$data['club']);
    print(',name='.$data['program']);
    print('</p>');
}

?>
</body>
</html>