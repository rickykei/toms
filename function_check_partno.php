<?php
#################################################################
# 20030702 function for checking Partno 's stock ,in and out	#
# input ==== partno [string]					#
# output ==== in [int]						#
#	 ==== out [ int]					#
#################################################################
function check_balance_by_partno($goods_partno)
{
	include("config.php3");
	$query1="select * from sumgoods where goods_partno=\"$goods_partno\"";
	$query2="select * from goods_invoice,invoice where goods_partno=\"$goods_partno\" and goods_invoice.invoice_no=invoice.invoice_no order by invoice.invoice_no desc";
	$query3="select * from goods where goods_partno=\"$goods_partno\" order by date desc";
	$result1=mysql_query($query1);
	$result2=mysql_query($query2);
	$result3=mysql_query($query3);
	$row1=mysql_fetch_array ($result1);
	$row2=mysql_fetch_array ($result2);
	$row3=mysql_fetch_array ($result3);
	$no2=mysql_num_rows($result2);
	$no3=mysql_num_rows($result3);
	$query5="select sum(qty) from goods_invoice where goods_partno=\"$goods_partno\"";
	$query6="select sum(stock) from goods where goods_partno=\"$goods_partno\"";
	$result5=mysql_query($query5);
	$result6=mysql_query($query6);
	$row5=mysql_fetch_array ($result5);
	$row6=mysql_fetch_array ($result6);
	//echo "  出貨 = ".$row5["sum(qty)"];
	//echo "  入貨 = ".$row6["sum(stock)"];
	//echo "\n";
	$a=$row6["sum(stock)"]-$row5["sum(qty)"];
	if ($a<0)
	{
		//echo "<font face=新細明體 color=#FF0000 size=4>";
	}
	else
	{
		//echo "<font face=新細明體 color=#123456 size=4>";
	}
		//echo "  存貨 = </font>".$a;
        return $a;
}




?>


