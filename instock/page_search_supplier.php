<?php 
   include_once("../include/config.php");
   
    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
	  
//get Supplier name
	$connection = DB::connect($dsn);
	if (DB::isError($connection))
		die($connection->getMessage());
	$sql="SELECT * FROM goods_company";
 
	 $sql_Search_Supplier="select * from goods_company ";
 $SupplierResult = $connection->query($sql_Search_Supplier);
	
if (isset($recid)==false) {$recid=0;}
if (isset($recid2)==false) {$recid2=0;}
if (isset($recid3)==false) {$recid3=0;}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head>
<script language="javascript">
function update2(a,b)
{
<?php echo "window.opener.document.getElementById('supplier_name').value=b;";?>
<?php //echo "window.opener.document.getElementById('supplier_id').value=b;";?>
window.close();
}


</script>

<script language="javascript">
function first_text_box_focus()
{
	//document.getElementById('goods_id0');
	document.hello.goods_partno.focus();
}
</script>
<body onLoad="javascript:first_text_box_focus();">
<?php

/*$recid=$_GET["recid"];
if ($recid=="")
{
	$recid=$_POST["recid"];
}
$goods_partno=$_POST["goods_partno"];
$update=$_POST["update"];
*/
if ($goods_partno!="")
{
	//echo "PARTNO:".$goods_partno;
	//echo "<p>";
}

//echo "Return element ID:".$recid;
/*
$mysql_class=new mysql("select * from sumgoods",1);
get_class($mysql_class);
$result=$mysql_class->ask_mysql();
*/


?>




<?


///////////////////////////////////////////////////////
//part-no and model INPUT       out=goods_partno,model,update=2
///////////////////////////////////////////////////////
?>

<form name="hello" method="post" action="page_search_supplier.php">
  <p><strong></strong>
    <input type="text" name="supplier_name" maxlength="20">
    <input type="hidden" name="update" value=2>    <input name="submit" type="submit" id="submit" value="search">
  </p>
</form><form name="hello" method="post" action="page_search_supplier.php">
      <input type="hidden" name="update" value=4>
<div><label></label>
  <select name="supplier_name" id="supplier_name" >
  <option value=""> </option>
  <? while($Supplierrow = $SupplierResult->fetchRow(DB_FETCHMODE_ASSOC)){
  ?><option value="<?=$Supplierrow["id"]?>"><?=$Supplierrow["company_name"]?></option><?}?>
  </select>
  <input name="submit2" type="submit" id="submit2" value="search" >
</div>
  
<p>&nbsp;</p>

<?
///////////////////////////////////////////////////////
//part-no and model INPUT
///////////////////////////////////////////////////////
?>

<?
if ($update==2||$update==3)
{
   #$query1="select * from sheet1 where goods_partno='$goods_partno' ";

   $query1="select * from goods_company where company_name like '%$supplier_name%'";
   $result1=$connection->query($query1);
	$no1=$result1->numRows();
}else if ($update==4)
{ $query1="select * from goods_company where id = '$supplier_name'";
   $result1=$connection->query($query1);
	$no1=$result1->numRows();
	echo $query1;
}

?>


<?
/////////////////////////////////////////////////////////
//if search record >1, that means user will input "55555-"
//this function will print all partno which start with 55555-%
//but finding if someone insert 08295-SP241-L(one item)
//after click it will show two more items
//because which have 08295-SP241-LL(other item)
//:solution...chage the var update->3
//if 3 =no more choose for user
//////////////////////////////////////////////////////////

if (($no1>=1&&$update==2))
{
//$query1="select * from sumgoods where goods_partno like '$goods_partno%' and model like '$model%' and  admin_view ='N' order by goods_partno ";
//$result1=mysql_query($query1);
//$row1=mysql_fetch_array($result1);
?><table bgcolor=#DEF123 ><tr><td></td></tr><?
	while(  $row1 = $result1->fetchRow(DB_FETCHMODE_ASSOC))
	{
	echo "<tr><td>";
	echo "<a href=\"javascript:update2('".$row1["id"]."','".htmlspecialchars($row1["company_name"])."');\">";
	echo $row1["company_name"];
	echo "</a>";
	echo "</td>";
	echo "<td><font color=#111111>";
	echo $row1["supplier_id"];
	echo "</font></td>";

	echo "</tr><p>";
  	}
 	
 	?><tr><td></td><td></td><td></td></tr></table><?
}else if ($no1==1&&$update==4)
{
$row1 = $result1->fetchRow(DB_FETCHMODE_ASSOC);
 echo "<script language='javascript'>
 update2('".$row1["id"]."','".htmlspecialchars($row1["company_name"])."');
 </script>";
 
 }
 /////////////////////////////////////////////////////////
 //if search record >1, that means user will input "55555-"
 //this function will print all partno which start with 55555-%
 //////////////////////////////////////////////////////////
?>

</BODY>
</HTML>
