<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<LINK REL=stylesheet HREF="english.css" TYPE="text/css">
<body bgcolor="#0066cc" text="#000000">
<?
$date=date("d-m-y_h-i-s");
echo "$date";
$openstring="/home/vhost/tomsracing.com/member/";
$openstring.="member";
$openstring.=".csv";

   include("./../config.php3");
$fp=fopen("$openstring","w");
   $string="";

$query1="select * from member order by mem_id";
   
   if ($sort==1 || $sort=="")
   $rows=mysql_query($query1);
   if (!$rows)
      echo "Too Bad!\n";
   else {
   
$openstring="<a href=\"member";
$openstring.=".csv\">mem_excel</a>";

      echo "$openstring";

      echo '</tr>',"\n";
$string="no., �|���s��, �^��W ,����W ,���������X ,date of birth ,�q�� ,�q��2 ,�a�} ,����1 ,����1 ,���~1 ,����2 ,����2 ,���~2 ,�J�|��� ,exp date  ,barcode ,�ק�";
$string.="\n";
      $chodd=0;
      while ($row=mysql_fetch_row($rows))
      {
         list($id,$mem_id,$mem_name_eng,$mem_name_chi,$mem_hkid,$mem_dob,$mem_tel,$mem_tel2,$mem_add,$mem_carno,$mem_cartype,$mem_caryear,$mem_carno2,$mem_cartype2,$mem_caryear2,$apply_date,$exp_date,$other,$barcode)=$row;


	for ($i=0;$i<count($rows);$i++)
         {
             
$string.="\"$id\","."\"$mem_id\","."\"$mem_name_eng\","."\"$mem_name_chi\","."\"$mem_hkid\","."\"$mem_dob\","."\"$mem_tel\","."\"$mem_tel2\","."\"$mem_add\","."\"$mem_carno\","."\"$mem_cartype\","."\"$mem_caryear\","."\"$mem_carno2\","."\"$mem_cartype2\","."\"$mem_caryear2\","."\"$apply_date\","."\"$exp_date\","."\"$other\","."\"$barcode\","."\n";
          // fputs($fp,$string);
$chodd=$chodd+1;
         }
      }
      //echo "$string";
   }
fputs($fp,$string);
fclose($fp);

?>
</body>
</html>
