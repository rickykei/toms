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
$query="update sumgoods set model='$model', goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price ,remark='$remark' where id='$id'";
   }
   if ($fromdollar==1)
   {
 $query="update sumgoods set model='$model',goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price ,remark='$remark'where id='$id'";
   }
   if (mysql_query($query))
   $string="��Ƥw�g���";
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

<title>���J�f�W update at 20040416</title>
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
	alert ("�п�J�f�~�s��.");
	document.ingoodnameform.goods_detail.focus();
	}else
	{
        document.ingoodnameform.submit();
        }

}

function check_del(aa)
{
 alert('�R�� '+ aa);
}

</script>
</head>

<body bgcolor="#CCCCCC" text="#FFFFFF">
<div align="center">
  <table height="418" border="0" cellpadding="2" cellspacing="0" bgcolor="#006666" width="728">
    <tr> 
      <td width="111" height="24" bgcolor="#006666"> 
        <div align="center"><strong>&lt;���J�f�W&gt;</strong></div>
      </td>
      <td width="210" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
      <td width="117" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
      <td width="285" height="24" bgcolor="#CCCCCC"><font color="#CCCCCC">&nbsp;</font></td>
    </tr>
    <tr> 
      <td colspan="4"> 
        <form name=hello method="post" action="ingoodnameedit3.php3">
          <input type="text" name="goods_partno" maxlength="20" <? if ($goods_partno !="") { echo "value=\"".$goods_partno."\"";}?>>
          <input type="hidden" name="update" value=2>
          <input type="submit" name="submit">
          (�п�J�n����ƪ�PART_NO.) 
        </form>
      </td>
    </tr>
    <tr> 
      <td width="111"><strong><font face="�s�ө���" color=#FFFFFF size="3"> 
        <? echo "  �X�f = ".$row2["sum(qty)"];?>
        </font></strong></td>
      <td width="210"><strong><font face="�s�ө���" color=#FFFFFF size="3"> 
        <? echo "  �J�f = ".$row3["sum(stock)"];?>
        </font></strong></td>
      <td width="117"><strong> 
        <? $a=$row3["sum(stock)"]-$row2["sum(qty)"];
if ($a<0)
{
 echo "<font face=�s�ө��� color=#FF0000 size=4>";
}
else
{ echo "<font face=�s�ө��� color=#FFFFFF size=4>";}
 echo "  �s�f = ".$a;?>
        </strong></td>
      <td width="285">&nbsp;</td>
    </tr>
    <form name=ingoodnameform method="post" action="ingoodnameedit3.php3">
      <tr bgcolor="#666666"> 
        <td width="111" height="5"></td>
        <td width="210" height="5">&nbsp;</td>
        <td width="117" height="5">&nbsp; </td>
        <td width="285" height="5">&nbsp;</td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111"> 
          <div align="right"><font face="�s�ө���" color="#FFFFFF" size="2"> 
            <input type="hidden" name="id" value=<?echo $row["id"];?> class="login">
            <input type="hidden" name="update" value=1 class="login">
        �f�~Part NO.: </font> </div>        </td>
        <td width="210"> 
        <input type="text" name="goods_partno" maxlength="20" class="login" value="<? echo $row["goods_partno"];?>">        </td>
        <td width="117"> 
        <div align="right"><font face="�s�ө���" color="#FFFFFF" size="2">�f�~�s��:</font></div>        </td>
        <td width="285"> 
        <input type="text" name="goods_id" maxlength="13" class="login" value="<? echo $row["goods_id"];?>" disabled/>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111"> 
        <div align="right"><font face="�s�ө���" color="#FFFFFF" size="2">�f�~�y�z:</font></div>        </td>
        <td colspan="3"> 
        <textarea name="goods_detail" cols="80" rows="8" class="login"><? $goods_detail=stripslashes($row["goods_detail"]); echo $goods_detail;?></textarea>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111"> 
        <div align="right"><font size="2">�Ƶ�:</font></div>        </td>
        <td colspan="3"> 
        <textarea name="remark" cols="50" rows="5" class="login"><? $remark=stripslashes($row["remark"]); echo $remark;?></textarea>        </td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111"> 
        <div align="right">MODEL:</div>        </td>
        <td width="210"> 
        <input type="text" name="model" class="login" value="<? $model=stripslashes($row["model"]); echo $model;?>" size="25" maxlength="255">        </td>
        <td width="117">&nbsp;</td>
        <td width="285">&nbsp;</td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111">&nbsp;</td>
        <td width="210"><font color="#FFFFFF" size="2">�餸 
          <input type="radio" name="fromdollar" value="0">
          �䤸 
          <input type="radio" name="fromdollar" value="1" checked>
        </font></td>
        <td width="117">&nbsp;</td>
        <td width="285">&nbsp;</td>
      </tr>
      <tr bgcolor="#999999"> 
        <td width="111"><font face="�s�ө���" color="#FFFFFF" size="2">��X<br>
        ��������:$/�C��</font></td>
        <td width="210"> 
        <input type="text" name="market_price" maxlength="9" class="login" value="<?echo $row["market_price"];?>">        </td>
        <td width="117">&nbsp;</td>
        <td width="285">&nbsp;</td>
      </tr>
      <tr> 
        <td width="111">&nbsp;</td>
        <td width="210" height="20" align="left" valign="middle"> 
          <input type="submit" name="Submit3" value="��s�O��" onclick="javascript:checkform();">
        <input type="reset" name="Submit2" value="�M��" ></td>
      
        <td width="117"></td>
        <td width="285">&nbsp;</td>
      </tr></form> 
      <tr> 
        <td width="111"></td>
        <td valign="bottom" width="210"> 
          <? echo "$string"?>
        </td>
        <td width="117"><form name="ingood_del_form"  action="ingoodname_del.php3">
		<input type=hidden name="goods_partno" value="<? echo $goods_partno;?>" >
        <input type="submit" name="Submit" value="�R�������f�~�W" onclick="javascript:check_del('<?echo $goods_partno;?>')">
        </form></td>
        <td width="285">&nbsp;</td>
      </tr>
  </table>
  <strong><font face="�s�ө���" color=#FFFFFF size="3"> </font> </font> </strong> 
</div>

  <p>&nbsp; </p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
  <p>&nbsp;</p>
  

  
  
    
<p>&nbsp;</p>
  
</body>
</html>