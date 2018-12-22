<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<script language="JavaScript">
function checkform()
{
        if(document.only_goodsshowform.ref_no.value == "")
	{

	}else
	{
        document.only_goodsshowform.submit();
        }

}
</script><?
   include("config.php3");

   $query="select * from goods where id=$ed";

   $rows2=mysql_query($query);
   if (!$rows2)
      echo "Too Bad!";
   else
   {
      $row=mysql_fetch_row($rows2);
      list($id,$ref_no,$goods_id,$goods_partno,$cost,$stock,$stockout,$place,$date,$status)=$row;  

   }
?>
</head>

<body bgcolor="#0066cc" text="#000000">
<form name=only_goodsshowform method="post" action="only_goodsshow_ed.php3">
<font face="新細明體" color="#FFFFFF" size="2">reference no :</font>
<input type="text" name="ref_no" maxlength="20" class="login" value="<?echo "$ref_no";?>">
<p><font face="新細明體" color="#FFFFFF" size="2"> 貨物編號: </font>
    <input type="text" name="goods_id" maxlength="13" class="login" value="<?echo "$goods_id";?>">
    <font face="新細明體" color="#FFFFFF" size="2"> 貨物Part NO.:</font>
    <input type="text" name="goods_partno" maxlength="20" class="login" value="<?echo "$goods_partno";?>">
  </p>
    <table width="75%" border="0">
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2"> 0.066港元</font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 1.000日元</font></td>
    </tr>

    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2"> 成本價格/每件 $</font> </td>
      <td>
        <input type="text" name="cost" maxlength="9" class="login" value="<?echo "$cost";?>">
      </td>
    </tr>
    <tr> 
      <td width="14%">&nbsp;</td>
      <td width="86%"><font color="#FFFFFF" size="2">日元 
        <input type="radio" name="fromdollar" value="0">
        港元 
        <input type="radio" name="fromdollar" value="1" checked>
        </font></td>
    </tr>
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2">買入存量</font></td>
      <td>
        <input type="text" name="stock" maxlength="9" class="login" value="<?echo "$stock";?>">
      </td>
    </tr>

    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2"> 存貨地: </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 旺角</font>
        <input type="radio" name="place" value="1" class="login" checked>
        <font face="新細明體" color="#FFFFFF" size="2"> 大圍</font>
        <input type="radio" name="place" value="2" class="login">
      </td>
    </tr>
    <tr>
      <input type="hidden" name="id" value="<?echo $id?>"><td>&nbsp;</td>
      <td><a href="JavaScript:checkform();"><img src="submit.gif" border=0 align=bottom></a> 
        <input type="reset" name="Submit2" value="Reset" class="login">
      </td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <td colspan="3">&nbsp;</td>
    <p></p>
  </form>
</body>
</html>
