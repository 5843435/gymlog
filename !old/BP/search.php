<html>
<body>
<?php 
//�f�[�^�x�[�X�ɐڑ� 
if (!$con = mysql_connect("localhost", "root", "Jpn12008")) {
echo "�ڑ��G���[" ;
exit ;
}

//�f�[�^�x�[�X��I��
if (!mysql_select_db("lesmills", $con)) {
echo "�f�[�^�x�[�X�I���G���[" ;
exit ;
}

//�t�H�[���ő����Ă�������������SELECT�����쐬
$sql = "select club, url, program, week, time, appendix from lesmills " ;
$sql . = "where club like '%$place% ' " ;

//SELECT�������s 
if (!$res = mysql_query($sql)) {
echo "SQL�G���[<BR>" ;
exit ;
}

//�������ʕ\��
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

//���ʃZ�b�g�̊J��
mysql_free_result ($res) ; 

//�f�[�^�x�[�X����ؒf
mysql_close($con) ;
?>

</body>
</html>