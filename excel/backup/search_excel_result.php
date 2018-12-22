<?
//create date	: 20041117
//modify date	: 20041203
//desc 				: for check wai's excel
//related db	: sumgoods
//programmer	: rickykei
//detail			: need to show out if input error partno..so change sql method;
//add excel version

if ($act==2)
{
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");
}
?>
<html>
<head>
<title>for check wai's excel toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<?if ($act==1)
echo "<LINK REL=stylesheet HREF='english.css' TYPE='text/css'>";
?>

<body>
<?
require ('./include/class200411.php');
require ('./include/connection.php');
//print_r($_POST['partno']);
//print_r($partno);
$mysql_class=new mysql("",1);
get_class($mysql_class);

?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr><td>
<table border=0 cellpadding=3 bgcolor="#CCCCCC" color=blue>

<?
$counter_arr=count($partno);



/*
for ($i=0;$i<$counter_arr;$i++)
{
	if ($partno[$i]!="")
	{
		$sql.="goods_partno='".$partno[$i]."'";
		if ($partno[$i+1]!="")
		{
			$sql.=" or ";
//			echo $i;
		}
	}
}
*/
$arr=0;
for ($i=0;$i<$counter_arr;$i++)
{
	if ($partno[$i]!="")
	{
		$temp_partno[$arr]=$partno[$i];
		$arr++;
	}
}
$counter_arr= count($temp_partno);



///echo $sql;
?>
<tr bgcolor=red><td>Part No.</td><td>Model</td><td>Notes</td><td>日本</td><td>香港</td><td>車房價</td>

<? if($act==1)
echo "<td>QTY</td><td>更生日期</td><td>EDIT</td>";
?>

</tr>
<?
for ($i=0;$i<$counter_arr;$i++)
{		
	echo "<tr><td>";
	echo $temp_partno[$i];
	echo "</td>";
	
	$sql="select * from sheet1 where goods_partno='".$temp_partno[$i]."'";
	$mysql_class->mysql($sql,1);
	$result=$mysql_class->ask_mysql();

	if ($row=mysql_fetch_array($result))
	{
		echo "<TD bgcolor='FFFF99'>";
		echo $row["model"];
		echo "</td><td bgcolor='FFFF99'>";
		echo $row["notes"];
		echo "</td><td bgcolor='FFFF99'>";
		$t_tom= $row["toms_dollar"];
		$t_tom=round($t_tom*1.3*0.1);
		echo "$".number_format($t_tom,2,'.',',');
		echo "</td><td bgcolor='FFFF99'>";
		$t_yen= $row["yen"];
		$t_yen=round($t_yen*1.3*0.1);
		echo "$".number_format($t_yen,2,'.',',');
		echo "</td><td bgcolor='FFFF99'>";
		$t_car= $row["car_shop_price"];
		$t_car=round($t_car*1.57);
		echo "$".number_format($t_car,2,'.',',');
		if ($act==1)
		{
			echo "</td><td bgcolor='FFFF99'>1";
			echo "</td><td bgcolor='FFFF99'>".$row["update_date"];
			echo "</td><td bgcolor='999999'><a href=modify_excel.php?update=2&goods_partno=$temp_partno[$i] target=_blank>EDIT</a></td></tr>";
		}

		}
		else
		{
			?>
			<td bgcolor="FFFF99">N/A</td><td bgcolor="FFFF99">N/A</td><td bgcolor="FFFF99">N/A</td><td bgcolor="FFFF99">N/A</td><td bgcolor="FFFF99">N/A</td>
			<?
		}
}
?>
</table></td></tr></table>
</body></html>
