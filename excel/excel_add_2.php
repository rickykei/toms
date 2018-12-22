<html>
<head>
<title>for add wai's excel toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<?
require('class200411.php');
require('connection.php');
   
   
   $string_class=new string_class;
   get_class($string_class);
   $goods_partno=$string_class->check_null($goods_partno);
   $model=$string_class->check_null($model);
	 $notes=$string_class->check_null($notes);
	 $toms_dollar=$string_class->check_null($toms_dollar);
	 $yen=$string_class->check_null($yen);
	 $car_shop_price=$string_class->check_null($car_shop_price);

	$counter=count($goods_partno);
	?>
	<style type="text/css">
<!--
body {
	background-color: #336699;
}
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
    </style><table width=754 border=1 cellpadding=3 cellspacing=0 bordercolor=#999999>
	     <tr><td width="" class="style1"><span class="style3"><font face="新細明體" size="2">PARTNO.</font></span></td>
      <td width="" class="style1"><strong> MODEL </strong></td>
      <td width="" class="style1"><strong> NOTES </strong></td>
      <td width="" class="style1"><strong>TOMS</strong></td>
      <td width="" class="style1"><strong> YEN </strong></td>
      <td width="" class="style1"><strong> 車房價 </strong></td>
      <td width="" class="style1"><strong>STATUS </strong></td>
      </tr>
      <?
	for ($i=0;$i<$counter;$i++)
	{
		echo "<tr>";
		echo "<td>".$goods_partno[$i]."</td>";
		echo "<td>".$model[$i]."</td>";
		echo "<td>".$notes[$i]."</td>";
		echo "<td>".$toms_dollar[$i]."</td>";
		echo "<td>".$yen[$i]."</td>";
		echo "<td>".$car_shop_price[$i]."</td>";
		echo "<td>";
		
		$sql="select * from sheet1 where goods_partno='".$goods_partno[$i]."'";
		$mysql_class=new mysql($sql,1);
		get_class($mysql_class);
		$result=$mysql_class->ask_mysql();
		
		if ($mysql_class->no_of_rows()==0)
		{
			$sql="INSERT INTO `sheet1` (`goods_partno`,`model`,`notes`,`toms_dollar`,`yen` ,`car_shop_price`)  VALUES ($goods_partno[$i],$model[$i],$notes[$i],$toms_dollar[$i],$yen[$i],$car_shop_price[$i])";
			
			$result = mysql_query($sql);
			echo "OK";
		}
		else
		{
			echo "重覆<a href=modify_excel.php?update=2&goods_partno=$goods_partno[$i] target=_blank>EDIT</a>";
		}
		echo "</td></tr>";
		
		
		
	}
			


?>
</table>
<a href="excel_add.php" class=".style2"><回上一頁></a>
</body>
</html>
