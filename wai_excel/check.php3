<?
include "class.php";
$bar=new table("select goods_partno as 'part_no',model as '����',notes as '�Ƶ�',toms_dollar as 'Toms',yen as 'yen1' ,car_shop_price as '���л�' from sheet1  ",0,"sheet1",$HTTP_SERVER_VARS["PHP_SELF"]);
get_class($bar);
$bar->table_goods_show_printing($offset,$rowset);  
?>
