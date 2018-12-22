<?

   include("config.php3");
   //add on 9-5-01
       for ($j=0;$j<13;$j++)
      {

         $ch=substr($goods_id,$j,1);

         if ($ch==" ")  //change the space to "-"
            $ch="-";

         $cha=$cha.$ch;
      }
      $goods_id=$cha;
        //add on 9-5-01
   
if ($update==1)
  {
   if ($fromdollar==0)
   {
    $query2="select hk from hkjp where id=1";
    $result2=mysql_query($query2);
    $row2=mysql_fetch_array($result2);
   $market_price=$market_price*$row2["hk"];
   $query="update sumgoods set goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price where id=$id";
   }
   if ($fromdollar==1)
   {
    $query="update sumgoods set goods_id='$goods_id',goods_partno='$goods_partno',goods_detail='$goods_detail',market_price=$market_price where id=$id";
   }
   if (mysql_query($query))
   $string="更生了";
   else
   $string="Too Bad!";
   $update=0;

   } 
     if ($update==0)
   {
   $query="select * from sumgoods where id=$id";
   $result=mysql_query($query);
   $row= mysql_fetch_array ($result);
   }
?>
<html>
<head>

<title>Untitled Document</title>
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

<body bgcolor="#0066cc" text="#000000">
<form name=ingoodnameform method="post" action="ingoodnameedit.php3">
  <p><font face="新細明體" color="#FFFFFF" size="2">貨品編號: </font>
  <input type="hidden" name="id" value=<?echo $id;?> class="login">
  <input type="hidden" name="update" value=1 class="login">
    <input type="text" name="goods_id" maxlength="13" class="login" value="<? echo $row["goods_id"];?>">
    <font face="新細明體" color="#FFFFFF" size="2">貨品Part NO.:</font>
    <input type="text" name="goods_partno" maxlength="20" class="login" value="<? echo $row["goods_partno"];?>">
  </p>
  <p><font face="新細明體" color="#FFFFFF" size="2">貨品描述:</font></p>
  <p> 
    <textarea name="goods_detail" cols="80" rows="8" class="login"><?echo $row["goods_detail"];?></textarea>
  </p>
  <p>&nbsp;</p>
  <table width="75%" border="0">
      <tr> 
      <td width="14%">&nbsp;</td>
      <td width="86%"><font color="#FFFFFF" size="2">日元 
        <input type="radio" name="fromdollar" value="0">
        港元 
        <input type="radio" name="fromdollar" value="1">
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
