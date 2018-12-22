<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
</head>
<body><table border=1><?php
   include_once("../include/config.php");
   $query="SET NAMES 'UTF8'";
    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());

   // (Run the query on the winestore through the connection
   $result = $connection->query("SET NAMES 'UTF8'");
   $result = $connection->query("SELECT * FROM sumgoods order by goods_partno");

   if (DB::isError($result))
      die ($result->getMessage());

   // While there are still rows in the result set, fetch the current
   // row into the array $row
   ?><TR><TD>ID</TD><TD>PART_NO</TD><TD>PARTID</TD><TD>DESCRIPTION</TD>?TD>MARKET PRICE</TD><TD>ALLSTOCK</TD><TD>STATUS</TD><TD>ADMIN_VIEW</TD><TD>REMARK</TD><TD>MODEL</TD></TR>
    <?php while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC))
   {
     // Print out each element in $row, that is, print the values of
      // the attributes
      print "<tr>";
      foreach ($row as $attribute)
      {
      	print "<td>";
         print "{$attribute} ";
         print "</td>";
			}
			print "</tr>";
      print "\n";
   }
   ?></table>
</body></html>
