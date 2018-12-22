<html>
<head>
<title>(po) toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="po.css" TYPE="text/css">



<script language="JavaScript">
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

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_showHideLayers() { //v3.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
</head>

<body bgcolor="#CCFFCC" text="#FFFFFF">
<form name="form1" method="post" action="po_add.php3" enctype="multipart/form-data">
  <table width="79%" border="0">
    <tr> 
      <td><font face="新細明體" color="#000000" size="2">發票編號.:</font></td>
      <td><font face="新細明體" color="#000000" size="2"> 
        <input type="text" name="textfield" value='<?include("../config.php3");
         $query="select po_no from po order by po_no desc";
         $rows=mysql_query($query);
         $row=mysql_fetch_row($rows);
         list($po_no)=$row;
	 $po_no=$po_no+1;
	 echo $po_no;
          ?>' class="login">
        </font></td>
      <td><font face="新細明體" color="#000000" size="2"> 
        <?
         echo '<input type="hidden" name="po_no" value=',$po_no,' class="login">';
     ?>
        </font></td>
      <td><font face="新細明體" color="#000000" size="2">發票日期: </font></td>
      <td><font face="新細明體" color="#000000" size="2"> 
        <input type="text" name="po_date" value='<? echo Date("d/m/Y"); ?>' class="login">
        </font> </td>
      
    </tr>
    <tr> 
      <td><font face="新細明體" color="#000000" size="2">買貨人: </font></td>
      <td><font face="新細明體" color="#000000" size="2"> 
        <input type="text" name="sales_name" class="login">
        </font></td>
      <td>&nbsp;</td>
      <td><font face="新細明體" color="#000000" size="2">售貨人:</font></td>
      <td><font face="新細明體" color="#000000" size="2">非會員 
        <input type="radio" name="customer" value="y" onClick="MM_showHideLayers('Layer1','','show','Layer2','','hide')" checked>
        會員 
        <input type="radio" name="customer" value="n" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','show')">
        </font></td>
      
    </tr>
    <tr> 
   
    </tr>
  </table>
  <div id="Layer1" style="position:absolute; width:319px; height:104px; z-index:1; left: 10px; top: 102px; visibility: visible"> 
    <table width="75%" border="0">
      <tr> 
        <td><font face="新細明體" color="#000000" size="2">售貨人:</font></td>
        <td><font face="新細明體" color="#000000" size="2"> 
          <input type="text" name="customer_name" class="login">
          </font></td>
      </tr>
      <tr> 
        <td><font face="新細明體" color="#000000" size="2">電話: </font></td>
        <td><font face="新細明體" color="#000000" size="2"> 
          <input type="text" name="customer_tel" class="login">
          </font></td>
      </tr>
      <tr>
        <td><font face="新細明體" color="#000000" size="2">其他資料: </font></td>
        <td><font face="新細明體" color="#000000" size="2">
          <input type="text" name="customer_detail" class="login">
          </font></td>
      </tr>
    </table>
    
  </div>
  <div id="Layer2" style="position:absolute; width:356px; height:39px; z-index:2; left: 9px; top: 103px; visibility: hidden"> 
    <table width="75%" border="0">
      <tr>
        <td width="25%"><font face="新細明體" color="#000000" size="2">會員編號: </font></td>
        <td width="75%"><font face="新細明體" color="#000000" size="2"> 
          <input type="text" name="member_id" class="login">
          </font>
<a href="JavaScript:check_record1();"><img src="submit2.png" width="20" height="10" border="0"></a>
</td>
      </tr>
    </table>
    
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

    
  <table width="661" border="1" bordercolor="#000000">
    <tr> 
      <td width="4%">&nbsp;</td>
      <td width="21%"> 
        <div align="center"><font face="新細明體" color="#000000" size="2">PART NO.</font></div>
      </td>
      <td width="22%"> 
        <div align="center"><font face="新細明體" color="#000000" size="2">描述 </font></div>
      </td>
      <td width="11%"> 
        <div align="center"><font face="新細明體" color="#000000" size="2">件數</font></div>
      </td>
      <td width="9%"> 
        <div align="center"><font face="新細明體" color="#000000" size="2">折扣率</font></div>
      </td>
      <td width="8%"> 
        <div align="center"><font face="新細明體" color="#000000" size="2">賣價</font></div></td>
      <td rowspan="31" width="4%"><a href="JavaScript:checkform();"><img src="../submit2.png" width="20" height="890" border="0"></a></td>
    </tr>
    <? for ($input=1;$input<=30;$input++)
   {
    ?>
    <tr> 
      <td width="4%"> <font face="新細明體" color="#000000" size="2"> 
        <? echo $input;?>
        </font> 
        <div align="center"></div>
      </td>
      <td width="21%"> 
        <input type="text" name="goods_partno[<?echo $input;?>]" class="login" size="20" maxlength="20">
      </td>
      <td width="22%"> 
        <input type="text" name="goods_detail[<?echo $input;?>]" class="login" size="20" maxlength="50">
      </td>
      <td width="11%"><font color="#000000" size="2">x 
        <input type="text" name="qty[<?echo $input;?>]" size="5" value="1" class="login" maxlength="5">
        </font></td>
      <td width="9%"> 
        <input type="text" name="discountrate[<?echo $input;?>]" size="3" class="login" maxlength="3" value="0">
        <font color="#000000" size="3">%</font> </td>
      <td width="8%"> 
        <input type="text" name="market_price[<?echo $input;?>]" class="login" size="4" maxlength="10">
      </td>
    </tr>
    <?
    }
    ?>
  </table>
 
 
  <td colspan="3">&nbsp;</td>

</form>
</body>
</html>
