<SCRIPT LANGUAGE="JavaScript">
function check_del(aa)
{
var temp_pass = prompt('dfsdfd!');
var pass="123";

 if (temp_pass==pass)
 {
 alert(aa);
 window.location="check_price_del.php3?id="+aa;
 }
 else
 {
 alert('error');
 }
}

function view_detail(aa)
{


 
 window.location="check_price_view.php3?id="+aa;
 
}
</script>


<?
include "class.php";
$bar=new table("select goods_partno as 'part_no',model as '車種',notes as '備註',toms_dollar as 'Toms',yen as 'yen1' ,car_shop_price as '車房價' from sheet1  ",0,"sheet1",$HTTP_SERVER_VARS["PHP_SELF"]);
get_class($bar);
$bar->table_goods_show_printing($offset,$rowset);  
?>