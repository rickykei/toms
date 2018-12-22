<?
//create date	: 20041117
//modify date	: 20041117
//desc 				: for check wai's excel
//related db	: sumgoods
//programmer	: rickykei
?>




<?

require ('./class200411.php');
require ('./connection.php');
$mysql_class=new mysql("select * from sumgoods",1);
get_class($mysql_class);
$result=$mysql_class->ask_mysql();


?>
<HTML>
<HEAD>
<TITLE>PARTNO_SEARCHING</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
</HEAD>

<script language="JavaScript">
function update2(where)
{

		window.opener.document.form1.<? echo $recid; ?>.value = where;
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
<BODY>

<?


///////////////////////////////////////////////////////
//part-no and model INPUT       out=goods_partno,model,update=2
///////////////////////////////////////////////////////
?>

<form name=hello method="post" action="b.php">
PartNo:<input type="text" name="goods_partno" maxlength="20">
<br>
Model:<input type="text" name="model" maxlength="255">
<input type="hidden" name="update" value=2>

<input type="hidden" name="recid" value="<? echo $recid;?>">
 	<br><input type="submit" name="submit">
</form>
<?
///////////////////////////////////////////////////////
//part-no and model INPUT
///////////////////////////////////////////////////////
?>

<?
if ($update==2||$update==3)
{
   #$query1="select * from sheet1 where goods_partno=\"".$goods_partno."\" ";
   if ($update==2&&$model!="")
   $query1="select * from sheet1 where goods_partno like \"$goods_partno%\" and model like '$model%' ";
   else
   $query1="select * from sheet1 where goods_partno like \"$goods_partno%\" order by goods_partno";
   if ($update==3)
   $query1="select * from sheet1 where goods_partno = \"$goods_partno\" ";
   $result1=mysql_query($query1);
   $row1=mysql_fetch_array ($result1);
   $no1=mysql_num_rows($result1);
   
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
   
   
    if ($no1==1||$no1==0)
   {

		echo $row1["goods_partno"];
   
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
echo "<table bgcolor=#EEEEEE>";
	do
	{
	echo "<tr><td>";
	echo "<a href=javascript:update2('".$row1["goods_partno"]."');>";
	echo $row1["goods_partno"];
	echo "</a>";
	echo "</td>";
	echo "<td><font color=#111111>";
	echo $row1["model"];
	echo "</font></td>";
	echo "<td><font color=#111111>";
	echo $row1["notes"];
	echo "</font></td>";
	echo "</tr><p>";
  	}
 	while($row1=mysql_fetch_array($result1));
 	echo "</table>";
}
 
 /////////////////////////////////////////////////////////
 //if search record >1, that means user will input "55555-"
 //this function will print all partno which start with 55555-%
 //////////////////////////////////////////////////////////
?>
<form name="toccbcc" method="POST" action="javascript:Update('partno1')">


 <?/* while($row=mysql_fetch_array($result))
 {
 	echo "<input type=\"checkbox\" name=\"addrlist\" value=\"";
 	echo $row["goods_partno"];
 	echo "\">";
 	echo $row["goods_partno"];
 	echo "<input type=\"hidden\" name=\"addrname\" value=\"";
 	
 	echo $row["goods_partno"];
 	echo "\">

 	
 	<br>";
}*/
 ?>	





</BODY>
</HTML>
