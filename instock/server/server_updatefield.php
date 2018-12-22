<?
  include_once("../include/config.php");
  $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());

   // (Run the query on the winestore through the connection
   $result = $connection->query("SET NAMES 'UTF8'");
  if (DB::isError($result))
      die ($result->getMessage());
      //$sql="SELECT ins.goods_detail, ins.market_price FROM goods_instock ins, sumgoods sum WHERE ins.goods_partno = '".$_GET['mph']."' AND ins.goods_partno = sum.goods_partno ORDER BY ins.id DESC LIMIT 0 , 1 ";
	  $sql="select ins.market_price,ins2.market_price as m2,sum.goods_detail from sumgoods sum left join goods_instock ins on sum.goods_partno= ins.goods_partno left join wood.goods_instock ins2 on sum.goods_partno= ins2.goods_partno  where sum.goods_partno='".$_GET['mph']."' and sum.status='Y'  ORDER BY ins.id DESC LIMIT 0 , 1  ";
	  $result = $connection->query($sql);
	  while(  $row = $result->fetchRow(DB_FETCHMODE_ASSOC))
	  {
	  if ($row['market_price']!="")
	  $kph=$row['market_price'];
		else
	  $kph=$row['m2'];
	  $mps=$row['goods_detail'];
	  }
	 
if ($kph == "" || $kph ==null)
$kph=0; 
echo '<item><name>market_price'.$_GET['num'].'</name><value>'.$kph.'</value></item><item><name>goods_detail'.$_GET['num'].'</name><value>'.$mps.'</value></item>';

