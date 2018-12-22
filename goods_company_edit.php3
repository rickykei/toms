<?

   include("config.php3");
   
if ($update==1)
  {
   $query="insert into goods_company values ('',\"$company_name\",\"\")";
  
   if (mysql_query($query))
   $string="更生了";
   else
   $string="Too Bad!";
   $update=0;

   } 
   
if ($update==2)
  {
   $query="delete from goods_company where id=$id";
   mysql_query($query);
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
	if(document.ingoodnameform.company_name.value == "")
	{
	alert ("請輸入貨品編號.");
	document.ingoodnameform.company_name.focus();
	}else
	{
        document.ingoodnameform.submit();
        }

}
</script>
</head>

<body bgcolor="#99CCFF" text="#FFFFFF">
<?
$result2=mysql_query("select * from goods_company");
$result3=mysql_num_rows($result2);
?>
<table>
<? for($i=1;$row=mysql_fetch_row($result2);++$i)
	{
echo "<tr><td width=\"14%\"><a href=\"goods_company_edit.php3?update=2&id=$row[0]\">".$row[0]."</a></td>";
echo "<td width=\"14%\">".$row[1]."</td></tr>";
}?>

</table>
<form name=ingoodnameform method="post" action="goods_company_edit.php3">
  <p><font face="新細明體" color="#FFFFFF" size="2">新增公司名:</font>
    <input type="hidden" name=update value=1>
	<input type="text" name="company_name" maxlength="100" class="login" >
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
