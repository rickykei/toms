<?
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=excel_excel.xls");
require ('./include/class200411.php');
require ('./include/connection.php');
$mysql_class=new mysql("",1);
get_class($mysql_class);

	$sql="select * from sheet1";
	$mysql_class->mysql($sql,1);
	$result=$mysql_class->ask_mysql();
echo "<table>";
		echo "<TR>";
		echo "<TD>Goods_partno</TD>";
		echo "<TD>Model</TD>";
		echo "<TD>Notes</TD>";
		echo "<TD>Toms_dollar</TD>";
		echo "<TD>Yen</TD>";
		echo "<TD>Car_shop_price</TD>";
		echo "<TD>Create_date</TD>";
		echo "<TD>Update_date</TD>";
		
		
		
		echo "</tr>";
	while ($row=mysql_fetch_array($result))
	{
		echo "<TR>";
		echo "<TD>".$row["goods_partno"]."</TD>";
		echo "<TD>".$row["model"]."</TD>";
		echo "<TD>".$row["notes"]."</TD>";
		echo "<TD>".$row["toms_dollar"]."</TD>";
		echo "<TD>".$row["yen"]."</TD>";
		echo "<TD>".$row["car_shop_price"]."</TD>";
		echo "<TD>".$row["create_date"]."</TD>";
		echo "<TD>".$row["update_date"]."</TD>";
		
		
		
		echo "</tr>";
	}
	echo "</table>";
?>
