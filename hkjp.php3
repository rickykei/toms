<?php
   include_once("config.php3");
   include_once("./include/config.php");
      $connection = DB::connect($dsn);

   if (DB::isError($connection))
      die($connection->getMessage());
  
  
  
if ($add==1)
{
$hk=$_POST['hk'];
$query1="update hkjp set hk=$hk ";
 if( mysql_query($query1))
 echo "success";
 else
 echo "error";
 echo $hk;
          
}else{
  $query="select * from hkjp";
  
    $result=$connection->query($query);


	while($coRow = $result->fetchRow(DB_FETCHMODE_ASSOC)){
		$hk=$coRow['hk'];
	}
}?>
<html>
<head>

<title>hkjp</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">

<script language="JavaScript">
function checkform()
{
	if(document.hkjpform.hk.value == "")
	{
	alert ("請輸入hk$.");
	document.ingoodnameform.hk.focus();
	}else
	{
        document.hkjpform.submit();
        }

}

</script>
</head>
<body bgcolor="#0066cc" text="#000000">
<form name=hkjpform method="post" action="hkjp.php3">
  <p>1&yen;> $hk <?php echo $hk;?>: 
    <input type="hidden" name="add" value=1 class="login">
    <input type="text" name="hk" maxlength="10" class="login">
  <p><a href="JavaScript:checkform();"><img src="submit.gif" border=0></a>
  </form>
  </body>
  </html>