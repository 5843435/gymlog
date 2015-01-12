<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>検索結果</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56429220-1', 'auto');
  ga('send', 'pageview');

</script>


<!--#include virtual="/include/header.txt" -->

<br />
<br />
<br />


<?php


try {
 $dbh = new PDO('mysql:host=localhost;dbname=lesmills','root','Jpn12008');

//フォームから引き渡された変数のセット
 $place = htmlspecialchars($_REQUEST['place'],ENT_QUOTES, "UTF-8");



$sql ="SELECT * FROM shop WHERE address LIKE '%$place%'";
$stmt = $dbh->query($sql);


} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

?>


  <div class="container">
  <div class="table-responsive">
     <table id="sort" class="table table-striped table-bordered table-hover table-condensed">
<thead>
<tr>
<td>クラブ名</td>
<td>住所</td>
<td>カテゴリ</td>
</tr>
</thead>
<tbody>

<?php 
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $club) {
	print 	'<tr>
	<td><a target="_blank" href="' . $club['url'] . '">' . $club['shopname'] . '</a></td>
	<td>' . $club['address'] . '</td>
	<td>' . $club['category'] . '</td>
	</tr>' . "\n";
}

?>
</tbody>
</table>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
   $('#sort').dataTable({
      "oLanguage" : {
         "sProcessing":   "処理中...",
         "sLengthMenu":   "_MENU_ 件表示",
         "sZeroRecords":  "データはありません。",
         "sInfo":         "_START_件～_END_件を表示（全_TOTAL_ 件中）",
         "sInfoEmpty":    " 0 件中 0 から 0 まで表示",
         "sInfoFiltered": "（全 _MAX_ 件より抽出）",
         "sInfoPostFix":  "",
         "sSearch":       "検索フィルター:",
         "sUrl":          "",
         "oPaginate": {
             "sFirst":    "先頭",
             "sPrevious": "前ページ",
             "sNext":     "次ページ",
             "sLast":     "最終"
         }
      },
	bFilter:false,
	bProcessing: true,
    "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 2 ] }
    ],
   });
});
</script>
  </body>
</html>