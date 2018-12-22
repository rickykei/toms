<? php_track_vars ?>
<?
include("../config.php3");
//$link=mysql_connect("localhost","root","") or die ("Cannot connect the SQL Server!");
//$link=mysql_connect() or die ("Cannot connect the SQL Server!");
//mysql_select_db("toms") or die ("Cannot connect the database!");

$mem_id = $HTTP_POST_VARS["mem_id"];
$mem_name_eng = $HTTP_POST_VARS["mem_name_eng"];
$mem_name_chi = $HTTP_POST_VARS["mem_name_chi"];
$mem_hkid = $HTTP_POST_VARS["mem_hkid"];
$mem_tel = $HTTP_POST_VARS["mem_tel"];
$mem_tel2 = $HTTP_POST_VARS["mem_tel2"];
$mem_add = $HTTP_POST_VARS["mem_add"];
$mem_carno = $HTTP_POST_VARS["mem_carno"];
$mem_cartype = $HTTP_POST_VARS["mem_cartype"];
$mem_caryear = $HTTP_POST_VARS["mem_caryear"];
$mem_carno2 = $HTTP_POST_VARS["mem_carno2"];
$mem_cartype2 = $HTTP_POST_VARS["mem_cartype2"];
$mem_caryear2 = $HTTP_POST_VARS["mem_caryear2"];
$apply_date = $HTTP_POST_VARS["apply_date"];
$exp_date = $HTTP_POST_VARS["exp_date"];
$other = $HTTP_POST_VARS["other"];
$barcode = $HTTP_POST_VARS["barcode"];

$query="delete from member where id=$id";
if (mysql_query($query))
	echo "Success!";
else
	echo "Too Bad!";
echo $query;
echo "<p><a href=\"./member.php3\">Add next member</a><p><a href=\"./membershow.php3\">view member</a><p><a href=\"../index.php3\">Back Home</a>";

mysql_close();
?>
