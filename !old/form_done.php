<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
<title>入力完了</title>
</head>
<body>
<div class="container">
<blockquote>
<p>入力内容</p>
</blockquote>

<?php
//フォームデータが空の場合は処理終了
if(isset($_POST)==false )
{
echo '入力されておりません。';
echo '<a href="form.html">入力フォームへ戻る</a>';
exit();
}
?>


<?php
date_default_timezone_set('Asia/Tokyo');

$date = date("Y-m-d H:i:s"); 
$name = htmlspecialchars($_POST['name'], ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$inquiry = htmlspecialchars($_POST['inquiry'], ENT_QUOTES,'UTF-8');

$line = array($date, $name, $email, $inquiry);
mb_convert_variables("SJIS-win", "UTF-8", $line);
//エクセルはSJIS-winしか読まないのでUTF-8からSJIS-winへ変換が必要。

//CSVファイルへの書き込み
$file_name = "inquiry.csv";
$fp = fopen($file_name, 'a');


$result = fputcsv($fp, $line);
fclose($fp);

if($result)
{
$result_message = "ありがとうございました。";
}
else 
{
$result_message = "エラーが発生しました。";
}
echo '<hr/>';
echo '<p>'.$result_message.'</p>';
echo '<hr/>';
echo '<br/>';
echo '<a href="http://gymlog.club/">トップへ戻る</a>';

/*
//管理者へアンケートされた事を伝えるメール本文の組立
$to = "akinobu.katou@gmail.com";
$title = "[メールフォームより]";
$header = "FROM:{$email}";
$body = <<<EOM
----------------------------
[gymlobからのメール]

名前:{$name}
メールアドレス：{$email}
内容：{$inquiry} 
---------------------------
EOM;

//メール送信の実行
$mail = mb_send_mail($to, $title,$body,$header);//mb_send_mail(宛先、件名、本文、送付者情報) の順番
if(!$mail)
{
echo '内容に不備があります、もう一度入力してください。<br/><br/><br/>';
echo '<a href="form.html">入力フォームへ戻る</a>';
exit();
}
else
{
$_SESSION = null;
echo '<p>メールを送信しました。</p>';
}
*/
?>
</body>
</html>