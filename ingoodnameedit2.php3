<?

   include("config.php3");
if ($update==1)
  {
   $goods_detail=addslashes($goods_detail);
if ($fromdollar==0)
   {
    $query2="select hk from hkjp where id=1";
    $result2=mysql_query($query2);
    $row2=mysql_fetch_array($result2);
   $market_price=$market_price*$row2["hk"];
$query="update sumgoods set goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price ,remark='$remark' where id='$id'";
   }
   if ($fromdollar==1)
   {
  $query="update sumgoods set goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price ,remark='$remark'where id='$id'";
   }
   if (mysql_query($query))
   $string="資料已經更生";
   else
   $string="Too Bad!";
   $update=0;

   } 
     if ($update==2)
   {
   
   $query="select * from sumgoods where goods_partno='$goods_partno'";
   $query2="select sum(qty) from goods_invoice where goods_partno='$goods_partno'";
   $query3="select sum(stock) from goods where goods_partno='$goods_partno'";
   $result=mysql_query($query);
   $result2=mysql_query($query2);
   $result3=mysql_query($query3);
   $row= mysql_fetch_array ($result);
   $row2=mysql_fetch_array ($result2);
   $row3=mysql_fetch_array ($result3);
   

}
?>
<html>
<head>

<title>更改入貨名</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<STYLE TYPE="text/css">
h1 {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"}
h2 {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"}
li { line-height: 14pt }
input {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 12px}
select {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 12px}
.login       { background-color: #33CCCC; color: #000000; font-size: 9pt; border-style: solid; 
               border-width: 1px }
small {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 9pt; line-height: 14pt}
p { font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 9pt ;font-color: #FFFFFF}
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
<form name=hello method="post" action="ingoodnameedit2.php3">
<input type="text" name="goods_partno" maxlength="20"  <? if ($goods_partno !="") { echo "value=\"".$goods_partno."\"";}?>>
<input type="hidden" name="update" value=2>
<input type="submit" name="submit">
</form><strong><font face="新細明體" color=#FFFFFF size="3">
<? echo "  出貨 = ".$row2["sum(qty)"];?>
<? echo "  入貨 = ".$row3["sum(stock)"];?>
</font>
<? $a=$row3["sum(stock)"]-$row2["sum(qty)"];
if ($a<0)
{
 echo "<font face=新細明體 color=#FF0000 size=4>";
}
else
{ echo "<font face=新細明體 color=#FFFFFF size=4>";}
 echo "  存貨 = ".$a;?>
</font></strong><form name=ingoodnameform method="post" action="ingoodnameedit2.php3">
  <p><font face="新細明體" color="#FFFFFF" size="2">貨品編號: </font>
  <input type="hidden" name="id" value=<?echo $row["id"];?> class="login">
  <input type="hidden" name="update" value=1 class="login">
    <input type="text" name="goods_id" maxlength="13" class="login" value="<? echo $row["goods_id"];?>">
    <font face="新細明體" color="#FFFFFF" size="2">貨品Part NO.:</font>
    <input type="text" name="goods_partno" maxlength="20" class="login" value="<? echo $row["goods_partno"];?>">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">貨品描述:</font></p>
  <p> 
    <textarea name="goods_detail" cols="80" rows="8" class="login"><? $goods_detail=stripslashes($row["goods_detail"]); echo $goods_detail;?></textarea>
  </p>
  <p><textarea name="remark" cols="50" rows="5" class="login"><? $remark=stripslashes($row["remark"]); echo $remark;?></textarea></p>
  <table width="75%" border="0">
      <tr> 
      <td width="14%">&nbsp;</td>
      <td width="86%"><font color="#FFFFFF" size="2">日元 
        <input type="radio" name="fromdollar" value="0">
        港元 
        <input type="radio" name="fromdollar" value="1" checked>
        </font></td>
    </tr>
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2">賣出市場價格:$/每件</font></td>
      <td> 
        <input type="text" name="market_price" maxlength="9" class="login" value="<?echo $row["market_price"];?>">
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><a href="JavaScript:checkform();"><img src="submit.gif" border=0 align=bottom></a> 
        <input type="reset" name="Submit2" value="Reset" class="login">
      </td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <td colspan="3">&nbsp;</td>
    <p><? echo "$string"?></p>
  </form>
</body>
</html>
