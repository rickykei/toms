<? include("config.php3");
echo $id;
$query="delete from goods where id=$id";
$checktotal=mysql_query($query);
?>
