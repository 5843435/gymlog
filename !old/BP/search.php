<html>
<body>
<?php 
//データベースに接続 
if (!$con = mysql_connect("localhost", "root", "Jpn12008")) {
echo "接続エラー" ;
exit ;
}

//データベースを選択
if (!mysql_select_db("lesmills", $con)) {
echo "データベース選択エラー" ;
exit ;
}

//フォームで送られてきた条件を元にSELECT文を作成
$sql = "select club, url, program, week, time, appendix from lesmills " ;
$sql . = "where club like '%$place% ' " ;

//SELECT文を実行 
if (!$res = mysql_query($sql)) {
echo "SQLエラー<BR>" ;
exit ;
}

//検索結果表示
echo "<table border=1>" ;
echo "<tr><td>company</td><td>club</td><td>url</td><td>program</td><td>week</td><td>time</td><td>appendix</td></tr>" ;
while($row = mysql_fetch_array($res)){
echo "<tr>" ;
echo "<td>" . $row["company"] . "</td>" ;
echo "<td>" . $row["club"] . "</td>" ;
echo "<td>" . $row["url"] . "</td>" ; 
echo "<td>" . $row["program"] . "</td>" ;
echo "<td>" . $row["week"] . "</td>" ;
echo "<td>" . $row["time"] . "</td>" ; 
echo "<td>" . $row["appendix"] . "</td>" ; 
echo "</tr>" ;
} 
echo "</table>" ;

//結果セットの開放
mysql_free_result ($res) ; 

//データベースから切断
mysql_close($con) ;
?>

</body>
</html>