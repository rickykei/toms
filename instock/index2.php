<?
$instockRecord=18;		//全張表共有十行記錄
$totalcounter=0;		//預設
//測試己用多少記錄
for ($i=0;$i<$instockRecord;$i++)
{
	if ($goods_partno[$i]!="")
	$totalcounter++;
}

//連線mysql
	include("../include/config.php");
	$query="SET NAMES 'UTF8'";
    $connection = DB::connect($dsn);

	if (DB::isError($connection))
		die($connection->getMessage());

//解決mysql中文連線
	$result = $connection->query("SET NAMES 'UTF8'");
		if (DB::isError($result))
      		die ($result->getMessage());
if ($update==3)
{//edit
  $query="update instock set instock_date='$instock_date', supplier_name='$supplier_name', staff_name='$staff_name', supplier_invoice_no='$supplier_invoice_no',remark='$remark',count_price='$count_price',discount_percent='$sub_discount',total_price='$total_price' where instock_no= '$instock_no'";
    $result=$connection->query($query);
  if (DB::isError($result)) die ($result->getMessage());
  //del goods_stock
  
  $query="delete from goods_instock where instock_no =$instock_no";
    $result=$connection->query($query);
  if (DB::isError($result)) die ($result->getMessage());
  //add goods_stock

    for ($i=0;$i<$totalcounter;$i++)
  {
	$goods_detail_enc[$i]= addslashes($goods_detail[$i]);
   $query="insert into goods_instock (instock_no,goods_partno,goods_detail,qty,market_price,unit,subtotal,discount,deductstock) ";
   $query.=" values ('$instock_no','$goods_partno[$i]','$goods_detail_enc[$i]','$qty[$i]','$market_price[$i]','$unit[$i]','$subtotal[$i]','$discount[$i]','$deductStock[$i]') ";
   
  $result=$connection->query($query);
  	if (DB::isError($result))
  	{
      die ($result->getMessage("OO"));
   	}}
}
else{
//add

  $query="insert into instock (instock_no,instock_date,entry_date,supplier_name,staff_name,supplier_invoice_no,remark,count_price,discount_percent,total_price) ";
  $query.=" values ('$instock_no','$instock_date',now(),'$supplier_name','$staff_name','$supplier_invoice_no','$remark','$count_price','$sub_discount','$total_price')";

  $result=$connection->query($query);
  if (DB::isError($result)) die ($result->getMessage());

//查詢入貨單編號
  $query="SELECT LAST_INSERT_ID();";
  $result=$connection->query($query);
  if (DB::isError($result)) die ($result->getMessage());
  $row=$result->fetchRow();
  $instock_no=$row[0];
 
  for ($i=0;$i<$totalcounter;$i++)
  {
   $query="insert into goods_instock (instock_no,goods_partno,goods_detail,qty,market_price,unit,subtotal,discount,deductstock) ";
   $query.=" values ('$instock_no','$goods_partno[$i]','$goods_detail[$i]','$qty[$i]','$market_price[$i]','$unit[$i]','$subtotal[$i]','$discount[$i]','$deductStock[$i]')";

  $result=$connection->query($query);
  	if (DB::isError($result))
  	{
      die ($result->getMessage());
   	}
}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../include/instock.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<table width="880"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99CCCC">

  <tr>
    <td>&nbsp;</td>
    <td width="870" align="center" valign="top"><table width="100%" height="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="14%" height="21" bgcolor="#006666" class="style6">入倉單</td>
        <td width="34%"><? echo "< ".$AREA."鋪,第".$PC."機 >";?></td>
        <td width="15%"></td>
        <td width="37%">&nbsp;</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="24" colspan="4"><table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr bgcolor="#006666">
            <td width="20%" height="21"><span class="style6"> 發票日期 ：</span></td>
            <td width="29%"><span class="style6"><? echo $instock_date; ?></span></td>
            <td><span class="style6">職員 :</span></td>
            <td><span class="style6"><? echo $staff_name; ?></span></td>
          </tr>
          <tr bgcolor="#006666">
            <td class="style6">供應商 ：</td>
            <td><span class="style6"><? echo $supplier_name; ?></span></td>
            <td class="style6">供應商發票編號：</td>
            <td><span class="style6"><? echo $supplier_invoice_no; ?></span></td>
          </tr>
        </table></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td colspan="4"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
          <tr bgcolor="#006666">
            <td width="5%" class="style6">行數</td>
            <td width="20%" class="style6">貨品編號</td>
            <td width="10%" class="style6">數量</td>
            <td width="30%" class="style6">項目</td>
            <td width="10%" class="style6"><div align="center">單價</div></td>
            <td width="7%" class="style6"><div align="center">折扣</div></td>
            <td width="4%" class="style6">金額</td>
            <td width="4%" class="style6">行送</td>
          </tr> 
<?$elements_counter=4;
for ($i=0;$i<$totalcounter;$i++)          
{
	?>
     <tr bgcolor="#CCCCCC"> 
            <td><div align="center"><? echo $i+1; ?></div></td>
            <td><? echo $goods_partno[$i]; ?></td>

            <td><? echo $qty[$i]; ?></td>
                       <td><div align="center"><? echo htmlspecialchars($goods_detail[$i]); ?></div></td>
			 <td><div align="center"><? echo $market_price[$i]; ?></div></td>
            <td>
              <div align="center"><? echo $discount[$i]; ?></div></td>
            <td><? echo $subtotal[$i]; ?></td>
            <td><span class="style7">
              <?if ($deductStock[$i]=="N"){ echo "Y";}else{echo "N";}?>
            </span></td>
     </tr>
<?}?>      </table>          </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td height="" colspan="4">
          <table width="100%" border="0" cellpadding="2" cellspacing="0" bgcolor="#006666">
            <tr class="style6">
              <td class="style6">備註欄</td>
              <td colspan="4"><strong>
                <label><? echo $remark; ?></label>
              </strong></td>
              <td>&nbsp;</td>
              <td></td>
            </tr>
            <tr class="style6">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right" class="style6">總數<strong> : </strong></div></td>
              <td><strong><? echo $count_price; ?></strong></td>
              <td></td>
            </tr>
            <tr class="style6">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right" class="style6">折扣<strong> : </strong></div></td>
              <td><strong><? echo $sub_discount; ?></strong></td>
              <td></td>
            </tr>
            <tr class="style6">
              <td width="15%">&nbsp;</td>
              <td width="14%">&nbsp;</td>
              <td width="11%">&nbsp;</td>
            <td width="24%">&nbsp;</td>
              <td width="25%"><div align="right" class="style6">應付金額<strong> : </strong></div></td>
              <td width="8%"><strong><? echo $total_price; ?></strong></td>
              <td width="3%"></td>
            </tr>
          </table>          </td>
      </tr>
      <tr>
        <td height=""><?if ($update!=3){
echo "<a href=\"./index.php\">回入貨單頁</a>";
echo "</br>";}
?></td>
        <td height=""><?
		if ($update==3){
echo "<a href=\"./instocklist.php\">回所有入貨單</a>";
echo "</br>";}
?></td>
        <td height=""><input type="hidden" name="AREA" value="<? echo $AREA; ?>" /><input type="hidden" name="PC" value="<? echo $PC; ?>" /></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form></body>
</html>