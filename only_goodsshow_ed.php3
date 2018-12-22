<html>
<title>
</title>
<body Onload="document.location='only_goodsshow.php3'">
<?

   include("config.php3");
   if($id!="")
	{
 	echo $goods_id;
	echo $goods_partno;
	echo $cost;
	echo $stock;
	echo $id;
	echo $place;
	echo $ref_no;
$query="update goods set goods_id='$goods_id', goods_partno='$goods_partno', ref_no='$ref_no', cost=$cost, stock=$stock, place=$place where id=$id";
    if (mysql_query($query))
{       echo "Success!";
mysql_close($link);
}
else
    {   echo "Too Bad!";}
}

?>
</BODY>
</html>
