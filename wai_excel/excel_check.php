<?
//create date	: 20041117
//modify date	: 20041117
//desc 				: for check wai's excel
//related db	: sumgoods
//programmer	: rickykei
?>
<html>
<head>
<title>for check wai's excel toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<script language="javascript">
function AddrWindow(toccbcc){
	
	window.open('b.php?recid=' + toccbcc,"","width=600,height=360,scrollbars=yes");
}
</script>


<script language="JavaScript">
<!--

function checkform()
{
	if(document.form1.sales_name.value == "")
	{
	alert ("請輸入貨品編號.");
	document.form1.goods_id[1].focus();
	}else
	{
        document.form1.submit();
        }

}

function check_record1()
{
	if(document.form1.member_id.value == "")
	{
	alert ("請輸入會員編號."+member_id);
	document.form1.member_id.focus();
	
	}else
	{
	window.open('check_record.php3?member_id='+form1.member_id.value);
        }

}
<!--

<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->

//-->//-->
</script>
</head>

<body bgcolor="#0066cc" text="#000000">

  <table width="79%" border="0">
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2">Check編號.:</font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
       
        </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <?
         echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">';
     ?>
        </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2">Check日期: </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <input type="text" name="invoice_date" value='<? echo Date("d/m/Y"); ?>' class="login">
        </font> </td>
      
    </tr>
  </table>
  <div id="Layer2" style="position:absolute; width:356px; height:39px; z-index:2; left: 9px; top: 103px; visibility: hidden"> 
    <table width="75%" border="0">
      <tr>
        <td width="25%"><font face="新細明體" color="#FFFFFF" size="2">會員編號: </font></td>
        <td width="75%"><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="member_id" class="login">
          </font>
<a href="JavaScript:check_record1();"><img src="submit2.png" width="20" height="10" border="0"></a>
</td>
      </tr>
    </table>
    
  </div>
  <form name="form1" method="post" action="search_excel_result.php">
  <table width="413" border="1" bordercolor="#00CC33">
    <tr> 
      <td width="8%">Rec.ID</td>




      <td width="78%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">PART NO.</font></div>
      </td>
      <td rowspan="31" width="14%"><a href="JavaScript:checkform();"><img src="submit2.png" width="47" height="28" border="0"></a></td>
    </tr>
    <? for ($i=0;$i<20;$i++)
   {
    ?>
    <tr> 
      <td width="8%"> <font face="新細明體" color="#FFFFFF" size="2"> 
        <? echo $i+1;?>
        </font> 
        <div align="center"></div>
      </td>
      <td width="78%"> 
          <input type="text" name="partno<?echo $i;?>"> 
<input type=button name="search" value=find onclick="javascript:AddrWindow('partno<?echo $i;?>')" ></td>
    </tr>
    <?
    }
    ?>
  </table>
 <input type=submit name=submit value=submit>
</form>
 
  <td colspan="3">&nbsp;</td>

</form>
</body>
</html>
