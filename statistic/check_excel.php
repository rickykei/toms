<?
include("config.php3");
if ($update==1)
{
   $notes=addslashes($notes);
   $model=addslashes($model);
   echo $goods_partno;
   echo $notes;
   echo $toms_dollar;
   echo $yen;
   echo $car_shop_price;
   
   $query="update sheet1 set model='$model',notes='$notes',toms_dollar=$toms_dollar, yen=$yen , car_shop_price=$car_shop_price where goods_partno='$goods_partno'";
   $result = mysql_query($query);
}
   

   
 
if ($update==2)
   {
   
   $query="select * from sheet1 where goods_partno='$goods_partno'";

   $result=mysql_query($query);
   $row= mysql_fetch_array ($result);
   }
?>
<html>
<head>

<title>更改excel update at 20041106</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
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

function check_del(aa)
{
 alert('刪除 '+ aa);
}

</script>
</head>

<body bgcolor="#CCCCCC" text="#FFFFFF">
<div align="center">
  <table height="418" border="0" cellpadding="2" cellspacing="0" bgcolor="#006666" width="728">
    <tr> 
      <td width="108" height="24" bgcolor="#006666"> 
        <div align="center"><strong>&lt;更改入貨名&gt;</strong></div>
      </td>
      <td width="206" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
      <td width="115" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
      <td width="283" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td colspan="4"> 
        <form name=hello method="post" action="check_excel.php">
          <input type="text" name="goods_partno" maxlength="20" <? if ($goods_partno !="") { echo "value=\"".$goods_partno."\"";}?>>
          <input type="hidden" name="update" value=2>
          <input type="submit" name="submit">
          (請輸入要更改資料的PART_NO.) 
        </form>
      </td>
    </tr>
    
    <form name=ingoodnameform method="post" action="ingoodnameedit3.php3">
      <tr bgcolor="#666666"> 
        <td width="108" height="5"></td>
        <td width="206" height="5">&nbsp;</td>
        <td width="115" height="5">&nbsp; </td>
        <td width="283" height="5">&nbsp;</td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="108"> 
          <div align="right"><font face="新細明體" color="#FFFFFF" size="2"> 
            <input type="hidden" name="id" value=<?echo $row["id"];?> class="login">
            <input type="hidden" name="update" value=1 class="login">
        貨品Part NO.: </font> </div>        </td>
        <td width="206"> 
        <input type="text" name="goods_partno" maxlength="20" class="login" value="<? echo $row["goods_partno"];?>">        </td>
        <td width="115"> 
        <div align="right"><font face="新細明體" color="#FFFFFF" size="2">貨品編號:</font></div>        </td>
        <td width="283"> 
        <input type="text" name="goods_id" maxlength="13" class="login" value="<? echo $row["goods_id"];?>">        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="108"> 
        <div align="right"><font face="新細明體" color="#FFFFFF" size="2">NOTES</font></div>        </td>
        <td colspan="3"> 
        <textarea name="notes" cols="80" rows="2" class="login"><? $notes=stripslashes($row["notes"]); echo $notes;?></textarea>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="108"> 
        <div align="right">MODEL:</div>        </td>
        <td colspan="3"><input type="text" name="model" class="login" value="<? $model=stripslashes($row["model"]); echo $model;?>" size="25" maxlength="255"></td>
      </tr>
      <tr bgcolor="#999999">
        <td><div align="right">TOMS</div></td>
        <td><input name="toms_dollar" type="text" class="login" id="toms_dollar" value="<? echo $row["toms_dollar"];?>" size="25" maxlength="255"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#999999">
        <td><div align="right">YEN</div></td>
        <td><input name="yen" type="text" class="login" id="yen" value="<? echo $row["yen"];?>" size="25" maxlength="255"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="108"><div align="right">車房價</div></td>
        <td width="206"><input name="car_shop_price" type="text" class="login" id="car_shop_price" value="<? echo $row["car_shop_price"];?>" size="25" maxlength="255"></td>
        <td width="115">&nbsp;</td>
        <td width="283">&nbsp;</td>
      </tr>
      <tr> 
        <td width="108">&nbsp;</td>
        <td width="206" height="20" align="left" valign="middle"> 
          <input type="submit" name="Submit3" value="更新記錄" onclick="javascript:checkform();">
        <input type="reset" name="Submit2" value="清除" ></td>
      
        <td width="115"></td>
        <td width="283">&nbsp;</td>
      </tr></form> 
      <tr> 
        <td width="108"></td>
        <td valign="bottom" width="206"> 
          <? echo "$string"?>
        </td>
        <td width="115"><form name="ingood_del_form"  action="del.php3">
		<input type=hidden name="goods_partno" value="<? echo $goods_partno;?>" >
        <input type="submit" name="Submit" value="刪除此項貨品名" onclick="javascript:check_del('<?echo $goods_partno;?>')">
        </form></td>
        <td width="283">&nbsp;</td>
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
