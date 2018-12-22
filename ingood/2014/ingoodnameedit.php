<?
   include_once("../include/config.php");
    $connection = DB::connect($dsn);
   if (DB::isError($connection))
   {
      die($connection->getMessage());
	}
   $query="SET NAMES 'UTF8'";
 $result1=mysql_query($query);

if ($update==1)
  {
   $goods_detail=addslashes($goods_detail);
   $query="update sumgoods set model='$model',goods_detail='$goods_detail',market_price=$market_price ,remark='$remark' , unitid='$unitid' where goods_partno='$goods_partno'";
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
  
   $query3="select sum(qty) from goods_instock where goods_partno='$goods_partno'";
   $result=mysql_query($query);
   $result2=mysql_query($query2);
   $result3=mysql_query($query3);
   if (!empty($result))
   $row= mysql_fetch_array ($result);
   if (!empty($result2))
   $row2=mysql_fetch_array ($result2);
   if (!empty($result3))
   $row3=mysql_fetch_array ($result3);
   

}
   $unitResult = $connection->query("SELECT id,unit_name_chi FROM unit");
   if (DB::isError($unitResult))
      die ($unitResult->getMessage());
	  		   $typeResult = $connection->query("SELECT * FROM type");
      if (DB::isError($typeResult))
      die ($typeResult->getMessage());
?>
<html>
<head>

<title>更改入貨名</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<STYLE TYPE="text/css">
h1 {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"}
h2 {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"}
li { line-height: 14pt }
input {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 12px}
select {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 12px}
.login       { background-color: #CCCCCC; color: #000000; font-size: 9pt; border-style: solid; 
               border-width: 1px }
small {  font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 9pt; line-height: 14pt}
p { font-family: "Verdana", "Arial", "Helvetica", "sans-serif"; font-size: 9pt ;font-color: #FFFFFF}
.style2 {color: #000000}
</STYLE>
<link href="../include/invoice.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style11 {font-size: xx-small}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
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

function check_del(aa)
{
 alert('刪除 '+ aa);
}

</script>
</head>

<body ">
<div align="center">
<table width="900"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99CC99">
  <tr>
    <td width="4" height="">&nbsp;</td>
    <td align="center" valign="top">
    <table width="100%"  border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="14%" height="21" bgcolor="#006633"><span class="style6">更改入貨名</span></td>
        <td width="34%"><span class="style7"><? echo "< ".$AREA."鋪,第".$PC."機 >";?></span></td>
        <td width="15%">  <span class="style2"><? echo "$string"?></span></td>
        <td width="37%">&nbsp;</td>
      </tr>
      <tr bgcolor="#669933">
        <td height="24" colspan="4">
  <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="">
    <tr> 
      <td colspan="4"> 
        <form name="form1" method="post" action="ingoodnameedit.php">
          <input type="text" name="goods_partno" maxlength="20" <? if ($goods_partno !="") { echo "value=\"".$goods_partno."\"";}?>>
          <input type="hidden" name="update" value=2>
          <input name="submit" type="submit" id="submit" value="搜尋">
          (請輸入要更改資料的PART_NO.) 
          </form>      </td>
    </tr>
    <tr> 
      <td width="113"><strong><font face="新細明體" color=#FFFFFF size="3"> 
        <? echo "  出貨 = ".$row2["sum(qty)"];?>
        </font></strong></td>
      <td width="275"><strong><font face="新細明體" color=#FFFFFF size="3"> 
        <? echo "  入貨 = ".$row3["sum(qty)"];?>
        </font></strong></td>
      <td width="142"><strong> 
        <? $a=$row3["sum(qty)"]-$row2["sum(qty)"];
if ($a<0)
{
 echo "<font face=新細明體 color=#FF0000 size=4>";
}
else
{ echo "<font face=新細明體 color=#FFFFFF size=4>";}
 echo "  存貨 = ".$a;?>
        </strong></td>
      <td width="346">&nbsp;</td>
    </tr>
    <form name=ingoodnameform method="post" action="ingoodnameedit.php">
      <tr bgcolor="#999999"> 
        <td width="113" align="left"> 
          <font face="新細明體" color="#FFFFFF" size="2"> 
            <input type="hidden" name="update" value=1 >
            <span class="style6">貨品編號:</span></font>         </td>
        <td width="275"> 
          <span class="style6"><? echo $row["goods_partno"];?> </span>       </td>
        <td width="142"> 
          <div align="right"></div>        </td>
        <td width="346">&nbsp;        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="113"> 
        <div class="style6"><font face="新細明體" color="#FFFFFF" size="2">貨品描述:</font></div>        </td>
        <td colspan="3"> 
        <textarea name="goods_detail" cols="80" rows="8" class="login"><? $goods_detail=stripslashes($row["goods_detail"]); echo $goods_detail;?></textarea>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="113"> 
        <div ><font size="2" class="style6">備註:</font></div>        </td>
        <td colspan="3"> 
        <textarea name="remark" cols="50" rows="5" class="login"><? $remark=stripslashes($row["remark"]); echo $remark;?></textarea>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="113"> 
        <div align="left" class="style6">種類::</div>        </td>
        <td width="275">   <select name="model" id="model">
		<? 

	  while ($typerow = $typeResult->fetchRow(DB_FETCHMODE_ASSOC))
		 {
		 
	echo "<option value=\"".$typerow['typeName']."\"";
	$model=stripslashes($row["model"]); 
	if ($model==$typerow['typeName'])
	echo " selected ";
	echo ">".$typerow['typeName']."</option>";
    }?>
        </select>                </td>
        <td width="142">&nbsp;</td>
        <td width="346">&nbsp;</td>
      </tr>      
       <tr  bgcolor="#999999"> 
      <td  ><font size="3" face="新細明體" class="style6">單位：</font></td>
      <td  > 
        <select name="unitid" id="unitid">
		<? while ($unitrow = $unitResult->fetchRow(DB_FETCHMODE_ASSOC))
		 {
		 
	echo "<option value=\"".$unitrow['id']."\"";
	$unitid=stripslashes($row["unitid"]); 
	if ($unitid==$unitrow['id'])
	echo " selected ";
	echo ">".$unitrow['unit_name_chi']."</option>";
    }?>
        </select>
      </td><td></td><td></td>
    </tr>
      <tr bgcolor="#999999"> 
        <td width="113"><font color="#FFFFFF" size="2" face="新細明體" class="style6">賣出<br>
        市場價格:$/每件</font></td>
        <td width="275"> 
        <input type="text" name="market_price" maxlength="9" class="login" value="<?=$row["market_price"];?>"/>
              </td>
        <td width="142">&nbsp;</td>
        <td width="346">&nbsp;</td>
      </tr>
      <tr> 
        <td width="113">&nbsp;</td>
        <td width="275" height="20" align="left" valign="middle"> 
		<input type="hidden" name="goods_partno" value="<?echo $row["goods_partno"];?>" >
          <input type="submit" name="Submit3" value="更新記錄" onClick="javascript:checkform();">
        <input type="reset" name="Submit2" value="清除" ></td>
      
        <td width="142"></td>
        <td width="346">&nbsp;</td>
      </tr></form> 
      <tr> 
        <td width="113"></td>
        <td valign="bottom" width="275">&nbsp;        </td>
        <td width="142"><form name="ingood_del_form"  action="ingoodname_del.php">
		<input type="hidden" name="goods_partno" value="<?echo $row["goods_partno"];?>" >
        <input type="submit" name="Submit" value="刪除此項貨品名" onClick="javascript:check_del('<?echo $goods_partno;?>')">
        </form></td>
        <td width="346">&nbsp;</td>
      </tr>
  </table></td>
      </tr>
</table>     </td>
  </tr>
</table>
  <strong><font face="新細明體" color=#FFFFFF size="3"> </font> </font> </strong> 
</div>

  <p>&nbsp; </p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
  <p>&nbsp;</p>
  

  
  
    
<p>&nbsp;</p>
  
</body>
</html>
