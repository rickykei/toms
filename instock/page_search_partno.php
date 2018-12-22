<?php 
if (isset($recid)==false) {$recid=0;}
if (isset($recid2)==false) {$recid2=0;}
if (isset($recid3)==false) {$recid3=0;}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<script language="javascript">
function update2(a,b,c)
{
<?php echo "window.opener.document.getElementById('goods_partno".$recid."').value=a;";?>
<?php echo "window.opener.document.getElementById('goods_detail".$recid."').value=b;";?>
<?php //echo "window.opener.document.getElementById('market_price".$recid."').value=c;";?>
		window.close();
}
function Update(where)
{
	var emailto;
	var listname;
	
	if (where == 'partno1')
		emailto = window.opener.document.form1.partno1.value;
	else if (where == 'cc')
		emailto = window.opener.document.ComposeForm.cc.value;
	else if (where == 'bcc')
		emailto = window.opener.document.ComposeForm.bcc.value;
	else if (where == 'addtogrp') {
		listname = window.opener.document.GroupForm.listname.value;
	}
	
	for (var i = 0; i < document.toccbcc.elements.length; i++){
		var e = document.toccbcc.elements[i];
		if (e.name == 'addrlist' && e.checked)	{
			if (emailto)	emailto += ",";
			emailto += e.value;
		}
		if (where == 'addtogrp') {
			i++;
			var e2 = document.toccbcc.elements[i];
			if (e2.name == 'addrname' && e.checked ){
				if (listname)	listname += "&";
				listname += e2.value;
			}
		}
	}

	if (where == 'partno1')
	{
		alert(emailto);
		window.opener.document.form1.partno1.value = emailto;
	}
	else if (where == 'cc')
		window.opener.document.ComposeForm.cc.value = emailto;
	else if (where == 'bcc')
		window.opener.document.ComposeForm.bcc.value = emailto;
	else if (where == 'addtogrp') {
		window.opener.document.GroupForm.listname.value=listname;
		window.opener.document.GroupForm.ADEtype.value='';
		window.opener.document.GroupForm.submit();
	}
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
<body onLoad="javascript:first_text_box_focus();"><?php
   include_once("../include/config.php");
   $query="SET NAMES 'UTF8'";
    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());

   // (Run the query on the winestore through the connection
   $result = $connection->query("SET NAMES 'UTF8'");
  if (DB::isError($result))
      die ($result->getMessage());?>



<?
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

<form name="hello" method="post" action="page_search_partno.php">
<strong>貨品編號</strong>:
<input type="text" name="goods_partno" maxlength="20">
<strong>種類</strong>:
<input type="text" name="model" maxlength="255">
<strong>售價</strong>:
<input type="text" name="price" maxlength="10">
<input type="hidden" name="update" value=2>
<input type="hidden" name="recid" value="<? echo $recid;?>">
<?
$recid2=$recid+4;
$recid3=$recid+5;
?>
<input type="hidden" name="recid2" value="<? echo $recid2;?>">
<input type="hidden" name="recid3" value="<? echo $recid3;?>">
<input name="submit" type="submit" id="submit" value="搜尋">


</form>
<?
///////////////////////////////////////////////////////
//part-no and model INPUT
///////////////////////////////////////////////////////
?>

<?
if ($update==2||$update==3)
{
   #$query1="select * from sheet1 where goods_partno='$goods_partno' ";
   if ($update==2&&$model!="")
   $query1="select * from sumgoods where goods_partno like '%$goods_partno%' and model like '$model%' ";
   else if($update==2&&$goods_partno=="" && $model=="" && $price!="")
   $query1="select * from sumgoods where market_price ='$price' order by goods_partno";
   else if ($update==2&&$goods_partno!="" && $model=="" && $price=="")
   $query1="select * from sumgoods where goods_partno like '%$goods_partno%' order by goods_partno";
   if ($update==3)
   $query1="select * from sumgoods where goods_partno = '$goods_partno' ";
   
   $result1 = $connection->query("SET NAMES 'UTF8'");
   if (DB::isError($result))
      die ($result->getMessage());
   $result1=$connection->query($query1);
$no1=$result1->numRows();
    $row1 = $result1->fetchRow(DB_FETCHMODE_ASSOC);

   
   ////////////////////////////////
   //can find record in sumgoods DB
   //即有入貨名的
   //如果冇record 就找其出入記錄
   //好果多個一就gen all partno
   ////////////////////////////////
   //
   //still find record from Invoice and goods db.200312082343 deal by Peggy
   //debug//echo "no1=".$no1;
   if ($no1==1)
   {
   	//echo "此partno在貨名中有記錄\t";
   	$goods_partno=$row1["goods_partno"];
   }else 
   if ($no1==0)
   {
   	//echo "<b><font color=\"FFFF00\">此partno在貨名中並冇記錄</font> 現在會嘗試找出其出貨入貨記錄 \t</b>";
   }
   
   /*
    if ($no1==1||$no1==0)
   {
			echo "<a href=javascript:update2('".$row1["goods_partno"]."');>";
		echo $row1["goods_partno"];
   echo "</a>";
   }
   
   */


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

if ($no1>=1&&$update==2)
{
//$query1="select * from sumgoods where goods_partno like '$goods_partno%' and model like '$model%' and  admin_view ='N' order by goods_partno ";
//$result1=mysql_query($query1);
//$row1=mysql_fetch_array($result1);
?><table bgcolor=#DEF123 ><tr><td>貨品編號</td><td>貨品詳情</td><td >零售價</td><td>種類</td></tr><?
	do
	{
	echo "<tr><td>";
	echo "<a href=\"javascript:update2('".$row1["goods_partno"]."','".htmlspecialchars($row1["goods_detail"])."','".$row1["market_price"]."');\">";
	echo $row1["goods_partno"];
	echo "</a>";
	echo "</td>";
	echo "<td><font color=#111111>";
	echo $row1["goods_detail"];
	echo "</font></td>";
	echo "<td align=\"right\"><font color=#111111>";
	echo $row1["market_price"];
	echo "</font></td>";
	echo "<td><font color=#111111>";
	echo $row1["notes"];
	echo "</font></td>";
    echo "<td><font color=#111111>";
	echo $row1["model"];
	echo "</font></td>";
	echo "</tr><p>";
  	}
 	while(  $row1 = $result1->fetchRow(DB_FETCHMODE_ASSOC));
 	?><tr><td></td><td></td><td></td></tr></table><?
}
 
 /////////////////////////////////////////////////////////
 //if search record >1, that means user will input "55555-"
 //this function will print all partno which start with 55555-%
 //////////////////////////////////////////////////////////
?>

</BODY>
</HTML>
