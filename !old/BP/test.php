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


/*�@�Â��ڑ�����
$link = mysql_connect('localhost', 'root', 'Jpn12008');
if (!$link) {
    die('�ڑ����s�ł��B'.mysql_error());
}

print('<p>�ڑ��ɐ������܂����B</p>');
*/

$db_selected = mysql_select_db('lesmills', $link);
if (!$db_selected){
    die('�f�[�^�x�[�X�I�����s�ł��B'.mysql_error());
}

print('<p>�f�[�^�x�[�X��I�����܂����B</p>');

mysql_set_charset('utf8');


$sql ="select * from lesmills where club like '%$place%'";
$result = mysql_query($sql);
if (!$result) {
    die('�N�G���[�����s���܂����B'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('id='.$row['club']);
    print(',name='.$row['program']);
    print('</p>');
}

$close_flag = mysql_close($link);

if ($close_flag){
    print('<p>�ؒf�ɐ������܂����B</p>');
}

?>
</body>
</html>