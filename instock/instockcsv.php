<?
if ($update!="1"){
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../include/instock_style.css" type="text/css">
<title>入貨單</title>
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
</head>
<body>
<form id="form1" name="form1" method="post" action="instockcsv.php">
  日期由:
  <input name="dateFrom" type="text" id="dateFrom" />
  <input name="cal" id="cal" value=".." type="button" />
  至
  <input name="dateTo" type="text" id="dateTo" />
  <input name="cal2" id="cal2" value=".." type="button" />
  <input type="submit" value="搜尋"/>
  <input type="hidden" name="update" value="1"/>

</form>


<script type="text/javascript">

  Calendar.setup(
    {
      inputField  : "dateFrom",         // ID of the input field
      ifFormat    : "%Y-%m-%d 00:00",    // the date format
      showsTime      :    true,
      button      : "cal"       // ID of the button
      
    }
  );
    Calendar.setup(
    {
      inputField  : "dateTo",         // ID of the input field
      ifFormat    : "%Y-%m-%d 23:59",    // the date format
      showsTime      :    true,
      button      : "cal2"       // ID of the button
      
    }
  );
</script>
</html>
<? }else{
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");
  include_once("../include/config.php");

    $db = DB::connect($dsn);
   if (DB::isError($connection))
      die($connection->getMessage());
	 $result = $db->query("SET NAMES 'UTF8'");
   // (Run the query on the winestore through the connection
 
    
	 $sql="select * from instock, goods_instock where instock.instock_no=goods_instock.instock_no and instock_date >='$dateFrom' and instock_date<='$dateTo'";
	 echo "<table>";
	 echo "<tr><td>入貨編號</td><td>入貨日期</td><td>供應商名</td><td>供應商invoice_no</td><td>總計</td><td>partno</td><td>貨品名稱</td><td>數量</td><td>價錢</td><td>折扣</td><td>項計</td><td>扣貨</td></tr>";
	 $result = $db->query($sql);
	 while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC))
	 {
	 	echo "<tr><td>".$row["instock_no"]."</td><td>".$row["instock_date"]."</td><td>".$row["supplier_name"]."</td><td>".$row["supplier_invoice_no"]."</td><td>".$row["total_price"]."</td><td>".$row["goods_partno"]."</td><td>".$row["goods_detail"]."</td><td>".$row["qty"]."</td><td>".$row["market_price"]."</td><td>".$row["discount"]."<td>".$row["subtotal"]."</td><td>".$row["deductstock"]."</td></tr>";
		
	 }
	 echo "</table>";
}
?>
