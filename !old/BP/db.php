<?php
$sql = mysql_connect("localhost", "root", "Jpn12008");
mysql_select_db("lesmills", $sql);
mysql_query('SET NAMES utf8', $sql ); # この行を追加する

$query = "SELECT * FROM lesmills";
$result = mysql_query($query);
print "$result";
?>