<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>入力内容確認</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
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
//入力値の取得とチェック
if(empty($_POST['inquiry']))
{
echo '<br/>';
echo 'お問い合わせ内容を入力してください';
echo '<br/>';
echo '<br/>';
echo '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger">';
exit();
}

$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$inquiry = htmlspecialchars($_POST['inquiry'], ENT_QUOTES, 'UTF-8');


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

