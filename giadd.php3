<?
   include("config.php3");

   $query="insert into goods_invoice (invoice_no,goods_id,ext_price,status) values ('$invoice_no',$goods_id,$ext_price,'$status')";

   if (mysql_query($query))
      echo "Success!";
   else
      echo "Too Bad!";
?>
