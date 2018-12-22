<html>
<body>
<?
include("config.php3");
echo $goods_partno;
$query="delete from sumgoods where goods_partno=\"$goods_partno\"";
if (!mysql_query($query))
die(mysql_error());
else
echo "入貨名已被刪除";



?>




<SCRIPT LANGUAGE="JavaScript">
window.location="ingoodnameedit3.php3";
</script>
</body>
</html>
