<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<?
 
error_reporting(0);

   include("config.php3");

   //$query="select * from goods_invoice left join goods on goods_invoice.goods_id=goods.goods_id left join invoice on goods_invoice.invoice_no=invoice.invoice_no where goods_invoice.invoice_no=$ed";
$query = "select * from invoice , goods_invoice where  invoice.invoice_no = goods_invoice.invoice_no and invoice.invoice_no=$ed";
   //$query= "Select i.invoice_no,gi.goods_id,gi.goods_partno,gi.qty,gi.discountrate,gi.marketprice,gi.status,i.invoice_no,i.invoice_date,i.sales_name,i.customer_name,i.customer_tel,i.customer_detail,i.member_id,i.customer_car_no,i.customer_car_type from goods_invoice as gi,invoice as i ,goods as g where g.goods_id=gi.goods_id and gi.invoice_no=i.invoice_no and i.invoice_no=$ed";
   $rows2=mysql_query($query);
 
   if (mysql_num_rows($rows2)==0)
   {
   echo "Too Bad!1";
   }else{
   
   $query="select * from goods_invoice left join goods on goods_invoice.goods_id=goods.goods_id left join invoice on goods_invoice.invoice_no=invoice.invoice_no where goods_invoice.invoice_no=$ed";
   $rows=mysql_query($query);
   if (!$rows)
      echo "Too Bad!";
   else
   {
      $row=mysql_fetch_row($rows);
      list($id,$invoice_no,$goods_id,$goods_partno,$qty,$discountrate,$marketprice,$gistatus,$gid,$ref_no,$goods_id1,$goods_partno,$cost,$stock,$stockout,$place,$date,$gstatus,$gin_good_comp_name,$invoice_no1,$invoice_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$istatus,$customer_car_no,$customer_car_type,$mile)=$row;  
      //list($invoice_no,$goods_id,$goods_partno,$qty,$discountrate,$marketprice,$gistatus,$invoice_no1,$invoice_date,$sales_name,$customer_name,$customer_tel,$customer_detail,$member_id,$customer_car_no,$customer_car_type)=$row;  

      $goodss=mysql_query("select * from goods_invoice where invoice_no=$invoice_no order by id asc"); //get goods item
      $i=1;
      while ($goods=mysql_fetch_row($goodss))
      {
         list($giid,$giinvoice_no,$gigoods_id,$gigoods_partno,$giqty,$gidiscountrate,$gimarketprice,$gistatus)=$goods;
         $pgoods_id[$i]=$gigoods_id;
         $pgoods_partno[$i]=$gigoods_partno;
         $pqty[$i]=$giqty;
         $pdiscountrate[$i]=$gidiscountrate;
         $pmarket_price[$i]=$gimarketprice;
         $i++;
      }


//change at 12-6-01
     // $d=substr($invoice_date,8,2);    //set date format
      //$m=substr($invoice_date,5,2);
      //$y=substr($invoice_date,0,4);
      //$invoice_date=$d."/".$m."/".$y;

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

   }
   }
?>


<script language="JavaScript">
function checkForm()
{
	if(document.form1.sales_name.value == "")
	{
	alert ("�п�J�f�~�s��.");
	document.form1.goods_id[1].focus();
	}else
	{
        document.form1.submit();
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

<body bgcolor="#0066cc" text="#000000">
<form name="form1" method="post" action="invoiceed.php3" enctype="multipart/form-data">
  <table width="75%" border="1">
    <tr>
      <td width="12%"><font face="�s�ө���" color="#FFFFFF" size="2">�o���s��.:</font></td>
      <td width="38%"><font face="�s�ө���" color="#FFFFFF" size="2"> 
        <input type="text" name="textfield" value='<? echo $invoice_no; ?>' class="login">
        <?
         echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">';
     ?>
        </font></td>
      <td width="14%"><font face="�s�ө���" color="#FFFFFF" size="2">�o�����: </font></td>
      <td width="36%"><font face="�s�ө���" color="#FFFFFF" size="2"> 
        <input type="text" name="invoice_date" value='<? echo $invoice_date ?>' class="login">
        </font></td>
    </tr>
    <tr>
      <td width="12%"><font face="�s�ө���" color="#FFFFFF" size="2">��f�H:</font></td>
      <td width="38%"><font face="�s�ө���" color="#FFFFFF" size="2">
        <input type="text" name="sales_name" value='<? echo $sales_name ?>' class="login">
        </font></td>
      <td width="14%"><font face="�s�ө���" color="#FFFFFF" size="2">�R�f�H: </font></td>
      <td width="36%"><font face="�s�ө���" color="#FFFFFF" size="2">�D�|�� 
        <input type="radio" name="customer" value="y" onClick="MM_showHideLayers('Layer1','','show','Layer2','','hide')" <? echo $nomem; ?>>
        �|�� 
        <input type="radio" name="customer" value="n" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','show')" <? echo $mem; ?>>
        </font></td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <p><font face="�s�ө���" color="#FFFFFF" size="2"> </font></p>
  <p>&nbsp;</p>
  <blockquote> 
    <p>&nbsp;</p>
    </blockquote>
  <div id="Layer1" style="position:absolute; width:700px; height:124px; z-index:1; left: 24px; top: 138px; visibility:<? echo $nomemshow; ?>"> 
     <table width="90%" border="0">
      <tr> 
        <td><font face="�s�ө���" color="#FFFFFF" size="2">�R�f�H:</font></td>
        <td><font face="�s�ө���" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_name" value="<?php echo $customer_name;?>" class="login">
          </font></td>
      </tr>
      <tr> 
        <td><font face="�s�ө���" color="#FFFFFF" size="2">�q��: </font></td>
        <td><font face="�s�ө���" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_tel" value="<?php echo $customer_tel;?>" class="login">
          </font></td>
      </tr>
      <tr >
        <td><font face="�s�ө���" color="#FFFFFF" size="2">���P���X: </font></td>
        
        <td><font face="�s�ө���" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_no" class="login"  value="<?php echo $customer_car_no;?>" >
          </font></td>
          
          <td><font face="�s�ө���" color="#FFFFFF" size="2">����: </font></td>
          
           <td><font face="�s�ө���" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_type"  value="<?php echo $customer_car_type;?>" class="login">
          </font></td>
          <td><font face="�s�ө���" color="#FFFFFF" size="2">����: </font></td>
          
           <td><font face="�s�ө���" color="#FFFFFF" size="2" >
          <input type="text" name="mile" class="login" value="<?php echo $mile;?>" >
          </font></td>
      </tr>
    </table>
  </div>
  <div id="Layer2" style="position:absolute; width:700px; height:39px; z-index:2; left: 11px; top: 158px; visibility:  <? echo $memshow; ?>">
 <table width="75%" border="0">
      <tr>
        <td width="25%"><font face="�s�ө���" color="#FFFFFF" size="2">�|���s��: </font></td>
        <td width="75%"><font face="�s�ө���" color="#FFFFFF" size="2"> 
          <input type="text" name="member_id" class="login" value="<?php echo $member_id;?>">
          </font>
<a href="JavaScript:check_record1();"><img src="submit2.png" width="20" height="10" border="0"></a>
</td>
      </tr>
	  <tr>
	   <td><font face="�s�ө���" color="#FFFFFF" size="2">���P���X: </font></td>
        
        <td><font face="�s�ө���" color="#FFFFFF" size="2">
          <input type="text" name="mem_car_no" class="login" value="<?php echo $customer_car_no;?>" >
          </font></td>
		  
		    <td><font face="�s�ө���" color="#FFFFFF" size="2">����: </font></td>        
           <td><font face="�s�ө���" color="#FFFFFF" size="2"><input type="text" name="mem_mile" class="login" value="<?php echo $mile;?>"></font></td>
		  </tr>
    </table>
  </div>
    <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="661" border="1" bordercolor="#FFFFFF">
    <tr> 
      <td width="4%">&nbsp;</td>
<? /*      <td width="21%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">�f���s��: </font></div>
      </td>
*/?>
      <td width="21%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">PART NO.</font></div>
      </td>
      <td width="22%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">�y�z </font></div>
      </td>
      <td width="11%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">���</font></div>
      </td>
      <td width="9%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">�馩�v</font></div>
      </td>
      <td width="8%"> 
        <div align="center"><font face="�s�ө���" color="#FFFFFF" size="2">���</font></div></td>
      <td rowspan="31" width="4%"><a href="JavaScript:checkForm();"><img src="submit2.png" width="20" height="890" border="0"></a></td>
    </tr>
 <? for ($input=1;$input<=30;$input++)
   {
    ?>
    <tr> 
      <td width="4%"> 
        <font face="�s�ө���" color="#FFFFFF" size="2"><? echo $input;?></font>
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
  <p><font face="�s�ө���" color="#FFFFFF" size="2"> 
    
  </font></p>
</form>
</body>
</html>