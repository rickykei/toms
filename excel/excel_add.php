<?
//create date	: 20041128
//modify date	: 20041228
//desc 				: for check wai's excel
//related db	: sheet1,
//programmer	: rickykei
?>
<?
if ($act==1)
{
require_once('./include/class200411.php');
require_once('./include/connection.php');
   
   
   $string_class=new string_class;
   get_class($string_class);
   $goods_partno=$string_class->check_null($goods_partno);
   $model=$string_class->check_null($model);
	 $notes=$string_class->check_null($notes);
	 $toms_dollar=$string_class->check_null($toms_dollar);
	 $yen=$string_class->check_null($yen);
	 $car_shop_price=$string_class->check_null($car_shop_price);

	$counter=count($goods_partno);

	for ($i=0;$i<$counter;$i++)
	{
		
		$sql="select * from sheet1 where goods_partno='".$goods_partno[$i]."'";
		//echo $sql;
		$mysql_class=new mysql($sql,1);
		get_class($mysql_class);
		$result=$mysql_class->ask_mysql();
		$have_record[$i]=$mysql_class->no_of_rows();
		$row=mysql_fetch_array($result);
		$model[$i]=$row["model"];
		$notes[$i]=$row["notes"];
		$toms_dollar[$i]=$row["toms_dollar"];
		$yen[$i]=$row["yen"];
		$car_shop_price[$i]=$row["car_shop_price"];
		
	}
}
else if ($act==2)
{
	echo "<table>";
	require_once('./include/class200411.php');
  require_once('./include/connection.php');
   $string_class=new string_class;
   get_class($string_class);
   $goods_partno=$string_class->check_null($goods_partno);
   $model=$string_class->check_null($model);
	 $notes=$string_class->check_null($notes);
	 $toms_dollar=$string_class->check_null($toms_dollar);
	 $yen=$string_class->check_null($yen);
	 $car_shop_price=$string_class->check_null($car_shop_price);
	 $counter=count($goods_partno);
	 
	 //20041228 fill dollar to '0'  coz if user don't fill dollar in form ,
	 // it will error. so fill zero if there is null
	 $toms_dollar=$string_class->check_null_fill_zero($toms_dollar,$counter);
	 $yen=$string_class->check_null_fill_zero($yen,$counter);
   $car_shop_price=$string_class->check_null_fill_zero($car_shop_price,$counter);
   
   
   
	for ($i=0;$i<$counter;$i++)
	{
		echo "<TR><TD>";
		if ($have_record[$i]>=1)
		   {
		   	$sql="update sheet1 set update_date=now(), model='".$model[$i]."', notes='".$notes[$i]."' , toms_dollar=".$toms_dollar[$i]." , yen=".$yen[$i]." , car_shop_price=".$car_shop_price[$i]."  where goods_partno='".$goods_partno[$i]."'";
		   echo "update</td>";
		  }
		else
		{
		   $sql="INSERT INTO `sheet1` (`goods_partno`,`model`,`notes`,`toms_dollar`,`yen` ,`car_shop_price`,`create_date`,`update_date`)  VALUES ('$goods_partno[$i]','$model[$i]','$notes[$i]',$toms_dollar[$i],$yen[$i],$car_shop_price[$i],now(),now())";
		   echo "insert</td>";
		 }	
		//echo $sql;
		
	
		
		$result = mysql_query($sql);
		//if (!$result) {   die('Invalid query: ' . mysql_error());	}

		//$row=mysql_fetch_array($result);
		echo "<TD>".$goods_partno[$i]."</Td>";

			echo "<TD>OK</td></tr>";
		echo "<P>";
		
	}
	echo "</table>";
	echo "<a href=excel_add.php> INSERT AGAIN </a>";
}

?>
<html>
<head>
<title>for add wai's excel toms & trd shop</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<script language="JavaScript" src="./include/javascript.js"></script>
<script language="javascript">

function checkform(i)
{
	if (i==1)
	{
		//action 1 page 1 view the result in text area
		document.form1.act.value=1;
	}
	else if (i==2)
	{
		//action 2 page 2 update goods_partno;
		document.form1.act.value=2;
	}
       document.form1.submit();
}
</script>


<script language="JavaScript">


<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->

//-->//-->
</script>
<style type="text/css">
<!--
body {
	background-color: #336699;
}
.style1 {
	color: #000000;
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
	font-size: 14px;
	font-style: normal;
	background-color: #CCCCCC;
}
.style2 {
	color: #000000;
	background-color: #CCCCCC;
}
.style4 {font-style: normal; background-color: #999999; color: #000000; font-weight: bold;}
-->
</style></head>


<? if ($act=="" || $act==1)
{
	?>
<body text="#000000">

  <table width="62%" border="0" cellpadding="3" cellspacing="0" bordercolor="#999999">
    <tr> 
      <td width="21%"><font color="#FFFFFF" size="2" face="新細明體">新增編號.:</font> <font face="新細明體" color="#FFFFFF" size="2">      </font></td>
      <td width="10%"><font face="新細明體" color="#FFFFFF" size="2"> 
        <?
         echo '<input type="hidden" name="invoice_no" value=',$invoice_no,' class="login">';
     ?>
        </font></td>
      <td width="39%"><font color="#FFFFFF" size="2" face="新細明體">Check日期: </font></td>
      <td width="30%"><font face="新細明體" color="#FFFFFF" size="2"> 
        <input type="text" name="invoice_date" value='<? echo Date("d/m/Y"); ?>' class="login">
        </font> </td>
      
    </tr>
</table>
  
  <form name="form1" method="post" action="excel_add.php">
  <table width="754" border="1" cellpadding="3" cellspacing="0" bordercolor="#999999">
    <tr> 
      <td width="13%" class="style1"><strong class="style1">REC.ID</strong></td>




      <td width="70%" class="style1"><span class="style1"><font face="新細明體" size="2">PARTNO.</font></span></td>
      <td width="70%" class="style1"> MODEL </td>
      <td width="70%" class="style1"> NOTES </td>
      <td width="70%" class="style1">TOMS</td>
      <td width="70%" class="style1"> YEN </td>
      <td width="70%" class="style1"> 車房價 </td>
      <td rowspan="31" width="17%"><a href="JavaScript:checkform(<?if ($act==null){echo "1";}else{echo "2";}?>);"><img src="submit<?if ($act==null){echo "2";}else{echo "3";}?>.png" width="47" height="700" border="0"></a></td>
    </tr>
    <? 
    $elements_counter=0;
    $model_elements_counter=1;
    for ($i=0;$i<20;$i++)
   {
    ?>
    <tr> 
      <td width="13%"> <font face="新細明體" color="#FFFFFF" size="4"> 
        <? echo $i+1;?>
        </font> 
        <div align="center"></div>
      </td>
      <td width="70%">
        <div align="left">
      <?
      /////20041210
      //cal next text box elements no.
      $temp_elements_counter=$elements_counter;
      $temp_model_elements_counter=$model_elements_counter;
      if ($temp_elements_counter==133)
      {
      	$temp_elements_counter=0;
      	
      }
      else if ($temp_elements_counter==0)
      {
      	$temp_elements_counter=7;
      	$elements_counter=7;
      }
      else
      {
      	$temp_elements_counter+=7;
      	$elements_counter+=7;
      }
      
      if ($temp_model_elements_counter==134)
      {
      	$temp_model_elements_counter=1;
      	
      }
      else if ($temp_model_elements_counter==1)
      {
      	$temp_model_elements_counter=8;
      	$model_elements_counter=8;
      }
      else
      {
      	$temp_model_elements_counter+=7;
      	$model_elements_counter+=7;
      }
      ?>
          <input name="goods_partno[]" type="text" size="20" value="<?echo $goods_partno[$i];?>" onkeypress="return next_text_box(<?echo $temp_elements_counter;?>);">      
        </div></td>
      <td width="70%">
        <div align="left">
          <input name="model[]" type="text" id="model[]" size="20" value="<?echo $model[$i];?>"  onkeypress="return next_text_box(<?echo $temp_model_elements_counter;?>);">
        </div></td>
      <td width="70%">
        <div align="left">
          <textarea name="notes[]" cols="30" id="notes[]" ><?echo $notes[$i];?></textarea>
        </div></td>
      <td width="70%">
        <div align="left">
          <input name="toms_dollar[]" type="text" id="toms[]" size="6" value="<?echo $toms_dollar[$i];?>">
        </div></td>
      <td width="70%">
        <div align="left">
          <input name="yen[]" type="text" id="yen[]" size="6" value="<?echo $yen[$i];?>">
        </div></td>
      <td width="70%">
        <div align="left">
          <input name="car_shop_price[]" type="text" id="car_shop_price[]" size="6" value="<?echo $car_shop_price[$i];?>">
        </div></td>

       <td ><?echo $have_record[$i];?></td>  
         
          <input name="have_record[]" type="hidden" id="have_record[]" value="<?echo $have_record[$i];?>">
       
    </tr>
    <?
    }
    ?>
  </table>
<input type=hidden name=act value=>
</form>
 
  <td colspan="3">&nbsp;</td>

</form>
</body>
<? }?>
</html>
