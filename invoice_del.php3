<html>
<title>
</title>
<body onLoad= "document.location='invoiceshow.php3?offset=0&rowset=30'">

<?

 include("config.php3");
 $query="delete from invoice where invoice_no='$id'";
 $query2="delete from goods_invoice where invoice_no='$id'";
 $rows=mysql_query($query);
 if (!$rows)
      echo "Too Bad!\n";
 else
  echo "del success!\n";
  $rows=mysql_query($query2);
  if (!$rows)
      echo "Too Bad!\n";
 else
  echo "del success!\n";
 ?>
</body>
</html>
