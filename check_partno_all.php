<html>
<head>

<title>�dpartno �X�J�O��</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<STYLE TYPE="text/css">
 /* unvisited link */
a:link {
  color: red;
}

/* visited link */
a:visited {
  color: green;
}

/* mouse over link */
a:hover {
  color: hotpink;
}

/* selected link */
a:active {
  color: blue;
}  

</STYLE>


<script language="JavaScript">
function checkform()
{
	if(document.ingoodnameform.goods_detail.value == "")
	{
	alert ("�п�J�f�~�s��.");
	document.ingoodnameform.goods_detail.focus();
	}else
	{
        document.ingoodnameform.submit();
        }

}
</script>
</head>

<body bgcolor="#0066cc" text="#FFFFFF">

<?
//////////////////////////////////
// stripslashes($goods_partno);200401130311
//////////////////////////////////
//$goods_partno=stripslashes($goods_partno);

///////////////////////////////////


   include("config.php3");
if ($update==2||$update==3)
{
   #$query1="select * from sumgoods where goods_partno=\"".$goods_partno."\" where admin_view='N'";
     if ($update==2&&($model!="" || $brand!=""))
   $query1="select * from sumgoods where goods_partno like \"$goods_partno%\" and brand like '%$brand%' and model like '%$model%' and admin_view=\"N\" ";
   else
   $query1="select * from sumgoods where goods_partno like \"$goods_partno%\" and admin_view=\"N\" order by goods_partno";
   if ($update==3)
   $query1="select * from sumgoods where goods_partno = \"$goods_partno\"  and admin_view=\"N\"";
   $result1=mysql_query($query1);
   $row1=mysql_fetch_array ($result1);
   $no1=mysql_num_rows($result1);
   ////////////////////////////////
   //can find record in sumgoods DB
   //�Y���J�f�W��
   //�p�G�Nrecord �N���X�J�O��
   //�n�G�h�Ӥ@�Ngen all partno
   ////////////////////////////////
   //
   //still find record from Invoice and goods db.200312082343 deal by Peggy
   //debug//echo "no1=".$no1;
   if ($no1==1)
   {
   	//echo "��partno�b�f�W�����O��\t";
   	$goods_partno=$row1["goods_partno"];
   }else 
   if ($no1==0)
   {
   	//echo "<b><font color=\"FFFF00\">��partno�b�f�W�����N�O��</font> �{�b�|���է�X��X�f�J�f�O�� \t</b>";
   }
   
   if ($no1==1||$no1==0)
   {

////// 
//gen �X�f record query//
/////

   $query2="select * from sumgoods,goods_invoice,invoice where goods_invoice.goods_partno=\"".$goods_partno."\" and sumgoods.goods_partno=goods_invoice.goods_partno and goods_invoice.invoice_no=invoice.invoice_no and sumgoods.admin_view=\"N\" order by invoice.invoice_no desc";
   $result2=mysql_query($query2);
   $row2=mysql_fetch_array ($result2);
   $no2=mysql_num_rows($result2);
   
   //echo "���?.$no2."���X�f�O��";
   
   //gen �J�f record query//
   $query3="select * from goods where goods_partno=\"".$goods_partno."\" order by date desc";
   $result3=mysql_query($query3);
   $row3=mysql_fetch_array ($result3);
   $no3=mysql_num_rows($result3);
   //echo "���?.$no3."���J�f�O��\t";
   
   // check sum of qty from goods_invoice for particular Partno
   $query5="select sum(qty) from goods_invoice where goods_partno=\"".$goods_partno."\"";
   // check sum of stock from goods for particular Partno
   $query6="select sum(stock) from goods where goods_partno=\"".$goods_partno."\"";
   // check don't remember function of blocked at 20031209 0017
   $query7="select * from goods_invoice,invoice where goods_invoice.invoice_no=invoice.invoice_no and goods_partno=\"".$goods_partno."\" order by goods_invoice.invoice_no  desc";
   $result7=mysql_query($query7);
   $row7=mysql_fetch_array ($result7);
   $no7=mysql_num_rows($result7);
   //echo "���?.$no7."���X�f�O��without sumgoodsjoin";
   
   $result5=mysql_query($query5);
   $result6=mysql_query($query6);
   
   $row5=mysql_fetch_array ($result5);
   $row6=mysql_fetch_array ($result6);
   
   }
   


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

if ($no1>1&&$update==2)
{
//$query1="select * from sumgoods where goods_partno like '$goods_partno%' and model like '$model%' and  admin_view ='N' order by goods_partno ";
//$result1=mysql_query($query1);
//$row1=mysql_fetch_array($result1);
echo "<table bgcolor=#EEEEEE border=1><tr bgcolor='Abcdef'><td ><font color=black> Partno</font></td><td><font color=black>Model</font></td><td><font color=black>Brand</font></td><td><font color=black>Description</font></td><td>MarketPrice</td><td>Stock</td></tr>";
	do
	{
	echo "<tr><td>";
	echo "<a href=check_partno_all.php?update=3&goods_partno=".urlencode($row1["goods_partno"]).">";
	echo $row1["goods_partno"];
	echo "</a>";
	echo "</td>";
	echo "<td><font color=#111111>";
	echo $row1["model"];
  echo "</font></td>";
  echo "<td><font color=#111111>";
	echo $row1["brand"];
  echo "</font></td>";
  echo "<td><font color=#111111>".$row1["goods_detail"]."</font></td>";
  
  // check sum of qty from goods_invoice for particular Partno
  $query5="select sum(qty) from goods_invoice where goods_partno=\"".$row1["goods_partno"]."\"";
  // check sum of stock from goods for particular Partno
  $query6="select sum(stock) from goods where goods_partno=\"".$row1["goods_partno"]."\"";
  // check don't remember function of blocked at 20031209 0017
  $query7="select * from goods_invoice,invoice where goods_invoice.invoice_no=invoice.invoice_no and goods_partno=\"".$row1["goods_partno"]."\" order by goods_invoice.invoice_no  desc";
  $result7=mysql_query($query7);
  $row7=mysql_fetch_array ($result7);
  $no7=mysql_num_rows($result7);
  
  $result5=mysql_query($query5);
  $result6=mysql_query($query6);
  
  $row5=mysql_fetch_array ($result5);
  $row6=mysql_fetch_array ($result6);
  echo "<td ><font  color=black>".$row1["market_price"]." </font></td><td>";
  $a=$row6["sum(stock)"]-$row5["sum(qty)"];
	if ($a<0)
	{
 		echo "<font face=�s�ө��� color=#FF0000 size=4>";
	}
	else
	{
		echo "<font face=�s�ө��� color=#000000 size=4>";
  }
  echo "  ".$a;
  echo "</font></td></tr><p>";
  	}
 	while($row1=mysql_fetch_array($result1));
 	echo "</table>";
}
 
 /////////////////////////////////////////////////////////
 //if search record >1, that means user will input "55555-"
 //this function will print all partno which start with 55555-%
 //////////////////////////////////////////////////////////
?>


<?
///////////////////////////////////////////////////////
//part-no and model INPUT       out=goods_partno,model,update=2
///////////////////////////////////////////////////////
?>

<form name=hello method="post" action="check_partno_all.php">
PartNo:<input type="text" name="goods_partno" maxlength="20">
Model:<input type="text" name="model" maxlength="255">
Brand:<input type="text" name="brand" maxlength="255">
<input type="hidden" name="update" value=2>
<input type="submit" name="submit">
</form>
<?
///////////////////////////////////////////////////////
//part-no and model INPUT
///////////////////////////////////////////////////////
?>



<?
////////////////////////////////////////////////
//generate �J�f�P�X�f 20031208 1614
///////////////////////////////////////////////
if ($no1==1||$no2!=0||$no7!=0)
{
	echo "<strong><font face=\"�s�ө���\" color=#FFFFFF size=\"3\">";
	echo "  �X�f = ".$row5["sum(qty)"];
	echo "  �J�f = ".$row6["sum(stock)"];
	echo "\n</font>";
	$a=$row6["sum(stock)"]-$row5["sum(qty)"];
	if ($a<0)
	{
 		echo "<font face=�s�ө��� color=#FF0000 size=4>";
	}
	else
	{
		echo "<font face=�s�ө��� color=#FFFFFF size=4>";
	}
	
echo "  �s�f = ".$a;
echo "<p>PARTNO = ".$row1["goods_partno"]." �f�~��� = ".$row1["goods_detail"]." ";
echo "\t ���� = ".$row1["market_price"];
echo "<p> Model = ".$row1["model"];
echo "<p> Brand = ".$row1["brand"];
echo "<p><font color=\"00DD00\"> REMARK=".$row1["remark"]."</font>";
echo "</ststrong>";
}
////////////////////////////////////////////////
//generate �J�f�P�X�f 20031208 1614
///////////////////////////////////////////////

?>

<?
////////////////////////////////////////////////
//generate �X�frecord 20031208 2354
///////////////////////////////////////////////
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td >
    <table  width="100%" border="1" cellpadding="2" cellspacing="1" >
      <tr class=tablehead>
           <td>�X�f</td>
      </tr>
      <tr>
        <td width="10%">invoice_no</td>
        <td width="10%">member_id</td>
        <td width="30%">customer_name</td>
        <td width="10%">goods_partno</td>
        <td width="3%">qty</td>
        <td width="5%">discoutrate</td>
        <td width="10%">marketprice</td><td width="10%">netPrice</td>
        <td width="20%">date</td>
      </tr>
      <? 
 if ($no1==1||$no2!=0||$no7!=0)
 {
  if ($no2!=0)
  {
  //	echo "no2!=0 line 249";
	for ($i=0;$i<$no2;$i++)
 	{
	if ($row2["customer_name"]=="")
	{
		if($row2["member_id"]!="")
		{
		$rows_member=mysql_query("select mem_name_eng,mem_name_chi from member where mem_id=".$row2["member_id"]);
		$rows_member2=mysql_fetch_array($rows_member);
 		if ($rows_member2["mem_name_eng"]!="")
 			$row2["customer_name"]=$rows_member2["mem_name_eng"];
 		else
 			$row2["customer_name"]=$rows_member2["mem_name_chi"];
		}
	}
  
	echo "<tr>";
	//<td width=\"10%\">".$row2["id"]."</td>";
	echo "<td width=\"10%\"><a target=\"invoice\" href=\"/invoice_pdf/".$row2["invoice_no"].".pdf\">".$row2["invoice_no"]."</a></td>";
  	echo "<td width=\"10%\">".$row2["member_id"]."</td>";
  	echo "<td width=\"30%\">".$row2["customer_name"]."</td>";
  	echo "<td width=\"10%\">".$row2["goods_partno"]."</td>";
  	echo "<td width=\"3%\">".$row2["qty"]."</td>";
  	echo "<td width=\"5%\">".$row2["discountrate"]."</td>";
  	echo "<td width=\"10%\">".$row2["marketprice"]."</td>";
	echo "<td width=\"10%\">".($row2["marketprice"]*(100-$row2["discountrate"])/100)."</td>";									   
  	//echo "<td width=\"3%\">".$row2["status"]."</td>";
  	echo "<td width=\"20%\">".$row2["invoice_date"]."</td>";
  	$row2=mysql_fetch_array ($result2);
 	}
  }
  else
  {
   for ($i=0;$i<$no7;$i++)
        {
        if ($row7["customer_name"]=="")
        {
                $rows_member=mysql_query("select mem_name_eng,mem_name_chi from member where mem_id=".$row7["member_id"]);
                $rows_member2=mysql_fetch_array($rows_member);
                if ($rows_member2["mem_name_eng"]!="")
                        $row7["customer_name"]=$rows_member2["mem_name_eng"];
                else
                        $row7["customer_name"]=$rows_member2["mem_name_chi"];
        }       
  
        echo "<tr>";
        //<td width=\"10%\">".$row7["id"]."</td>";
        echo "<td width=\"10%\">".$row7["invoice_no"]."</td>";
        echo "<td width=\"10%\">".$row7["member_id"]."</td>";
        echo "<td width=\"30%\">".$row7["customer_name"]."</td>";
        echo "<td width=\"10%\">".$row7["goods_partno"]."</td>";
        echo "<td width=\"3%\">".$row7["qty"]."</td>";
        echo "<td width=\"5%\">".$row7["discountrate"]."</td>";
        echo "<td width=\"10%\">".$row7["marketprice"]."</td>";
        //echo "<td width=\"3%\">".$row7["status"]."</td>";
        echo "<td width=\"20%\">".$row7["invoice_date"]."</td>";
        $row7=mysql_fetch_array ($result7);
	}
  }
  }
?>

  </tr>
</table>
</td></tr></table>
<br>
      <?
////////////////////////////////////////////////
//generate �J�frecord 20031208 2354
///////////////////////////////////////////////
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td bgcolor="">
      <table width="100%" border="1" cellpadding="2" cellspacing="1" bgcolor=>
        <tr class=tablehead>
          <td>�J�f</td>
        </tr>
        <tr class=tableBGcolor>
          <td width="5%">id</td>
          <td width="10%">ref_no</td>
          <td width="10%">goods_partno</td>
          <td width="10%">HK cost</td>
		  <td width="10%">rate</td>
		  <td width="10%">jp_cost</td>
		  <td width="10%">D/R</td>
		  <td width="10%">jp price</td>
		  <td width="10%">jp delivery</td>
		  <td width="10%">jp paint</td>
          <td width="10%">stock</td>
          <td width="10%">stockout</td>
          <td width="10%">place</td>
          <td width="10%">date</td>
		  <td width="10%">supplier</td>
          <td width="10%">status</td>
        </tr>
        <? 
 if ($no1==1||$no3!=0)
 {
 	for ($i=0;$i<$no3;$i++)
 	{
  	echo "<tr class=tableBGcolor><td width=\"10%\">".$row3["id"]."</td>";
  	echo "<td width=\"10%\">".$row3["ref_no"]."</td>";
  	echo "<td width=\"10%\">".$row3["goods_partno"]."</td>";
  	echo "<td width=\"10%\">".$row3["cost"]."</td>";
	echo "<td width=\"10%\">".$row3["jp_rate"]."</td>";
	echo "<td width=\"10%\">".$row3["jp_cost"]."</td>";
	echo "<td width=\"10%\">".$row3["discount"]."</td>";
	echo "<td width=\"10%\">".$row3["jp_price"]."</td>";
	echo "<td width=\"10%\">".$row3["jp_delivery"]."</td>";
	echo "<td width=\"10%\">".$row3["jp_paint"]."</td>";
  	echo "<td width=\"10%\">".$row3["stock"]."</td>";
  	echo "<td width=\"10%\">".$row3["stockout"]."</td>";
  		if ($row3["place"]==1)
  		$temp="����";
  	else 	if ($row3["place"]==2)
  		$temp="�j��";
	else 	if ($row3["place"]==3)
	  		$temp="�g���W";
	echo "<td width=\"10%\">".$temp."</td>";
  	echo "<td width=\"10%\">".$row3["date"]."</td>";
	echo "<td width=\"10%\">".$row3["in_comp_name"]."</td>";
  	echo "<td width=\"10%\">".$row3["status"]."</td>";
  	$row3=mysql_fetch_array ($result3);
 	}
}

////////////////////////////////////////////////
//generate �J�frecord 20031208 2354
///////////////////////////////////////////////
?>
     </tr> </table>
     </td></tr>
     </table>
    
</body>
</html>
