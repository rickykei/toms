<? 
if ($add==1) //after submit
  {
   $flag=0;
   include("config.php3");
      
   $query="select * from sumgoods where goods_partno='$goods_partno'";
   $result=mysql_query($query);
   $row= mysql_fetch_array ($result);
   if ($row["goods_partno"]!=null)
   $flag=1;
   
   
   
   if ($flag==1)
   {
    echo "此項partno已於早前被輸入資料庫";
   }
   else
   {
    $query2="select hk from hkjp where id=1";
    $result2=mysql_query($query2);
    $row2=mysql_fetch_array($result2);
    echo $row2["hk"];

   //add on 9-5-01
   /* disable 11-6-02 remove good_id
    for ($j=0;$j<13;$j++)
      {
        
         $ch=substr($goods_id,$j,1);

         if ($ch==" ")  //change the space to "-"
            $ch="-";

         $cha=$cha.$ch;
      }
      $goods_id=$cha;
        //add on 9-5-01
   */

    if ($fromdollar==0)
    {
 
    $market_price=$market_price*$row2["hk"];
       
    $query="insert into sumgoods (goods_id,goods_partno,goods_detail,market_price,allstock,status,admin_view,remark,model) values ('$goods_id','$goods_partno','$goods_detail',$market_price,0,'Y','N','$remark','$model')";
    }
    
    if ($fromdollar==1)
    {
    $query="insert into sumgoods (goods_id,goods_partno,goods_detail,market_price,allstock,status,admin_view,remark,model) values ('$goods_id','$goods_partno','$goods_detail',$market_price,0,'Y','N','$remark','$model')";
    }
      echo "己經存入";
      
      if (mysql_query($query))
       echo "Success!";
      else
       echo "Too Bad!";
   }

}
?>
<html>
<head>

<title>入貨名</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
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
<form name=ingoodnameform method="post" action="ingoodname.php3">
  <? /*<p><font face="新細明體" color="#FFFFFF" size="2">貨品編號: </font>
  <input type="hidden" name="add" value=1 class="login">
    <input type="text" name="goods_id" maxlength="13" class="login">
  */?>
  <table width="87%" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <input type="hidden" name="add" value=1 class="login">
      <td width="18%"><font face="新細明體" color="#FFFFFF" size="2">貨品Part NO.:</font></td>
      <td withd="86%" width="82%"> 
        <input type="text" name="goods_partno" maxlength="20" class="login">
      </td>
    </tr>
    <tr> 
      <td width="18%"><font face="新細明體" color="#FFFFFF" size="2">貨品描述:</font> 
      </td>
      <td width="82%"> 
        <textarea name="goods_detail" cols="80" rows="8" class="login"></textarea>
      </td>
    </tr>
    <tr> 
      <td width="18%"><font face="新細明體" color="#FFFFFF" size="2">備註:</font> </td>
      <td width="82%"> 
        <textarea name="remark" cols="80" rows="8" class="login"></textarea>
      </td>
    </tr>
    <tr> 
      <td width="18%"><font color="#FFFFFF" >MODEL:</font></td>
      <td width="82%"> 
        <input type="text" name="model" size="30" maxlength="255" class="login">
      </td>
    </tr>
    <tr> 
      <td width="18%">&nbsp;</td>
      <td width="82%" ><font color="#FFFFFF" size="2" >日元 
        <input type="radio" name="fromdollar" value="0" class="login">
        港元 
        <input type="radio" name="fromdollar" value="1" class="login">
        </font></td>
    </tr>
    <tr> 
      <td width="18%"><font face="新細明體" color="#FFFFFF" size="2">賣出市場價格:$/每件</font></td>
      <td width="82%"> 
        <input type="text" name="market_price" maxlength="9" class="login">
      </td>
    </tr>
    <tr> 
      <td width="18%">&nbsp;</td>
      <td width="82%"><a href="JavaScript:checkform();"><img src="submit.gif" border=0 align=bottom></a> 
        <input type="reset" name="Submit2" value="Reset" class="login">
      </td>
    </tr>
  </table>
  <p>
    <? if ($add==1){echo "存入了!!";}?>
  </p>
  </form>
</body>
</html>
