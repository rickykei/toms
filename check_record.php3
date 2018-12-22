<?
include("config.php3");
//$rows=mysql_query("select invoice.invoice_date, goods_invoice.marketprice, goods_invoice.invoice_no,goods_invoice.goods_id,goods_invoice.goods_partno from invoice,goods_invoice where invoice.invoice_no = goods_invoice.invoice_no and invoice.customer_name like \"%$member_id%\" order by invoice.invoice_date desc;"); 
$rows=mysql_query("select * from invoice, goods_invoice where invoice.invoice_no = goods_invoice.invoice_no and invoice.customer_name like \"%$member_id%\" order by invoice.invoice_date desc;"); 
while($row=mysql_fetch_array($rows))
{
echo $row["invoice_date"].$row["goods_partno"].$row["goods_id"].$row["marketprice"].$row["invoice_no"].$row["customer_name"].$row["member_id"];
echo "<p>";
}
 ?>