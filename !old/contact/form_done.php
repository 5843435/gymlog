<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>入力完了</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen"></head>
<body>

	<header class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">GymLog</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <a href="/help/">About Us</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Service <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="/BodyPumper">BodyPumper</a></li>
              </ul>
				</li>
				<li>
						<a href="/help/">Help</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/contact" target="_blank">Contact Us</a></li>
			</ul>
		</div>
		</div>
	</header>

<br />
<br />
<br />


<div class="container">
<blockquote>
<p>入力内容</p>
</blockquote>

<?php
//フォームデータが空の場合は処理終了
if(empty($_POST['inquiry']))
{
echo '<br/>';
echo 'お問い合わせ内容を入力してください';
echo '<br/>';
echo '<br/>';
echo '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger">';
exit();
}

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