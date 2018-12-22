<? 

 include_once("../include/config.php");
 $connection = DB::connect($dsn);
   if (DB::isError($connection))
   {
      die($connection->getMessage());
	}
	    $result = $connection->query("SET NAMES 'UTF8'");

if ($add==1) //after submit
  {
   $flag=0;
  
      
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

  
    $query="insert into sumgoods (goods_partno,goods_detail,market_price,allstock,status,admin_view,remark,model,unitid) values ('$goods_partno','$goods_detail',$market_price,0,'Y','N','$remark','$model','$unitid')";
   
      echo "己經存入";
      if (mysql_query($query))
       echo "Success!";
      else
       echo "Too Bad!";
   }

}else
{
 
}
    //find out model type

   $unitResult = $connection->query("SELECT id,unit_name_chi FROM unit");
   if (DB::isError($unitResult))
      die ($unitResult->getMessage());
   $typeResult = $connection->query("SELECT * FROM type");
      if (DB::isError($typeResult))
      die ($typeResult->getMessage());
?>
<html>
<head>

<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
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
.style3 {font-size: 9pt; border-style: solid; border-width: 1px; background-color: #CCCCCC;}
.style6 {color: #FFFFFF}
.style8 {color: #FFFFFF; font-size: 14px; }
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
</script><link href="../include/invoice.css" rel="stylesheet" type="text/css">
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
</head>
<body >

<table width="900"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99CC99">
  <tr>
    <td width="4" height="">&nbsp;</td>
    <td align="center" valign="top"><table width="100%"  border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="14%" height="21" bgcolor="#006633"><span class="style6">入貨名</span></td>
        <td width="34%"><span class="style7"><? echo "< ".$AREA."鋪,第".$PC."機 >";?></span></td>
        <td width="15%">&nbsp;</td>
        <td width="37%">&nbsp;</td>
      </tr>
      <tr bgcolor="">
        <td height="24" colspan="4">
<form name=ingoodnameform method="post" action="ingoodname.php">

  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor=""> 
      <input type="hidden" name="add" value=1 class="login">
      <td width="15%" bgcolor="#669933"><font size="3" face="新細明體" class="style8">貨品編號：</font></td>
      <td width="85%" bgcolor="#669933" withd="86%"> 
        <input name="goods_partno" type="text">
        </td>
    </tr>
    <tr bgcolor=""> 
      <td width="15%" bgcolor="#669933"><font size="3" face="新細明體" class="style8">貨品描述：</font></td>
      <td width="85%" bgcolor="#669933"> 
        <textarea name="goods_detail" cols="40" rows="4" ></textarea>
      </td>
    </tr>
    <tr bgcolor="#666666"> 
      <td width="15%" bgcolor="#669933"><font size="3" face="新細明體" class="style8">備註：</font></td>
      <td width="85%" bgcolor="#669933"> 
        <textarea name="remark" cols="40" rows="4" ></textarea>
      </td>
    </tr>
    <tr bgcolor="#666666"> 
      <td width="15%" bgcolor="#669933" ><font face="新細明體" size="3"  class="style8">種類：</font></span></td>
      <td width="85%" bgcolor="#669933"> 
        <select name="model" id="model">
		<? while ($typerow = $typeResult->fetchRow(DB_FETCHMODE_ASSOC))
		 {
		 
	echo "<option value=\"".$typerow['typeName']."\">".$typerow['typeName']."</option>";
    }?>
        </select>
      </td>
    </tr>
       <tr bgcolor="#666666"> 
      <td width="15%" bgcolor="#669933"><font size="3" face="新細明體" class="style8">單位：</font></td>
      <td width="85%" bgcolor="#669933"> 
        <select name="unitid" id="unitid">
		<? while ($unitrow = $unitResult->fetchRow(DB_FETCHMODE_ASSOC))
		 {
		 
	echo "<option value=\"".$unitrow['id']."\">".$unitrow['unit_name_chi']."</option>";
    }?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#666666"> 
      <td width="15%" bgcolor="#669933"><font size="3" face="新細明體" class="style8">賣出市場價格:$/每件</font></td>
      <td width="85%" bgcolor="#669933"> 
        <input name="market_price" type="text"  >
      </td>
    </tr>
    <tr bgcolor="#006666"> 
      <td width="15%" bgcolor="#006633">&nbsp;</td>
      <td width="85%" bgcolor="#006633"><span class="style6"><input type="submit" name="submit" onclick="JavaScript:checkform();"/> 
      </span></td>
    </tr>
  </table>

</form></td>
      </tr>

    
    </table>     </td>
  </tr>
</table>



</body>
</html>
