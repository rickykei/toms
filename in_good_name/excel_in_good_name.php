<?
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=ingoodnames.xls");
require ('./include/class200411.php');
require ('./include/connection.php');
$mysql_class=new mysql("",1);
get_class($mysql_class);

	$sql="select * from sumgoods";
	$mysql_class->mysql($sql,1);
	$result=$mysql_class->ask_mysql();
echo "<table>";
		echo "<TR>";
		echo "<TD>id</TD>";
		echo "<TD>goods_id</TD>";
		echo "<TD>goods_partno</TD>";
		echo "<TD>goods_detail</TD>";
		echo "<TD>market_price</TD>";
		echo "<TD>allstock</TD>";
		echo "<TD>status</TD>";
		echo "<TD>admin_view</TD>";
		echo "<TD>remark</TD>";
		echo "<TD>model</TD>";
		
		echo "</tr>";
	while ($row=mysql_fetch_array($result))
	{
		echo "<TR>";
		echo "<TD>".$row["id"]."</TD>";
		echo "<TD>".$row["goods_id"]."</TD>";
		echo "<TD>".$row["goods_partno"]."</TD>";
		echo "<TD>".$row["goods_detail"]."</TD>";
		echo "<TD>".$row["market_price"]."</TD>";
		echo "<TD>".$row["allstock"]."</TD>";
		echo "<TD>".$row["status"]."</TD>";
		echo "<TD>".$row["admin_view"]."</TD>";
		echo "<TD>".$row["remark"]."</TD>";
		echo "<TD>".$row["model"]."</TD>";
		
		echo "</tr>";
	}
	echo "</table>";
?>
