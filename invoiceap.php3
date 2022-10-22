<html>
<head>
<title>(invoice) toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
 
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


<?php
include_once("./include/config.php");
  $co_no=$_GET['co_no']; 
   $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
 
 if ($co_no!=""){
	$query="select * from co where co_no=".$co_no;
  
  $result=$connection->query($query);
  
	while($coRow = $result->fetchRow(DB_FETCHMODE_ASSOC)){
		$co_date=$coRow['co_date'];
		$sales_name=$coRow['sales_name'];
		$customer_name=$coRow['customer_name'];
		$customer_tel=$coRow['customer_tel'];
		$customer_car_no=$coRow['customer_detail'];
		$member_id=$coRow['member_id'];
		if ($member_id=="0") $member_id="";
		
	}
	
	$sql="select * from goods_co where co_no=".$co_no." order by id asc";
	$goodsCoResult = $connection->query($sql);
	$i=0;
	while($goodsCoRow = $goodsCoResult->fetchRow(DB_FETCHMODE_ASSOC)){
		$goods_partno[$i]=$goodsCoRow['goods_partno'];
		$qty[$i]=$goodsCoRow['qty'];
		$discountrate[$i]=$goodsCoRow['discountrate'];
		$goods_detail[$i]=$goodsCoRow['description'];
		$marketprice[$i]=$goodsCoRow['marketprice'];
		$i++;
	}
 }
		//print_r($goods_partno);
	
?>

<body bgcolor="#0066cc" text="#000000">
<form name="form1" method="post" action="invoiceadd.php3" enctype="multipart/form-data">
  <table width="79%" border="0">
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2">發票編號.:</font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <input type="text" name="textfield" value='<? 
         $query="select invoice_no from invoice order by invoice_no desc";
	 $query2="select * from staff where status='Y' order by staff_name";
	$rows=mysql_query($query);
        $rows2=mysql_query($query2);
	$row=mysql_fetch_row($rows);
	$row2=mysql_fetch_array($rows2);
	 $result3 = mysql_num_rows($rows2);
list($invoice_no)=$row;
	 $invoice_no=$invoice_no+1;
	 echo $invoice_no;
          ?>' class="login">
        </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <?
         echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">';
     ?>
        </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2">發票日期: </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
        <input type="text" name="invoice_date" value='<? echo Date("d/m/Y"); ?>' class="login">
        </font> </td>
      
    </tr>
    <tr> 
      <td><font face="新細明體" color="#FFFFFF" size="2">售貨人: </font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2"> 
                <select name="sales_name" size="1">
          <? for ($i=1;$i<=$result3;$i++)
                {
                echo "<option value=\"".$row2["staff_name"]."\">".$row2["staff_name"]."</option>";
                $row2=mysql_fetch_array ($rows2);}
        ?>
        </select>
        </font></td>
      <td>&nbsp;</td>
      <td><font face="新細明體" color="#FFFFFF" size="2">買貨人:</font></td>
      <td><font face="新細明體" color="#FFFFFF" size="2">非會員 
        <input type="radio" name="customer" value="y" onClick="MM_showHideLayers('Layer1','','show','Layer2','','hide')" checked>
        會員 
        <input type="radio" name="customer" value="n" onClick="MM_showHideLayers('Layer1','','hide','Layer2','','show')">
        </font></td>
      
    </tr>
    <tr> 
   
    </tr>
  </table>
  <div id="Layer1" style="position:absolute; width:700px; height:124px; z-index:1; left: 10px; top: 102px; visibility: visible"> 
    <table width="90%" border="0">
      <tr> 
        <td><font face="新細明體" color="#FFFFFF" size="2">買貨人:</font></td>
        <td><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_name" class="login" value="<?php echo $customer_name;?>">
          </font></td>
      </tr>
      <tr> 
        <td><font face="新細明體" color="#FFFFFF" size="2">電話: </font></td>
        <td><font face="新細明體" color="#FFFFFF" size="2"> 
          <input type="text" name="customer_tel" class="login" value="<?php echo $customer_tel;?>">
          </font></td>
      </tr>
      <tr >
        <td><font face="新細明體" color="#FFFFFF" size="2">車牌號碼: </font></td>
        
        <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_no" class="login" value="<?php echo $customer_car_no;?>">
          </font></td>
          
          <td><font face="新細明體" color="#FFFFFF" size="2">車種: </font></td>
          
           <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="customer_car_type" class="login">
          </font></td>
          <td><font face="新細明體" color="#FFFFFF" size="2">里數: </font></td>
          
           <td><font face="新細明體" color="#FFFFFF" size="2">
          <input type="text" name="mile" class="login">
          </font></td>
      </tr>
    </table>
    
  </div>
  <div id="Layer2" style="position:absolute; width:656px; height:59px; z-index:2; left: 9px; top: 103px; visibility: hidden"> 
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
          <input type="text" name="mem_car_no" class="login" >
          </font></td>
		  	  <td><font face="新細明體" color="#FFFFFF" size="2">里數: </font></td>        
           <td><font face="新細明體" color="#FFFFFF" size="2"><input type="text" name="mem_mile" class="login"></font></td>

		  </tr>
	
		  
    </table>
    
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

    
  <table width="661" border="1" bordercolor="#FFFFFF">
    <tr> 
      <td width="4%">&nbsp;</td>


<? //delete item_no at 10-6-02

//  <td width="21%"> 
//   <div align="center"><font face="新細明體" color="#FFFFFF" size="2">貨物編號: </font></div>
// </td>
?>

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
      <td rowspan="31" width="4%"><a href="JavaScript:checkform();"><img src="submit2.png" width="20" height="890" border="0"></a></td>
    </tr>
    <? for ($input=1;$input<=30;$input++)
   {
    ?>
    <tr> 
      <td width="4%"> <font face="新細明體" color="#FFFFFF" size="2"> 
        <? echo $input;?>
        </font> 
        <div align="center"></div>
      </td>

<?
/*delete item_no at 10-6-02
      <td width="21%"> 
        <input type="text" name="goods_id[<?echo $input;?>]" class="login" size="20" maxlength="13">
      </td>
*/
?>
      <td width="21%"> 
        <input type="text" name="goods_partno[<?echo $input;?>]" class="login" size="20" maxlength="20" value="<?php echo $goods_partno[$input-1];?>">
      </td>
      <td width="22%"> 
        <input type="text" name="goods_detail[<?echo $input;?>]" class="login" size="20" maxlength="50" value="<?php echo $goods_detail[$input-1];?>">
      </td>
      <td width="11%"><font color="#FFFFFF" size="2">x 
	  <?php if ($co_no!=""){ ?>
        <input type="text" name="qty[<?echo $input;?>]" size="5"  class="login" maxlength="5" value="<?php echo $qty[$input-1];?>">
	  <?php } else { ?>
	  <input type="text" name="qty[<?echo $input;?>]" size="5" value="1" class="login" maxlength="5" >
	  <?php }?>
        </font></td>
      <td width="9%"> 
        <input type="text" name="discountrate[<?echo $input;?>]" size="3" class="login" maxlength="3" value="<?php echo $discountrate[$input-1];?>">
        <font color="#FFFFFF" size="3">%</font> </td>
      <td width="8%"> 
        <input type="text" name="market_price[<?echo $input;?>]" class="login" size="4" maxlength="10" value="<?php echo $marketprice[$input-1];?>">
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
