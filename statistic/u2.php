<html>
<html><head><title>TOM'S & TRD SHOP STATISTIC2</title>

<meta http-equiv="Content-Type" content="text/html; charset=big5"></head>
<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body bgcolor>
<?php
if ($hello!="")
{

//$handin=$_POST["handin_year"]."-".$_POST["handin_month"]."-".$_POST["handin_day"]." 00:00:00";
$handin=$handin_year."-".$handin_month."-".$handin_day." 00:00:00";
echo $handin;
//$exp_date=$_POST["exp_year"]."-".$_POST["exp_month"]."-".$_POST["exp_day"]." 23:59:59";
$exp_date=$exp_year."-".$exp_month."-".$exp_day." 23:59:59";
echo $exp_date;

include("./config.php3"); 

$qry="select *,round(sum(round(goods_invoice.marketprice*((100-goods_invoice.discountrate)/100))*goods_invoice.qty),2) as aa from invoice,goods_invoice where invoice.invoice_no=goods_invoice.invoice_no and invoice.invoice_date >= \"$handin\" && invoice.invoice_date <= \"$exp_date\" group by invoice.invoice_no order by invoice.invoice_date ";
echo $qry;
$result=mysql_query($qry);
$count = mysql_num_fields($result);
//echo "<p>".$count."p";
$count=mysql_num_rows($result); 
echo $count;

       
echo '<table width="100%" border="1" class="login">';
echo '<tr>';
echo '<td>發票編號 </td>',"\n";
echo '<td>total amount</td>',"\n";
echo '<td>發票日期 </td>',"\n";
echo '<td>售貨人 </td>',"\n";
echo '<td>買貨人 </td>',"\n";
echo '<td>電話 </td>',"\n";
echo '<td>會員編號 </td>',"\n";

echo '</tr>',"\n";
     $str_="<tr><td>發票編號 </td><td>total amount</td><td>發票日期 </td><td>售貨人 </td><td>買貨人 </td><td>電話 </td><td>會員編號 </td></tr>";
     $gendate="";
while ($row=mysql_fetch_array ($result))
{
	if ($gendate==substr($row["invoice_date"],0,7))
	{
		//20091201 rounding invoice >74102
			 if ($row["invoice_no"]>74102){
				// round 20091201
				//$subtotal[$gendate]=$subtotal[$gendate]+round($row["round(sum(goods_invoice.marketprice*goods_invoice.qty*(100-goods_invoice.discountrate)/100),2)"]);
				// round 20101215
				$subtotal[$gendate]=$subtotal[$gendate]+round($row["aa"]);
				}else{
				$subtotal[$gendate]=$subtotal[$gendate]+$row["aa"];
				}
			//20091201 rounding invoice >74102		
	}
	else
	{
		if ($gendate!="")
		{
		$str_.="<tr><td>".$gendate." subtotal</td><td>".$subtotal[$gendate]."</td></tr>";
		echo "<tr><td>".$gendate." subtotal</td><td>".$subtotal[$gendate]."</td></tr>";
		}
	$gendate=substr($row["invoice_date"],0,7);
	
			//20091201 rounding invoice >74102
			 if ($row["invoice_no"]>74102){
				// round 20091201
				//$subtotal[$gendate]=round($row["round(sum(goods_invoice.marketprice*goods_invoice.qty*(100-goods_invoice.discountrate)/100),2)"]);
				// round 20101215
				$subtotal[$gendate]=round($row["aa"]);
				}else{
				$subtotal[$gendate]=$row["aa"];
			}
			//20091201 rounding invoice >74102	
	}

	
	if ($row["member_id"]==null || $row["member_id"]==0)
	{
		
			//20091201 rounding invoice >74102
			 if ($row["invoice_no"]>74102){
				// round 20091201
				$str1="<tr><td>".$row["invoice_no"]."</td><td>".number_format(round($row["aa"]),2)."</td><td>".$row["invoice_date"]."</td><td>".$row["sales_name"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_tel"]."</td></tr>";
				}else{
					$str1="<tr><td>".$row["invoice_no"]."</td><td>".$row["aa"]."</td><td>".$row["invoice_date"]."</td><td>".$row["sales_name"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_tel"]."</td></tr>";
				}
				//20091201 rounding invoice >74102	
	}
	else
	{
		$str2="select mem_name_eng,mem_name_chi,mem_tel,mem_tel2 from member where mem_id=".$row['member_id'];
		$result2=mysql_query($str2);
		$row2=mysql_fetch_array ($result2);
		if ($row2["mem_name_eng"]=="")
			$mem_name=$row2["mem_name_chi"];
		else
			$mem_name=$row2["mem_name_eng"];
			
		if ($row2["mem_tel"]=="")
			$mem_tel=$row2["mem_tel2"];
		else
			$mem_tel=$row2["mem_tel"];
			
	 	//20091201 rounding invoice >74102
			 if ($row["invoice_no"]>74102){
				// round 20091201
				$str1="<tr><td>".$row["invoice_no"]."</td><td>".round($row["aa"])."</td><td>".$row["invoice_date"]."</td><td>".$row["sales_name"]."</td><td>".$mem_name."</td><td>".$mem_tel."</td><td>".$row["member_id"]."</td></tr>";
				}else{
				$str1="<tr><td>".$row["invoice_no"]."</td><td>".$row["aa"]."</td><td>".$row["invoice_date"]."</td><td>".$row["sales_name"]."</td><td>".$mem_name."</td><td>".$mem_tel."</td><td>".$row["member_id"]."</td></tr>";
				}
			//20091201 rounding invoice >74102		
	}//endif

echo $str1;
$str_.=$str1;
}//endwhile


echo "<tr><td>".$gendate." subtotal</td><td>".$subtotal[$gendate]."</td></tr>";
$str_.="<tr><td>".$gendate." subtotal</td><td>".$subtotal[$gendate]."</td></tr>";
$total=array_sum($subtotal);
echo "<tr><td>total=".$total."</td></tr>";
$str_.="<tr><td>total=".$total."</td></tr>";
$str_=str_replace("<tr>","",$str_);
$str_=str_replace("<td>","\"",$str_);
$str_=str_replace("</td>","\",",$str_);
$str_=str_replace("</tr>","\n",$str_);

$date=date("d-m-y_h-i-s");
$openstring=$date.".csv";
$fp=fopen("/home/vhost/tomsracing.com.hk/statistic/record/$date.csv","w");
fputs($fp,$str_);
fclose($fp);
echo "</table>";
echo "<a href=\"./record/".$date.".csv\"> download excel format</a>";
//echo $str_;
}
//end if
?>
<form action="<? $PHP_SELF ?>" method="POST" enctype="multipart/form-data">

  <table width="75%" border="0" cellpadding="0" cellspacing="0">

    <tr> 
      <td width="15%">Handin</td>
      <td width="51%"> 年
        <select name="handin_year">
        <option value="2001" selected>2001</option>
          <option value="2002" >2002</option>
          <option value="2003" >2003</option>
          <option value="2004">2004</option>
	  <option value="2005">2005</option>
	  <option value="2006">2006</option>
	  <option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>

        </select>
        月 
        <select name="handin_month">
          <option value="01" selected>1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        日
        <select name="handin_day">
          <option value="01" selected>1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
      </td>
      <td width="34%">&nbsp;</td>
    </tr>
    <tr> 
      <td width="15%">Exp_Date</td>
      <td width="51%">年 
        <select name="exp_year">
          <option value="2002" selected>2002</option>
          <option value="2003" >2003</option>
          <option value="2004">2004</option>
	  <option value="2005">2005</option>
   	  <option value="2006">2006</option>
	     	  <option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
        </select>
        月 
        <select name="exp_month">
          <option value="01" selected>1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        日 
        <select name="exp_day">
          <option value="01" >1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31" selected>31</option>
        </select>
      </td>
      <td width="34%">&nbsp;</td>
    </tr>
 
    <tr> 
      <td width="15%"> 
        <input type="submit" value="開始上傳" name="submit">
        <input type="hidden" value="1" name="hello">
      </td>
      <td width="51%">&nbsp;</td>
      <td width="34%">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <br>
  <br>


  
    
  <p>&nbsp; </p>
</form>


<?

?>
</body>
</html>
