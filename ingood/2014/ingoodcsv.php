<?if ($update!="1"){
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../include/invoice_style.css" type="text/css">
<title>貨名excel</title>
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
</head>
<body>
<form id="form1" name="form1" method="post" action="ingoodcsv.php">
  <input type="submit" value="submit"/>
  <input type="hidden" name="update" value="1"/>

</form>

</html>
<? }else{
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=test.xls");
//header("Content-type:application/vnd.ms-excel;charset=utf-8");
//header("Content-Disposition:filename=test.xls");
  include_once("../include/config.php");
$db = DB::connect($dsn);
   if (DB::isError($connection))
      die($connection->getMessage());
	$result = $db->query("SET NAMES 'UTF8'");
   // (Run the query on the winestore through the connection
 $sql="select * from sumgoods order by id";
	 ?> <table>
<tr><td>id</td><td>goods_partno</td><td>goods_detail</td><td>market_price</td><td>status</td><td>admin_view</td><td>remark</td><td>model</td><td>unitid</td></tr><?
	 $result = $db->query($sql);
	 while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC))
	 {
	 	echo "<tr><td>".$row["id"]."</td><td>".$row["goods_partno"]."</td><td>".$row["goods_detail"]."</td><td>".$row["market_price"]."</td><td>".$row["status"]."</td><td>".$row["admin_view"]."</td><td>".$row["remark"]."</td><td>".$row["model"]."</td><td>".$row["unitid"]."</td></tr>";
		
	 }
	 ?></table><?
}
?>
