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
function first_text_box_focus()
{
	document.form1.elements[0].focus();
}

function next_text_box(a)
{
	if (event.keyCode==13)
	{
	//alert(a);
	eval("document.form1.elements["+a+"].focus();");
	//alert(event.keyCode);
	return false;
	}

}

function AddrWindow(toccbcc){
	///var abc;
	//abc=document.form1.partno[0].value;
	//alert(abc);
	window.open('page_search_partno.php?recid=' + toccbcc,"","width=600,height=360,scrollbars=yes");
}
function checkform(i)
{
	if (i==1)
	{	
	document.form1.act.value=1;
	}
	else if (i==2)
	{
	document.form1.act.value=2;
	}
	
       document.form1.submit();
}
</script>


<script language="JavaScript">


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
<style type="text/css">
<!--
body {
	background-color: #336699;
}
.style1 {
	color: #000000;
	font-weight: bold;
}
.style2 {
	color: #FFFFFF;
	font-size: 14px;
	font-family: "Times New Roman", Times, serif;
}
-->
</style></head>

<body text="#000000" onload="javascript:first_text_box_focus()">

  <table width="79%" border="0">
    <tr> 
      <td><font color="#FFFFFF" class="style2"><strong>Check編號.:</strong></font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
       
        </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <?
         echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">';
     ?>
        </font></td>
      <td><font color="#FFFFFF" face="新細明體" class="style2"><strong>Check日期: </strong></font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <input type="text" name="invoice_date" value='<? echo Date("d/m/Y"); ?>' class="login">
        </font> </td>
      
    </tr>
  </table>
  
  <form name="form1" method="post" action="search_excel_result.php">
  
  <table width="387" border="1" bordercolor="#999999">
    <tr> 
      <td width="13%"><strong class="style1 style2">Rec.ID</strong></td>




      <td width="70%"> 
        <div align="center" class="style1 style2">PART NO.</div>
      </td>

      <td rowspan="31" width="17%"><a href="JavaScript:checkform(1);"><img src="submit2.png" width="34" height="600" border="0"></a><a href="JavaScript:checkform(2);"><img src="submit3.png" width="35" height="600" border="0"></a></td>
    </tr>
    <? 
    $elements_counter=0;
    for ($i=0;$i<20;$i++)
   {
    ?>
    <tr> 
      <td width="13%"> <font face="新細明體" color="#FFFFFF" size="3"> 
        <? echo $i+1;?>
        </font> 
        <div align="center"></div>
      </td>
      <td width="70%"> 
      <?
      /////20041210
      //cal next text box elements no.
      $temp_elements_counter=$elements_counter;
      if ($temp_elements_counter==38)
      {
      	$temp_elements_counter=0;
      }
      else
      {
      	$temp_elements_counter+=2;
      }
      ?>
          <input type="text" name="partno[]" onkeypress="return next_text_box(<?echo $temp_elements_counter;?>);"> 
<input type=button name="search" value=find onclick="javascript:AddrWindow('elements[<?echo $elements_counter;
$elements_counter=$elements_counter+2;
?>]')" ></td>
    </tr>
    <?
    }
    ?>
  </table>
<input type=hidden name=act value="">
</form>
 
  <td colspan="3">&nbsp;</td>

</form>
</body>
</html>
