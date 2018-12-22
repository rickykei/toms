<?php
 require_once 'DB.php';
 
$dsn = 'mysql://root:@localhost/toms';
      $db = DB::connect($dsn);
	//  $result=$db->query("SET NAMES 'big5'");
	   if (DB::isError($db))
      die($db->getMessage());
	  

?>
