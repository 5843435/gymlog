<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
<body>

<?php

//shop�e�[�u������shopid��S�����o���A�z��Ɋi�[�i�������z��ɂȂ��Ă���j
try {
 $dbh = new PDO('mysql:host=localhost; dbname=lesmills; charaset=utf8','root','Jpn12008');
 $sql ="SELECT shop_id FROM `shop` ORDER BY `shop_id` ASC";
 $stmt = $dbh->query($sql);
 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

//���[�v��
for ($i = 0, $size = count($result); $i < $size; ++$i) {
//shopid��3-4���Ȃ̂ŁA����0��⊮����
$params = array('facilityCd' => substr('000'.$result[$i]["shop_id"],-6));
//�t�@�C���ۑ��B�t�@�C�����͎{��ID�Őݒ�
file_put_contents($params['facilityCd'].".html", "test");
}

/*

//�^�C���A�E�g�������l30�b�Ȃ̂𖳐����ɕύX
set_time_limit(0);

//dom�̃v���O�C���Ǎ�
require_once 'simple_html_dom.php';

define("CHAR_SET","UTF-8");
mb_language("Japanese");

//�擾��URL�w��
$html = file_get_html("000361.html");

//�擾�����w�肵�Ĕz��Ɋi�[
$program = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[2]');
$schedule = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[3]');
$tantou = $html->find('/html/body/table[2]/tbody/tr/td[3]/table[2]/tbody/tr/td/table/tbody/tr/td[4]');

//�f�o�b�O�p
echo 
for ($i = 1, $end = count($program); $i < $end ; $i++) {
echo $program[$i];
echo $schedule[$i]->plaintext;
echo $tantou[$i]->plaintext;
echo '<br>';
}
*/
?>

</body>
</html>