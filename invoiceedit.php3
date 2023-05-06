<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<?php 
	error_reporting(0);
	include_once("config.php3");

   
   $query="select invoice_no from invoice where invoice_no =$ed";
   
   $rows2=mysql_query($query);
 
   if (mysql_num_rows($rows2)==0)
   {
	   echo "Too Bad! Can't find invoice reocrd";
	  
   }else{
   
		$query="SELECT i.invoice_no, goods_id, goods_partno, qty, discountrate, marketprice, gi.status, gi.description, gi.invoice_no, invoice_date, sales_name, customer_name, customer_tel, customer_detail, member_id, i.status, customer_car_no, customer_car_type, mile
FROM goods_invoice AS gi
LEFT JOIN invoice AS i ON gi.invoice_no = i.invoice_no
WHERE gi.invoice_no =$ed";
		
  $rows=mysql_query($query);
   if (!$rows){
	 
			echo "There is an invoice record , but item records not found";
   }
   else
   {
      $row=mysql_fetch_row($rows);
      list($invoice_no,$goods_id,$goods_partno,$qty,$discountrate,$marketprice,$gistatus,$goods_detail, $invoice_no,$invoice_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$istatus,$customer_car_no,$customer_car_type,$mile)=$row;   
		$goods_invoice_sql="select id,invoice_no,goods_id,goods_partno,qty,discountrate,marketprice,status,description from goods_invoice where invoice_no=$invoice_no order by id asc";
	 
      $goodss=mysql_query($goods_invoice_sql);  
	  
      $i=1;
      while ($goods=mysql_fetch_row($goodss))
      {
         list($giid,$giinvoice_no,$gigoods_id,$gigoods_partno,$giqty,$gidiscountrate,$gimarketprice,$gistatus,$goods_detail)=$goods;
         $pgoods_id[$i]=$gigoods_id;
         $pgoods_partno[$i]=$gigoods_partno;
         $pqty[$i]=$giqty;
         $pdiscountrate[$i]=$gidiscountrate;
         $pmarket_price[$i]=$gimarketprice;
		 $pgoods_detail[$i]=$goods_detail;
         $i++;
      }


 

   }
   }
    if (!empty($member_id))     //check member
      {
         $mem="checked";
         $nomem="";
         $memshow="visible";
         $nomemshow="hidden";
      }
      else
      {
         $mem="";
         $nomem="checked";
         $memshow="hidden";
         $nomemshow="visible";
      }
?>


<script language="JavaScript">
function checkForm()
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

<body bgcolor="#0066cc" text="#000000">
<form name="form1" method="post" action="invoiceed.php3" enctype="multipart/form-data">
  <table width="75%" border="1">
    <tr>
      <td width="12%"><font face="新細明體" color="#FFFFFF" size="2">發票編號.:</font></td>
      <td width="38%"><font face="新細明體" color="#FFFFFF" size="2"> 
         <?php echo $invoice_no; 
         echo '<input type="hidden" name="invoice_no" value="',$invoice_no,'">';
     ?>
        </font></td>
      <td width="14%"><font face="新細明體" color="#FFFFFF" size="2">發票日期: </font></td>
      <td width="36%"><font face="新細明體" color="#FFFFFF" size="2"> 
         <?php echo $invoice_date;
		 echo '<input type="hidden" name="invoice_date" value="',$invoice_date,'">';
		 ?> 
        </font></td>
    </tr>
    <tr>
      <td width="12%"><font face="新細明體" color="#FFFFFF" size="2">售貨人:</font></td>
      <td width="38%"><font face="新細明體" color="#FFFFFF" size="2">
        <input type="text" name="sales_name" value='<? echo $sales_name ?>' class="login">
        </font></td>
      <td width="14%"><font face="新細明體" color="#FFFFFF" size="2">買貨人: </font></td>
      <td width="36%"><font face="新細明體" color="#FFFFFF" size="2">非會員 
        <input type="radio" name="customer" value="y" onClick="MM_showHideLayers('Layer1','','show','Layer2','','hide')" <? echo $nomem; ?>>
        會員 
        <input type="radio" name="customer" value="n" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','show')" <? echo $mem; ?>>
        </font></td>
    </tr>
  </table>
 
  <p>&nbsp;</p>
  <blockquote> 
    <p>&nbsp;</p>
    </blockquote>
  <div id="Layer1" style="position:absolute; width:700px; height:124px; z-index:1; left: 24px; top: 80px; visibility:<? echo $nomemshow; ?>"> 
     <table width="90%" border="0">
      <tr> 
        <td><font face="新細明體" color="#FFFFFF" size="2">買貨人:</font></td>
        <td><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_name" value="<?php echo $customer_name;?>" class="login">
          </font></td>
      </tr>
      <tr> 
        <td><font face="新細明體" color="#FFFFFF" size="2">電話: </font></td>
        <td><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_tel" value="<?php echo $customer_tel;?>" class="login">
          </font></td>
      </tr>
      <tr >
        <td><font face="新細明體" color="#FFFFFF" size="2">車牌號碼: </font></td>
        
        <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_no" class="login"  value="<?php echo $customer_car_no;?>" >
          </font></td>
          
          <td><font face="新細明體" color="#FFFFFF" size="2">車種: </font></td>
          
           <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_type"  value="<?php echo $customer_car_type;?>" class="login">
          </font></td>
          <td><font face="新細明體" color="#FFFFFF" size="2">里數: </font></td>
          
           <td><font face="新細明體" color="#FFFFFF" size="2" >
          <input type="text" name="mile" class="login" value="<?php echo $mile;?>" >
          </font></td>
      </tr>
    </table>
  </div>
  <div id="Layer2" style="position:absolute; width:700px; height:30px; z-index:2; left: 11px; top: 100px; visibility:  <? echo $memshow; ?>">
 <table width="75%" border="0">
      <tr>
        <td width="25%"><font face="新細明體" color="#FFFFFF" size="2">會員編號: </font></td>
        <td width="75%"><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="member_id" class="login" value="<?php echo $member_id;?>">
          </font>
<a href="JavaScript:check_record1();"><img src="submit2.png" width="20" height="10" border="0"></a>
</td>
      </tr>
	  <tr>
	   <td><font face="新細明體" color="#FFFFFF" size="2">車牌號碼: </font></td>
        
        <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="mem_car_no" class="login" value="<?php echo $customer_car_no;?>" >
          </font></td>
		  
		    <td><font face="新細明體" color="#FFFFFF" size="2">里數: </font></td>        
           <td><font face="新細明體" color="#FFFFFF" size="2"><input type="text" name="mem_mile" class="login" value="<?php echo $mile;?>"></font></td>
		  </tr>
    </table>
  </div>
 
  <p>&nbsp;</p>
  <table width="661" border="1" bordercolor="#FFFFFF">
    <tr> 
      <td width="4%">&nbsp;</td>
<? /*      <td width="21%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">貨物編號: </font></div>
      </td>
*/?>
      <td width="21%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">PART NO.</font></div>
      </td>
      <td width="22%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">描述 </font></div>
      </td>
      <td width="11%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">件數</font></div>
      </td>
      <td width="9%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">折扣率</font></div>
      </td>
      <td width="8%"> 
        <div align="center"><font face="新細明體" color="#FFFFFF" size="2">賣價</font></div></td>
      <td rowspan="31" width="4%"><a href="JavaScript:checkForm();"><img src="submit2.png" width="20" height="890" border="0"></a></td>
    </tr>
 <? for ($input=1;$input<=30;$input++)
   {
    ?>
    <tr> 
      <td width="4%"> 
        <font face="新細明體" color="#FFFFFF" size="2"><? echo $input;?></font>
        <div align="center"></div>
      </td>
<? /*      <td width="21%"> 
       <input type="text" name="goods_id[<?echo $input;?>]" value="<? echo $pgoods_id[$input]; ?>" class="login" size="20" maxlength="13">
      </td>
*/
?>
      <td width="21%"> 
        <input type="text" name="goods_partno[<?echo $input;?>]" value="<? echo $pgoods_partno[$input]; ?>" class="login" size="20" maxlength="20">
      </td>
      <td width="22%"> 
        <input type="text" name="goods_detail[<?echo $input;?>]" value="<? echo $pgoods_detail[$input]; ?>"class="login" size="20" maxlength="50">
      </td>
      <td width="11%"><font color="#FFFFFF" size="2">x 
      <input type="text" name="qty[<?echo $input;?>]" size="5" value="<? echo $pqty[$input]; ?>" class="login" maxlength="5">
      </font></td>
      <td width="9%"> 
        <input type="text" name="discountrate[<?echo $input;?>]" size="3" value="<? echo $pdiscountrate[$input]; ?>" class="login" maxlength="3" value="0">
        <font color="#FFFFFF" size="3">%</font> </td>
      <td width="8%"> 
        <input type="text" name="market_price[<?echo $input;?>]" class="login" size="4" maxlength="10" value="<? echo $pmarket_price[$input]; ?>">
      </td>
    </tr>
    <?
    }
    ?>
    </table>
  <p><font face="新細明體" color="#FFFFFF" size="2"> 
    
  </font></p>
</form>
</body>
</html>
