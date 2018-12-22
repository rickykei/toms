<?
  include_once("../include/config.php");
  $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());

   // (Run the query on the winestore through the connection
   $result = $connection->query("SET NAMES 'UTF8'");
  if (DB::isError($result))
      die ($result->getMessage());
	  $sql="select * from member where member_id='".$_GET['mem_id']."'";
	  $result = $connection->query($sql);
	  while(  $row = $result->fetchRow(DB_FETCHMODE_ASSOC))
	  {
		$mem_name=$row['member_name'];
		$mem_add=$row['member_add'];
		$mem_credit_level=$row['creditLevel'];
	  }


echo '<item><name>mem_name</name><value>'.$mem_name.'</value></item><item><name>mem_credit_level</name><value>'.$mem_credit_level.'</value></item>';
if ($mem_add=="")
{
echo '<item><name>mem_add</name><value> </value></item>';
}
else
{
echo '<item><name>mem_add</name><value>'.$mem_add.'</value></item>';
}

