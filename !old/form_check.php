<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
<title>入力内容確認</title>
</head>
<body>
<div class="container">
<blockquote>
<p>入力内容</p>
</blockquote>

<?php 
//入力値の取得とチェック
$date = 
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$inquiry = htmlspecialchars($_POST['inquiry'], ENT_QUOTES, 'UTF-8');
if(empty($inquiry))
{
echo '<br/>';
echo 'お問い合わせ内容を入力してください';
echo '<br/>';
echo '<a href="form.html">入力フォームへ戻る</a>';
exit();
}

?> 

<form method="post" action="form_done.php">


<table class="table table-striped table-bordered table-hover table-condensed">
<tr><td>名前</td><td><?php echo $name; ?></td></tr>
<tr><td>メールアドレス</td><td><?php echo $email; ?></td></tr>
<tr><td>内容</td><td><?php echo nl2br($inquiry); ?></td></tr>
</table>

<input type='button' onclick="history.back()" value="戻る" class="btn btn-danger">
<input type="submit" value="送信" class="btn btn-primary">


<input type="hidden" name="name" value="<?php echo $name; ?>" >
<input type="hidden" name="email" value="<?php echo $email; ?>" >
<input type="hidden" name="inquiry" value="<?php echo $inquiry; ?>" >


</table>
</form>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

