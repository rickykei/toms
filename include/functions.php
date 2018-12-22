<?php


function sqllog($sql)
{
	include("../include/config.php");
    $query="SET NAMES 'UTF8'";
    $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());

		$sql2 = str_replace("'", "''", "$sql");
		$username = $_SESSION[user_name];
		$ip_addr = $_SERVER['REMOTE_ADDR'];
		$page = $_SERVER['PHP_SELF'];
		$log_sql = "INSERT INTO sql_log SET
					ip_addr = '$ip_addr',
					area = '$AREA',
					pc = '$PC',
					username = '$username',
					page = '$page',
					sql_stmt = '$sql2'";
	 	$result=$connection->query($log_sql);
	  if (DB::isError($result))
    	  die ($result->getMessage());
	
}

function chkUserName($dsn,$area,$pc)
{
	 
    $query="SET NAMES 'UTF8'";
    $connection = DB::connect($dsn);
	   if (DB::isError($connection))
      die($connection->getMessage());
	$sql=" SELECT name FROM  `staff`  WHERE pc =  '".$pc."' AND area =  '".$area."' ";
	$result=$connection->query($sql);
	if (DB::isError($result))
    	  die ($result->getMessage());
    $row=$result->fetchRow(DB_FETCHMODE_ASSOC);
    return $row["name"];
}

?>