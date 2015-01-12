<html>
<head>
<title>PHP TEST</title>
</head>
<body>

<?php

$options = array(
PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/my.cnf',
); 
$pdo = new PDO(
'mysql:host=localhost;dbname=lesmills',
'root', 'Jpn12008', $options
);


/*　古い接続方式
$link = mysql_connect('localhost', 'root', 'Jpn12008');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

print('<p>接続に成功しました。</p>');
*/

$db_selected = mysql_select_db('lesmills', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

print('<p>データベースを選択しました。</p>');

mysql_set_charset('utf8');


$sql ="select * from lesmills where club like '%$place%'";
$result = mysql_query($sql);
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('id='.$row['club']);
    print(',name='.$row['program']);
    print('</p>');
}

$close_flag = mysql_close($link);

if ($close_flag){
    print('<p>切断に成功しました。</p>');
}

?>
</body>
</html>