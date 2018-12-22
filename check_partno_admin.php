<?
   include("config.php3");
   if ($update_sql==1)
   {
   	echo $admin_view;
   	$query_sql="update sumgoods set admin_view=\"$admin_view\" where goods_partno=\"$goods_partno\"";
   	$result_sql=mysql_query($query_sql);
   	//$rowsql=mysql_fetch_array($result_sql);
   	echo "updated";
   }
   if ($update==2)
   {
   $query1="select * from sumgoods where goods_partno='$goods_partno'";
   $query2="select * from sumgoods,goods_invoice,invoice where sumgoods.goods_partno='$goods_partno' and sumgoods.goods_partno=goods_invoice.goods_partno and goods_invoice.invoice_no=invoice.invoice_no order by invoice.invoice_no desc";
   $query3="select * from sumgoods,goods where sumgoods.goods_partno='$goods_partno' and sumgoods.goods_partno=goods.goods_partno order by date desc";
   $result1=mysql_query($query1);
   $result2=mysql_query($query2);
   $result3=mysql_query($query3);
   $row1=mysql_fetch_array ($result1);
   $row2=mysql_fetch_array ($result2);
   $row3=mysql_fetch_array ($result3);
   $no2=mysql_num_rows($result2);
   $no3=mysql_num_rows($result3);
   $query5="select sum(qty) from goods_invoice where goods_partno='$goods_partno'";
   $query6="select sum(stock) from goods where goods_partno='$goods_partno'";
   $result5=mysql_query($query5);
   $result6=mysql_query($query6);
   $row5=mysql_fetch_array ($result5);
   $row6=mysql_fetch_array ($result6);
   }

?>
<html>
<head>

<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<STYLE TYPE="text/css">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
</STYLE>

<script language="JavaScript">
function checkform()
{
	if(document.ingoodnameform.goods_detail.value == "")
	{
	alert ("請輸入貨品編號.");
	document.ingoodnameform.goods_detail.focus();
	}else
	{
        document.ingoodnameform.submit();
        }

}
</script>
</head>

<body bgcolor="#0066cc" text="#FFFFFF">


<?
//IF INPUT CHAR != full certfiy of the partno in sumgoods
// e.g ABCDE-ABCDE input =AB will GO HERE
// and print all partno which include AB character



if ($row1==null&&$update==2)
{
$query1="select * from sumgoods where goods_partno like '$goods_partno%' order by goods_partno ";
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
echo "<table bgcolor=#EEEEEE>";
do
{
echo "<tr><td>";
echo "<a href=check_partno_admin.php?update=2&goods_partno=".$row1["goods_partno"].">";
echo $row1["goods_partno"];
echo "</a>";
echo "</td><td><font color=#111111>";
echo $row1["goods_detail"];
echo "</font></td></tr><p>";
}while($row1=mysql_fetch_array($result1));
}
echo "</table>";
?>



<form name=hello method="post" action="check_partno_admin.php">
<input type="text" name="goods_partno" maxlength="20">
<input type="hidden" name="update" value=2>
<input type="submit" name="submit">
</form>
<strong>
<font face="新細明體" color=#FFFFFF size="3">
<? echo "  出貨 = ".$row5["sum(qty)"];?>
<? echo "  入貨 = ".$row6["sum(stock)"];?>
<? echo "\n"?>
</font>


<? $a=$row6["sum(stock)"]-$row5["sum(qty)"];

if ($a<0)
{
 echo "<font face=新細明體 color=#FF0000 size=4>";
}
else
{ echo "<font face=新細明體 color=#FFFFFF size=4>";}
 echo "  存貨 = ".$a;?>
<? echo "  市價 = ".$row1["market_price"];?>
 <? echo "<p>desc=".$row1["goods_detail"]."";
?></font></strong>
<?
 if ($update==2){
echo "<form name=\"add_admin_view\" method=\"post\" action=\"check_partno_admin.php\">";
echo "<input type=\"radio\" name=\"admin_view\" value=N ";
if ($row1["admin_view"]=='N')
echo "checked";
echo ">大家看到";

echo "<input type=\"radio\" name=\"admin_view\" value=Y ";
if ($row1["admin_view"]=='Y')
echo "checked";
echo ">只有admin看到";
echo "<input type=\"hidden\" name=\"update_sql\" value=1>";
echo "<input type=\"hidden\" name=\"update\" value=2>";
echo "<input type=\"hidden\" name=\"goods_partno\" value=";
echo $row1["goods_partno"];
echo ">";
echo "<input type=\"submit\" name=\"submit\" value=\"更改管理權限\"></form>";
}
?>
<table  width="80%" border="1">
 <tr><td>入貨</td></tr>
 <tr>
 <td width="10%">id</td>
 <td width="10%">ref_no</td>
 <td width="10%">goods_partno</td>
 <td width="10%">cost</td>
 <td width="10%">stock</td>
 <td width="10%">stockout</td>
 <td width="10%">place</td>
 <td width="10%">date</td>
 <td width="10%">status</td>
 </tr>
 <? for ($i=0;$i<$no3;$i++)
 {
  echo "<tr><td width=\"10%\">".$row3["id"]."</td>";
  echo "<td width=\"10%\">".$row3["ref_no"]."</td>";
  echo "<td width=\"10%\">".$row3["goods_partno"]."</td>";
  echo "<td width=\"10%\">".$row3["cost"]."</td>";
  echo "<td width=\"10%\">".$row3["stock"]."</td>";
  echo "<td width=\"10%\">".$row3["stockout"]."</td>";
  if ($row3["place"]==1)
  $temp="旺角";
  else
  $temp="大圍";
 echo "<td width=\"10%\">".$temp."</td>";
  echo "<td width=\"10%\">".$row3["date"]."</td>";
  echo "<td width=\"10%\">".$row3["status"]."</td>";
  $row3=mysql_fetch_array ($result3);
 }
?>
<table  width="90%" border="1">
 <tr><td>出貨</td></tr><tr>
 <td width="10%">invoice_no</td>
 <td width="10%">member_id</td>
 <td width="30%">customer_name</td>
 <td width="10%">goods_partno</td>
 <td width="3%">qty</td>
 <td width="5%">discoutrate</td>
 <td width="10%">marketprice</td>
 <td width="20%">date</td>
 </tr>
 <? for ($i=0;$i<$no2;$i++)
 {
 if ($row2["customer_name"]=="")
{
 $rows_member=mysql_query("select mem_name_eng,mem_name_chi from member where mem_id=".$row2["member_id"]);
 $rows_member2=mysql_fetch_array($rows_member);
 
 if ($rows_member2["mem_name_eng"]!="")
 $row2["customer_name"]=$rows_member2["mem_name_eng"];
 else
 $row2["customer_name"]=$rows_member2["mem_name_chi"];
}
  echo "<tr>";
//<td width=\"10%\">".$row2["id"]."</td>";
  echo "<td width=\"10%\">".$row2["invoice_no"]."</td>";
  echo "<td width=\"10%\">".$row2["member_id"]."</td>";
  echo "<td width=\"30%\">".$row2["customer_name"]."</td>";
  echo "<td width=\"10%\">".$row2["goods_partno"]."</td>";
  echo "<td width=\"3%\">".$row2["qty"]."</td>";
  echo "<td width=\"5%\">".$row2["discountrate"]."</td>";
  echo "<td width=\"10%\">".$row2["marketprice"]."</td>";
  //echo "<td width=\"3%\">".$row2["status"]."</td>";
  echo "<td width=\"20%\">".$row2["invoice_date"]."</td>";
  $row2=mysql_fetch_array ($result2);
 } 
?>
</body>
</html>
