<?
include "db.php";
$rs=mysql_query("select id,nombre from areas",$db);
while($rsr=mysql_fetch_row($rs)){
	echo "<option value=".$rsr[0].">".$rsr[1]."</option>";
}
?>


