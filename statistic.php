<html><head><title>日曆</title>
<LINK REL=stylesheet HREF="../english.css" TYPE="text/css">
</head>
<body bgcolor="#0066cc" text="#000000">
<?
function printcalendar($month,$year)
{
$pass_salt="1";
$pass_plain="1";
$action = crypt($pass_plain, $pass_salt); 

if(!$day)
{$day = date(d);}
if(!$month)
	{$month = date(m);}
if(!$year)
	{$year = date(Y);}


$fecha_ut = mktime(0,0,0,$month,$day,$year);

$days_month = date(t,$fecha_ut);


$days_semana = date(w,mktime(0,0,0,$month,1,$year));


$month_top = $month;
if($month_top == 1)
	{$month_top = '一月';}
	elseif($month_top == 2)
		{$month_top = '二月';}
	elseif($month_top == 3)
		{$month_top = '三月';}
	elseif($month_top == 4)
		{$month_top = '四月';}
	elseif($month_top == 5)
		{$month_top = '五月';}
	elseif($month_top == 6)
		{$month_top = '六月';}
	elseif($month_top == 7)
		{$month_top = '七月';}
	elseif($month_top == 8)
		{$month_top = '八月';}
	elseif($month_top == 9)
		{$month_top = '九月';}
	elseif($month_top == 10)
		{$month_top = '十月';}
	elseif($month_top == 11)
		{$month_top = '十一月';}
	elseif($month_top == 12)
		{$month_top = '十二月';}


$month_ant = $month - 1;
$year_ant = $year;
if($month_ant == 0)
{
	$month_ant = 12;
	$year_ant = $year - 1;
}

$month_sig = $month + 1;
$year_sig = $year;
if($month_sig == 13)
{
	$month_sig = 1;
	$year_sig = $year + 1;
}
echo ("<center>") ;

$offset = $days_semana;
echo("
<table border=1 cellspacing=0 cellpadding=1 bordercolor=#8b0000 bordercolordark=#8b0000 bgcolor=#F5F5DC>
<tr>
	<td align=center><a href=\"$PHP_SELF?month=$month_ant&year=$year_ant\"><font size=1 color=red>&lt;</font></a></td>
	<td colspan=5 align=center><b><a href=$PHP_SELF?day=0&month=$month&year=$year&action=$action><font size=1 color=red>$month_top $year</font></a></b></td>
	<td align=center><a href=\"$PHP_SELF?month=$month_sig&year=$year_sig\"><font size=1>&gt;</font></a></td>
</tr>
<tr>
	<td align=center><b><font color=red size=2>星期日</font></b></td>
	<td align=center><b><font size=2>星期一</font></b></td>
	<td align=center><b><font size=2>星期二</font></b></td>
	<td align=center><b><font size=2>星期三</font></b></td>
	<td align=center><b><font size=2>星期四</font></b></td>
	<td align=center><b><font size=2>星期五</font></b></td>
	<td align=center><b><font size=2>星期六</font></b></td>
</tr>");
$tot_cel = $days_month + $offset;
$i = 0;
$a = 1;
while($i <= $tot_cel)
{
$ii = 1;
echo("<tr>");

	while($ii <= 7)
	{
		if($offset)
		{
			while($i <= $offset - 1)
			{
			echo("<td><font size=1 color=red>&nbsp;</font></td>");
			$i++;
			$ii++;
			}
		}
		
		if($a < $days_month+1)
		{
			if($a == date(d) AND $month == date(m) AND $year == date(Y))
			{
			$hoy = '#deb887';
			}
			elseif ($ii==1) 
			{	$hoy = "pink" ; }
			else
			{
			$hoy = '';
			}
echo("<td align=center bgcolor=$hoy><a 
href=$PHP_SELF?day=$a&month=$month&year=$year&action=$action><font 
face=verdana 
size=1 color=red>$a</font></a></td>");
		$i++;
		$ii++;
		$a++;
		}
		elseif($i >= $days_month)
		{
		echo("<td><font size=1>&nbsp;</font></td>");
		$i++;
		$ii++;
		}
	}
echo("</tr>");
}
}


if ($action=="")
{
printcalendar($month,$year);
}
else
{

?>
<table border="0" cellpadding="1" cellspacing="1" class="login" width=100%><tr>
<td width=5%>
<font color=000000><?echo "invoice_no";?></font>
</td>
<td width=10%>
<font color=000000><?echo "invoice_date";?></font>
</td>
<td width=10%>
<font color=000000><?echo "customer_name";?></font>
</td>
<td width=10%>
<font color=000000><?echo "goods_partno";?></font>
</td>
<td width=10%>
<font color=000000><?echo "qty";?></font>
</td>
<td width=10%>
<font color=000000><?echo "marketprice";?></font>
</td>
<td width=10%>
<font color=000000><?echo "discountrate";?></font>
</td>
<td width=10%>
<font color=000000><?echo "amount";?></font>
</td>
<td width=10%>
<font color=000000><?echo "sales";?></font>
</td>
</tr>
<?

$total=0.00;
include("./config.php3");
if ($day==0)
{
$rows=mysql_query("select * from invoice ,goods_invoice where invoice.invoice_no=goods_invoice.invoice_no && month(invoice.invoice_date)=$month && year(invoice.invoice_date)=$year order by invoice.invoice_no desc"); 
}else
{$rows=mysql_query("select * from invoice ,goods_invoice where invoice.invoice_no=goods_invoice.invoice_no && month(invoice.invoice_date)=$month && year(invoice.invoice_date)=$year && DAYOFMONTH(invoice.invoice_date)=$day order by invoice.invoice_no desc"); }

while($row=mysql_fetch_array($rows))
{
?>
<? if ($day!=0)
{?>
<table border="0" cellpadding="1" cellspacing="1" class="login" width=100%><tr>
<td width=5% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["invoice_no"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["invoice_date"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["customer_name"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["goods_partno"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}
else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["qty"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}
else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["marketprice"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}
else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["discountrate"];?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}
else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>> 
<?$amount=((100-$row["discountrate"])/100)*$row["qty"]*$row["marketprice"];?>
<font color=000000><?echo number_format($amount,2,'.',',');?></font>
</td>
<td width=10% align=right <?if (($row["invoice_no"]%2)==1){echo "bordercolor=\"#FFFFFF\" bgcolor=\"#CCCCCC\"";}
else{echo "bordercolor=\"#FFFFFF\" bgcolor=\"#BBBBBB\"";}?>>
<font color=000000><?echo $row["sales_name"];?></font>
</td>
</tr>
<?
$total+=$amount;
echo "</table>";
}
else
{
$amount=((100-$row["discountrate"])/100)*$row["qty"]*$row["marketprice"];
$total+=$amount;
}
}

echo "STATISTIC OF ".$year."-".$month."-".$day;
echo "TOTAL =".number_format($total,2,'.',',');
}
?>
</table>
</center>
<hr>
<a href=<?echo $PHP_SELF;?>>返回上頁</a>
<a href=../index.php3>退回主頁</a>
</body>
</html>
