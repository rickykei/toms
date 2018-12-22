<?php

$browseryrt = $_SERVER['HTTP_USER_AGENT'];
list($LTD,$AREA,$PC) =  split("_",$browseryrt);
$LTD=strtoupper($LTD);
$AREA=strtoupper($AREA);
$PC=strtoupper($PC);

$shop_array = array ( "A","Y","H","F","B");
$shopAddress[0]="九龍旺角塘尾道66-68號福強工業大廈E-H座地下";
$shopAddress[1]="九龍旺角塘尾道85-95號長豐大廈A-M舖地下";
$shopAddress[2]="香港灣仔告士打道200號新銀集團中心地下2號舖";
$shopAddress[3]="新界火炭坳背灣街38-40號華衛工貿中心1號地舖";
$shopAddress[4]="九龍旺角鴉蘭街7號連勝大廈地下";
$shopDetail[0]="TEL : 2393-9335, 2787-7678 FAX : 2393-8707";
$shopDetail[1]="TEL : 2412-2335, 2412-2241 FAX : 2413-3373";
$shopDetail[2]="TEL : 2891-8039, 2891-8019 FAX : 2891-8330";
$shopDetail[3]="TEL : 2393-9345 FAX : 2687-6870";
$shopDetail[4]="TEL : 2393-9335, 2787-7678 FAX : 2393-8707";


if($LTD=="YRT")
{
	require_once 'DB.php';
$dsn = 'mysql://wood:wood2009@localhost/wood';
//	$dsn = 'mysql://root:@localhost/wood';
//$dsn = 'mysql://root:@localhost/wood';
      $db = DB::connect($dsn);
	  $result=$db->query("SET NAMES 'UTF8'");

 
	   if (DB::isError($db))
      die($db->getMessage());
	$sql=" SELECT name FROM  `staff`  WHERE pc =  '".$PC."' AND upper(area) =  '".$AREA."' ";
	
	$result=$db->query($sql);
	if (DB::isError($result))
    	  die ($result->getMessage());
	else	  
		$row=$result->fetchRow(DB_FETCHMODE_ASSOC);
  
	$USER=$row["name"];
	$row="";
}else{
echo "@Y@";
}

 

?>
