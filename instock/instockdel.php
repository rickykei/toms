<html>
<body>
<?
include("config.php");
echo $instock_no;
$query="delete from instock where instock_no=\"$instock_no\"";
if (!mysql_query($query))
die(mysql_error());
else
echo "入貨單已被刪除";

?>

<SCRIPT LANGUAGE="JavaScript">
window.location="instockedit.php";
</script>
</body>
</html>
