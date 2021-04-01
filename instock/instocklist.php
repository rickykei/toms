<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<link rel="stylesheet" href="../include/instock_style.css" type="text/css">
<title>In Stock List</title>
<SCRIPT LANGUAGE="JavaScript">
function check_del(aa)
{
var temp_pass = prompt('如你真的要刪除此項,請輸入密碼!!');
var pass="123";

 if (temp_pass==pass)
 {
 alert(aa);
 window.location="only_goodsshow_del.php?id="+aa;
 }
 else
 {
 alert('error');
 }
}

</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #CCCCCC;
}

-->
</style>
<style type="text/css">
@import url(../include/cal/calendar-win2k-1.css);
</style>
<script type="text/javascript" src="../include/cal/calendar.js"></script>
<script type="text/javascript" src="../include/cal/lang/calendar-en.js"></script>
<script type="text/javascript" src="../include/cal/calendar-setup.js"></script>
<script type="text/javascript" src="../include/instock.js"></script></head>
<?php
  include_once("../include/config.php");
      require "../include/Pager.class.php";
   $query="SET NAMES 'big5'";
    $db = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
 //$result = $db->query("SET NAMES 'big5'");
 
 $sql_Search_Supplier="select * from goods_company ";
 $SupplierResult = $db->query($sql_Search_Supplier);
 
   // (Run the query on the winestore through the connection 
   ?>
<body>
<form id="form1" name="form1" method="post" action="instocklist.php">
    <div><label>Ref No.</label>
	<input name="supplier_invoice_no" type="text" id="supplier_invoice_no" size="20" maxlength="20" class="buttonstyle"/>
</div>
 
<div><label>Partno</label>
  <input name="goods_partno" class="buttonstyle"type="text" id="goods_partno" />
</div>
 
  
  
  <div><label>date start</label>
<input name="instock_date_start" id="instock_date_start" class="buttonstyle" type="text"  size="15"><input name="cal" id="calendar" value=".." type="button">
 
<input name="instock_date_end" id="instock_date_end" class="buttonstyle" type="text"  size="15" />
  <input name="cal2" id="calendar2" value=".." type="button" />
  </div><div><label> supplier name</label>
    <input name="suppliername" class="buttonstyle" type="text" id="supplier_name" />
    <input type="button" name="search2" value=".." onclick="javascript:popUp('page_search_supplier.php','650','350')" />
  </div>
  <input type="submit" value="search"/>
 <input type="hidden" name="update" value="2"/>
</form>
<?php

 $checking=0;
     	 if ($suppliername=="" && $supplier_invoice_no!="" && $instock_no=="" && $goods_partno=="" && $goods_partno2=="" && $market_price=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_detail=="")
	 	$sql="SELECT * FROM goods a where a.ref_no like \"%".$supplier_invoice_no."%\"";
	 
	 else if ($suppliername=="" && $goods_partno!="" && $instock_no=="" && $supplier_invoice_no=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_detail=="" && $goods_partno2=="" && $market_price=="")
	 	$sql="SELECT * FROM goods a where goods_partno=\"$goods_partno\"";
	 else if ($suppliername=="" && $instock_date_start!="" && $instock_date_end!="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail=="" && $goods_partno2=="" && $market_price=="")
	 	$sql="SELECT * from goods a where a.date >= '".$instock_date_start." 00:00:00' and a.instock_date <='".$instock_date_end." 23:59:00'";
		 else if ($suppliername!="" && $instock_date_start=="" && $instock_date_end=="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail=="" && $goods_partno2=="" && $market_price=="")
		 {
		// $sql=" select * from supplier where supplier.supplier_id='".$suppliername."'";
		//echo $sql;
		//  $SupplierResult = $db->query($sql);
		//  $supplierrow = $SupplierResult->fetchRow(DB_FETCHMODE_ASSOC);
		//20071006  
		 $sql="SELECT * FROM goods a where in_comp_name=\"$suppliername\"";
		 }
		  else if ($suppliername=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail!="" && $goods_partno2=="" && $market_price=="")
		 {
		 $sql="SELECT a.instock_date as instock_date,a.supplier_name as supplier_name, a.supplier_invoice_no as supplier_invoice_no,a.staff_name as staff_name, a.count_price as count_price, a.discount_percent as discount_percent,a.total_price as total_price,  a.instock_no as instock_no from instock a, goods_instock b where a.instock_no=b.instock_no and b.goods_detail like \"%".$goods_detail."%\"";
		 }
		 else if ($suppliername=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail=="" && $goods_partno2!="" && $market_price=="")
		 {
		$sql="select a.instock_date as instock_date, a.instock_no as instock_no, a.supplier_name as supplier_name,a.supplier_invoice_no as supplier_invoice_no,a.staff_name as staff_name,a.count_price as count_price,a.discount_percent as discount_percent,a.total_price as total_price ,b.market_price as market_price from goods_instock b ,instock a where b.instock_no = a.instock_no and b.goods_partno like \"%".$goods_partno2."%\" group by a.instock_no";
		 }
		  else if ($suppliername=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail=="" && $goods_partno2=="" && $market_price!="")
		 {
		$sql="select a.instock_date as instock_date, a.instock_no as instock_no, a.supplier_name as supplier_name,a.supplier_invoice_no as supplier_invoice_no,a.staff_name as staff_name,a.count_price as count_price,a.discount_percent as discount_percent,a.total_price as total_price ,b.market_price as market_price from goods_instock b ,instock a where b.instock_no = a.instock_no and b.market_price = ".$market_price." group by a.instock_no";
		 }
		 else if ($suppliername=="" && $instock_date_start=="" && $instock_date_end=="" && $goods_partno=="" && $instock_no=="" && $supplier_invoice_no=="" && $goods_detail=="" && $goods_partno2=="" && $market_price=="")
		$sql="SELECT * FROM goods a ";
		else {
	 	if ($goods_partno!=""){
	 		$sql="select a.instock_date as instock_date,a.instock_no as instock_no, a.supplier_name as supplier_name,a.supplier_invoice_no as supplier_invoice_no,a.staff_name as staff_name,a.count_price as count_price,a.discount_percent as discount_percent,a.total_price as total_price ,b.market_price as market_price from goods_instock  as b,instock as a  where b.instock_no = a.instock_no and b.goods_partno like \"%".$goods_partno."%\" ";
			$checking=1;
	 	}else{
	 		$sql="select * from instock as a  where ";
			$checking=0;
		}
		if ($supplier_invoice_no!=""){
			if ($checking==1) $sql.=" and ";
			$sql.=" a.supplier_invoice_no='".$supplier_invoice_no."' ";
		}
		if ($instock_no!=""){
			if($checking==1) $sql.=" and ";
			$sql.=" a.instock_no='".$instock_no."' ";
		}
		if ($instock_date_start!="" && $instock_date_end!=""){
			if($checking==1) $sql.=" and ";
			$sql.=" a.instock_date >= '".$instock_date_start." 00:00:00' and a.instock_date <='".$instock_date_end." 23:59:00' ";
		}
		if ($suppliername!=""){
		    if($checking==1) $sql.=" and ";
			$sql.=" a.supplier_name='".$suppliername."' ";
		}
	}

$sql.=" order by a.date desc ";
// echo $sql;
   include('Pager_header.php');
   ?>

<?

echo $turnover;
echo $Pager->numPages;
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#006666">
  <td width="22" height="23" bgcolor="#006666"><div align="center"><strong> id</strong></div></td>
    <td width="22" height="23" bgcolor="#006666"><div align="center"><strong> refno</strong></div></td>
    <td width="66" bgcolor="#006666"><div align="center"><strong>date </strong></div></td>
	<td width="66" bgcolor="#006666"><div align="center"><strong>supplier </strong></div></td>
    <td width="33" bgcolor="#006666"><div align="center"><strong>partno </strong></div></td>
    <td width="22" bgcolor="#006666"><div align="center"><strong>cost </strong></div></td>
    <td width="10%" bgcolor="#006666"><div align="center"><strong> place</strong></div></td>


	<td width="5%" bgcolor="#006666"><div align="center"><strong>EDIT</strong></div></td>
	<td width="5%" bgcolor="#006666"><div align="center"><strong>DELETE</strong></div></td>
  </tr>
  <?php 
	for ($i=0;$i<count($result);$i++)
	{ 
	$row=$result[$i];
	
   ?><tr valign="middle" align="center" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
   <td class="style7">    <?=$row['id']?> </td>
   <td class="style7">    <?=$row['ref_no']?> </td>
  <td class="style7">    <?=$row['date']?>  </td>
  <td class="style7">    <?=$row['in_comp_name']?>  </td>
  <td class="style7">    <?=$row['goods_partno']?>  </td>
  <td class="style7">    <?=$row['cost']?>  </td>
  <td class="style7"><div align="center"><?if($row['place']==1)echo "旺角"; if($row['place']==2)echo "大圍"; if($row['place']==3)echo "土瓜灣"; ?></strong></div></td>
 
  <td><a href="goodsedit.php?ed=<?=$row['id'];?>" class="b">EDIT</a></td>
  <td><a href="javascript:check_del(<?=$row['id'];?>)">DELETE</a></td>
  </tr>
<?
		 }
   ?>
</table>
<?php echo $turnover;?>
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "instock_date_start",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
      showsTime      :    true,
      button      : "calendar"       // ID of the button
      
    }
  );
  Calendar.setup(
    {
      inputField  : "instock_date_end",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
      showsTime      :    true,
      button      : "calendar2"       // ID of the button
      
    }
  );
</script>
</body>
</html>
